let tblUsuarios, tblCajas, tblClientes, tblCategorias, tblMedidas, tblProductos, tblDetalle, tblHistCompras, tblHistVentas, tblArqueo;
document.addEventListener("DOMContentLoaded", function () {
    
    $('#cliente').select2();

    const buttons = [{
            extend: 'excelHtml5',
            footer: true,
            title: 'Archivo',
            filename: 'Export_File',
            text: '<span class="badge bg-success"><i class="fas fa-file-excel"></i></span>'
        },
        {
            extend: 'pdfHtml5',
            download: 'open',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  bg-danger"><i class="fas fa-file-pdf"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        {
            extend: 'copyHtml5',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  bg-primary"><i class="fas fa-copy"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        {
            extend: 'print',
            footer: true,
            filename: 'Export_File_print',
            text: '<span class="badge bg-dark"><i class="fas fa-print"></i></span>'
        },
        {
            extend: 'csvHtml5',
            footer: true,
            filename: 'Export_File_csv',
            text: '<span class="badge  bg-success"><i class="fas fa-file-csv"></i></span>'
        }, {
            extend: 'colvis',
            text: '<span class="badge  bg-info"><i class="fas fa-columns"></i></span>',
            postfixButtons: ['colvisRestore']
        }
    ]
    const dom = "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-5'i><'col-sm-7'p>>";
    
    tblUsuarios = $('#tblUsuarios').DataTable({
        ajax: {
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        },
        columns: [
            {'data' : 'id'},
            {'data': 'usuario'},
            {'data': 'nombre'},
            {'data': 'caja'},
            {'data': 'estado'},
            {'data': 'acciones'}
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons
    });//Fin de la tabla usuarios

    tblCajas = $('#tblCajas').DataTable({
        ajax: {
            url: base_url + "Cajas/listar",
            dataSrc: ''
        },
        columns: [
            {'data': 'id'},
            {'data': 'caja'},
            {'data': 'estado'},
            {'data': 'acciones'}
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons
    });//Fin de la tabla Cajas

    tblClientes = $('#tblClientes').DataTable({
        ajax: {
            url: base_url + "Clientes/listar",
            dataSrc: ''
        },
        columns: [
            {'data' :'id'},
            {'data': 'rif'},
            {'data': 'nombre'},
            {'data': 'telefono'},
            {'data': 'direccion'},
            {'data': 'estado'},
            {'data': 'acciones'}
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons
    });//Fin de la tabla clientes

    tblCategorias = $('#tblCategorias').DataTable({
        ajax: {
            url: base_url + "Categorias/listar",
            dataSrc: ''
        },
        columns: [
            {'data': 'id'},
            {'data': 'nombre'},
            {'data': 'estado'},
            {'data': 'acciones'}
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons
    });//Fin de la tabla Categorias

    tblMedidas = $('#tblMedidas').DataTable({
        ajax: {
            url: base_url + "Medidas/listar",
            dataSrc: ''
        },
        columns: [
            {'data': 'id'},
            { 'data': 'nombre' },
            {'data': 'nombre_corto'},
            {'data': 'estado'},
            {'data': 'acciones'}
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons
    });//Fin de la tabla Medidas

    tblProductos = $('#tblProductos').DataTable({
        ajax: {
            url: base_url + "Productos/listar",
            dataSrc: ''
        },
        columns: [
            {'data': 'id'},
            {'data': 'imagen'},
            {'data': 'codigo'},
            {'data': 'descripcion'},
            {'data': 'precio_venta' },
            {'data': 'precio_venta_bolos'},
            {'data': 'cantidad' },
            {'data': 'estado'},
            {'data': 'acciones'}
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons
    });//Fin de la tabla Productos

    tblHistCompras = $('#t_historial_c').DataTable({
        ajax: {
            url: base_url + "Compras/listar_historial",
            dataSrc: ''
        },
        columns: [
            {'data': 'id'},
            {'data': 'total'},
            {'data': 'total_bolos'},
            {'data': 'fecha'},
            {'data': 'estado'},
            {'data': 'acciones'}
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons
    });//Fin de la tabla Historial Compras

    tblHistVentas = $('#t_historial_v').DataTable({
        ajax: {
            url: base_url + "Ventas/listar_historial",
            dataSrc: ''
        },
        columns: [
            {'data': 'id'},
            {'data': 'nombre'},
            {'data': 'total'},
            {'data': 'total_bolos'},
            {'data': 'fecha'},
            {'data': 'estado'},
            {'data': 'acciones'}
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons
    });//Fin de la tabla Historial Ventas

    tblArqueo = $('#tblArqueo').DataTable({
        ajax: {
            url: base_url + "Cajas/listarArqueos",
            dataSrc: ''
        },
        columns: [
            {'data': 'id'},
            {'data': 'monto_inicial'},
            {'data': 'monto_final'},
            {'data': 'fecha_apertura'},
            {'data': 'fecha_cierre'},
            {'data': 'total_ventas'},
            {'data': 'monto_total'},
            {'data': 'estado'}
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons
    });//Fin de la tabla Arqueos
})

function frmCambiarPass(e) {
    e.preventDefault();
    const actual = document.getElementById("clave_actual").value;
    const nueva = document.getElementById("clave_nueva").value;
    const confirmar = document.getElementById("confirmar_clave").value;

    if (actual == "" || nueva == "" || confirmar == "") {
        alertas('Todos los campos son obligatorios', 'warning');
    } else {
        if (nueva != confirmar) {
            alertas('La Nueva Clave no coincide con la Confirmacion', 'warning');
        } else {
            const url = base_url + "Usuarios/cambiarPass";
            const frm = document.getElementById("frmCambiarPass");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    $("#cambiarPass").modal("hide");
                    alertas(res.msg, res.icono);
                    frm.reset();
                    location.reload();
                }
            }
        }
    }
}

function frmUsuario() {
    document.getElementById("title").textContent = "Nuevo Usuario";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmUsuario").reset();
    document.getElementById("id").value = "";
    $('#nuevo_usuario').modal('show');
}
function registrarUser(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const nombre = document.getElementById("nombre");
    const caja = document.getElementById("caja");
    if (usuario.value == "" || nombre.value == "" || caja.value == "") {
        alertas('Todo los campos son obligatorios', 'warning');
    } else {
        const url = base_url + "Usuarios/registrar";
        const frm = document.getElementById("frmUsuario");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevo_usuario").modal("hide");
                alertas(res.msg, res.icono);
                tblUsuarios.ajax.reload();
            }
        }
    }
}
function btnEditarUser(id) {
    document.getElementById("title").innerHTML = "Actualizar usuario";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "Usuarios/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("usuario").value = res.usuario;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("caja").value = res.id_caja;
            document.getElementById("claves").classList.add("d-none");
            $('#nuevo_usuario').modal('show');
        }
    }
}
function btnEliminarUser(id) {
    Swal.fire({
        title: 'Esta seguro?',
        text: "El Usuario sera Inactivado!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblUsuarios.ajax.reload();
                }
            }
            
        }
    })
}
function btnReingresarUser(id) {
    Swal.fire({
        title: 'Esta seguro de Reactivar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblUsuarios.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    })
}
//Fin Usuarios

function frmCaja() {
    document.getElementById("title").textContent = "Nueva Caja";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmCaja").reset();
    document.getElementById("id").value = "";
    $('#nuevoCaja').modal('show');

}
function registrarCaja(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    if (nombre.value == "") {
        alertas('El nombre es requerido', 'warning');
    } else {
        const url = base_url + "Cajas/registrar";
        const frm = document.getElementById("frmCaja");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                alertas(res.msg, res.icono);
                frm.reset();
                $('#nuevoCaja').modal('hide');
                tblCajas.ajax.reload();
            }
        }
    }
}
function btnEditarCaja(id) {
    document.getElementById("title").textContent = "Actualizar caja";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "Cajas/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("nombre").value = res.caja;
            $('#nuevoCaja').modal('show');
        }
    }
}
function btnEliminarCaja(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "La caja no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Cajas/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblCajas.ajax.reload();
                }
            }
        }
    })
}
function btnReingresarCaja(id) {
    Swal.fire({
        title: 'Esta seguro de reingresar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Cajas/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblCajas.ajax.reload();
                }
            }
        }
    })
}
//Fin Cajas

