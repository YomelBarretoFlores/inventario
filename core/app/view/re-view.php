<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<!-- Búsqueda de productos -->
			<div class="card mb-4">
				<div class="card-header bg-light">
					<h4 class="card-title mb-0 d-flex align-items-center">
						<i class="cil-cart me-2"></i>
						Realizar Compra
					</h4>
				</div>
				<div class="card-body">
					<form class="mb-4">
						<div class="row g-3">
							<div class="col-12 col-md-8">
								<div class="form-floating">
									<input type="hidden" name="view" value="re">
									<input type="text" 
										   name="product" 
										   class="form-control form-control-lg" 
										   id="searchProduct" 
										   placeholder="Buscar producto"
										   required>
									<label for="searchProduct">
										<i class="cil-search me-2"></i>
										Buscar por nombre o código
									</label>
								</div>
							</div>
							<div class="col-12 col-md-4">
								<button type="submit" class="btn btn-primary btn-lg w-100">
									<i class="cil-search me-2"></i>
									Buscar Producto
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>

			<!-- Resultados de búsqueda -->
			<?php if(isset($_GET["product"])): ?>
				<?php
				$products = ProductData::getLike($_GET["product"]);
				if(count($products)>0):
				?>
				<div class="card mb-4">
					<div class="card-header bg-primary text-white">
						<h5 class="card-title mb-0 d-flex align-items-center">
							<i class="cil-list me-2"></i>
							Resultados de la Búsqueda
						</h5>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover align-middle">
								<thead class="table-light">
									<tr>
										<th>Código</th>
										<th>Nombre</th>
										<th>Unidad</th>
										<th>Precio Unit.</th>
										<th>Stock</th>
										<th>Cantidad</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($products as $product):
										$q = OperationData::getQYesF($product->id);
									?>
									<tr class="<?php echo ($q<=$product->inventary_min) ? 'table-danger' : ''; ?>">
										<form method="post" action="index.php?view=addtore">
											<td><?php echo $product->id; ?></td>
											<td><?php echo $product->name; ?></td>
											<td><?php echo $product->unit; ?></td>
											<td class="text-end">S/<?php echo number_format($product->price_in, 2); ?></td>
											<td class="text-center"><?php echo $q; ?></td>
											<td>
												<input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
												<input type="number" class="form-control" required name="q" placeholder="Cantidad">
											</td>
											<td class="text-center">
												<button type="submit" class="btn btn-success btn-sm">
													<i class="cil-plus me-1"></i>
													Agregar
												</button>
											</td>
										</form>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<?php else: ?>
					<div class="alert alert-info d-flex align-items-center" role="alert">
						<i class="cil-info me-2"></i>
						<div>
							No se encontraron productos que coincidan con 
							"<strong><?php echo htmlspecialchars($_GET["product"]); ?></strong>".
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>

			<!-- Carrito de compras -->
			<?php if(isset($_SESSION["reabastecer"])): 
				$total = 0;
			?>
			<div class="card mb-4">
				<div class="card-header bg-success text-white">
					<h5 class="card-title mb-0 d-flex align-items-center">
						<i class="cil-cart me-2"></i>
						Lista de Reabastecimiento
					</h5>
				</div>
				<div class="card-body">
					<div class="table-responsive mb-4">
						<table class="table table-bordered table-hover align-middle">
							<thead class="table-light">
								<tr>
									<th>Código</th>
									<th>Cantidad</th>
									<th>Unidad</th>
									<th>Producto</th>
									<th>Precio Unit.</th>
									<th>Total</th>
									<th>Acción</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($_SESSION["reabastecer"] as $p):
									$product = ProductData::getById($p["product_id"]);
									$pt = $product->price_in * $p["q"];
									$total += $pt;
								?>
								<tr>
									<td><?php echo $product->id; ?></td>
									<td class="text-center"><?php echo $p["q"]; ?></td>
									<td><?php echo $product->unit; ?></td>
									<td><?php echo $product->name; ?></td>
									<td class="text-end">S/<?php echo number_format($product->price_in, 2); ?></td>
									<td class="text-end">S/<?php echo number_format($pt, 2); ?></td>
									<td class="text-center">
										<a href="index.php?view=clearre&product_id=<?php echo $product->id; ?>" 
										   class="btn btn-danger btn-sm">
											<i class="cil-x me-1"></i>
											Eliminar
										</a>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>

					<!-- Formulario de proceso -->
					<form method="post" id="processsell" action="index.php?view=processre">
						<div class="row">
							<div class="col-md-6 mb-3">
								<label class="form-label">Proveedor</label>
								<select name="client_id" class="form-select">
									<option value="">-- Seleccione Proveedor --</option>
									<?php foreach(PersonData::getProviders() as $client): ?>
										<option value="<?php echo $client->id; ?>">
											<?php echo $client->name." ".$client->lastname; ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-md-6 mb-3">
								<label class="form-label">Efectivo</label>
								<input type="number" name="money" required class="form-control" id="money" step="0.01">
							</div>
						</div>

						<div class="row justify-content-end">
							<div class="col-md-6">
								<div class="card bg-light">
									<div class="card-body">
										<table class="table table-borderless mb-0">
											<tr>
												<td>Subtotal:</td>
												<td class="text-end">S/<?php echo number_format($total*.84, 2); ?></td>
											</tr>
											<tr>
												<td>IVA:</td>
												<td class="text-end">S/<?php echo number_format($total*.16, 2); ?></td>
											</tr>
											<tr class="fw-bold">
												<td>Total:</td>
												<td class="text-end">S/<?php echo number_format($total, 2); ?></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>

						<div class="text-end mt-4">
							<a href="index.php?view=clearre" class="btn btn-danger btn-lg">
								<i class="cil-x me-2"></i>
								Cancelar
							</a>
							<button type="submit" class="btn btn-primary btn-lg">
								<i class="cil-check me-2"></i>
								Procesar Reabastecimiento
							</button>
						</div>
					</form>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<script>
	document.getElementById('processsell').addEventListener('submit', function(e) {
		const money = parseFloat(document.getElementById('money').value);
		const total = <?php echo isset($total) ? $total : 0; ?>;
		
		if(money < total) {
			e.preventDefault();
			alert('El monto ingresado es insuficiente para completar la operación');
		} else {
			const change = money - total;
			if(!confirm(`Cambio a devolver: $${change.toFixed(2)}\n¿Desea continuar?`)) {
				e.preventDefault();
			}
		}
	});
</script>
