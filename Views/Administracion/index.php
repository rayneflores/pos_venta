<?php include "Views/Templates/header.php"; ?>
<div class="card mt-4">
  <div class="card-header bg-dark text-white">
    Datos de la Empresa
  </div>
  <div class="card-body">
    <form id="frmEmpresa">
        <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $data['empresa']['id']; ?>">
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de la Empresa" value="<?php echo $data['empresa']['nombre']; ?>">
                    <label for="nombre">Nombre de la Empresa</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" name="rif" id="rif" class="form-control" placeholder="rif" value="<?php echo $data['empresa']['rif']; ?>">
                    <label for="rif">R.I.F</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono" value="<?php echo $data['empresa']['telefono']; ?>">
                    <label for="telefono">Telefono</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Direccion" value="<?php echo $data['empresa']['direccion']; ?>">
                    <label for="direccion">Direccion</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" name="tasa" id="tasa" class="form-control" placeholder="Tasa del Dia" value="<?php echo $data['tasa']['factor']; ?>">
                    <label for="tasa">Tasa del Dia</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <textarea class="form-control" name="mensaje" id="mensaje" placeholder="Mensaje" rows="3"><?php echo $data['empresa']['mensaje']; ?></textarea>
                    <label for="mensaje">Mensaje</label>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary mt-2" onclick="modificarEmpresa()">Modificar</button>
    </form>
  </div>
</div>
<?php include "Views/Templates/footer.php"; ?>