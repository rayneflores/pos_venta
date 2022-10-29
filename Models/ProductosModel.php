<?php
class ProductosModel extends Query{
    private $codigo, $descripcion, $precio_compra, $precio_venta, $id_medida, $id_categoria, $id, $estado, $img;
    public function __construct(){
        parent::__construct();
    }

    public function getProductos(){
        $sql = "SELECT p.id, p.foto, p.codigo, p.descripcion, p.precio_venta, p.precio_venta_bolos, p.cantidad, p.estado, m.nombre AS medida, c.nombre AS categoria FROM productos p INNER JOIN medidas m ON m.id = p.id_medida INNER JOIN categorias c ON c.id = p.id_categoria";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getMedidas() {
        $sql = "SELECT * FROM medidas WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getCategorias() {
        $sql = "SELECT * FROM categorias WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarProducto(string $codigo, string $descripcion, string $precio_compra, string $precio_venta, int $id_medida, int $id_categoria, string $img, string $tasa){
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
        $this->precio_compra = $precio_compra;
        $this->precio_compra_bolos = $precio_compra * $tasa;
        $this->precio_venta = $precio_venta;
        $this->precio_venta_bolos = $precio_venta * $tasa;
        $this->id_medida = $id_medida;
        $this->id_categoria = $id_categoria;
        $this->img = $img;
        $verificar = "SELECT * FROM productos WHERE codigo = '$this->codigo'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO productos(codigo, descripcion, precio_compra, precio_compra_bolos, precio_venta, precio_venta_bolos, id_medida, id_categoria, foto) VALUES (?,?,?,?,?,?,?,?,?)";
            $datos = array($this->codigo, $this->descripcion, $this->precio_compra, $this->precio_compra_bolos, $this->precio_venta, $this->precio_venta_bolos, $this->id_medida, $this->id_categoria, $this->img);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "ok";
            }else{
                $res = "error";
            }
        }else{
            $res = "existe";
        }
        return $res;
    }

    public function modificarProducto(string $codigo, string $descripcion, string $precio_compra, string $precio_venta, int $id_medida, int $id_categoria, string $img, string $tasa, int $id){
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
        $this->precio_compra = $precio_compra;
        $this->precio_compra_bolos = $precio_compra * $tasa;
        $this->precio_venta = $precio_venta;
        $this->precio_venta_bolos = $precio_venta * $tasa;
        $this->id_medida = $id_medida;
        $this->id_categoria = $id_categoria;
        $this->img = $img;
        $this->id = $id;
        $sql = "UPDATE productos SET codigo = ?, descripcion = ?, precio_compra = ?, precio_compra_bolos = ?, precio_venta = ?, precio_venta_bolos = ?, id_medida = ?, id_categoria = ?, foto = ? WHERE id = ?";
        $datos = array($this->codigo, $this->descripcion, $this->precio_compra, $this->precio_compra_bolos, $this->precio_venta, $this->precio_venta_bolos, $this->id_medida, $this->id_categoria, $this->img ,$this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function editarPro(int $id){
        $sql = "SELECT * FROM productos WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function accionProducto(int $estado, int $id){
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE productos SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function verificarPermisos(int $id_usuario, string $nombre) {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON d.id_permiso = p.id WHERE d.id_usuario = $id_usuario AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }
}
?>