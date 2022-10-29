<?php
class Productos extends Controller{
    public function __construct() {
        session_start();
        parent::__construct();
    }

    public function index(){
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'productos');
        if(!empty($verificar) || $id_usuario == 1){
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url);
            }
    
            $data['medidas'] = $this->model->getMedidas();
            $data['categorias'] = $this->model->getCategorias();
            $this->views->getView($this, "index", $data);
        } else {
            header('Location:' .base_url. 'Errors/permisos');
        }
    }
    
    public function listar(){
        $data = $this->model->getProductos();
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['imagen'] = '<img class="img-thumbnail" src= "'. base_url . "Assets/img/" . $data[$i]['foto'] .'">';
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarPro(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarPro(' . $data[$i]['id'] . ');"><i class="fas fa-ban"></i></button>
                <div/>';
            }else {
                $data[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarPro(' . $data[$i]['id'] . ');"><i class="fas fa-check"></i></button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar(){
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'registrar_producto');
        if(!empty($verificar) || $id_usuario == 1){
            $codigo = $_POST['codigo'];
            $descripcion = $_POST['descripcion'];
            $precio_compra = $_POST['precio_compra'];
            $precio_venta = $_POST['precio_venta'];
            $medida = $_POST['medida'];
            $categoria = $_POST['categoria'];
            $id = $_POST['id'];
            $img = $_FILES['imagen'];
            $name = $img['name'];
            $tmpName = $img['tmp_name'];
            $fecha = date('YmdHis');
            $tasa = $_SESSION['tasa'];
            if (empty($codigo) || empty($descripcion) || empty($precio_compra) || empty($precio_venta)) {
                $msg = array('msg' => 'Todo los campos son obligatorios', 'icono' => 'warning');
            }else{
                if (!empty($name)) {
                    $imgNombre = $fecha . ".jpg";
                    $destino = "Assets/img/".$imgNombre;
                } else if(!empty($_POST['foto_actual']) && empty($name)) {
                    $imgNombre = $_POST['foto_actual'];
                } else {
                    $imgNombre = "default.jpeg";
                }
                if ($id == "") {
                    $data = $this->model->registrarProducto($codigo, $descripcion, $precio_compra, $precio_venta, $medida, $categoria, $imgNombre, $tasa);
                    if ($data == "ok") {
                        if (!empty($name)) {
                            move_uploaded_file($tmpName, $destino);
                        }
                        $msg = array('msg' => 'Producto registrado con éxito ' . $tasa, 'icono' => 'success');
                        
                    }else if($data == "existe"){
                        $msg = array('msg' => 'El Producto ya existe', 'icono' => 'warning');
                    }else{
                        $msg = array('msg' => 'Error al registrar el Producto', 'icono' => 'error');
                    }
                }else{
                    $img_delete = $this->model->editarPro($id);
                    if ($img_delete['foto'] != "default.jpeg") {
                        if (file_exists("Assets/img/" . $img_delete['foto'])) {
                            unlink("Assets/img/" . $img_delete['foto']);
                        }
                    }
                    $data = $this->model->modificarProducto($codigo, $descripcion, $precio_compra, $precio_venta, $medida, $categoria, $imgNombre, $tasa, $id);
                    if ($data == "modificado") {
                        if (!empty($name)) {
                            move_uploaded_file($tmpName, $destino);
                        }
                        $msg = array('msg' => 'Producto modificado con éxito ' . $tasa, 'icono' => 'success');
                    }else {
                        $msg = array('msg' => 'Error al modificar el Producto', 'icono' => 'error');
                    }
                }
            }
        } else {
            $msg = array('msg' => 'No tienes Permisos para Registrar Productos', 'icono' => 'warning');
        }
        
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id){
        $data = $this->model->editarPro($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $id){
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'eliminar_producto');
        if(!empty($verificar) || $id_usuario == 1){
            $data = $this->model->accionProducto(0, $id);
            if ($data == 1) {
                $msg = array('msg' => 'Producto dado de baja', 'icono' => 'success');
            }else{
                $msg = array('msg' => 'Error al Inactivar el Producto', 'icono' => 'error');
            }
        } else {
            $msg = array('msg' => 'No tienes Permisos para Inactivar Productos', 'icono' => 'warning');
        }
        
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar(int $id){
        $data = $this->model->accionProducto(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Producto Activado con éxito', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al Activar el Producto', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

}