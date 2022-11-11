<?php
class VentasModel extends Query{
    private $codigo, $id;
    public function __construct(){
        parent::__construct();
    }

    public function getClientes() {
        $sql = "SELECT * FROM clientes WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getCliente(int $id_venta) {
        $sql = "SELECT * from clientes c INNER join ventas v ON v.id_cliente = c.id where v.id = $id_venta";
        $data = $this->select($sql);
        return $data;
    }

    public function getProCod(string $codigo) {
        $sql = "SELECT * FROM productos WHERE codigo = '$codigo'";
        $data = $this->select($sql);
        return $data;
    }

    public function getProductoById(int $id) {
        $sql = "SELECT * FROM productos WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function registrarDetalleVentas(int $id_producto, int $id_usuario, string $precio, string $precio_bolos, string $cantidad, string $sub_total, string $sub_total_bolos, string $fecha) {
        $sql = "INSERT INTO detalle2 (id_producto, id_usuario, precio, precio_bolos, cantidad, sub_total, sub_total_bolos, fecha) VALUES (?,?,?,?,?,?,?,?)";
        $datos = array($id_producto, $id_usuario, $precio, $precio_bolos, $cantidad, $sub_total, $sub_total_bolos, $fecha);
        $data = $this->save($sql, $datos);
        if($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function getDetallesVenta(int $id) {
        $sql = "SELECT d.*, p.id as product_id, p.descripcion FROM detalle2 d INNER JOIN productos p ON p.id = d.id_producto WHERE d.id_usuario = $id";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function calcularVenta(int $id_usuario) {
        $sql = "SELECT SUM(sub_total) AS total, SUM(sub_total_bolos) AS total_bolos FROM detalle2 WHERE id_usuario = $id_usuario";
        $data = $this->select($sql);
        return $data;
    }

    public function deleteDetalleVenta(int $id) {
        $sql = "DELETE FROM detalle2 WHERE id = ?";
        $datos = array($id);
        $data = $this->save($sql, $datos);
        if($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function consultarDetalleVenta(int $id_producto, int $id_usuario) {
        $sql = "SELECT * FROM detalle2 WHERE id_producto = $id_producto AND id_usuario = $id_usuario";
        $data = $this->select($sql);
        return $data;
    }

    public function actualizarDetalleVenta(string $precio, string $precio_bolos, string $cantidad, string $sub_total, string $sub_total_bolos, string $fecha, int $id_producto, int $id_usuario) {
        $sql = "UPDATE detalle2 SET  precio = ?, precio_bolos = ?, cantidad = ?, sub_total = ?, sub_total_bolos = ?, fecha = ? WHERE id_producto = ? AND id_usuario = ?";
        $datos = array($precio, $precio_bolos, $cantidad, $sub_total, $sub_total_bolos, $fecha, $id_producto, $id_usuario);
        $data = $this->save($sql, $datos);
        if($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function registrarVenta(int $id_usuario, int $id_cliente, string $total, string $total_bolos, string $fecha) {
        $sql = "INSERT INTO ventas (id_usuario, id_cliente, total, total_bolos, fecha) VALUES (?,?,?,?,?)";
        $datos = array($id_usuario, $id_cliente, $total, $total_bolos, $fecha);
        $data = $this->save($sql, $datos);
        if($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function ultimaVenta() {
        $sql = "SELECT MAX(id) as id FROM ventas";
        $data = $this->select($sql);
        return $data;
    }

    public function registrarDetalleVenta(int $id_venta, int $id_producto, string $cantidad, string $precio, string $precio_bolos, string $sub_total, string $sub_total_bolos, string $fecha) {
        $sql = "INSERT INTO detalle_ventas (id_venta, id_producto, cantidad, precio, precio_bolos, sub_total, sub_total_bolos, fecha) VALUES (?,?,?,?,?,?,?,?)";
        $datos = array($id_venta, $id_producto, $cantidad, $precio, $precio_bolos, $sub_total, $sub_total_bolos, $fecha);
        $data = $this->save($sql, $datos);
        if($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function vaciarDetallesVenta(int $id_usuario) {
        $sql = "DELETE FROM detalle2 WHERE id_usuario = ?";
        $datos = array($id_usuario);
        $data = $this->save($sql, $datos);
        if($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function getHistorialVentas() {
        $sql = "SELECT v.*, c.id as id_cli, c.nombre FROM ventas v INNER JOIN clientes c ON c.id = v.id_cliente";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function actualizarStock(int $cantidad, int $id_producto) {
        $sql = "UPDATE productos SET cantidad = ? WHERE id = ?";
        $datos = array($cantidad, $id_producto);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function getProVenta(int $id_venta) {
        $sql = "SELECT v.*, d.*, p.id, p.descripcion FROM ventas v INNER JOIN detalle_ventas d ON d.id_venta = v.id INNER JOIN productos p ON d.id_producto = p.id where v.id = $id_venta";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getEmpresa() {
        $sql = "SELECT * FROM configuracion";
        $data = $this->select($sql);
        return $data;
    }

    public function getVenta(int $id_venta) {
        $sql = "SELECT v.*, d.* FROM ventas v INNER JOIN detalle_ventas d ON d.id_venta = v.id WHERE v.id = $id_venta";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function anularVenta(int $id_venta) {
        $sql = "UPDATE ventas SET estado = ? WHERE id = ?";
        $datos = array(0, $id_venta);
        $data = $this->save($sql, $datos);
        if($data == 1) {
            $res = 'ok';
        } else {
            $res = 'error';
        }
        return $res;
    }

    public function verificarCaja(int $id_usuario) {
        $sql = "SELECT * FROM cierre_caja WHERE id_usuario = $id_usuario AND estado = 1";
        $data = $this->select($sql);
        return $data;
    }

    public function verificarPermisos(int $id_usuario, string $nombre) {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON d.id_permiso = p.id WHERE d.id_usuario = $id_usuario AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getRangoFechas(string $desde, string $hasta) {
        $sql = "SELECT c.id as id_cli, c.nombre, v.* FROM ventas v INNER JOIN clientes c ON c.id = v.id_cliente WHERE v.estado = 1 AND v.fecha BETWEEN '$desde' AND '$hasta'";
        $data = $this->selectAll($sql);
        return $data;
    }
}
?>