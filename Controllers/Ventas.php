<?php

class Ventas extends Controller {
    public function __construct() {
        session_start();
        parent::__construct();
    }

    public function index() {
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'ventas');
        if(!empty($verificar) || $id_usuario == 1){
            $data = $this->model->getClientes();
            $this->views->getView($this, "index", $data);
        } else {
            header('Location:' .base_url. 'Errors/permisos');
        }
    }

    public function buscarCodigoVentas($codigo) {
       $data = $this->model->getProCod($codigo);
       echo json_encode($data, JSON_UNESCAPED_UNICODE);
       die();
    }

    public function ingresar() {
        $id = $_POST['id'];
        $fecha = date('Y-m-d');
        $datos = $this->model->getProductoById($id);
        $id_producto = $datos['id'];
        $id_usuario = $_SESSION['id_usuario'];
        $precio = $datos['precio_venta'];
        $precio_bolos = $datos['precio_venta_bolos'];
        $cantidad = $_POST['cantidad'];
        $comprobar = $this->model->consultarDetalleVenta($id_producto, $id_usuario);
        if (empty($comprobar)) {
            if ($datos['cantidad'] >= $cantidad) {
                $sub_total = $cantidad * $precio;
                $sub_total_bolos = $cantidad * $precio_bolos;
                $data = $this->model->registrarDetalleVentas($id_producto, $id_usuario, $precio, $precio_bolos, $cantidad, $sub_total, $sub_total_bolos, $fecha);
                if($data == "ok") {
                    $msg = array('msg' => 'Producto Ingresado a la Venta', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error Ingresando Producto a la Venta', 'icono' => 'error');
                }
            } else {
                $msg = array('msg' => 'Cantidad Supera el Stock Disponible, Solo quedan: ' . $datos['cantidad'], 'icono' => 'warning');
            }            
        } else {
            $total_cantidad = $comprobar['cantidad'] + $cantidad;
            $sub_total = $total_cantidad * $precio;
            $sub_total_bolos = $total_cantidad * $precio_bolos;
            if ($datos['cantidad'] < $total_cantidad) {
                $msg = array('msg' => 'Cantidad Supera el Stock Disponible', 'icono' => 'warning');
            } else {
                $data = $this->model->actualizarDetalleVenta($precio, $precio_bolos, $total_cantidad, $sub_total, $sub_total_bolos, $fecha, $id_producto, $id_usuario);
                if($data == "ok") {
                    $msg = array('msg' => 'Producto Actualizado', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error Actualizando Producto', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function listar() {
        $id_usuario = $_SESSION['id_usuario'];
        $data['detalle'] = $this->model->getDetallesVenta($id_usuario);
        $data['total_pagar'] = $this->model->calcularVenta($id_usuario);
        $data['total_pagar_bolos'] = $this->model->calcularVenta($id_usuario);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function delete($id) {
        $data = $this->model->deleteDetalleVenta($id);
        if ($data == "ok") {
            $msg = array('msg' => 'Detalle Eliminado con éxito', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al registrar el Producto', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrarVenta($id_cliente) {
        $id_usuario = $_SESSION['id_usuario'];
        $abierta = $this->model->verificarCaja($id_usuario);
        if (empty($abierta)) {
            $msg = array('msg' => 'Para Realizar Ventas es Necesario Aperturar Caja', 'icono' => 'warning');
        } else {
            $fecha = date('Y-m-d');
            $total = $this->model->calcularVenta($id_usuario)['total'];
            $total_bolos = $this->model->calcularVenta($id_usuario)['total_bolos'];
            $data = $this->model->registrarVenta($id_usuario, $id_cliente, $total, $total_bolos, $fecha);
            if ($data == 'ok') {
                $detalles = $this->model->getDetallesVenta($id_usuario);
                $id_venta = $this->model->ultimaVenta();
                foreach ($detalles as $row) {
                    $cantidad = $row['cantidad'];
                    $precio = $row['precio'];
                    $precio_bolos = $row['precio_bolos'];
                    $id_producto = $row['id_producto'];
                    $sub_total = $cantidad * $precio;
                    $sub_total_bolos = $cantidad * $precio_bolos;
                    $this->model->registrarDetalleVenta($id_venta['id'], $id_producto, $cantidad, $precio, $precio_bolos, $sub_total, $sub_total_bolos, $fecha);
                    $stock_actual = $this->model->getProductoById($id_producto);
                    $stock = $stock_actual['cantidad'] - $cantidad;
                    $this->model->actualizarStock($stock, $id_producto);
                }
                $vaciar = $this->model->vaciarDetallesVenta($id_usuario);
                if ($vaciar == "ok") {
                    $msg = array('msg' => 'Venta Registrada', 'id_venta' => $id_venta['id'], 'icono' => 'success');
                }
            } else {
                $msg = array('msg' => 'Error al realizar la Venta', 'icono' => 'warning');
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function historialV() {
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'historialV');
        if(!empty($verificar) || $id_usuario == 1){
            $data = $this->model->getClientes();
            $this->views->getView($this, "historialV");
        } else {
            header('Location:' .base_url. 'Errors/permisos');
        }
    }

    public function listar_historial() {
        $data = $this->model->getHistorialVentas();
        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-success">Completada</span>';
                $data[$i]['acciones'] = '<div>
                <button type="button" class="btn btn-warning" onclick="btnAnularVenta('. $data[$i]['id'] .')"><i class="fas fa-ban"></i></button>
                <a class="btn btn-danger" href="' . base_url . "Ventas/generarPdfVenta/" . $data[$i]['id'] .'" target="_blank"><i class="fas fa-file-pdf"></i></button>
                <div/>';
            } else {
                $data[$i]['estado'] = '<span class="badge bg-danger">Anulada</span>';
                $data[$i]['acciones'] = '<div>
                <a class="btn btn-danger" href="' . base_url . "Ventas/generarPdfVenta/" . $data[$i]['id'] .'" target="_blank"><i class="fas fa-file-pdf"></i></button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function generarPdfVenta($id_venta) {
        $empresa = $this->model->getEmpresa();
        $productos = $this->model->getProVenta($id_venta);
        require('Libraries/fpdf/fpdf.php');

        $pdf = new FPDF('P', 'mm', array(94, 200));
        $pdf->addPage();
        $pdf->setMargins(5, 0, 0);
        
        $pdf->setTitle('Ticket de Venta');
        
        $pdf->setFont('Arial', 'B', 11);
        $pdf->Cell(65, 10, utf8_decode($empresa['nombre']), 0, 1, 'C');
        $pdf->image('Assets/img/logoempresa.png',5,8,9,8);
        
        $pdf->setFont('Arial', 'B', 7);
        $pdf->Cell(18, 5, 'R.I.F: ', 0, 0, 'L');
        $pdf->setFont('Arial', '', 7);
        $pdf->Cell(20, 5, $empresa['rif'], 0, 1, 'L');

        $pdf->Ln(0.1);

        $pdf->setFont('Arial', 'B', 7);
        $pdf->Cell(18, 5, 'Telefono: ', 0, 0, 'L');
        $pdf->setFont('Arial', '', 7);
        $pdf->Cell(20, 5, $empresa['telefono'], 0, 1, 'L');

        $pdf->setFont('Arial', 'B', 7);
        $pdf->Cell(18, 5, 'Direccion: ', 0, 0, 'L');
        $pdf->setFont('Arial', '', 7);
        $pdf->Cell(20, 5, utf8_decode($empresa['direccion']), 0, 1, 'L');

        $pdf->setFont('Arial', 'B', 7);
        $pdf->Cell(18, 5, 'Venta: ', 0, 0, 'L');
        $pdf->setFont('Arial', '', 7);
        $pdf->Cell(20, 5, $id_venta, 0, 1, 'L');
        $pdf->Ln();

        //Encabezados de Cliente
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->setFont('Arial', 'B', 6);
        $pdf->Cell(20, 5, 'Nombre', 0, 0, 'L', true);
        $pdf->Cell(20, 5, 'Telefono', 0, 0, 'L', true);
        $pdf->Cell(44, 5, 'Direccion', 0, 1, 'L', true);
        
        //Datos del Cliente
        $cliente = $this->model->getCliente($id_venta); 
        $pdf->setFont('Arial', '', 6);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(20, 5, utf8_decode($cliente['nombre']), 0, 0, 'L');
        $pdf->Cell(20, 5, $cliente['telefono'], 0, 0, 'L');
        $pdf->MultiCell(44, 5, utf8_decode($cliente['direccion']));

        $pdf->Ln();

        //Encabezados de Productos en la Venta
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(10, 5, 'Cant', 0, 0, 'L', true);
        $pdf->Cell(34, 5, 'Descripcion', 0, 0, 'L', true);
        $pdf->Cell(8, 5, 'Precio $', 0, 0, 'R', true);
        $pdf->Cell(12, 5, 'STotal $', 0, 0, 'L', true);
        $pdf->Cell(8, 5, 'Precio B', 0, 0, 'R', true);
        $pdf->Cell(12, 5, 'STotal B', 0, 1, 'R', true);
        
        //Productos en la Venta
        $pdf->SetTextColor(0, 0, 0);
        $total = 0.00;
        $total_bolos = 0.00;
        foreach($productos as $row) {
            $total += $row['sub_total'];
            $total_bolos += $row['sub_total_bolos'];
            $pdf->Cell(10, 5, $row['cantidad'], 0, 0, 'C');
            $pdf->Cell(35, 5, utf8_decode($row['descripcion']), 0, 0, 'L');
            $pdf->Cell(8, 5, $row['precio'], 0, 0, 'R');
            $pdf->Cell(12, 5, number_format($row['sub_total'], 2, ',', '.'), 0, 0, 'L');
            $pdf->Cell(8, 5, $row['precio_bolos'], 0, 0, 'R');
            $pdf->Cell(12, 5, number_format($row['sub_total_bolos'], 2, ',', '.'), 0, 1, 'R');
        }
        
        // Total de la Venta
        $pdf->Ln();
        $pdf->setFont('Arial', 'B', 7);
        $pdf->Cell(60, 5, 'Total a Pagar $:', 0, 0, 'R');
        $pdf->Cell(25, 5, 'Total a Pagar Bs:', 0, 1, 'R');
        $pdf->setFont('Arial', '', 7);
        $pdf->Cell(60, 5, number_format($total, 2, ',', '.'), 0, 0, 'R');
        $pdf->Cell(25, 5, number_format($total_bolos, 2, ',', '.'), 0, 0, 'R');
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Cell(0, 0, utf8_decode($empresa['mensaje']), 0, 0, 'C');
        $pdf->Output();
    }

    public function anularVenta($id_venta) {
        $data = $this->model->getVenta($id_venta);
        $venta = $this->model->anularVenta($id_venta);
        foreach ($data as $row){
            $stock_actual = $this->model->getProductoById($row['id_producto']);
            $stock = $stock_actual['cantidad'] + $row['cantidad'];
            $this->model->actualizarStock($stock, $row['id_producto']);
        }
        if ($venta == "ok") {
            $msg = array('msg' => 'Venta Anulada', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error Anulando Venta', 'icono' => 'error');
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function pdf() {
        $desde = $_POST['desde'];
        $hasta = $_POST['hasta'];
        if (empty($desde) || empty($hasta)) {
            $data = $this->model->getHistorialVentas();
        } else {
            $data = $this->model->getRangoFechas($desde, $hasta);
        }
        require('Libraries/fpdf/fpdf.php');

        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->addPage();
        $pdf->setMargins(10, 0, 0);
        $pdf->setTitle('Reporte de Ventas');
        $pdf->setFont('Arial', 'B', 12);

        //Encabezados de las Venta
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(20, 5, 'Id', 0, 0, 'C', true);
        $pdf->Cell(90, 5, 'Fecha', 0, 0, 'C', true);
        $pdf->Cell(30, 5, 'Cliente', 0, 0, 'C', true);
        $pdf->Cell(25, 5, 'Total', 0, 1, 'R', true);
        
        //Ventas Realizadas
        $pdf->setFont('Arial', '', 10);
        $pdf->SetTextColor(0, 0, 0);
        $total = 0.00;
        foreach($data as $row) {
            $total += $row['total'];
            $pdf->Cell(20, 5, $row['id'], 0, 0, 'C');
            $pdf->Cell(90, 5, $row['fecha'], 0, 0, 'C');
            $pdf->Cell(30, 5, $row['nombre'], 0, 0, 'C');
            $pdf->Cell(25, 5, number_format($row['total'], 2, ',', '.'), 0, 1, 'R');
        }
        
        // Total de la Venta
        $pdf->Ln();
        $pdf->setFont('Arial', 'B', 10);
        $pdf->Cell(165, 5, 'Total Ventas:', 0, 1, 'R');
        $pdf->Cell(165, 5, number_format($total, 2, ',', '.'), 0, 0, 'R');
        $pdf->Output();
    }
    
}