function frmCliente() {
    document.getElementById("title").textContent = "Nuevo Cliente";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmCliente").reset();
    $('#nuevo_cliente').modal('show');
    document.getElementById("id").value = "";
}
function registrarCli(e) {
    e.preventDefault();
    const rif = document.getElementById("rif");
    const nombre = document.getElementById("nombre");
    const telefono = document.getElementById("telefono");
    const direccion = document.getElementById("direccion");
    if (rif.value == "" || nombre.value == "" || telefono.value == "" || direccion.value == "") {
        alertas('Todo los campos son obligatorios', 'warning');
    } else {
        const url = base_url + "Clientes/registrar";
        const frm = document.getElementById("frmCliente");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevo_cliente").modal("hide");
                alertas(res.msg, res.icono);
                tblClientes.ajax.reload();
            }
        }
    }
}
function btnEditarCli(id) {
    document.getElementById("title").innerHTML = "Actualizar Cliente";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "Clientes/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("rif").value = res.rif;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("telefono").value = res.telefono;
            document.getElementById("direccion").value = res.direccion;
            $('#nuevo_cliente').modal('show');
        }
    }
}
function btnEliminarCli(id) {
    Swal.fire({
        title: 'Esta seguro?',
        text: "El Cliente sera Inactivado!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Clientes/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblClientes.ajax.reload();
                }
            }
            
        }
    })
}
function btnReingresarCli(id) {
    Swal.fire({
        title: 'Esta seguro de Reactivar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Clientes/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblClientes.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    })
}
//Fin Clientes

function frmCategoria() {
    document.getElementById("title").textContent = "Nueva Categoria";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmCategoria").reset();
    $('#nuevo_categoria').modal('show');
    document.getElementById("id").value = "";
}
function registrarCat(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    if (nombre.value == "") {
        alertas('El Nombre de la Categoria es obligatorio', 'warning');
    } else {
        const url = base_url + "Categorias/registrar";
        const frm = document.getElementById("frmCategoria");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevo_categoria").modal("hide");
                alertas(res.msg, res.icono);
                tblCategorias.ajax.reload();
            }
        }
    }
}
function btnEditarCat(id) {
    document.getElementById("title").innerHTML = "Actualizar Categoria";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "Categorias/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("nombre").value = res.nombre;
            $('#nuevo_categoria').modal('show');
        }
    }
}
function btnEliminarCat(id) {
    Swal.fire({
        title: 'Esta seguro?',
        text: "La Categoria sera Inactivada!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Categorias/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblCategorias.ajax.reload();
                }
            }
            
        }
    })
}
function btnReingresarCat(id) {
    Swal.fire({
        title: 'Esta seguro de Reactivar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Categorias/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblCategorias.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    })
}
//Fin Categorias

function frmMedida() {
    document.getElementById("title").textContent = "Nueva Medida";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmMedida").reset();
    $('#nuevo_medida').modal('show');
    document.getElementById("id").value = "";
}
function registrarMed(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    const nombre_corto = document.getElementById("nombre_corto");
    if (nombre.value == "" || nombre_corto.value == "") {
        alertas('Todos los campos son obligatorios', 'warning');
    } else {
        const url = base_url + "Medidas/registrar";
        const frm = document.getElementById("frmMedida");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevo_medida").modal("hide");
                alertas(res.msg, res.icono);
                tblMedidas.ajax.reload();
            }
        }
    }
}
function btnEditarMed(id) {
    document.getElementById("title").innerHTML = "Actualizar Medida";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "Medidas/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("nombre_corto").value = res.nombre_corto;
            $('#nuevo_medida').modal('show');
        }
    }
}
function btnEliminarMed(id) {
    Swal.fire({
        title: 'Esta seguro?',
        text: "La Categoria sera Inactivada!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Medidas/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblMedidas.ajax.reload();
                }
            }
            
        }
    })
}
function btnReingresarMed(id) {
    Swal.fire({
        title: 'Esta seguro de Reactivar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Medidas/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblMedidas.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    })
}
//Fin Categorias

function frmProducto() {
    document.getElementById("title").textContent = "Nuevo Producto";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmProducto").reset();
    document.getElementById("id").value = "";
    $('#nuevo_producto').modal('show');
    deleteImg();
}
function registrarPro(e) {
    e.preventDefault();
    const codigo = document.getElementById("codigo");
    const descripcion = document.getElementById("descripcion");
    const precio_compra = document.getElementById("precio_compra");
    const precio_venta = document.getElementById("precio_venta");
    const id_medida = document.getElementById("medida");
    const id_cat = document.getElementById("categoria");
    if (codigo.value == "" || descripcion.value == "" || precio_compra.value == "" || precio_venta.value == "") {
        alertas('Todos los campos son obligatorios', 'warning');
    } else {
        const url = base_url + "Productos/registrar";
        const frm = document.getElementById("frmProducto");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevo_producto").modal("hide");
                alertas(res.msg, res.icono);
                tblProductos.ajax.reload();
            }
        }
    }
}
function btnEditarPro(id) {
    document.getElementById("title").innerHTML = "Actualizar Producto";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "Productos/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("codigo").value = res.codigo;
            document.getElementById("descripcion").value = res.descripcion;
            document.getElementById("precio_compra").value = res.precio_compra;
            document.getElementById("precio_venta").value = res.precio_venta;
            document.getElementById("medida").value = res.id_medida;
            document.getElementById("categoria").value = res.id_categoria;
            document.getElementById("img-preview").src = base_url + 'Assets/img/' + res.foto;
            document.getElementById("icon-cerrar").innerHTML = `
            <button class="btn btn-danger" onClick="deleteImg()"><i class="fas fa-times"></i></button>`;
            document.getElementById("icon-image").classList.add("d-none");
            document.getElementById("foto_actual").value = res.foto;
            document.getElementById("foto_delete").value = res.foto;
            $('#nuevo_producto').modal('show');
        }
    }
}
function btnEliminarPro(id) {
    Swal.fire({
        title: 'Esta seguro?',
        text: "El Producto sera Inactivado!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Productos/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblProductos.ajax.reload();
                }
            }
            
        }
    })
}
function btnReingresarPro(id) {
    Swal.fire({
        title: 'Esta seguro de Reactivar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Productos/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblProductos.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    })
}
//Fin Productos

function alertas(mensaje, icono) {
    Swal.fire({
        position: 'top',
        icon: icono,
        title: mensaje,
        showConfirmButton: false,
        timer: 1500
    })
}

function preview(e) {
    const url = e.target.files[0];
    const urlTmp = URL.createObjectURL(url);
    document.getElementById("img-preview").src = urlTmp;
    document.getElementById("icon-image").classList.add("d-none");
    document.getElementById("icon-cerrar").innerHTML = `
    <button class="btn btn-danger" onclick="deleteImg()"><i class="fas fa-times"></i></button>
    ${url['name']}`;
}

function deleteImg() {
    document.getElementById("icon-cerrar").innerHTML = '';
    document.getElementById("icon-image").classList.remove("d-none");
    document.getElementById("img-preview").src = '';
    document.getElementById("imagen").value = '';
    document.getElementById("foto_delete").value = res.foto;
}

function buscarCodigoCompras(e) {
    e.preventDefault();
    const codigo = document.getElementById("codigo").value;
    // if (e.which == 13) { TODO: Si quiero que responda solo a Enter
        if (codigo != "") {
            const url = base_url + "Compras/buscarCodigoCompras/" + codigo;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200 && this.responseText != "") {
                    const res = JSON.parse(this.responseText);
                    if (res) {
                        document.getElementById("descripcion").value = res.descripcion;
                        document.getElementById("precio").value = res.precio_compra;
                        document.getElementById("precio_bolos").value = res.precio_compra_bolos;
                        document.getElementById("id").value = res.id;
                        document.getElementById("cantidad").removeAttribute('disabled');
                        document.getElementById("cantidad").focus();
                    } else {
                        alertas('El Producto no existe', 'warning');
                        document.getElementById("codigo").value = '';
                        document.getElementById("codigo").focus();
                    }
                }
            }
        } else {
            alertas('Ingrese el Codigo', 'warning');
            document.getElementById("cantidad").value = '';
            document.getElementById("codigo").focus();
        }
    //} Fin TODO 
}

