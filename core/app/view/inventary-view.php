<div class="container-fluid">
	<div class="fade-in">
		<div class="row">
			<div class="col-12">
				<div class="card shadow border-0 mb-4">
					<!-- Header mejorado -->
					<div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
						<div>
							<div class="d-flex align-items-center">
								<div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
									<i class="cil-storage text-primary fs-4"></i>
								</div>
								<div>
									<h4 class="mb-1">Inventario de Productos</h4>
									<span class="text-muted small">Gestión del stock de productos</span>
								</div>
							</div>
						</div>
						<div class="btn-toolbar">
							<div class="btn-group">
								<button type="button" class="btn btn-primary dropdown-toggle" data-coreui-toggle="dropdown">
									<i class="cil-cloud-download me-2"></i> Exportar
								</button>
								<ul class="dropdown-menu dropdown-menu-end shadow-sm">
									<li>
										<a class="dropdown-item py-2 px-3" href="report/inventary-word.php">
											<i class="cil-document text-primary me-2"></i> Exportar a Word
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="card-body px-4">
						<?php
						$page = isset($_GET["page"]) ? $_GET["page"] : 1;
						$limit = isset($_GET["limit"]) && $_GET["limit"]!="" ? $_GET["limit"] : 10;
						$products = ProductData::getAll();
						
						if(count($products)>0){
							$curr_products = ($page==1) ? 
								ProductData::getAllByPage($products[0]->id,$limit) : 
								ProductData::getAllByPage($products[($page-1)*$limit]->id,$limit);
							
							$npaginas = ceil(count($products)/$limit);
						?>

						<!-- Controles de navegación mejorados -->
						<div class="d-flex justify-content-between align-items-center mb-4">
							<div class="badge bg-light text-dark p-2">
								<i class="cil-list me-1"></i> Página <?php echo $page." de ".$npaginas; ?>
							</div>
							<nav>
								<div class="btn-group">
									<?php if($page > 1): ?>
									<a class="btn btn-outline-primary" href="<?php echo "index.php?view=inventary&limit=$limit&page=".($page-1); ?>">
										<i class="cil-chevron-left"></i>
									</a>
									<?php endif; ?>
									
									<?php if($page < $npaginas): ?>
									<a class="btn btn-outline-primary" href="<?php echo "index.php?view=inventary&limit=$limit&page=".($page+1); ?>">
										<i class="cil-chevron-right"></i>
									</a>
									<?php endif; ?>
								</div>
							</nav>
						</div>

						<!-- Tabla mejorada -->
						<div class="table-responsive">
							<table class="table table-hover align-middle border">
								<thead class="bg-light">
									<tr>
										<th scope="col" class="text-center" width="100">Código</th>
										<th scope="col">Nombre del Producto</th>
										<th scope="col" class="text-center" width="150">Stock</th>
										<th scope="col" class="text-center" width="150">Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($curr_products as $product):
									$q=OperationData::getQYesF($product->id);
									$rowClass = $q<=$product->inventary_min/2 ? "table-danger" : 
											  ($q<=$product->inventary_min ? "table-warning" : "");
									?>
									<tr class="<?php echo $rowClass; ?>">
										<td class="text-center fw-bold"><?php echo $product->id; ?></td>
										<td>
											<div class="fw-semibold"><?php echo $product->name; ?></div>
										</td>
										<td class="text-center">
											<span class="badge bg-<?php echo $rowClass ? str_replace('table-','',$rowClass) : 'info' ?> rounded-pill px-3 py-2">
												<?php echo $q; ?>
											</span>
										</td>
										<td class="text-center">
											<a href="index.php?view=history&product_id=<?php echo $product->id; ?>" 
											   class="btn btn-sm btn-primary" 
											   data-coreui-toggle="tooltip" 
											   title="Ver historial">
												<i class="cil-clock me-1"></i> Historial
											</a>
										</td>
									</tr>
									<?php endforeach;?>
								</tbody>
							</table>
						</div>

						<!-- Footer mejorado -->
						<div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mt-4">
							<nav aria-label="Paginación" class="d-flex flex-wrap gap-1">
								<?php for($i=0;$i<$npaginas;$i++): ?>
									<a href='index.php?view=inventary&limit=<?php echo $limit?>&page=<?php echo ($i+1)?>' 
									   class='btn btn-sm <?php echo ($i+1==$page)?"btn-primary":"btn-outline-primary" ?>'>
										<?php echo ($i+1)?>
									</a>
								<?php endfor; ?>
							</nav>
							
							<form class="d-flex align-items-center bg-light rounded p-2">
								<input type="hidden" name="view" value="inventary">
								<label class="me-2 text-muted" for="limit">Mostrar:</label>
								<input type="number" value="<?php echo $limit?>" name="limit" id="limit"
									   class="form-control form-control-sm text-center" style="width:70px;">
								<span class="ms-2 text-muted">registros</span>
							</form>
						</div>

						<?php } else { ?>
						<div class="alert alert-info d-flex align-items-center border-0 bg-info bg-opacity-10">
							<i class="cil-warning me-3 fs-3 text-info"></i>
							<div>
								<h5 class="alert-heading">No hay productos</h5>
								<p class="mb-0">No se han agregado productos a la base de datos. 
								   Puedes agregar uno usando el botón "Agregar Producto".</p>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
