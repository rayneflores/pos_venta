<?php
class ComprasModel extends Query{
    private $codigo, $id;
    public function __construct(){
        parent::__construct();
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

    public function registrarDetalleCompras(int $id_producto, int $id_usuario, string $precio, string $precio_bolos, string $cantidad, string $sub_total, string $sub_total_bolos) {
        $sql = "INSERT INTO detalle (id_producto, id_usuario, precio, precio_bolos, cantidad, sub_total, sub_total_bolos) VALUES (?,?,?,?,?,?,?)";
        $datos = array($id_producto, $id_usuario, $precio, $precio_bolos, $cantidad, $sub_total, $sub_total_bolos);
        $data = $this->save($sql, $datos);
        if($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function getDetallesCompra(int $id) {
        $sql = "SELECT d.*, p.id as product_id, p.descripcion FROM detalle d INNER JOIN productos p ON p.id = d.id_producto WHERE d.id_usuario = $id";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function calcularCompra(int $id_usuario) {
        $sql = "SELECT SUM(sub_total) AS total, SUM(sub_total_bolos) AS total_bolos FROM detalle WHERE id_usuario = $id_usuario";
        $data = $this->select($sql);
        return $data;
    }

    public function deleteDetalleCompra(int $id) {
        $sql = "DELETE FROM detalle WHERE id = ?";
        $datos = array($id);
        $data = $this->save($sql, $datos);
        if($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function consultarDetalleCompra(int $id_producto, int $id_usuario) {
        $sql = "SELECT * FROM detalle WHERE id_producto = $id_producto AND id_usuario = $id_usuario";
        $data = $this->select($sql);
        return $data;
    }

    public function actualizarDetalleCompra(string $precio, string $precio_bolos, string $cantidad, string $sub_total, string $sub_total_bolos, int $id_producto, int $id_usuario) {
        $sql = "UPDATE detalle SET precio = ?, precio_bolos = ?, cantidad = ?, sub_total = ?, sub_total_bolos = ? WHERE id_producto = ? AND id_usuario = ?";
        $datos = array($precio, $precio_bolos, $cantidad, $sub_total, $sub_total_bolos, $id_producto, $id_usuario);
        $data = $this->save($sql, $datos);
        if($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function registrarCompra(string $total, string $total_bolos) {
        $sql = "INSERT INTO compras (total, total_bolos) VALUES (?,?)";
        $datos = array($total, $total_bolos);
        $data = $this->save($sql, $datos);
        if($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function ultimaCompra() {
        $sql = "SELECT MAX(id) as id FROM compras";
        $data = $this->select($sql);
        return $data;
    }

    public function registrarDetalleCompra(int $id_compra, int $id_producto, string $cantidad, string $precio, string $precio_bolos, string $sub_total, string $sub_total_bolos) {
        $sql = "INSERT INTO detalle_compras (id_compra, id_producto, cantidad, precio, precio_bolos, sub_total, sub_total_bolos) VALUES (?,?,?,?,?,?,?)";
        $datos = array($id_compra, $id_producto, $cantidad, $precio, $precio_bolos, $sub_total, $sub_total_bolos);
        $data = $this->save($sql, $datos);
        if($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function vaciarDetallesCompra(int $id_usuario) {
        $sql = "DELETE FROM detalle WHERE id_usuario = ?";
        $datos = array($id_usuario);
        $data = $this->save($sql, $datos);
        if($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function getHistorialCompras() {
        $sql = "SELECT * FROM compras";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function actualizarStock(int $cantidad, int $id_producto) {
        $sql = "UPDATE productos SET cantidad = ? WHERE id = ?";
        $datos = array($cantidad, $id_producto);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function getProCompra(int $id_compra) {
        $sql = "SELECT c.*, d.*, p.id, p.descripcion from compras c INNER JOIN detalle_compras d ON d.id_compra = c.id INNER JOIN productos p ON d.id_producto = p.id where c.id = $id_compra";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getEmpresa() {
        $sql = "SELECT * FROM configuracion";
        $data = $this->select($sql);
        return $data;
    }

    public function getCompra(int $id_compra) {
        $sql = "SELECT c.*, d.* FROM compras c INNER JOIN detalle_compras d ON d.id_compra = c.id WHERE c.id = $id_compra";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function anularCompra(int $id_compra) {
        $sql = "UPDATE compras SET estado = ? WHERE id = ?";
        $datos = array(0, $id_compra);
        $data = $this->save($sql, $datos);
        if($data == 1) {
            $res = 'ok';
        } else {
            $res = 'error';
        }
        return $res;
    }

    public function verificarPermisos(int $id_usuario, string $nombre) {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON d.id_permiso = p.id WHERE d.id_usuario = $id_usuario AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }
}
?>