    <?php 
$categories = CategoryData::getAll();
    ?>
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <strong><i class="cil-plus"></i> Nuevo Producto</strong>
      </div>
      <div class="card-body">
        <form method="post" enctype="multipart/form-data" id="addproduct" action="index.php?view=addproduct">
          <div class="row g-4">
            <!-- Columna Izquierda -->
            <div class="col-12 col-lg-6">
              <div class="card h-100">
                <div class="card-header bg-light">
                  <strong>Información Básica</strong>
                </div>
                <div class="card-body">
                  <div class="mb-3">
                    <label class="form-label text-muted" for="image">Imagen del Producto</label>
                    <input type="file" class="form-control" name="image" id="image">
                  </div>

                  <div class="mb-3">
                    <label class="form-label text-muted" for="product_code">Código de Barras*</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="cil-barcode"></i></span>
                      <input type="text" name="barcode" id="product_code" class="form-control" placeholder="Escanee o ingrese el código">
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label text-muted" for="name">Nombre del Producto*</label>
                    <input type="text" name="name" required class="form-control" id="name" placeholder="Ej: Laptop HP 15">
                  </div>

                  <div class="mb-3">
                    <label class="form-label text-muted" for="category_id">Categoría</label>
                    <select name="category_id" id="category_id" class="form-select">
                      <option value="">-- SELECCIONE CATEGORÍA --</option>
                      <?php foreach($categories as $category):?>
                        <option value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
                      <?php endforeach;?>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label text-muted" for="description">Descripción</label>
                    <textarea name="description" class="form-control" id="description" rows="4" placeholder="Describa las características del producto"></textarea>
                  </div>
                </div>
              </div>
            </div>

            <!-- Columna Derecha -->
            <div class="col-12 col-lg-6">
              <div class="card h-100">
                <div class="card-header bg-light">
                  <strong>Precios e Inventario</strong>
                </div>
                <div class="card-body">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label text-muted" for="price_in">Precio de Entrada*</label>
                      <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" step="0.01" name="price_in" required class="form-control" id="price_in" placeholder="0.00">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <label class="form-label text-muted" for="price_out">Precio de Salida*</label>
                      <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" step="0.01" name="price_out" required class="form-control" id="price_out" placeholder="0.00">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <label class="form-label text-muted" for="unit">Unidad*</label>
                      <input type="text" name="unit" required class="form-control" id="unit" placeholder="Ej: Pieza, Kg, Lt">
                    </div>

                    <div class="col-md-6">
                      <label class="form-label text-muted" for="presentation">Presentación</label>
                      <input type="text" name="presentation" class="form-control" id="presentation" placeholder="Ej: Caja, Paquete">
                    </div>

                    <div class="col-md-6">
                      <label class="form-label text-muted" for="inventary_min">Stock Mínimo</label>
                      <input type="number" name="inventary_min" class="form-control" id="inventary_min" placeholder="Mínimo: 10">
                    </div>

                    <div class="col-md-6">
                      <label class="form-label text-muted" for="inventary_in">Stock Inicial</label>
                      <input type="number" name="inventary_in" class="form-control" id="inventary_in" placeholder="Cantidad inicial">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary btn-lg px-4">
              <i class="cil-save me-2"></i> Guardar Producto
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    $("#product_code").keydown(function(e){
        if(e.which==17 || e.which==74 ){
            e.preventDefault();
        }else{
            console.log(e.which);
        }
    })
});

</script>