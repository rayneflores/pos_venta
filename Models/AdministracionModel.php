<?php
class AdministracionModel extends Query{
    public function __construct(){
        parent::__construct();
    }

    public function getEmpresa(){
        $sql = "SELECT * FROM configuracion";
        $data = $this->select($sql);
        return $data;
    }

    public function modificarEmpresa(string $nombre, string $rif, string $telefono, string $direccion, string $mensaje, int $id, string $tasa, string $tasa_bcv) {
        $sql = "UPDATE configuracion SET nombre = ?, rif = ?, telefono = ?, direccion = ?, mensaje = ? WHERE id = ?";
        $datos = array($nombre, $rif, $telefono, $direccion, $mensaje, $id);
        $data = $this->save($sql, $datos);
        if($data == 1) {
            $tasas = $this->getTasa();
            if (is_array($tasas)) {
                $sql = "UPDATE tasa SET factor = ?, factor_bcv = ? WHERE fecha > CURDATE()";
                $datos = array($tasa, $tasa_bcv);
                $data = $this->save($sql, $datos);
                if($data == 1) {
                    $_SESSION['tasa'] = $tasa;
                    $_SESSION['tasa_bcv'] = $tasa_bcv;
                    $res = "ok";
                } else {
                    $res = "error";
                }
            } else {
                $sql = "INSERT INTO tasa (factor, factor_bcv) VALUES (?,?)";
                $datos = array($tasa, $tasa_bcv);
                $data = $this->save($sql, $datos);
                if($data == 1) {
                    $_SESSION['tasa'] = $tasa;
                    $_SESSION['tasa_bcv'] = $tasa_bcv;
                    $res = "ok";
                } else {
                    $res = "error";
                }
            }
        } else {
            $res = "error";
        }
        return $res;
    }

    public function getDatos(string $table){
        $sql = "SELECT COUNT(*) as total FROM $table";
        $data = $this->select($sql);
        return $data;
    }

    public function getVentasDarias(){
        $sql = "SELECT COUNT(*) as total FROM ventas where fecha > CURDATE()";
        $data = $this->select($sql);
        return $data;
    }

    public function getStockMinimo(){
        $sql = "SELECT * FROM productos WHERE cantidad < 15 ORDER BY cantidad DESC LIMIT 10";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getMasVendidos() {
        $sql = "SELECT d.id, d.cantidad, p.id, p.descripcion, SUM(d.cantidad) AS total FROM detalle_ventas d INNER JOIN productos p ON p.id = d.id_producto GROUP BY d.id_producto ORDER BY d.cantidad DESC LIMIT 10";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getTasa() {
        $sql = "SELECT factor as factor, factor_bcv as factor_bcv FROM tasa where fecha > CURDATE()";
        $data = $this->select($sql);
        return $data;
    }

    public function getTasaAnterior() {
        $sql = "SELECT factor as factor, factor_bcv as factor_bcv FROM tasa where fecha > CURDATE() - 1";
        $data = $this->select($sql);
        return $data;
    }

    public function verificarPermisos(int $id_usuario, string $nombre) {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON d.id_permiso = p.id WHERE d.id_usuario = $id_usuario AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }
}
