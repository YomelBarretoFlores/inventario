<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<!-- Header -->
			<div class="d-flex justify-content-between align-items-center mb-4">
				<h1><i class='bi bi-cart text-primary'></i> Lista de Ventas</h1>
				<a href="index.php?view=sell" class="btn btn-primary">
					<i class="bi bi-plus-circle me-2"></i>Nueva Venta
				</a>
			</div>

			<?php
			$products = SellData::getSells();
			if(count($products) > 0):
			?>

			<!-- Card principal -->
			<div class="card shadow-sm">
				<div class="card-header bg-light">
					<h4 class="card-title mb-0">Resumen de Ventas</h4>
				</div>
				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table table-striped table-hover align-middle mb-0">
							<thead class="bg-light">
								<tr>
									<th class="text-center" width="80">Detalles</th>
									<th>Productos</th>
									<th>Total</th>
									<th>Fecha</th>
									<th class="text-center" width="80">Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($products as $sell): ?>
								<tr>
									<td class="text-center">
										<a href="index.php?view=onesell&id=<?php echo $sell->id; ?>" 
										   class="btn btn-ghost-primary btn-sm" 
										   data-coreui-toggle="tooltip" 
										   title="Ver detalles">
											<i class="bi bi-eye"></i>
										</a>
									</td>
									<td>
										<span class="badge bg-info">
											<?php
											$operations = OperationData::getAllProductsBySellId($sell->id);
											echo count($operations) . ' productos';
											?>
										</span>
									</td>
									<td>
										<span class="fw-bold text-success">
										S/ <?php echo number_format($sell->total - $sell->discount, 2); ?>
										</span>
										<?php if($sell->discount > 0): ?>
											<span class="badge bg-danger ms-2">-$<?php echo number_format($sell->discount, 2); ?></span>
										<?php endif; ?>
									</td>
									<td>
										<i class="bi bi-calendar me-2"></i>
										<?php echo date('d/m/Y H:i', strtotime($sell->created_at)); ?>
									</td>
									<td class="text-center">
										<a href="index.php?view=delsell&id=<?php echo $sell->id; ?>" 
										   class="btn btn-ghost-danger btn-sm"
										   onclick="return confirm('¿Está seguro de eliminar esta venta?')"
										   data-coreui-toggle="tooltip" 
										   title="Eliminar venta">
											<i class="bi bi-trash"></i>
										</a>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<?php else: ?>
			<div class="card text-center p-5">
				<div class="card-body">
					<i class="bi bi-cart-x display-1 text-muted mb-4"></i>
					<h2 class="text-muted">No hay ventas registradas</h2>
					<p class="text-muted">No se ha realizado ninguna venta hasta el momento.</p>
					<a href="index.php?view=sell" class="btn btn-primary">
						<i class="bi bi-plus-circle me-2"></i>Registrar Nueva Venta
					</a>
				</div>
			</div>
			<?php endif; ?>

		</div>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	// Inicializar tooltips
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-coreui-toggle="tooltip"]'))
	tooltipTriggerList.map(function (tooltipTriggerEl) {
		return new coreui.Tooltip(tooltipTriggerEl)
	});
});
</script>
