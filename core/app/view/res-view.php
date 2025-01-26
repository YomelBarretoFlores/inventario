<div class="container-lg">
	<div class="row mb-4">
		<div class="col-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php" class="text-decoration-none"><i class="cil-home"></i> Inicio</a></li>
					<li class="breadcrumb-item active"><i class="cil-cart"></i> Compras</li>
				</ol>
			</nav>
			<div class="d-flex justify-content-between align-items-center bg-light p-3 rounded-3 shadow-sm">
				<h1 class="h3 mb-0"><i class="cil-cart text-primary"></i> Gestión de Compras</h1>
				<!-- <button class="btn btn-primary btn-sm" onclick="window.location='index.php?view=newre'">
					<i class="cil-plus"></i> Nueva Compra
				</button> -->
			</div>
		</div>
	</div>

	<div class="card shadow">
		<div class="card-header bg-white border-bottom">
			<div class="d-flex justify-content-between align-items-center">
				<h5 class="mb-0"><i class="cil-list text-primary"></i> Lista de Compras</h5>
			</div>
		</div>
		<div class="card-body">
			<?php
			$products = SellData::getRes();
			if(count($products)>0):
			?>
			<div class="table-responsive">
				<table class="table table-hover align-middle border">
					<thead class="bg-light">
						<tr>
							<th scope="col" width="5%" class="text-center">Ver</th>
							<th scope="col">Productos</th>
							<th scope="col">Total</th>
							<th scope="col">Fecha</th>
							<th scope="col" width="5%" class="text-center">Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($products as $sell): ?>
						<tr>
							<td class="text-center">
								<a href="index.php?view=onere&id=<?php echo $sell->id; ?>" 
								   class="btn btn-sm btn-info rounded-pill" 
								   data-coreui-toggle="tooltip" 
								   title="Ver detalles">
									<i class="bi bi-eye"></i>
								</a>
							</td>
							<td>
								<?php
								$operations = OperationData::getAllProductsBySellId($sell->id);
								echo '<span class="badge bg-primary rounded-pill">'.count($operations).' items</span>';
								?>
							</td>
							<td>
								<?php
								$total=0;
								foreach($operations as $operation){
									$product = $operation->getProduct();
									$total += $operation->q*$product->price_in;
								}
								echo '<span class="text-success fw-semibold">$ '.number_format($total).'</span>';
								?>
							</td>
							<td>
								<div class="d-flex align-items-center">
									<i class="cil-calendar text-primary me-2"></i>
									<span><?php echo date('d/m/Y H:i', strtotime($sell->created_at)); ?></span>
								</div>
							</td>
							<td class="text-center">
								<a href="index.php?view=delre&id=<?php echo $sell->id; ?>" 
								   class="btn btn-sm btn-danger rounded-pill"
								   onclick="return confirm('¿Está seguro de eliminar esta compra?')"
								   data-coreui-toggle="tooltip" 
								   title="Eliminar">
									<i class="bi bi-trash"></i>
								</a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<?php else: ?>
			<div class="alert alert-info d-flex align-items-center border-0 bg-light-info" role="alert">
				<i class="cil-info text-info me-2 h5 mb-0"></i>
				<div>
					No hay compras registradas en el sistema.
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-coreui-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
		return new coreui.Tooltip(tooltipTriggerEl)
	})
});
</script>