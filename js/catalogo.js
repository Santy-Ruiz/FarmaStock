$(document).ready(function(){
    
    console.log("Iniciando catálogo...");
    buscar_producto('');

    // Evento para capturar las teclas en el buscador
    $(document).on('keyup', '#buscar-medicamento', function(){
        let valor = $(this).val();
        if(valor != ""){
            buscar_producto(valor);
        } else {
            buscar_producto('');
        }
    });

    // Función que arma las tarjetas
    function buscar_producto(consulta) {
        let funcion = 'buscar_producto'; 
        console.log("Enviando consulta:", consulta);
        
        $.post('../controlador/ProductoController.php', {consulta, funcion}, (response)=>{
            console.log("Respuesta cruda del servidor:", response); // ESTO ES CLAVE
            
            try {
                
                const productos = JSON.parse(response.trim());
                let template = '';
                
                if(productos.length === 0){
                    template = '<div class="col-12 text-center p-4"><h5 class="text-muted">No hay medicamentos registrados en el inventario.</h5></div>';
                } else {
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
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Laboratorio: ${producto.laboratorio}</li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> Presentación: ${producto.presentacion}</li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-plus-square"></i></span> Adicional: ${producto.adicional}</li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-dollar-sign"></i></span> <b>Precio: $${producto.precio}</b></li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-boxes"></i></span> <b class="text-success">Stock Total: ${producto.stock}</b></li>
                                  </ul>
                                </div>
                                <div class="col-5 text-center">
                                  <img src="../img/medicamento.png" alt="medicamento" class="img-circle img-fluid">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        `;
                    });
                }
                
                $('#medicamentos').html(template);
                
            } catch (error) {
                console.error("Error crítico al procesar JSON. Revisa la respuesta del servidor arriba.", error);
            }
        });
    }
});