<?php

class Compras extends Controller {
    public function __construct() {
        session_start();
        parent::__construct();
    }

    public function index() {
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'compras');
        if(!empty($verificar) || $id_usuario == 1){
            $this->views->getView($this, "index");
        } else {
            header('Location:' .base_url. 'Errors/permisos');
        }
    }

    public function buscarCodigoCompras($codigo) {
       $data = $this->model->getProCod($codigo);
       echo json_encode($data, JSON_UNESCAPED_UNICODE);
       die();
    }

    public function ingresar() {
        $id = $_POST['id'];
        $datos = $this->model->getProductoById($id);
        $id_producto = $datos['id'];
        $id_usuario = $_SESSION['id_usuario'];
        $precio = $datos['precio_compra'];
        $precio_bolos = $datos['precio_compra_bolos'];
        $cantidad = $_POST['cantidad'];
        $comprobar = $this->model->consultarDetalleCompra($id_producto, $id_usuario);
        if (empty($comprobar)) {
            $sub_total = $cantidad * $precio;
            $sub_total_bolos = $cantidad * $precio_bolos;
            $data = $this->model->registrarDetalleCompras($id_producto, $id_usuario, $precio, $precio_bolos, $cantidad, $sub_total, $sub_total_bolos);
            if($data == "ok") {
                $msg = array('msg' => 'Producto Ingresado a la Compra', 'icono' => 'success');
            } else {
                $msg = array('msg' => 'Error Ingresando Producto a la Compra', 'icono' => 'error');
            }
        } else {
            $total_cantidad = $comprobar['cantidad'] + $cantidad;
            $sub_total = $total_cantidad * $precio;
            $sub_total_bolos = $total_cantidad * $precio_bolos;
            $data = $this->model->actualizarDetalleCompra($precio, $precio_bolos, $total_cantidad, $sub_total, $sub_total_bolos, $id_producto, $id_usuario);
            if($data == "ok") {
                $msg = array('msg' => 'Producto Actualizado', 'icono' => 'success');
            } else {
                $msg = array('msg' => 'Error Actualizando Producto', 'icono' => 'error');
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function listar() {
        $id_usuario = $_SESSION['id_usuario'];
        $data['detalle'] = $this->model->getDetallesCompra($id_usuario);
        $data['total_pagar'] = $this->model->calcularCompra($id_usuario);
        $data['total_pagar_bolos'] = $this->model->calcularCompra($id_usuario);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function delete($id) {
        $data = $this->model->deleteDetalleCompra($id);
        if ($data == "ok") {
            $msg = array('msg' => 'Detalle Eliminado con éxito', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al registrar el Producto', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrarCompra() {
        $id_usuario = $_SESSION['id_usuario'];
        $total = $this->model->calcularCompra($id_usuario)['total'];
        $total_bolos = $this->model->calcularCompra($id_usuario)['total_bolos'];
        $data = $this->model->registrarCompra($total, $total_bolos);
        if ($data == 'ok') {
            $detalles = $this->model->getDetallesCompra($id_usuario);
            $id_compra = $this->model->ultimaCompra();
            foreach ($detalles as $row) {
                $cantidad = $row['cantidad'];
                $precio = $row['precio'];
                $precio_bolos = $row['precio_bolos'];
                $id_producto = $row['id_producto'];
                $sub_total = $cantidad * $precio;
                $sub_total_bolos = $cantidad * $precio_bolos;
                $this->model->registrarDetalleCompra($id_compra['id'], $id_producto, $cantidad, $precio, $precio_bolos, $sub_total, $sub_total_bolos);
                $stock_actual = $this->model->getProductoById($id_producto);
                $stock = $stock_actual['cantidad'] + $cantidad;
                $this->model->actualizarStock($stock, $id_producto);
            }
            $vaciar = $this->model->vaciarDetallesCompra($id_usuario);
            if ($vaciar == "ok") {
                $msg = array('msg' => 'Compra Registrada', 'id_compra' => $id_compra['id'], 'icono' => 'success');
            }
        } else {
            $msg = array('msg' => 'Error al realizar la Venta', 'icono' => 'warning');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function historialC() {
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'historialC');
        if(!empty($verificar) || $id_usuario == 1){
            $this->views->getView($this, "historialC");
        } else {
            header('Location:' .base_url. 'Errors/permisos');
        }
    }

    public function listar_historial() {
        $data = $this->model->getHistorialCompras();
        for ($i=0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-success">Completada</span>';
                $data[$i]['acciones'] = '<div>
                <button type="button" class="btn btn-warning" onclick="btnAnularCompra('. $data[$i]['id'] .')"><i class="fas fa-ban"></i></button>
                <a class="btn btn-danger" href="' . base_url . "Compras/generarPdfCompra/" . $data[$i]['id'] .'" target="_blank"><i class="fas fa-file-pdf"></i></button>
                <div/>';
            }else {
                $data[$i]['estado'] = '<span class="badge bg-danger">Anulada</span>';
                $data[$i]['acciones'] = '<div>
                <a class="btn btn-danger" href="' . base_url . "Compras/generarPdfCompra/" . $data[$i]['id'] .'" target="_blank"><i class="fas fa-file-pdf"></i></button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function generarPdfCompra($id_compra) {
        $empresa = $this->model->getEmpresa();
        $productos = $this->model->getProCompra($id_compra);
        require('Libraries/fpdf/fpdf.php');

        $pdf = new FPDF('P', 'mm', array(80, 200));
        $pdf->addPage();
        $pdf->setMargins(5, 0, 0);
        
        $pdf->setTitle('Reporte de Compra');
        
        $pdf->setFont('Arial', 'B', 12);
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
        $pdf->Cell(20, 5, $id_compra, 0, 1, 'L');
        
        $pdf->Ln();

        //Encabezados de Productos en la Compra
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->setFont('Arial', '', 7);
        $pdf->Cell(10, 5, 'Cant', 0, 0, 'L', true);
        $pdf->Cell(35, 5, 'Descripcion', 0, 0, 'L', true);
        $pdf->Cell(10, 5, 'Precio', 0, 0, 'L', true);
        $pdf->Cell(15, 5, 'SubTotal', 0, 1, 'R', true);
        
        //Productos en la Compra
        $pdf->SetTextColor(0, 0, 0);
        $total = 0.00;
        foreach($productos as $row) {
            $total += $row['sub_total'];
            $pdf->Cell(10, 5, $row['cantidad'], 0, 0, 'C');
            $pdf->Cell(35, 5, utf8_decode($row['descripcion']), 0, 0, 'L');
            $pdf->Cell(10, 5, $row['precio'], 0, 0, 'C');
            $pdf->Cell(15, 5, number_format($row['sub_total'], 2, ',', '.'), 0, 1, 'R');
        }
        
        // Total de la Compra
        $pdf->Ln();
        $pdf->Cell(70, 5, 'Total a Pagar:', 0, 1, 'R');
        $pdf->Cell(70, 5, number_format($total, 2, ',', '.'), 0, 1, 'R');
        $pdf->Ln();
        $pdf->Cell(0, 0, utf8_decode($empresa['mensaje']), 0, 0, 'C');
        $pdf->Output();
    }

    public function anularCompra($id_compra) {
        $data = $this->model->getCompra($id_compra);
        $compra = $this->model->anularCompra($id_compra);
        foreach ($data as $row){
            $stock_actual = $this->model->getProductoById($row['id_producto']);
            $stock = $stock_actual['cantidad'] - $row['cantidad'];
            $this->model->actualizarStock($stock, $row['id_producto']);
        }
        if ($compra == "ok") {
            $msg = array('msg' => 'Compra Anulada', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error Anulando Compra', 'icono' => 'error');
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}