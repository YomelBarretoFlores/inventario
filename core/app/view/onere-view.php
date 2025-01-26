<div class="container-lg">
	<div class="row mb-4">
		<div class="col">
			<h1 class="display-6"><i class="cil-cart text-primary me-2"></i>Resumen de Compra</h1>
		</div>
		<div class="col-auto">
			<div class="dropdown">
				<button type="button" class="btn btn-primary btn-lg shadow-sm" data-coreui-toggle="dropdown">
					<i class="cil-cloud-download me-2"></i> Exportar
				</button>
				<ul class="dropdown-menu dropdown-menu-end">
					<li><a class="dropdown-item d-flex align-items-center" href="report/onere-word.php?id=<?php echo $_GET["id"];?>">
						<i class="cil-document me-2"></i> Exportar a Word
					</a></li>
					<li><a class="dropdown-item d-flex align-items-center" href="#">
						<i class="cil-spreadsheet me-2"></i> Exportar a Excel
					</a></li>
					<li><a class="dropdown-item d-flex align-items-center" href="#">
						<i class="cil-file-pdf me-2"></i> Exportar a PDF
					</a></li>
				</ul>
			</div>
		</div>
	</div>

	<?php if(isset($_GET["id"]) && $_GET["id"]!=""):?>
	<?php
	$sell = SellData::getById($_GET["id"]);
	$operations = OperationData::getAllProductsBySellId($_GET["id"]);
	$total = 0;
	?>

	<?php if(isset($_COOKIE["selled"])): ?>
		<div class="row mb-4">
			<div class="col">
				<?php
				foreach ($operations as $operation) {
					$qx = OperationData::getQYesF($operation->product_id);
					$p = $operation->getProduct();
					if($qx==0){
						echo "<div class='alert alert-danger d-flex align-items-center fade show' role='alert'>
								<i class='cil-warning me-2 fs-5'></i>
								<div>El producto <strong class='mx-1 text-uppercase'>$p->name</strong> no tiene existencias en inventario.</div>
								<button type='button' class='btn-close ms-auto' data-coreui-dismiss='alert'></button>
							  </div>";
					}else if($qx<=$p->inventary_min/2){
						echo "<div class='alert alert-danger d-flex align-items-center fade show' role='alert'>
								<i class='cil-warning me-2 fs-5'></i>
								<div>El producto <strong class='mx-1 text-uppercase'>$p->name</strong> tiene muy pocas existencias.</div>
								<button type='button' class='btn-close ms-auto' data-coreui-dismiss='alert'></button>
							  </div>";
					}else if($qx<=$p->inventary_min){
						echo "<div class='alert alert-warning d-flex align-items-center fade show' role='alert'>
								<i class='cil-warning me-2 fs-5'></i>
								<div>El producto <strong class='mx-1 text-uppercase'>$p->name</strong> tiene pocas existencias.</div>
								<button type='button' class='btn-close ms-auto' data-coreui-dismiss='alert'></button>
							  </div>";
					}
				}
				setcookie("selled","",time()-18600);
				?>
			</div>
		</div>
	<?php endif; ?>

	<div class="card shadow-sm border-0">
		<div class="card-header bg-light py-3">
			<h5 class="card-title mb-0"><i class="cil-notes text-primary me-2"></i>Detalles de la Compra</h5>
		</div>
		<div class="card-body">
			<div class="row g-4">
				<div class="col-md-6">
					<div class="card bg-light border-0">
						<div class="card-body">
							<h6 class="card-subtitle mb-3 text-muted"><i class="cil-user me-2"></i>Información General</h6>
							<?php if($sell->person_id!=""): $client = $sell->getPerson(); ?>
							<div class="d-flex align-items-center mb-2">
								<i class="cil-people text-primary me-3"></i>
								<div>
									<small class="text-muted">Proveedor</small>
									<div class="fw-bold"><?php echo $client->name." ".$client->lastname;?></div>
								</div>
							</div>
							<?php endif; ?>
							<?php if($sell->user_id!=""): $user = $sell->getUser(); ?>
							<div class="d-flex align-items-center">
								<i class="cil-user-follow text-primary me-3"></i>
								<div>
									<small class="text-muted">Atendido por</small>
									<div class="fw-bold"><?php echo $user->name." ".$user->lastname;?></div>
								</div>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>

			<div class="table-responsive mt-4">
				<table class="table table-hover align-middle border">
					<thead class="bg-light">
						<tr>
							<th class="py-3">Código</th>
							<th class="py-3">Cantidad</th>
							<th class="py-3">Producto</th>
							<th class="py-3">Precio Unitario</th>
							<th class="py-3">Total</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($operations as $operation):
						$product = $operation->getProduct(); ?>
						<tr>
							<td><span class="badge bg-light text-dark"><?php echo $product->id;?></span></td>
							<td><?php echo $operation->q;?></td>
							<td class="text-primary fw-bold"><?php echo $product->name;?></td>
							<td>$ <?php echo number_format($product->price_in,2,".",",");?></td>
							<td class="fw-bold">$ <?php echo number_format($operation->q*$product->price_in,2,".",",");
								$total+=$operation->q*$product->price_in;?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>

			<div class="row mt-4">
				<div class="col-md-6 ms-auto">
					<div class="card bg-primary text-white border-0">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<i class="cil-dollar fs-3 me-3"></i>
								<div>
									<small>Total a Pagar</small>
									<h3 class="mb-0">$ <?php echo number_format($total,2,'.',','); ?></h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php else: ?>
		<div class="alert alert-danger d-flex align-items-center" role="alert">
			<i class="cil-warning me-2 fs-5"></i>
			<div>501 Error Interno del Servidor</div>
		</div>
	<?php endif; ?>
</div>