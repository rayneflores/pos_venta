<?php include "Views/Templates/header.php"; ?>
<div class="card mt-4">
    <div class="card-header card-header-primary fw-bold">
        Clientes
    </div>
    <div class="card-body">
        <button class="btn btn-primary mb-2" type="button" onclick="frmCliente();"><i class="fas fa-plus"></i></button>
        <div class="table-responsive">
            <table class="table table-light table-bordered table-hover" id="tblClientes">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>RIF</th>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="nuevo_cliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="title">Nuevo Cliente</h5>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmCliente">
                    <div class="form-floating mb-3">
                        <input type="hidden" id="id" name="id">
                        <input id="rif" class="form-control" type="text" name="rif" placeholder="RIF">
                        <label for="rif">RIF</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del Cliente">
                        <label for="nombre">Nombre</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Telefono del Cliente">
                        <label for="telefono">Telefono</label>
                    </div>
                    <div class="form-floating mb-3">
                      <textarea class="form-control" name="direccion" id="direccion" placeholder="Direccion del Cliente" rows="3"></textarea>
                      <label for="direccion">Direccion</label>
                    </div>
                    <button class="btn btn-primary" type="button" onclick="registrarCli(event);" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>