function calcularPrecioCompra(e) {
    e.preventDefault();
    if (document.getElementById("codigo").value != '') {
        const cantidad = document.getElementById("cantidad").value;
        const precio = document.getElementById("precio").value;
        const precio_bolos = document.getElementById("precio_bolos").value;
        document.getElementById("sub_total").value = cantidad * precio;
        document.getElementById("sub_total_bolos").value = cantidad * precio_bolos;
        if (e.which == 13) {
            if (cantidad > 0) {
                const url = base_url + "Compras/ingresar";
                const http = new XMLHttpRequest();
                const frm = document.getElementById("frmCompra");
                http.open("POST", url, true);
                http.send(new FormData(frm));
                http.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200 && this.responseText != "") {
                        const res = JSON.parse(this.responseText);
                        alertas(res.msg, res.icono);
                        frm.reset();
                        cargarDetallesCompra();
                        document.getElementById("cantidad").setAttribute('disabled', 'true');
                        document.getElementById("codigo").focus();
                    }
                }
            }
        }
    } else {
        alertas('Ingrese el Codigo', 'warning');
        document.getElementById("cantidad").value = '';
        document.getElementById("codigo").focus();
    }
}

if (document.getElementById('tblDetalleCompra')) {
    cargarDetallesCompra();
}

