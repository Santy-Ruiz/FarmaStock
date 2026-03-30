$(document).ready(function(){
    var funcion = '';
    buscar_datos();

    $(document).on('keyup', '#buscar', function(){
        let valor = $(this).val();
        if(valor != ""){
            buscar_datos(valor);
        } else {
            buscar_datos();
        }
    });

    function buscar_datos(consulta) {
        funcion = 'buscar_usuarios_adm';
        $.post('../controlador/usuarioController.php', {consulta, funcion}, (response)=>{
            const usuarios = JSON.parse(response);
            let template = '';

            usuarios.forEach(usuario => {
                template += `
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                  <div class="card bg-light">
                    <div class="card-header text-muted border-bottom-0">
                      ${usuario.tipo_usuario}
                    </div>
                    <div class="card-body pt-0">
                      <div class="row">
                        <div class="col-7">
                          <h2 class="lead"><b>${usuario.nombre} ${usuario.apellidos}</b></h2>
                          <p class="text-muted text-sm"><b>Sobre mí: </b>${usuario.adicional}</p>
                          <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-id-card"></i></span> DNI: ${usuario.documento_identidad}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span> Edad: ${usuario.edad}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> direccion: ${usuario.direccion}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> celular #: ${usuario.celular}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> Correo: ${usuario.correo}</li>
                          </ul>
                        </div>
                        <div class="col-5 text-center">
                          <img src="${usuario.avatar}" alt="user-avatar" class="img-circle img-fluid">
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <div class="text-right">
                        <button class="btn btn-sm btn-danger" type="button">
                          <i class="fas fa-window-close mr-1"></i>Eliminar
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                `;
            });

            
            $('#usuarios').html(template);
        });
    }

    $('#form-crear').submit(e => {
        let nombre = $('#nombre').val();
        let apellidos = $('#apellidos').val();
        let edad = $('#edad').val(); 
        let dni = $('#documento_identidad').val();
        let pass = $('#pass').val();
        funcion = 'crear_usuario';

        $.post('../controlador/usuarioController.php', {nombre, apellidos, edad, documento_identidad, pass, funcion}, (response) => {
            if (response.trim() == 'add') {
                $('#add').hide('slow');
                $('#add').show(1000);
                $('#add').hide(2000);
                $('#form-crear').trigger('reset');
                buscar_datos();
            } else {
                $('#noadd').hide('slow');
                $('#noadd').show(1000);
                $('#noadd').hide(2000);
                $('#form-crear').trigger('reset');
            }
        });
        e.preventDefault();
    });
});