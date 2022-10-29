<?php
class Clientes extends Controller{
    public function __construct() {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
    }

    public function index(){
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'clientes');
        if(!empty($verificar) || $id_usuario == 1){
            $this->views->getView($this, "index");
        } else {
            header('Location:' .base_url. 'Errors/permisos');
        }
    }
    
    public function listar(){
        $data = $this->model->getClientes();
        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarCli(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarCli(' . $data[$i]['id'] . ');"><i class="fas fa-ban"></i></button>
                <div/>';
            }else {
                $data[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarCli(' . $data[$i]['id'] . ');"><i class="fas fa-check"></i></button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar(){
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'registrar_cliente');
        if(!empty($verificar) || $id_usuario == 1){
            $rif = $_POST['rif'];
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];
            $id = $_POST['id'];
            if (empty($rif) || empty($nombre) || empty($telefono) || empty($direccion)) {
                $msg = array('msg' => 'Todo los campos son obligatorios', 'icono' => 'warning');
            }else{
                if ($id == "") {
                    $data = $this->model->registrarCliente($rif, $nombre, $telefono, $direccion);
                    if ($data == "ok") {
                        $msg = array('msg' => 'Cliente registrado con éxito', 'icono' => 'success');
                    }else if($data == "existe"){
                        $msg = array('msg' => 'El Cliente ya existe', 'icono' => 'warning');
                    }else{
                        $msg = array('msg' => 'Error al registrar el Cliente', 'icono' => 'error');
                    }
                }else{
                    $data = $this->model->modificarCliente($rif, $nombre, $telefono, $direccion, $id);
                    if ($data == "modificado") {
                        $msg = array('msg' => 'Cliente modificado con éxito', 'icono' => 'success');
                    }else {
                        $msg = array('msg' => 'Error al modificar el Cliente', 'icono' => 'error');
                    }
                }
            }            
        } else {
            $msg = array('msg' => 'No tienes Permisos para Registrar Clientes', 'icono' => 'warning');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id){
        $data = $this->model->editarCli($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $id){
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'eliminar_cliente');
        if(!empty($verificar) || $id_usuario == 1){
            $data = $this->model->accionCliente(0, $id);
            if ($data == 1) {
                $msg = array('msg' => 'Usuario dado de baja', 'icono' => 'success');
            }else{
                $msg = array('msg' => 'Error al Inactivar el Cliente', 'icono' => 'error');
            }
        } else {
            $msg = array('msg' => 'No tienes Permisos para Inactivar Clientes', 'icono' => 'warning');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar(int $id){
        $data = $this->model->accionCliente(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Usuario Activado con éxito', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al Activar el Cliente', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

}