function cargarDetallesCompra() {
    const url = base_url + "Compras/listar";
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                let html = '';
                res.detalle.forEach(row => {
                    html += `
                    <tr>
                        <td>${row['id']}</td>
                        <td>${row['descripcion']}</td>
                        <td>${row['cantidad']}</td>
                        <td>${row['precio']}</td>
                        <td>${row['precio_bolos']}</td>
                        <td>${row['sub_total']}</td>
                        <td class="d-flex justify-content-end">${row['sub_total_bolos']}</td>
                        <td>
                            <button class="btn btn-danger" type="button" onclick="deleteDetalleCompra(${row['id']})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>`;
                });
                document.getElementById("tblDetalleCompra").innerHTML = html;
                document.getElementById("total").value = res.total_pagar.total;
                document.getElementById("total_bolos").value = res.total_pagar.total_bolos;
            }
        }
}

function deleteDetalleCompra(id) {
    const url = base_url + "Compras/delete/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            alertas(res.msg, res.icono);
            cargarDetallesCompra();
            document.getElementById("codigo").focus();
        }
    }
}

function generarCompra() {
    Swal.fire({
        title: 'Esta seguro de Generar la Compra?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Compras/registrarCompra";
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    const ruta = base_url + 'Compras/generarPdfCompra/' + res.id_compra;
                    window.open(ruta);
                    setTimeout(() => {
                        window.location.reload();
                    }, 300);
                    cargarDetallesCompra();
                }
            }
        }
    })
}

