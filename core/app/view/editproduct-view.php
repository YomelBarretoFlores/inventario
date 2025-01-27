<?php
$product = ProductData::getById($_GET["id"]);
$categories = CategoryData::getAll();

if($product!=null):
?>
<div class="container-lg">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <!-- Card Header -->
        <div class="card-header pb-0">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h5 class="mb-0">
                <i class="cil-pencil text-primary me-2"></i>
                Editar Producto
              </h5>
              <p class="text-sm mb-0 text-muted">
                <?php echo htmlspecialchars($product->name) ?>
              </p>
            </div>
            <div class="d-flex gap-2">
              <a href="index.php?view=products" class="btn btn-outline-secondary btn-sm">
                <i class="cil-arrow-left me-1"></i>Volver
              </a>
            </div>
          </div>
        </div>

        <!-- Alert Message -->
        <?php if(isset($_COOKIE["prdupd"])): ?>
          <div class="alert alert-success alert-dismissible fade show mx-4 mt-3 d-flex align-items-center" role="alert">
            <i class="cil-check-circle text-success me-2"></i>
            <div>Producto actualizado exitosamente</div>
            <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php 
          setcookie("prdupd","",time()-18600);
          echo "<script>
                  setTimeout(function() {
                    window.location.href = 'index.php?view=products';
                  }, 1500);
                </script>";
          ?>
        <?php endif; ?>

        <!-- Form -->
        <div class="card-body">
          <form method="post" enctype="multipart/form-data" action="index.php?view=updateproduct" id="productForm">
            <div class="row g-4">
              <!-- Información Básica -->
              <div class="col-md-6">
                <div class="card shadow-none border h-100">
                  <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="cil-info me-2"></i>Información Básica</h6>
                  </div>
                  <div class="card-body">
                    <div class="mb-3">
                      <label class="form-label fw-bold text-required">Código de Barras</label>
                      <div class="input-group">
                        <span class="input-group-text bg-light"><i class="cil-barcode"></i></span>
                        <input type="text" name="barcode" class="form-control" 
                               value="<?php echo htmlspecialchars($product->barcode); ?>" required>
                      </div>
                    </div>

                    <div class="mb-3">
                      <label class="form-label fw-bold text-required">Nombre del Producto</label>
                      <input type="text" name="name" class="form-control" 
                             value="<?php echo htmlspecialchars($product->name); ?>" required>
                    </div>

                    <div class="mb-3">
                      <label class="form-label fw-bold">Categoría</label>
                      <select name="category_id" class="form-select">
                        <option value="">-- Seleccionar Categoría --</option>
                        <?php foreach($categories as $category): ?>
                          <option value="<?php echo $category->id;?>" 
                              <?php echo ($product->category_id == $category->id) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category->name);?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="mb-3">
                      <label class="form-label fw-bold">Imagen del Producto</label>
                      <input type="file" name="image" class="form-control" accept="image/*">
                      <?php if($product->image): ?>
                        <div class="mt-2">
                          <img src="storage/products/<?php echo htmlspecialchars($product->image);?>" 
                               class="img-thumbnail" style="max-height: 120px;">
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Precios y Stock -->
              <div class="col-md-6">
                <div class="card shadow-none border h-100">
                  <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="cil-dollar me-2"></i>Precios y Stock</h6>
                  </div>
                  <div class="card-body">
                    <div class="row g-3">
                      <div class="col-md-6">
                        <label class="form-label fw-bold text-required">Precio de Entrada</label>
                        <div class="input-group">
                          <span class="input-group-text bg-light">$</span>
                          <input type="number" step="0.01" name="price_in" class="form-control" 
                                 value="<?php echo htmlspecialchars($product->price_in); ?>" required>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <label class="form-label fw-bold text-required">Precio de Salida</label>
                        <div class="input-group">
                          <span class="input-group-text bg-light">$</span>
                          <input type="number" step="0.01" name="price_out" class="form-control" 
                                 value="<?php echo htmlspecialchars($product->price_out); ?>" required>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <label class="form-label fw-bold text-required">Unidad</label>
                        <input type="text" name="unit" class="form-control" 
                               value="<?php echo htmlspecialchars($product->unit); ?>" required>
                      </div>

                      <div class="col-md-6">
                        <label class="form-label fw-bold">Stock Mínimo</label>
                        <input type="number" name="inventary_min" class="form-control" 
                               value="<?php echo htmlspecialchars($product->inventary_min);?>">
                      </div>

                      <div class="col-12">
                        <div class="form-check form-switch">
                          <input type="checkbox" class="form-check-input" name="is_active" 
                                 <?php echo $product->is_active ? 'checked' : '';?>>
                          <label class="form-check-label fw-bold">Producto Activo</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Descripción -->
              <div class="col-12">
                <div class="card shadow-none border">
                  <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="cil-notes me-2"></i>Descripción del Producto</h6>
                  </div>
                  <div class="card-body">
                    <textarea name="description" class="form-control" rows="3" 
                              placeholder="Ingrese una descripción del producto..."
                    ><?php echo htmlspecialchars($product->description);?></textarea>
                  </div>
                </div>
              </div>
            </div>

            <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
            
            <div class="d-flex justify-content-end gap-2 mt-4">
              <a href="index.php?view=products" class="btn btn-outline-danger">
                <i class="cil-x me-1"></i>Cancelar
              </a>
              <button type="submit" class="btn btn-primary">
                <i class="cil-save me-1"></i>Guardar Cambios
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.text-required::after {
  content: '*';
  color: red;
  margin-left: 4px;
}
.card {
  box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}
.bg-light {
  background-color: #f8f9fa !important;
}
</style>
<?php endif; ?>
