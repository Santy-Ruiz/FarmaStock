<?php
session_start();
if($_SESSION['id_tipo_usuario']==1){
    include_once 'layouts/header.php';
?>

  <title>FarmaStock | Catalogo</title>
<?php
    include_once 'layouts/nav.php';
?>
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catálogo de Medicamentos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Catálogo Principal</li>
            </ol>
          </div>
        </div>
      </div></section>

    <section class="content">

      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Buscar Medicamento en Inventario</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Minimizar">
              <i class="fas fa-minus"></i>
            </button>
            </div>
        </div>
        
        <div class="card-body">
            <div class="input-group mb-4">
              <input type="text" id="buscar-medicamento" class="form-control form-control-lg" placeholder="Escriba el nombre del medicamento para buscar...">
              <div class="input-group-append">
                <button class="btn btn-lg btn-default"><i class="fas fa-search"></i></button>
              </div>
            </div>

            <div id="medicamentos" class="row d-flex align-items-stretch">
                </div>
        </div>
        <div class="card-footer text-muted text-center">
          Utilice la barra de búsqueda para filtrar rápidamente por nombre.
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

<script src="../js/catalogo.js"></script>