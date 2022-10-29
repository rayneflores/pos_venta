<?php
class Categorias extends Controller{
    public function __construct() {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
    }

    public function index(){
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'categorias');
        if(!empty($verificar) || $id_usuario == 1){
            $this->views->getView($this, "index");
        } else {
            header('Location:' .base_url. 'Errors/permisos');
        }
    }
    
    public function listar(){
        $data = $this->model->getCategorias();
        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarCat(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarCat(' . $data[$i]['id'] . ');"><i class="fas fa-ban"></i></button>
                <div/>';
            }else {
                $data[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarCat(' . $data[$i]['id'] . ');"><i class="fas fa-check"></i></button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar(){
        $nombre = $_POST['nombre'];
        $id = $_POST['id'];
        if (empty($nombre)) {
            $msg = array('msg' => 'El Nombre de la Categoria es obligatorio', 'icono' => 'warning');
        }else{
            if ($id == "") {
                $data = $this->model->registrarCategoria($nombre);
                if ($data == "ok") {
                    $msg = array('msg' => 'Categoria registrada con éxito', 'icono' => 'success');
                }else if($data == "existe"){
                    $msg = array('msg' => 'La Categoria ya existe', 'icono' => 'warning');
                }else{
                    $msg = array('msg' => 'Error al registrar la Categoria', 'icono' => 'error');
                }
            }else{
                $data = $this->model->modificarCategoria($nombre, $id);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Categoria modificada con éxito', 'icono' => 'success');
                }else {
                    $msg = array('msg' => 'Error al modificar la Categoria', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id){
        $data = $this->model->editarCat($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $id){
        $data = $this->model->accionCategoria(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Categoria dada de baja', 'icono' => 'success');
        }else{
            $msg = array('msg' => 'Error al Inactivar la Categoria', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar(int $id){
        $data = $this->model->accionCategoria(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Categoria Activada con éxito', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al Activar la Categoria', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

}