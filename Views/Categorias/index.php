<?php include "Views/Templates/header.php"; ?>
<div class="card mt-4">
    <div class="card-header card-header-primary fw-bold">
        Categorias
    </div>
    <div class="card-body">
        <button class="btn btn-primary mb-2" type="button" onclick="frmCategoria();"><i class="fas fa-plus"></i></button>
        <div class="table-responsive">
            <table class="table table-light table-bordered table-hover" id="tblCategorias">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
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
<div class="modal fade" id="nuevo_categoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="title">Nueva Categoria</h5>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmCategoria">
                    <div class="form-floating mb-3">
                        <input type="hidden" id="id" name="id">
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre de la Categoria">
                        <label for="nombre">Nombre</label>
                    </div>
                    <button class="btn btn-primary" type="button" onclick="registrarCat(event);" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>