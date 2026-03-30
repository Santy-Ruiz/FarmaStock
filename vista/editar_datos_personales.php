<?php
session_start();
if($_SESSION['id_tipo_usuario']==1){
    include_once 'layouts/header.php';
?>

  <title>FarmaStock | Editar Datos Personales</title>
<?php
    include_once 'layouts/nav.php';
?>

  <div class="content-wrapper">
   
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Datos Personales</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vista/admin_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Datos Personales</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section>
        <div class = "content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3">
                <div class="card card-success card-outline">
                  <div class="card-body box-profile ">
                    <div class="text-center">
                      <img src="../img/doctor_avatar.png" class="profile-user-img img-fluid img-circle">
                    </div>
                    <input id="id_usuario" type="hidden" value="<?php echo $_SESSION['usuario']; ?>">
                      <h3 id = "nombre" class="profile-username text-center text-succes">Nombre</h3>
                      <p id="apellidos" class="text-muted text-center">Apellidos</p>
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class = "list-group-item">
                          <b style="color: #0B7300;">Edad</b><a id = "edad" class="float-right">12</a>
                        </li>
                          <li class = "list-group-item">
                          <b style="color: #0B7300;">Documento de identidad</b><a id="documento_identidad" class="float-right">12</a>
                        </li>
                          <li class = "list-group-item">
                          <b style="color: #0B7300;">Tipo Usuario</b>
                          <span id="id_tipo_usuario" class="float-right badge badge-primary">Administrador</span>
                        </li>
                      </ul>
                  </div>
                </div>
                 <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-tittle">Sobre mi</h3>
                </div>
                <div class="card-body">
                  <strong>
                    <i class="fas fa-phone mr-1"></i>Celular
                  </strong>
                  <p id="celular" class="text-muted">312-477-3041</p>
                   <strong>
                    <i class="fas fa-map-marker-alt mr-1"></i>Dirección
                  </strong>
                  <p id="direccion" class="text-muted">312-477-3041</p>
                   <strong>
                    <i class="fas fa-envelope mr-1"></i>Correo Electrónico
                  </strong>
                  <p id="correo" class="text-muted">312-477-3041</p>
                   <strong>
                    <i class="fas fa-pencil-alt mr-1"></i>Información adicional
                  </strong>
                  <p id="adicional" class="text-muted">312-477-3041</p>
                  <button class = "edit btn btn-block bg-gradient-danger" >Editar</button>
                </div>
                <div class="card-footer">
                  <p class="text-muted">Click en boton si desea editar datos personales</p>
                </div>
              </div>
              </div>
              <div class="col-md-9">
         <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Editar Datos Personales</h3>
          </div>
          <div class="card-body">
            <div class="alert alert-success text-center" id="editado" style="display:none;">
              <span><i class="fas fa-check m-1"></i>Datos editados exitosamente</span>
            </div>
            <div class="alert alert-danger text-center" id="no_editado" style="display:none;">
              <span><i class="fas fa-times m-1"></i>Edición deshabilitada</span>
            </div>
            
            <form id="form-usuario" class="form-horizontal">
              <div class="form-group row">
                <label for="celular" class="col-sm-2 col-form-label">Celular</label>
                <div class="col-sm-10">
                  <input type="number" id="celular" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
                <div class="col-sm-10">
                  <input type="text" id="direccion" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label for="correo" class="col-sm-2 col-form-label">Correo Electrónico</label>
                <div class="col-sm-10">
                  <input type="email" id="correo" class="form-control">
                </div>
              </div>
              
              <div class="form-group row">
                <label for="adicional" class="col-sm-2 col-form-label">Información adicional</label>
                <div class="col-sm-10">
                  <textarea class="form-control" id="adicional" cols="30" rows="10"></textarea>
                </div>
              </div>
              
              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10 float-right">
                  <button type="submit" class="btn btn-block btn-outline-success">Guardar Cambios</button>
                </div>
              </div>
            </form> </div>
          <div class="card-footer">
            <p class="text-muted">Verifica tus datos antes de guardar cambios</p>
          </div>
        </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
  </div> 

<?php
include_once 'layouts/footer.php';
}
else{
    header('Location: ../index.php');
}
?>
<script src = "../js/usuario.js"></script>