function buscarCodigoVentas(e) {
    e.preventDefault();
    const codigo = document.getElementById("codigo").value;
    // if (e.which == 13) { TODO: Si quiero que responda solo a Enter
    if (codigo != "") {
        const url = base_url + "Ventas/buscarCodigoVentas/" + codigo;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200 && this.responseText != "") {
                const res = JSON.parse(this.responseText);
                if (res) {
                    document.getElementById("descripcion").value = res.descripcion;
                    document.getElementById("precio").value = res.precio_venta;
                    document.getElementById("precio_bolos").value = res.precio_venta_bolos;
                    document.getElementById("id").value = res.id;
                    document.getElementById("cantidad").removeAttribute('disabled');
                    document.getElementById("cantidad").focus();
                } else {
                    alertas('El Producto no existe', 'warning');
                    document.getElementById("codigo").value = '';
                    document.getElementById("codigo").focus();
                }
            }
        }
    } else {
        alertas('Ingrese el Codigo', 'warning');
        document.getElementById("cantidad").value = '';
        document.getElementById("codigo").focus();
    }
    //} Fin TODO
}

function calcularPrecioVenta(e) {
    e.preventDefault();
    if (document.getElementById("codigo").value != '') {
        const cantidad = document.getElementById("cantidad").value;
        const precio = document.getElementById("precio").value;
        const precio_bolos = document.getElementById("precio_bolos").value;
        document.getElementById("sub_total").value = cantidad * precio;
        document.getElementById("sub_total_bolos").value = cantidad * precio_bolos;
        if (e.which == 13) {
            if (cantidad > 0) {
                const url = base_url + "Ventas/ingresar";
                const http = new XMLHttpRequest();
                const frm = document.getElementById("frmVenta");
                http.open("POST", url, true);
                http.send(new FormData(frm));
                http.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200 && this.responseText != "") {
                        const res = JSON.parse(this.responseText);
                        alertas(res.msg, res.icono);
                        frm.reset();
                        cargarDetallesVenta();
                        document.getElementById("cantidad").setAttribute('disabled', 'true');
                        document.getElementById("codigo").focus();
                    }
                }
            }
        }
    } else {
        alertas('Ingrese el Codigo', 'warning');
        document.getElementById("cantidad").value = '';
        document.getElementById("codigo").focus();
    }
}

