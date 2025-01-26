<div class="container-lg px-4">
	<div class="d-flex justify-content-between align-items-center mb-4">
		<h1 class="h3">Resumen de Venta</h1>
		<div class="dropdown">
			<button type="button" class="btn btn-primary dropdown-toggle" data-coreui-toggle="dropdown">
				<i class="cil-cloud-download"></i> Descargar
			</button>
			<ul class="dropdown-menu">
				<li><a class="dropdown-item" href="report/onesell-word.php?id=<?php echo $_GET["id"];?>">
					<i class="cil-file me-2"></i>Word 2007 (.docx)
				</a></li>
			</ul>
		</div>
	</div>

<?php if(isset($_GET["id"]) && $_GET["id"]!=""):?>
<?php
$sell = SellData::getById($_GET["id"]);
$operations = OperationData::getAllProductsBySellId($_GET["id"]);
$total = 0;

// Alertas de inventario
if(isset($_COOKIE["selled"])){
	foreach ($operations as $operation) {
		$qx = OperationData::getQYesF($operation->product_id);
		$p = $operation->getProduct();
		if($qx==0){
			echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
							<i class='cil-warning me-2'></i>
							El producto <b class='mx-1 text-uppercase'>$p->name</b> no tiene existencias en inventario.
						</div>";     
		}else if($qx<=$p->inventary_min/2){
			echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
							<i class='cil-warning me-2'></i>
							El producto <b class='mx-1 text-uppercase'>$p->name</b> tiene muy pocas existencias.
						</div>";
		}else if($qx<=$p->inventary_min){
			echo "<div class='alert alert-warning d-flex align-items-center' role='alert'>
							<i class='cil-warning me-2'></i>
							El producto <b class='mx-1 text-uppercase'>$p->name</b> tiene pocas existencias.
						</div>";
		}
	}
	setcookie("selled","",time()-18600);
}
?>

<div class="card mb-4">
	<div class="card-header">
		<h5 class="card-title mb-0">Detalles de la venta</h5>
	</div>
	<div class="card-body">
		<div class="row mb-4">
			<div class="col-12 col-md-6">
				<?php if($sell->person_id!=""): $client = $sell->getPerson(); ?>
				<div class="mb-3">
					<label class="form-label fw-bold">Cliente:</label>
					<div><?php echo $client->name." ".$client->lastname;?></div>
				</div>
				<?php endif; ?>
				
				<?php if($sell->user_id!=""): $user = $sell->getUser(); ?>
				<div class="mb-3">
					<label class="form-label fw-bold">Atendido por:</label>
					<div><?php echo $user->name." ".$user->lastname;?></div>
				</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-bordered table-hover align-middle">
				<thead class="table-light">
					<tr>
						<th>Código</th>
						<th>Cantidad</th>
						<th>Producto</th>
						<th>Precio Unit.</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($operations as $operation):
					$product = $operation->getProduct(); ?>
					<tr>
						<td><?php echo $product->id;?></td>
						<td><?php echo $operation->q;?></td>
						<td><?php echo $product->name;?></td>
						<td class="text-end">$ <?php echo number_format($product->price_out,2,".",",");?></td>
						<td class="text-end fw-bold">$ <?php echo number_format($operation->q*$product->price_out,2,".",",");
							$total+=$operation->q*$product->price_out;?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>

		<div class="row justify-content-end mt-4">
			<div class="col-12 col-md-4">
				<div class="card bg-light">
					<div class="card-body">
						<div class="d-flex justify-content-between mb-2">
							<span>Descuento:</span>
							<span class="fw-bold">$ <?php echo number_format($sell->discount,2,'.',',');?></span>
						</div>
						<div class="d-flex justify-content-between mb-2">
							<span>Subtotal:</span>
							<span class="fw-bold">$ <?php echo number_format($total,2,'.',',');?></span>
						</div>
						<div class="d-flex justify-content-between">
							<span class="h5 mb-0">Total:</span>
							<span class="h5 mb-0">$ <?php echo number_format($total-$sell->discount,2,'.',',');?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php else:?>
	<div class="alert alert-danger">
		<i class="cil-warning me-2"></i>
		501 Internal Error
	</div>
<?php endif; ?>
</div>