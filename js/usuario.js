$(document).ready(function(){
    var funcion = '';
    var id_usuario = $('#id_usuario').val();
    var edit = false;
    buscar_usuario(id_usuario);
    
    function buscar_usuario(dato){
        funcion = 'buscar_usuario';
        $.post('../controlador/usuarioController.php',{dato,funcion},(response)=>{

            let nombre = '';
            let apellidos = '';
            let edad = '';
            let documento_identidad = '';
            let id_tipo_usuario = '';
            let celular = '';
            let direccion = '';
            let correo = '';
            let adicional = '';
            const usuario = JSON.parse(response);
            nombre += `${usuario.nombre}`;
            apellidos += `${usuario.apellidos}`;
            edad += `${usuario.edad}`;
            documento_identidad += `${usuario.documento_identidad}`;
            id_tipo_usuario += `${usuario.id_tipo_usuario}`;
            celular += `${usuario.celular}`;
            direccion += `${usuario.direccion}`;
            correo += `${usuario.correo}`;
            adicional += `${usuario.adicional}`;

            $('#nombre').html(nombre);
            $('#apellidos').html(apellidos);
            $('#edad').html(edad);
            $('#documento_identidad').html(documento_identidad);
            $('#id_tipo_usuario').html(id_tipo_usuario);
            $('#celular').html(celular);
            $('#direccion').html(direccion);
            $('#correo').html(correo);
            $('#adicional').html(adicional);

        })
    }

    $(document).on('click', '.edit', (e)=>{
        funcion = 'capturar_datos';
        edit = true;

        $.post('../controlador/usuarioController.php',{id_usuario,funcion},(response)=>{
            console.log(response);
            const usuario = JSON.parse(response);
            $('input#celular').val(usuario.celular);
            $('input#direccion').val(usuario.direccion);
            $('input#correo').val(usuario.correo);
            $('textarea#adicional').val(usuario.adicional);
        

        })
    })

    $('#form-usuario').submit(e=>{
        if(edit == true){
            let celular = $('input#celular').val();
            let direccion = $('input#direccion').val();
            let correo = $('input#correo').val();
            let adicional = $('textarea#adicional').val();
            funcion = 'editar_usuario';
            $.post('../controlador/usuarioController.php',{id_usuario,celular,direccion,correo,adicional,funcion},(response)=>{

                if (response == 'editado'){
                    $('#editado').hide('slow');
                    $('#editado').show(1000);
                    $('#editado').hide(3000);
                    $('#form-usuario').trigger('reset');
                }
                edit = false;
                buscar_usuario(id_usuario);
            })

        }
        else{
            $('#no_editado').hide('slow');
            $('#no_editado').show(1000);
            $('#no_editado').hide(3000);
            $('#form-usuario').trigger('reset');
        }
        e.preventDefault();
    })
  
})


