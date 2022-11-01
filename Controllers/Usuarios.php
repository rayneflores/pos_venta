<?php
class Usuarios extends Controller{
    public function __construct() {
        session_start();
        parent::__construct();
    }

    public function index(){
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'usuarios');
        if(!empty($verificar) || $id_usuario == 1){
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url);
            }
            $data['cajas'] = $this->model->getCajas();
            $this->views->getView($this, "index", $data);
        } else {
            header('Location:' .base_url. 'Errors/permisos');
        }
    }

    public function listar(){
        $data = $this->model->getUsuarios();
        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
                if ($data[$i]['id'] == 1) {
                    $data[$i]['acciones'] = '<div>
                        <span class="badge bg-dark text-white">Administrador</span>
                    <div/>';
                } else {
                    $data[$i]['acciones'] = '<div>
                    <a class="btn btn-dark" href="'.base_url.'Usuarios/permisos/'. $data[$i]['id'] .'"><i class="fas fa-key"></i></a>
                    <button class="btn btn-primary" type="button" onclick="btnEditarUser(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" type="button" onclick="btnEliminarUser(' . $data[$i]['id'] . ');"><i class="fas fa-ban"></i></button>
                    <div/>';
                }
            }else {
                $data[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarUser(' . $data[$i]['id'] . ');"><i class="fas fa-check"></i></button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function validar(){
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $msg = "Los campos estan vacios";
        }else{
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $hash = hash("SHA256", $clave);
            $data = $this->model->getUsuario($usuario, $hash);
            if ($data) {
                $_SESSION['id_usuario'] = $data['id'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['activo'] = true;
                $_SESSION['tasa'] = "0.00";
                $msg = "ok";
            }else{
                $msg = "Usuario o contraseña incorrecta";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function registrar(){
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'registrar_usuario');
        if(!empty($verificar) || $id_usuario == 1){
            $usuario = $_POST['usuario'];
            $nombre = $_POST['nombre'];
            $clave = $_POST['clave'];
            $confirmar = $_POST['confirmar'];
            $caja = $_POST['caja'];
            $id = $_POST['id'];
            $hash = hash("SHA256", $clave);
            if (empty($usuario) || empty($nombre) || empty($caja)) {
                $msg = array('msg' => 'Todo los campos son obligatorios', 'icono' => 'warning');
            }else{
                if ($id == "") {
                    if($clave != $confirmar){
                        $msg = array('msg' => 'Las contraseña no coinciden', 'icono' => 'warning');
                    }else{
                        $data = $this->model->registrarUsuario($usuario, $nombre, $hash, $caja);
                        if ($data == "ok") {
                            $msg = array('msg' => 'Usuario registrado con éxito', 'icono' => 'success');
                        }else if($data == "existe"){
                            $msg = array('msg' => 'El usuario ya existe', 'icono' => 'warning');
                        }else{
                            $msg = array('msg' => 'Error al registrar el usuario', 'icono' => 'error');
                        }
                    }
                }else{
                    $data = $this->model->modificarUsuario($usuario, $nombre, $caja, $id);
                    if ($data == "modificado") {
                        $msg = array('msg' => 'Usuario modificado con éxito', 'icono' => 'success');
                    }else {
                        $msg = array('msg' => 'Error al modificar el usuario', 'icono' => 'error');
                    }
                }
            }
        } else {
            $msg = array('msg' => 'No tienes Permisos para Registrar Usuarios', 'icono' => 'warning');
        }
        
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id){
        $data = $this->model->editarUser($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $id){
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'eliminar_usuario');
        if(!empty($verificar) || $id_usuario == 1){
            if ($id_usuario != $id) {
                $data = $this->model->accionUser(0, $id);
                if ($data == 1) {
                    $msg = array('msg' => 'Usuario dado de baja', 'icono' => 'success');
                }else{
                    $msg = array('msg' => 'Error al Inactivar el usuario', 'icono' => 'error');
                }
            } else {
                $msg = array('msg' => 'No puedes Desactivar tu propio Usuario', 'icono' => 'error');
            }
        } else {
            $msg = array('msg' => 'No tienes Permisos para Inactivar Usuarios', 'icono' => 'warning');
        }

        
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar(int $id){
        $data = $this->model->accionUser(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Usuario Activado con éxito', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al Activar el usuario', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function cambiarPass() {
        $actual = $_POST['clave_actual'];
        $nueva = $_POST['clave_nueva'];
        $confirmar = $_POST['confirmar_clave'];

        if (empty($actual) || empty($nueva) || empty($confirmar)) {
            $msg = array('msg' => 'Todos los campos son obligatorios', 'icono' => 'error');
        } else {
            if ($nueva != $confirmar) {
                $msg = array('msg' => 'La Nueva Clave no coincide con la Confirmacion', 'icono' => 'error');
            } else {
                $id_usuario = $_SESSION['id_usuario'];
                $hash = hash("SHA256", $actual);
                $data = $this->model->getPass($hash, $id_usuario);
                if (!empty($data)) {
                    $hash = hash("SHA256", $nueva);
                    $verificar = $this->model->modificarPass($hash, $id_usuario);
                    if ($verificar == 1) {
                        $msg = array('msg' => 'Password Modificado con éxito', 'icono' => 'success');
                    } else {
                        $msg = array('msg' => 'Error la Realizar el cambio de Clave', 'icono' => 'error');
                    }
                } else {
                    $msg = array('msg' => 'La Clave es Incorrecta', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function permisos($id){
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'permisos');
        if(!empty($verificar) || $id_usuario == 1){
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url);
            }
            $data['datos'] = $this->model->getPermisos();
            $permisos = $this->model->getDetallePermisos($id);
            $data['permisos_asignados'] = array();
            foreach ($permisos as $permiso) {
                $data['permisos_asignados'][$permiso['id_permiso']] = true;
            }
            $data['id_usuario'] = $id;
            $this->views->getView($this, "permisos", $data);
        } else {
            header('Location:' .base_url. 'Errors/permisos');
        }
    }

    public function registrarPermisos() {
        $id_usuario = $_POST['id_usuario'];
        $eliminar = $this->model->borrarPermisos($id_usuario);

        if ($eliminar == 'ok') {
            foreach ($_POST['permisos'] as $id_permiso) {
                $resultado = $this->model->registrarPermisos($id_usuario, $id_permiso);
                if ($resultado == 'ok') {
                    $msg = array('msg' => 'Permisos Configurados', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al Configurar los Permisos', 'icono' => 'error');
                }                
            }
        } else {
            $msg = array('msg' => 'Error al Configurar los Permisos', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function salir(){
        session_destroy();
        header("location: ".base_url);
    }
}
