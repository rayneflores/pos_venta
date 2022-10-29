<?php
class MedidasModel extends Query{
    private $rif, $nombre, $nombre_corto, $id, $estado;
    public function __construct(){
        parent::__construct();
    }

    public function getMedidas(){
        $sql = "SELECT * FROM medidas";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarMedida(string $nombre, string $nombre_corto){
        $this->nombre = $nombre;
        $this->nombre_corto = $nombre_corto;
        $verificar = "SELECT * FROM medidas WHERE nombre = '$this->nombre'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO medidas(nombre, nombre_corto) VALUES (?,?)";
            $datos = array($this->nombre, $this->nombre_corto);
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

    public function modificarMedida(string $nombre, string $nombre_corto, int $id){
        $this->nombre = $nombre;
        $this->nombre_corto = $nombre_corto;
        $this->id = $id;
        $sql = "UPDATE medidas SET nombre = ?, nombre_corto = ? WHERE id = ?";
        $datos = array($this->nombre, $this->nombre_corto, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function editarMed(int $id){
        $sql = "SELECT * FROM medidas WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function accionMedida(int $estado, int $id){
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE medidas SET estado = ? WHERE id = ?";
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