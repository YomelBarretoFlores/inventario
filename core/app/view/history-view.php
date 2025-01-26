<?php
if(isset($_GET["product_id"])):
$product = ProductData::getById($_GET["product_id"]);
$operations = OperationData::getAllByProductId($product->id);
?>
<div class="row">
	<div class="col-md-12">


<h1><?php echo $product->name;; ?> <small>Historial</small></h1>


	</div>
	</div>

<div class="row">


	<div class="col-md-4">


	<?php
$itotal = OperationData::GetInputQYesF($product->id);

	?>

<?php
?>

</div>

	<div class="col-md-4">
	<?php
$total = OperationData::GetQYesF($product->id);


	?>



<?php
?>

</div>

	<div class="col-md-4">


	<?php
$ototal = -1*OperationData::GetOutputQYesF($product->id);

	?>



<?php
?>

</div>
</div>
<div class="row g-4 mb-4">
  <div class="col-sm-6 col-xl-4">
    <div class="card border-start border-primary border-4 shadow-sm hover-shadow">
      <div class="card-body p-4">
        <div class="d-flex align-items-center">
          <div class="bg-primary bg-opacity-10 rounded-3 p-3 me-3">
            <i class="bi bi-box-seam text-primary fs-2"></i>
          </div>
          <div>
            <div class="fs-4 fw-semibold text-primary mb-1"><?php echo number_format($itotal); ?></div>
            <p class="text-medium-emphasis mb-0">Total Entradas</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-4">
    <div class="card border-start border-success border-4 shadow-sm hover-shadow">
      <div class="card-body p-4">
        <div class="d-flex align-items-center">
          <div class="bg-success bg-opacity-10 rounded-3 p-3 me-3">
            <i class="bi bi-check-circle text-success fs-2"></i>
          </div>
          <div>
            <div class="fs-4 fw-semibold text-success mb-1"><?php echo number_format($total); ?></div>
            <p class="text-medium-emphasis mb-0">Stock Disponible</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-4">
    <div class="card border-start border-warning border-4 shadow-sm hover-shadow">
      <div class="card-body p-4">
        <div class="d-flex align-items-center">
          <div class="bg-warning bg-opacity-10 rounded-3 p-3 me-3">
            <i class="bi bi-cart text-warning fs-2"></i>
          </div>
          <div>
            <div class="fs-4 fw-semibold text-warning mb-1"><?php echo number_format($ototal); ?></div>
            <p class="text-medium-emphasis mb-0">Total Salidas</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-light border-bottom-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Historial de Operaciones</h5>
        </div>
      </div>
      <div class="card-body">
        <?php if(count($operations)>0):?>
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="bg-light">
              <tr>
                <th scope="col" class="text-center" width="5%">#</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Tipo</th>
                <th scope="col">Fecha</th>
                <th scope="col" class="text-end" width="10%">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($operations as $index => $operation):?>
              <tr>
                <td class="text-center"><?php echo $index + 1; ?></td>
                <td class="fw-medium"><?php echo number_format($operation->q); ?></td>
                <td>
                  <?php if($operation->getOperationType()->name == 'entrada'): ?>
                    <span class="badge rounded-pill bg-success-subtle text-success">
                      <i class="bi bi-box-arrow-in-right me-1"></i>Entrada
                    </span>
                  <?php else: ?>
                    <span class="badge rounded-pill bg-warning-subtle text-warning">
                      <i class="bi bi-box-arrow-right me-1"></i>Salida
                    </span>
                  <?php endif; ?>
                </td>
                <td><?php echo date('d/m/Y H:i', strtotime($operation->created_at)); ?></td>
                <td class="text-end">
                  <button class="btn btn-danger btn-sm rounded-pill delete-operation" 
                      data-id="<?php echo $operation->id; ?>"
                      data-pid="<?php echo $operation->product_id; ?>"
                      data-coreui-toggle="tooltip"
                      title="Eliminar operación">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?php else: ?>
        <div class="text-center py-5">
          <div class="text-muted">
            <i class="bi bi-inbox display-1"></i>
            <h5 class="mt-3">No hay operaciones registradas</h5>
            <p class="mb-0">Aún no se han registrado operaciones para este producto</p>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<script>
document.querySelectorAll('.delete-operation').forEach(button => {
  button.addEventListener('click', function() {
    if(confirm('¿Está seguro que desea eliminar esta operación?')) {
      window.location.href = `index.php?view=deleteoperation&ref=history&pid=${this.dataset.pid}&opid=${this.dataset.id}`;
    }
  });
});
</script>

<?php endif; ?>