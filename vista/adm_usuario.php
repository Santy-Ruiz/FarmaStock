<?php
session_start();
if($_SESSION['id_tipo_usuario'] == 1 || $_SESSION['id_tipo_usuario'] == 2) { 
    include_once 'layouts/header.php';
?>

  <title>Farmacia | Gestion Usuarios</title>

<?php
    include_once 'layouts/nav.php';
?>

<div class="modal fade" id="crearusuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Crear usuario</h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div id="usuarios" class="row d-flex align-items-stretch"></div>
          <form id="form-crear">
            <div class="alert alert-success text-center" id="add" style="display:none;">
                <span><i class="fas fa-check m-1"></i>Se agregó correctamente</span>
            </div>
            <div class="alert alert-danger text-center" id="noadd" style="display:none;">
                <span><i class="fas fa-times m-1"></i>El documento de identidad ya existe en otro usuario</span>
            </div>
            <div class="form-group">
              <label for="nombre">Nombres</label>
              <input type="text" id="nombre" class="form-control" placeholder="Ingrese nombre" required>
            </div>
            <div class="form-group">
              <label for="apellidos">Apellidos</label>
              <input type="text" id="apellidos" class="form-control" placeholder="Ingrese apellido" required>
            </div>
            <div class="form-group">
              <label for="edad">Nacimiento</label>
              <input type="date" id="edad" class="form-control" placeholder="Ingrese fecha de nacimiento" required>
            </div>
            <div class="form-group">
              <label for="documento_identidad">Documento de identidad</label>
              <input type="text" id="documento_identidad" class="form-control" placeholder="Ingrese documento de identidad" required>
            </div>
            <div class="form-group">
              <label for="pass">Password</label>
              <input type="password" id="pass" class="form-control" placeholder="Ingrese password" required>
            </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
          <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestión usuarios</h1>
            <button type="button" data-toggle="modal" data-target="#crearusuario" class="btn bg-gradient-primary ml-2">Crear usuario</button>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestión usuario</li>
            </ol>
          </div>
        </div>
      </div></section>

    <section class="content">
      <div class="container-fluid">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Buscar usuario</h3>
            <div class="input-group">
              <input type="text" id="buscar" class="form-control float-left" placeholder="Ingrese nombre de usuario">
              <div class="input-group-append">
                <button class="btn btn-default"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
          <div class="card-body">
             </div>
          <div class="card-footer">
            
          </div>
        </div>
      </div>
    </section>
    </div>
<?php
    include_once 'layouts/footer.php';
} else {
    header('Location: ../index.php');
}
?>
<script src = "../js/Gestion_usuario.js"></script>