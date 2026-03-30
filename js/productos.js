$(document).ready(function(){
    var funcion = '';
    var edit = false; // Nuestra bandera para saber si estamos creando o editando

    // --- 1. CARGA INICIAL ---
    cargar_laboratorios();
    cargar_tipos();
    cargar_presentaciones();
    buscar_producto('');
    cargar_proveedores();

    // --- 2. FUNCIONES PARA LLENAR LOS SELECTS ---
    function cargar_laboratorios() {
        funcion = 'cargar_laboratorios';
        $.post('../controlador/AtributoController.php', {funcion}, (response)=>{
            const laboratorios = JSON.parse(response.trim());
            let template = '<option value="" selected disabled>Seleccione Laboratorio</option>';
            laboratorios.forEach(lab => { template += `<option value="${lab.id}">${lab.nombre}</option>`; });
            $('#laboratorio').html(template);
        });
    }

   function cargar_proveedores() {
        let funcion = 'llenar_proveedores';
        $.post('../controlador/ProveedorController.php', {funcion}, (response)=>{
            // Imprimimos la respuesta cruda para ver si hay errores de PHP ocultos
            console.log("Respuesta cruda de Proveedores:", response); 
            
            try {
                const proveedores = JSON.parse(response.trim());
                let template = '<option value="" selected disabled>Seleccione Proveedor</option>';
                proveedores.forEach(prov => { 
                    template += `<option value="${prov.id}">${prov.nombre}</option>`; 
                });
                $('#proveedor').html(template);
            } catch (error) {
                console.error("Error al cargar proveedores. El JSON se rompió:", error);
            }
        });
    }


    function cargar_tipos() {
        funcion = 'cargar_tipos';
        $.post('../controlador/AtributoController.php', {funcion}, (response)=>{
            const tipos = JSON.parse(response.trim());
            let template = '<option value="" selected disabled>Seleccione Tipo</option>';
            tipos.forEach(tipo => { template += `<option value="${tipo.id}">${tipo.nombre}</option>`; });
            $('#tipo').html(template);
        });
    }

    function cargar_presentaciones() {
        funcion = 'cargar_presentaciones';
        $.post('../controlador/AtributoController.php', {funcion}, (response)=>{
            const presentaciones = JSON.parse(response.trim());
            let template = '<option value="" selected disabled>Seleccione Presentación</option>';
            presentaciones.forEach(pre => { template += `<option value="${pre.id}">${pre.nombre}</option>`; });
            $('#presentacion').html(template);
        });
    }

    // --- 3. FUNCIONES DEL BUSCADOR ---
    $(document).on('keyup', '#buscar-producto', function(){
        let valor = $(this).val();
        if(valor != ""){ buscar_producto(valor); } else { buscar_producto(''); }
    });

    function buscar_producto(consulta) {
        funcion = 'buscar_producto';
        $.post('../controlador/ProductoController.php', {consulta, funcion}, (response)=>{
            try {
                const productos = JSON.parse(response.trim());
                let template = '';
                productos.forEach(producto => {
                    template += `
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                      <div class="card bg-light w-100">
                        <div class="card-header text-muted border-bottom-0">
                          <i class="fas fa-cubes"></i> ${producto.tipo}
                        </div>
                        <div class="card-body pt-0">
                          <div class="row">
                            <div class="col-7">
                              <h2 class="lead"><b>${producto.nombre}</b></h2>
                              <h4 class="lead"><b><i class="fas fa-pills"></i> ${producto.concentracion}</b></h4>
                              <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Lab: ${producto.laboratorio}</li>
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> Pres: ${producto.presentacion}</li>
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-plus-square"></i></span> Adic: ${producto.adicional}</li>
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-dollar-sign"></i></span> <b>Precio: $${producto.precio}</b></li>
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-boxes"></i></span> <b class="text-success">Stock Total: ${producto.stock}</b></li>
                              </ul>
                            </div>
                            <div class="col-5 text-center">
                              <img src="../img/medicamento.png" alt="producto" class="img-circle img-fluid">
                            </div>
                          </div>
                        </div>
                        <div class="card-footer">
                          <div class="text-right">
                            <button class="editar btn btn-sm btn-success" type="button" title="Editar" id="${producto.id}">
                              <i class="fas fa-pencil-alt"></i>
                            </button>
                            <button class="borrar btn btn-sm btn-danger" type="button" title="Eliminar" id="${producto.id}" nombre="${producto.nombre}">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                            <button class="lote btn btn-sm btn-primary" type="button" title="Agregar Lote" id="${producto.id}" nombre="${producto.nombre}">
                                <i class="fas fa-plus-square"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    `;
                });
                $('#productos').html(template);
            } catch (error) { console.error("Error en JSON", error); }
        });
    }

    // --- 4. EVENTO CLICK EN BOTÓN EDITAR (LLENAR MODAL) ---
    $(document).on('click', '.editar', function(){
        let id = $(this).attr('id');
        funcion = 'obtener_producto';
        edit = true; // ACTIVAMOS MODO EDICIÓN

        $.post('../controlador/ProductoController.php', {id, funcion}, (response)=>{
            const producto = JSON.parse(response.trim());
            $('#id_edit_prod').val(producto.id);
            $('#nombre').val(producto.nombre);
            $('#concentracion').val(producto.concentracion);
            $('#adicional').val(producto.adicional);
            $('#precio').val(producto.precio);
            $('#laboratorio').val(producto.laboratorio).trigger('change');
            $('#tipo').val(producto.tipo).trigger('change');
            $('#presentacion').val(producto.presentacion).trigger('change');
            $('#crear-producto').modal('show');
        });
    });

    // --- 5. EVENTO SUBMIT ÚNICO Y BLINDADO ---
    // Usamos .off('submit') antes del .on para matar eventos duplicados
    $('#form-crear-producto').off('submit').on('submit', e => {
        e.preventDefault(); 

        // Escudo 2: Desactivamos el botón de guardar para evitar doble clic
        let btnGuardar = $(this).find('button[type="submit"]');
        btnGuardar.prop('disabled', true);

        let id = $('#id_edit_prod').val();
        let nombre = $('#nombre').val();
        let concentracion = $('#concentracion').val();
        let adicional = $('#adicional').val();
        let precio = $('#precio').val();
        let laboratorio = $('#laboratorio').val();
        let tipo = $('#tipo').val();
        let presentacion = $('#presentacion').val();
        
        if (laboratorio === null || tipo === null || presentacion === null) {
            Swal.fire({icon: 'warning', title: 'Faltan datos', text: 'Seleccione Laboratorio, Tipo y Presentación.'});
            btnGuardar.prop('disabled', false); // Volvemos a activar el botón
            return;
        }

        if(edit == true) {
            funcion = 'editar_producto';
        } else {
            funcion = 'crear_producto';
        }

        $.post('../controlador/ProductoController.php', {
            id, nombre, concentracion, adicional, precio, laboratorio, tipo, presentacion, funcion
        }, (response) => {
            
            // Reactivamos el botón al recibir la respuesta
            btnGuardar.prop('disabled', false);

            if(response.trim() == 'add'){
                Swal.fire({position: 'center', icon: 'success', title: 'Producto creado', showConfirmButton: false, timer: 1500});
                $('#form-crear-producto').trigger('reset');
                $('#laboratorio, #tipo, #presentacion').val('').trigger('change');
                buscar_producto(''); 
            }
            else if(response.trim() == 'edit'){
                Swal.fire({position: 'center', icon: 'success', title: 'Producto editado', showConfirmButton: false, timer: 1500});
                $('#form-crear-producto').trigger('reset');
                $('#laboratorio, #tipo, #presentacion').val('').trigger('change');
                $('#crear-producto').modal('hide'); 
                edit = false; 
                buscar_producto(''); 
            }
            else if(response.trim() == 'noadd' || response.trim() == 'noedit'){
                 Swal.fire({icon: 'error', title: 'Error', text: 'El producto ya existe (Nombre y Concentración).'});
            }
        });
    });

    // --- 6. EVENTO ELIMINAR ---
    $(document).on('click', '.borrar', function() {
        let id = $(this).attr('id');
        let nombre = $(this).attr('nombre');
        funcion = 'borrar_producto';

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Se eliminará el producto: " + nombre,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                $.post('../controlador/ProductoController.php', {id, funcion}, (response) => {
                    if (response.trim() == 'borrado') {
                        Swal.fire('¡Eliminado!', 'El producto ' + nombre + ' ha sido borrado.', 'success');
                        buscar_producto('');
                    } else {
                        Swal.fire({icon: 'error', title: 'Error', text: 'No se pudo eliminar el producto.'});
                    }
                });
            }
        });
    });

    // --- 7. RESETEAR FORMULARIO SI EL USUARIO CIERRA EL MODAL ---
    $('#crear-producto').on('hidden.bs.modal', function () {
        edit = false; // Apagamos bandera si cancelan
        $('#form-crear-producto').trigger('reset');
        $('#laboratorio, #tipo, #presentacion').val('').trigger('change');
    });

    // --- 8. EVENTO CLICK EN BOTÓN "+" (ABRIR MODAL LOTE) ---
    $(document).on('click', '.lote', function(){
        let id = $(this).attr('id');
        let nombre = $(this).attr('nombre');
        
        // Llenamos el ID oculto y el título del modal
        $('#id_lote_prod').val(id);
        $('#nombre_producto_lote').html(nombre);
        $('#crear-lote').modal('show');
    });

    // --- 9. EVENTO GUARDAR LOTE ---
    $('#form-crear-lote').off('submit').on('submit', function(e){
        e.preventDefault();
        
        let id_producto = $('#id_lote_prod').val();
        let proveedor = $('#proveedor').val();
        let stock = $('#stock').val();
        let vencimiento = $('#vencimiento').val();
        let funcion = 'crear_lote';

        if (proveedor === null) {
            Swal.fire({icon: 'warning', title: 'Faltan datos', text: 'Por favor seleccione un proveedor.'});
            return;
        }

        $.post('../controlador/LoteController.php', {
            id_producto, proveedor, stock, vencimiento, funcion
        }, (response) => {
            console.log("Respuesta de LoteController:", response); // ESTO ES CLAVE

            if(response.trim() == 'add'){
                Swal.fire({position: 'center', icon: 'success', title: 'Lote ingresado exitosamente', showConfirmButton: false, timer: 1500});
                $('#form-crear-lote').trigger('reset');
                $('#proveedor').val('').trigger('change');
                $('#crear-lote').modal('hide');
                buscar_producto(''); 
            } else {
                // Ahora el SweetAlert te mostrará el error real de la base de datos
                Swal.fire({
                    icon: 'error', 
                    title: 'Error de Base de Datos', 
                    text: response // Mostramos el mensaje exacto
                });
            }
        });
    });

});