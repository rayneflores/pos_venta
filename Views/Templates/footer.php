</div>
</main>
<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; RyFSystems 2022</div>
            <div>
                <a href="#">Politica de Privacidad</a>
                &middot;
                <a href="#">Terminos &amp; Condiciones</a>
            </div>
        </div>
    </div>
</footer>
<!-- Modal -->
<div class="modal fade" id="cambiarPass" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Cambiar Password</h5>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmCambiarPass" onsubmit="frmCambiarPass(event);">
                    <div class="form-floating mb-3">
                      <input type="password" name="clave_actual" id="clave_actual" class="form-control" placeholder="Password Actual">
                      <label for="clave_actual">Password Actual</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="password" name="clave_nueva" id="clave_nueva" class="form-control" placeholder="Password Nuevo">
                      <label for="clave_nueva">Password Nuevo</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="password" name="confirmar_clave" id="confirmar_clave" class="form-control" placeholder="Confirmar Password">
                      <label for="confirmar_clave">Confirmar Password</label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Modificar Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script src="<?php echo base_url; ?>Assets/js/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/chart.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/select2.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url; ?>Assets/DataTables/datatables.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/scripts.js"></script>
<script>
    const base_url = "<?php echo base_url; ?>";
</script>
<script src="<?php echo base_url; ?>Assets/js/funciones.js"></script>
</body>
</html>