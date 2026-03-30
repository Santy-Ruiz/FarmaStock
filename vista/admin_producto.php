<?php
session_start();
// Validación de sesión (Administrador o Técnico)
if($_SESSION['id_tipo_usuario'] == 1 || $_SESSION['id_tipo_usuario'] == 2) { 
    include_once 'layouts/header.php';
?>

  <title>Farmacia | Gestión Productos</title>

<?php
    include_once 'layouts/nav.php';
?>
<div class="modal fade" id="crear-producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Crear Producto</h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <form id="form-crear-producto">
          
          <input type="hidden" id="id_edit_prod">

          <div class="card-body">
            
            <div class="form-group">
              <label for="nombre">Nombre del Producto</label>
              <input type="text" id="nombre" class="form-control" placeholder="Ingrese nombre" required>
            </div>

            <div class="form-group">
              <label for="concentracion">Concentración</label>
              <input type="text" id="concentracion" class="form-control" placeholder="Ej: 500mg" required>
            </div>

            <div class="form-group">
              <label for="adicional">Información Adicional (Opcional)</label>
              <input type="text" id="adicional" class="form-control" placeholder="Ej: Caja x 30 tabletas">
            </div>

            <div class="form-group">
              <label for="precio">Precio</label>
              <input type="number" step="0.01" id="precio" class="form-control" placeholder="0.00" required>
            </div>

            <div class="form-group">
              <label for="laboratorio">Laboratorio</label>
              <select id="laboratorio" class="form-control select2" style="width: 100%;"></select>
            </div>

            <div class="form-group">
              <label for="tipo">Tipo de Producto</label>
              <select id="tipo" class="form-control select2" style="width: 100%;"></select>
            </div>

            <div class="form-group">
              <label for="presentacion">Presentación</label>
              <select id="presentacion" class="form-control select2" style="width: 100%;"></select>
            </div>

          </div> <div class="card-footer">
            <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar Producto</button>
            <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
          </div>
          
        </form> </div>
    </div>
  </div>
</div>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestión Productos</h1>
            <button type="button" data-toggle="modal" data-target="#crear-producto" class="btn bg-gradient-primary ml-2">Crear Producto</button>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestión Producto</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Buscar Producto</h3>
            <div class="input-group">
              <input type="text" id="buscar-producto" class="form-control float-left" placeholder="Ingrese nombre de producto">
              <div class="input-group-append">
                <button class="btn btn-default"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
          <div class="card-body">
             <div id="productos" class="row d-flex align-items-stretch"></div>
          </div>
        </div>
      </div>
    </section>
</div>

<div class="modal fade" id="crear-lote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Ingresar Lote: <span id="nombre_producto_lote"></span></h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-crear-lote">
          <input type="hidden" id="id_lote_prod">
          <div class="card-body">
            
            <div class="form-group">
              <label for="proveedor">Proveedor</label>
              <select id="proveedor" class="form-control select2" style="width: 100%;" required></select>
            </div>

            <div class="form-group">
              <label for="stock">Cantidad (Stock)</label>
              <input type="number" id="stock" class="form-control" placeholder="Ej: 50" required>
            </div>

            <div class="form-group">
              <label for="vencimiento">Fecha de Vencimiento</label>
              <input type="date" id="vencimiento" class="form-control" required>
            </div>

          </div>
          <div class="card-footer">
            <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar Lote</button>
            <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
    include_once 'layouts/footer.php';
} else {
    // Redirección si no es usuario autorizado
    header('Location: ../index.php');
}
?>
<script src="../js/productos.js"></script>