<?php include "Views/Templates/header.php"; ?>
<div class="card mt-4">
    <div class="card-header card-header-primary fw-bold">
        Arqueo de Caja
    </div>
    <div class="card-body">
    <button class="btn btn-success mb-2" type="button" onclick="arqueoCaja();"><i class="fas fa-unlock"></i>&nbsp;&nbsp; Apertura</button>
    <button class="btn btn-danger mb-2" type="button" onclick="cerrarCaja();"><i class="fas fa-lock"></i>&nbsp;&nbsp; Cierre</button>
    <div class="table-responsive">
        <table class="table table-light" id="tblArqueo">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Monto Inicial ($)</th>
                    <th>Monto Final ($)</th>
                    <th>Apertura</th>
                    <th>Cierre</th>
                    <th>Ventas</th>
                    <th>Monto Total ($)</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    </div>
</div>
<div class="modal fade" id="aperturarCaja" tabindex="-1" aria-labelledby="my_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="title">Arqueo de Caja</h5>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmAperturaCaja" onsubmit="abrirArqueo(event);">
                    <div class="form-group mb-2">
                        <input type="hidden" id="id" name="id">
                        <label for="monto_inicial">Monto Inicial</label>
                        <input id="monto_inicial" class="form-control" type="text" name="monto_inicial" placeholder="0.00" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="fecha_apertura">Fecha de Apertura</label>
                        <input id="fecha_apertura" class="form-control" type="date" value="<?php echo date("Y-m-d"); ?>" name="fecha_apertura"  required>
                    </div>
                    <div id="detalles">
                        <div class="form-group mb-2">
                            <label for="monto_final">Monto Final</label>
                            <input id="monto_final" class="form-control" type="text" name="monto_final" disabled>
                        </div>
                        <div class="form-group mb-2">
                            <label for="total_ventas">Ventas Totales</label>
                            <input id="total_ventas" class="form-control" type="text" name="total_ventas" disabled>
                        </div>
                        <div class="form-group mb-2">
                            <label for="monto_total">Monto Total</label>
                            <input id="monto_total" class="form-control" type="text" name="monto_total" disabled>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit" id="btnAccion">Aperturar</button>
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>