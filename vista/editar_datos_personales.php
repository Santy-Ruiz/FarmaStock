<?php
session_start();
if($_SESSION['id_tipo_usuario']==1){
    include_once 'layouts/header.php';
?>

  <title>FarmaStock | Editar Datos Personales</title>
<?php
    include_once 'layouts/nav.php';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
                    <div class="class text-center">
                      <img src="../img/doctor_avatar.png" class="profile-user-img img-fluid img-circle">
                      <h3 class="profile-username text-center text-succes">Nombre</h3>
                      <p class="text-muted text-center">Apellidos</p>
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class = "list-group-item">
                          <b style="color: #0B7300;">Edad</b>
                        </li>
                      </ul>
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