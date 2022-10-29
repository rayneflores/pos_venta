<?php include "Views/Templates/header.php"; ?>
<div class="container-fluid">
    <h1 class="mt-4">Dashboard</h1>
</div>
<div class="row mt-4">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary">
            <div class="card-body d-flex text-white align-items-center justify-content-between">
                Usuarios
                <i class="fas fa-user fa-2x ml-end"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>Usuarios" class="text-white">Ver Detalle</a>
                <span class="text-white"><?php echo($data['usuarios']['total'])?></span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success">
            <div class="card-body d-flex text-white align-items-center justify-content-between">
                Clientes
                <i class="fas fa-users fa-2x ml-end"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>Clientes" class="text-white">Ver Detalle</a>
                <span class="text-white"><?php echo($data['clientes']['total'])?></span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning">
            <div class="card-body d-flex text-white align-items-center justify-content-between">
                Productos
                <i class="fas fa-store fa-2x ml-end"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>Productos" class="text-white">Ver Detalle</a>
                <span class="text-white"><?php echo($data['productos']['total'])?></span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger">
            <div class="card-body d-flex text-white align-items-center justify-content-between">
                Ventas del dia
                <i class="fas fa-shopping-cart fa-2x ml-end"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>Ventas/historial" class="text-white">Ver Detalle</a>
                <span class="text-white"><?php echo($data['ventas']['total'])?></span>
            </div>
        </div>
    </div>
</div>
<div class="row mt-2 d-flex justify-content-center">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header bg-dark text-white">
                Productos con Stock Minimo
            </div>
            <div class="card-body d-flex text-white align-items-center justify-content-between">
                <canvas id="stockMinimo" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header bg-dark text-white">
                Productos Mas Vendidos
            </div>
            <div class="card-body d-flex text-white align-items-center justify-content-between">
                <canvas id="masVendidos" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>