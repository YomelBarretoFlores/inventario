<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<!-- Header Section -->
			<div class="card mb-4">
				<div class="card-header bg-light">
					<div class="d-flex justify-content-between align-items-center">
						<div>
							<h4 class="mb-0"><i class='fa fa-archive text-primary'></i> Gestión de Caja</h4>
							<small class="text-muted">Panel de control de ventas y transacciones</small>
						</div>
						<div class="btn-toolbar">
							<button class="btn btn-primary btn-sm ms-2">
								<i class="fa fa-refresh"></i> Actualizar
							</button>
						</div>
					</div>
				</div>
			</div>

			<?php
			$products = SellData::getSellsUnBoxed();
			if(count($products) > 0){
				$total_total = 0;
			?>
			
			<!-- Sales Data Card -->
			<div class="card">
				<div class="card-header bg-white">
					<div class="d-flex justify-content-between align-items-center">
						<h5 class="card-title mb-0">
							<i class="fa fa-list text-primary"></i> Registro de Ventas
						</h5>
						<span class="badge bg-primary"><?php echo count($products); ?> ventas</span>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped table-hover border">
							<thead class="bg-light">
								<tr>
									<th class="text-center" width="5%">#</th>
									<th width="30%">Productos</th>
									<th width="30%">Total</th>
									<th width="35%">Fecha y Hora</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($products as $index => $sell): ?>
								<tr>
									<td class="text-center"><?php echo $index + 1; ?></td>
									<td>
										<?php
										$operations = OperationData::getAllProductsBySellId($sell->id);
										?>
										<span class="badge bg-info">
											<?php echo count($operations); ?> items
										</span>
									</td>
									<td>
										<?php
										$total = 0;
										foreach($operations as $operation){
											$product = $operation->getProduct();
											$total += $operation->q * $product->price_out;
										}
										$total_total += $total;
										?>
										<span class="text-success fw-bold">
											$ <?php echo number_format($total, 2, ".", ","); ?>
										</span>
									</td>
									<td>
										<i class="fa fa-calendar text-muted"></i>
										<?php echo date('d/m/Y H:i', strtotime($sell->created_at)); ?>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					
					<!-- Total Summary -->
					<div class="card bg-light mt-4">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-center">
								<h4 class="mb-0">Total General</h4>
								<h3 class="text-success mb-0">
									$ <?php echo number_format($total_total, 2, ".", ","); ?>
								</h3>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php } else { ?>
			<!-- Empty State -->
			<div class="card">
				<div class="card-body text-center py-5">
					<i class="fa fa-shopping-cart fa-4x text-muted mb-3"></i>
					<h3 class="text-muted">No hay ventas registradas</h3>
					<p class="text-muted">Aún no se han realizado transacciones en la caja.</p>
					<button class="btn btn-primary">
						<i class="fa fa-plus"></i> Nueva Venta
					</button>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
