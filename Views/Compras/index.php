<?php include "Views/Templates/header.php"; ?>
<div class="card mt-4">
    <div class="card-header bg-primary text-white">
        <h4>Nueva Compra</h4>
    </div>
    .<div class="card">
        <div class="card-body">
            <form id="frmCompra">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                          <label for="codigo"><i class="fas fa-barcode"></i>&nbsp; Codigo de Barras</label>
                          <input type="hidden" name="id" id="id">
                          <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Codigo de Barras" onkeyup="buscarCodigoCompras(event)">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                          <label for="descripcion"><i class="fas fa-monument"></i>&nbsp; Descripcion</label>
                          <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion" disabled>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                          <label for="cantidad"><i class="fas fa-list-ol"></i>&nbsp;Cantidad</label>
                          <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Cantidad" onchange="calcularPrecioCompra(event)" onkeyup="calcularPrecioCompra(event)" disabled>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                          <label for="precio"><i class="fas fa-dollar-sign"></i> &nbsp; Precio</label>
                          <input type="text" name="precio" id="precio" class="form-control" placeholder="Precio de Compra" disabled>
                        </div>
                    </div>
                    <div class="col-md-2 mt-2">
                        <div class="form-group">
                          <label for="precio_bolos"><i class="fas fa-money-bill"></i> &nbsp; Precio BsD</label>
                          <input type="text" name="precio_bolos" id="precio_bolos" class="form-control" placeholder="Precio de Compra en BsD" disabled>
                        </div>
                    </div>
                    <div class="col-md-2 mt-2">
                        <div class="form-group">
                            <label for="sub_total"><i class="fas fa-dollar-sign"></i>&nbsp; Sub Total</label>
                            <input type="text" name="sub_total" id="sub_total" class="form-control" placeholder="0.00" disabled>
                        </div>
                    </div>
                    <div class="col-md-2 mt-2">
                        <div class="form-group">
                            <label for="sub_total_bolos"><i class="fas fa-wallet"></i>&nbsp; Sub Total BsD</label>
                            <input type="text" name="sub_total_bolos" id="sub_total_bolos" class="form-control" placeholder="0.00" disabled>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-light table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Precio Bs D</th>
                    <th>Sub Total</th>
                    <th class="d-flex justify-content-end">Sub Total BsD</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="tblDetalleCompra">
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-end">
            <div class="form-group">
                <label for="total" class="fw-bold"><i class="fas fa-dollar-sign"></i>&nbsp;Total</label>
                <input type="text" name="total" id="total" class="form-control" placeholder="0.00" disabled>
            </div>
            <div class="form-group">
                <label for="total_bolos" class="fw-bold">Total BsD</label>
                <input type="text" name="total_bolos" id="total_bolos" class="form-control" placeholder="0.00" disabled>
                <button type="button" class="btn btn-primary mt-2 col-12 mb-2" onclick="generarCompra()">Generar Compra</button>
            </div>
        </div>
    </div>
<?php include "Views/Templates/footer.php"; ?>