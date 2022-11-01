<?php
    Class Administracion extends Controller {
        public function __construct() {
            session_start();
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url);
            }
            parent::__construct();
        }

        public function index(){
            $id_usuario = $_SESSION['id_usuario'];
            $verificar = $this->model->verificarPermisos($id_usuario, 'administracion');
            if(!empty($verificar || $id_usuario == 1)){
                $data['empresa'] = $this->model->getEmpresa();
                if (!empty($_SESSION['tasa'])) {
                    $comprobar = $this->model->getTasa();
                    if (empty($comprobar)) {
                        $data['tasa'] = $this->model->getTasaAnterior();
                    } else {
                        $data['tasa'] = $comprobar;
                    }
                } else {
                    $data['tasa'] = $this->model->getTasaAnterior();
                    $_SESSION['tasa'] = $this->model->getTasaAnterior();
                }
                $this->views->getView($this, "index", $data);
            } else {
                header('Location:' .base_url. 'Errors/permisos');
            }
        }

        public function home(){
            $data['usuarios'] = $this->model->getDatos('usuarios');
            $data['clientes'] = $this->model->getDatos('clientes');
            $data['productos'] = $this->model->getDatos('productos');
            $data['ventas'] = $this->model->getVentasDarias();
            $this->views->getView($this, "home", $data);
        }

        public function modificarEmpresa(){
            $nombre = $_POST['nombre'];
            $rif = $_POST['rif'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];
            $mensaje = $_POST['mensaje'];
            $id = $_POST['id'];
            $tasa = $_POST['tasa'];
            $tasa_bcv = $_POST['tasa_bcv'];
            $data = $this->model->modificarEmpresa($nombre, $rif, $telefono, $direccion, $mensaje, $id, $tasa, $tasa_bcv);
            if ($data == 'ok') {
                $msg = array('msg' => 'Los Datos fueron Modificados', 'icono' => 'success');
            } else {
                $msg = array('msg' => 'Error al Modificar la Empresa', 'icono' => 'warning');
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function reporteStock() {
            $data = $this->model->getStockMinimo();
            echo json_encode($data);
            die();
        }

        public function reporteMasVendidos() {
            $data = $this->model->getMasVendidos();
            echo json_encode($data);
            die();
        }
    }
?>