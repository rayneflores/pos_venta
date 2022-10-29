<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="ng. Rayne Flores" />
    <title>Panel Adminstrativo</title>
    <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet" />
    <link href="<?php echo base_url; ?>Assets/DataTables/datatables.min.css" rel="stylesheet" />
    <link href="<?php echo base_url; ?>Assets/css/select2.min.css" rel="stylesheet" />
    <link href="<?php echo base_url; ?>Assets/css/estilos.css" rel="stylesheet" />
    <script src="<?php echo base_url; ?>Assets/js/all.min.js"></script>
</head>

<body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="<?php echo base_url; ?>Administracion/home">Punto de Venta</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-auto me-0 me-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#cambiarPass">Cambiar Password</a>
                        <hr class="dropdown-divider" />
                        <a class="dropdown-item" href="<?php echo base_url; ?>Usuarios/salir">Cerrar Sesión</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCompras" aria-expanded="false" aria-controls="collapseCompras">
                                <div class="sb-nav-link-icon"><i class="fa solid fa-truck fa-2x text-success"></i></div>
                                Compras
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCompras" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>Compras"><i class="fas fa-truck text-success"></i> &nbsp;&nbsp;Nueva Compra</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Compras/historialC"><i class="fas fa-bread-slice text-success"></i> &nbsp;&nbsp;Historico</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseVentas" aria-expanded="false" aria-controls="collapseVentas">
                                <div class="sb-nav-link-icon"><i class="fa solid fa-shopping-cart fa-2x text-success"></i></div>
                                Ventas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseVentas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>Ventas"><i class="fas fa-shopping-cart text-success"></i> &nbsp;&nbsp;Nueva Venta</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Ventas/historialV"><i class="fas fa-bread-slice text-success"></i> &nbsp;&nbsp;Historico</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="<?php echo base_url; ?>Clientes">
                                <div class="sb-nav-link-icon"><i class="fas fa-users fa-2x text-success"></i></div>
                                Clientes
                            </a>
                            <a class="nav-link" href="<?php echo base_url; ?>Categorias">
                                <div class="sb-nav-link-icon"><i class="fa solid fa-gifts fa-2x text-success"></i></div>
                                Categorias
                            </a>
                            <a class="nav-link" href="<?php echo base_url; ?>Medidas">
                                <div class="sb-nav-link-icon"><i class="fa solid fa-ruler fa-2x text-success"></i></div>
                                Medidas
                            </a>
                            <a class="nav-link" href="<?php echo base_url; ?>Productos">
                                <div class="sb-nav-link-icon"><i class="fa solid fa-store fa-2x text-success"></i></div>
                                Productos
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-cogs fa-2x text-success"></i></div>
                                Administracion
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>Usuarios"><i class="fas fa-user text-success"></i> &nbsp;&nbsp;Usuarios</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Administracion"><i class="fas fa-tools text-success"></i> &nbsp;&nbsp;Configuración</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCajas" aria-expanded="false" aria-controls="collapseCajas">
                                <div class="sb-nav-link-icon"><i class="fas fa-cash-register text-success fa-2x text-success"></i></div>
                                Cajas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCajas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>Cajas"><i class="fas fa-cash-register text-success"></i> &nbsp;&nbsp;Cajas</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Cajas/arqueo"><i class="fas fa-user-ninja text-success"></i> &nbsp;&nbsp;Arqueo de Caja</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="mb-2">Usuario: </div>
                        <?php echo $_SESSION['nombre'];?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">

