<?php
class Medidas extends Controller{
    public function __construct() {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
    }

    public function index(){
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'medidas');
        if(!empty($verificar) || $id_usuario == 1){
            $this->views->getView($this, "index");
        } else {
            header('Location:' .base_url. 'Errors/permisos');
        }
    }
    
    public function listar(){
        $data = $this->model->getMedidas();
        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarMed(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarMed(' . $data[$i]['id'] . ');"><i class="fas fa-ban"></i></button>
                <div/>';
            }else {
                $data[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarMed(' . $data[$i]['id'] . ');"><i class="fas fa-check"></i></button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar(){
        $nombre = $_POST['nombre'];
        $nombre_corto = $_POST['nombre_corto'];
        $id = $_POST['id'];
        if (empty($nombre) || empty($nombre_corto)) {
            $msg = array('msg' => 'Todo los campos son obligatorios', 'icono' => 'warning');
        }else{
            if ($id == "") {
                $data = $this->model->registrarMedida($nombre, $nombre_corto);
                if ($data == "ok") {
                    $msg = array('msg' => 'Medida registrada con éxito', 'icono' => 'success');
                }else if($data == "existe"){
                    $msg = array('msg' => 'La Medida ya existe', 'icono' => 'warning');
                }else{
                    $msg = array('msg' => 'Error al registrar la Medida', 'icono' => 'error');
                }
            }else{
                $data = $this->model->modificarMedida($nombre, $nombre_corto, $id);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Medida modificada con éxito', 'icono' => 'success');
                }else {
                    $msg = array('msg' => 'Error al modificar la Medida', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id){
        $data = $this->model->editarMed($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $id){
        $data = $this->model->accionMedida(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Medida dada de baja', 'icono' => 'success');
        }else{
            $msg = array('msg' => 'Error al Inactivar la Medida', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar(int $id){
        $data = $this->model->accionMedida(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Medida Activada con éxito', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al Activar la Medida', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

}