if (document.getElementById('tblDetalleVenta')) {
    cargarDetallesVenta();
}

function cargarDetallesVenta() {
    const url = base_url + "Ventas/listar";
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                let html = '';
                res.detalle.forEach(row => {
                    html += `
                    <tr>
                        <td>${row['id']}</td>
                        <td>${row['descripcion']}</td>
                        <td>${row['cantidad']}</td>
                        <td>${row['precio']}</td>
                        <td>${row['precio_bolos']}</td>
                        <td>${row['sub_total']}</td>
                        <td class="d-flex justify-content-end">${row['sub_total_bolos']}</td>
                        <td>
                            <button class="btn btn-danger" type="button" onclick="deleteDetalleVenta(${row['id']})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>`;
                });
                document.getElementById("tblDetalleVenta").innerHTML = html;
                document.getElementById("total").value = res.total_pagar.total;
                document.getElementById("total_bolos").value = res.total_pagar.total_bolos;
            }
        }
}

function deleteDetalleVenta(id) {
    const url = base_url + "Ventas/delete/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            alertas(res.msg, res.icono);
            cargarDetallesVenta();
            document.getElementById("codigo").focus();
        }
    }
}

function generarVenta() {
    Swal.fire({
        title: 'Esta seguro de Generar la Venta?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const id_cliente = document.getElementById("cliente").value;
            const url = base_url + "Ventas/registrarVenta/" + id_cliente;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if (res.icono == 'warning') {
                        alertas(res.msg, res.icono);
                    } else {
                        if (res.icono == 'success') {
                            const ruta = base_url + 'Ventas/generarPdfVenta/' + res.id_venta;
                            window.open(ruta);
                            setTimeout(() => {
                                window.location.reload();
                            }, 300);
                            cargarDetallesVenta();
                        }
                    }
                }
            }
        }
    })
}

