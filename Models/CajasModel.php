<?php
class CajasModel extends Query{
    private $dni, $caja, $telefono, $direccion, $id, $estado;
    public function __construct(){
        parent::__construct();
    }
    
    public function getCajas(string $table){
        $sql = "SELECT * FROM $table";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getUserCajas(string $table, int $id_usuario){
        $sql = "SELECT * FROM $table WHERE id_usuario = $id_usuario";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarCaja(string $caja){
        $this->caja = $caja;
        $verficar = "SELECT * FROM caja WHERE caja = '$this->caja'";
        $existe = $this->select($verficar);
        if (empty($existe)) {
            # code...
            $sql = "INSERT INTO caja (caja) VALUES (?)";
            $datos = array($this->caja);
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

    public function modificarCaja(string $caja, int $id){
        $this->caja = $caja;
        $this->id = $id;
        $sql = "UPDATE caja SET caja = ? WHERE id = ?";
        $datos = array($this->caja, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function editarCaja(int $id){
        $sql = "SELECT * FROM caja WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function accionCaja(int $estado, int $id){
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE caja SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function registrarArqueo(int $id_usuario, string $monto_inicial, string $monto_inicial_bolos, string $fecha_apertura){
        $verficar = "SELECT * FROM cierre_caja WHERE id_usuario = $id_usuario AND estado = 1";
        $existe = $this->select($verficar);
        if (empty($existe)) {
            $sql = "INSERT INTO cierre_caja (id_usuario, monto_inicial, monto_inicial_bolos, fecha_apertura, monto_total, monto_total_bolos) VALUES (?,?,?,?,?,?)";
            $datos = array($id_usuario, $monto_inicial, $monto_inicial_bolos, $fecha_apertura, $monto_inicial, $monto_inicial_bolos);
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

    public function getVentas(int $id_usuario){
        $sql = "SELECT COUNT(total) AS total_ventas, SUM(total) AS monto_total, SUM(total_bolos) AS monto_total_bolos FROM ventas WHERE id_usuario = $id_usuario AND estado = 1 AND apertura = 1";
        $data = $this->select($sql);
        return $data;
    }

    public function getMontoInicial(int $id_usuario){
        $sql = "SELECT id, monto_inicial, monto_inicial_bolos FROM cierre_caja WHERE id_usuario = $id_usuario AND estado = 1";
        $data = $this->select($sql);
        return $data;
    }

    public function actualizarArqueo(string $monto_final, string $monto_final_bolos, string $fecha_cierre, int $total_ventas, string $monto_total, string $monto_total_bolos, int $id){
        $sql = "UPDATE cierre_caja SET monto_final = ?, monto_final_bolos = ?, fecha_cierre = ?, total_ventas = ?, monto_total = ?, monto_total_bolos = ?, estado = ? WHERE id = ?";
        $datos = array($monto_final, $monto_final_bolos, $fecha_cierre, $total_ventas, $monto_total, $monto_total_bolos, 0, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        }else{
            $res = "error";
        }
        return $res;
    }

    public function actualizarApertura(int $id_usuario){
        $sql = "UPDATE ventas SET apertura = ? WHERE id_usuario = ?";
        $datos = array(0, $id_usuario);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        }else{
            $res = "error";
        }
        return $res;
    }

    public function verificarPermisos(int $id_usuario, string $nombre) {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON d.id_permiso = p.id WHERE d.id_usuario = $id_usuario AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }
}