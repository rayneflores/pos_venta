<?php
class ClientesModel extends Query{
    private $rif, $nombre, $telefono, $direccion, $id, $estado;
    public function __construct(){
        parent::__construct();
    }

    public function getClientes(){
        $sql = "SELECT * FROM clientes";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarCliente(string $rif, string $nombre, string $telefono, string $direccion){
        $this->rif = $rif;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $verificar = "SELECT * FROM clientes WHERE rif = '$this->rif'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO clientes(rif, nombre, telefono, direccion) VALUES (?,?,?,?)";
            $datos = array($this->rif, $this->nombre, $this->telefono, $this->direccion);
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

    public function modificarCliente(string $rif, string $nombre, string $telefono, string $direccion, int $id){
        $this->rif = $rif;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->id = $id;
        $sql = "UPDATE clientes SET rif = ?, nombre = ?, telefono = ?, direccion = ? WHERE id = ?";
        $datos = array($this->rif, $this->nombre, $this->telefono, $this->direccion, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function editarCli(int $id){
        $sql = "SELECT * FROM clientes WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function accionCliente(int $estado, int $id){
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE clientes SET estado = ? WHERE id = ?";
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