function modificarEmpresa() {
    const frm = document.getElementById("frmEmpresa");
    const url = base_url + "Administracion/modificarEmpresa";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            alertas(res.msg, res.icono);
        }
    }
}

if (document.getElementById('stockMinimo')) {
    reporteStock();
    reporteMasVendidos();
}

function reporteStock() {
    const url = base_url + "Administracion/reporteStock";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            let nombres = [];
            let cantidades = [];
            for (let i = 0; i < res.length; i++) {
                nombres.push(res[i]['descripcion']);
                cantidades.push(res[i]['cantidad']);
            }
            var ctx = document.getElementById("stockMinimo");
            var stockMinimo = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: nombres,
                    datasets: [{
                        data: cantidades,
                        backgroundColor: ['#007BFF', '#DC3545', '#FFC107', '#28A745', '#FF6E33', '#E333FF', '#33FFF9', '#FF3399', '#86FF33', '#333CFF']
                    }],
                },
            })
        }   
    }
}

function reporteMasVendidos() {
    const url = base_url + "Administracion/reporteMasVendidos";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            let nombres = [];
            let cantidades = [];
            for (let i = 0; i < res.length; i++) {
                nombres.push(res[i]['descripcion']);
                cantidades.push(res[i]['total']);
            }
            var ctx = document.getElementById("masVendidos");
            var masVendidos = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: nombres,
                    datasets: [{
                        data: cantidades,
                        backgroundColor: ['#007BFF', '#DC3545', '#FFC107', '#28A745', '#FF6E33', '#E333FF', '#33FFF9', '#FF3399', '#86FF33', '#333CFF']
                    }],
                },
            })
        }   
    }
}

function btnAnularCompra(id) {
    Swal.fire({
        title: 'Esta seguro de Anular la Compra?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Compras/anularCompra/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblHistCompras.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    })
}

function btnAnularVenta(id) {
    Swal.fire({
        title: 'Esta seguro de Anular la Venta?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Ventas/anularVenta/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblHistVentas.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    })
}

function arqueoCaja() {
    document.getElementById("detalles").classList.add('d-none');
    document.getElementById("monto_inicial").value = '';
    document.getElementById("btnAccion").textContent = 'Aperturar Caja';
    $('#aperturarCaja').modal('show');
}

function abrirArqueo(e) {
    e.preventDefault();
    const monto_inicial = document.getElementById('monto_inicial').value;
    if (monto_inicial == '') {
        alertas('El Monto Inicial no puede ser vacio', 'error');
    } else {
        const frm = document.getElementById('frmAperturaCaja');
        const url = base_url + "Cajas/abrirArqueo";
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $('#aperturarCaja').modal('hide');
                tblArqueo.ajax.reload();
                alertas(res.msg, res.icono);
            }   
        }
    }
}

function cerrarCaja() {
    const url = base_url + "Cajas/getVentas";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            const id = res.montos_iniciales.id;
            const total_ventas = res.totales.total_ventas;
            const monto_final = res.totales.monto_total;
            const monto_inicial = res.montos_iniciales.monto_inicial;
            const monto_total = res.montos_totales;
            document.getElementById("monto_inicial").value = monto_inicial;
            document.getElementById("total_ventas").value = total_ventas;
            document.getElementById("monto_final").value = monto_final;
            document.getElementById("monto_total").value = monto_total;
            document.getElementById("detalles").classList.remove('d-none');
            document.getElementById("id").value = id;
            document.getElementById("btnAccion").textContent = 'Cerrar Caja';
            $('#aperturarCaja').modal('show');
        }   
    }
}

function salir() {
    session_destroy();
    header("location: ".base_url);
}

function registrarPermisos(e) {
    e.preventDefault();
    const url = base_url + "Usuarios/registrarPermisos";
    const frm = document.getElementById('frmPermisos');
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            alertas(res.msg, res.icono);
        }   
    }
}