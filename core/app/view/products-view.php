
<div class="row">
	<div class="col-md-12">

		<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
			<div>
			<h1 class="h3 mb-1">Productos</h1>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb mb-0 small">
				<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
				<li class="breadcrumb-item active" aria-current="page">Productos</li>
				</ol>
			</nav>
			</div>
			<div class="d-flex flex-wrap gap-2">
			<a href="index.php?view=newproduct" class="btn btn-primary d-flex align-items-center">
				<i class="bi bi-plus-circle me-2"></i>
				Nuevo Producto
			</a>
			<div class="dropdown">
				<button class="btn btn-outline-primary dropdown-toggle d-flex align-items-center" type="button" data-coreui-toggle="dropdown" aria-expanded="false">
				<i class="bi bi-file-earmark-arrow-down me-2"></i>
				Exportar
				</button>
				<ul class="dropdown-menu">
				<li><a class="dropdown-item d-flex align-items-center" href="?view=exportproducts&export-format=pdf">
					<i class="bi bi-file-earmark-word me-2"></i> Exportar a PDF
				</a></li>
				<li><hr class="dropdown-divider"></li>
				<li><a class="dropdown-item d-flex align-items-center" href="?view=exportproducts&export-format=excel" >
					<i class="bi bi-file-earmark-excel me-2"></i> Exportar a Excel
				</a></li>
				</ul>
			</div>
			</div>
		</div>

		<div class="card mb-4">
			<div class="card-header bg-light">
			<h5 class="card-title mb-0"><i class="bi bi-box me-2"></i>Lista de Productos</h5>
			</div>
			<div class="card-body">
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

			<div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mb-3">
			<div class="small text-medium-emphasis">Mostrando página <?php echo $page; ?> de <?php echo $npaginas; ?></div>
			<nav aria-label="Product navigation">
				<ul class="pagination pagination-sm justify-content-end mb-0">
				<?php if($page > 1): ?>
					<li class="page-item">
					<a class="page-link" href="<?php echo "index.php?view=products&limit=$limit&page=".($page-1); ?>">
						<i class="bi bi-chevron-left"></i> Anterior
					</a>
					</li>
				<?php endif; ?>
				<?php if($page < $npaginas): ?>
					<li class="page-item">
					<a class="page-link" href="<?php echo "index.php?view=products&limit=$limit&page=".($page+1); ?>">
						Siguiente <i class="bi bi-chevron-right"></i>
					</a>
					</li>
				<?php endif; ?>
				</ul>
			</nav>
			</div>

			<div class="table-responsive">
			<table class="table table-hover table-striped table-bordered align-middle">
				<thead class="table-light">
				<tr>
					<th class="text-center">Código</th>
					<th>Imagen</th>
					<th>Nombre</th>
					<th class="text-end">Precio Entrada</th>
					<th class="text-end">Precio Salida</th>
					<th>Categoría</th>
					<th class="text-center">Mínima</th>
					<th class="text-center">Estado</th>
					<th class="text-center">Acciones</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach($curr_products as $product):?>
				<tr>
					<td class="text-center"><span class="badge bg-dark"><?php echo $product->barcode; ?></span></td>
					<td>
					<?php if($product->image!=""):?>
					<img src="storage/products/<?php echo $product->image;?>" class="rounded-circle border" width="40" height="40" style="object-fit: cover;">
					<?php else:?>
					<div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:40px;height:40px">
						<i class="bi bi-image text-muted"></i>
					</div>
					<?php endif;?>
					</td>
					<td class="fw-semibold"><?php echo $product->name; ?></td>
					<td class="text-end">$ <?php echo number_format($product->price_in,2,'.',','); ?></td>
					<td class="text-end">$ <?php echo number_format($product->price_out,2,'.',','); ?></td>
					<td><?php echo $product->category_id!=null ? $product->getCategory()->name : "<span class='text-muted fst-italic'>Sin categoría</span>"; ?></td>
					<td class="text-center"><?php echo $product->inventary_min; ?></td>
					<td class="text-center">
					<?php if($product->is_active): ?>
					<span class="badge bg-success-subtle text-success border border-success-subtle">Activo</span>
					<?php else: ?>
					<span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">Inactivo</span>
					<?php endif;?>
					</td>
					<td class="text-center">
					<div class="btn-group btn-group-sm">
						<a href="index.php?view=editproduct&id=<?php echo $product->id; ?>" class="btn btn-ghost-primary" data-coreui-toggle="tooltip" title="Editar">
						<i class="bi bi-pencil"></i>
						</a>
						<a href="index.php?view=delproduct&id=<?php echo $product->id; ?>" class="btn btn-ghost-danger" data-coreui-toggle="tooltip" title="Eliminar">
						<i class="bi bi-trash"></i>
						</a>
					</div>
					</td>
				</tr>
				<?php endforeach;?>
				</tbody>
			</table>
			</div>

			<div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mt-4">
			<div class="btn-group">
				<?php for($i=0; $i<$npaginas; $i++): ?>
				<a href='index.php?view=products&limit=<?php echo $limit;?>&page=<?php echo ($i+1);?>' 
				   class='btn btn-outline-primary btn-sm <?php echo ($i+1==$page)?"active":"";?>'>
					<?php echo ($i+1);?>
				</a>
				<?php endfor; ?>
			</div>
			<div class="d-flex align-items-center gap-2">
				<label class="form-label mb-0">Registros por página:</label>
				<form class="d-flex">
				<input type="hidden" name="view" value="products">
				<input type="number" value="<?php echo $limit?>" name="limit" 
					   class="form-control form-control-sm" style="width:70px;">
				</form>
			</div>
			</div>

			<?php } else { ?>
			<div class="alert alert-info d-flex align-items-center" role="alert">
				<i class="bi bi-info-circle-fill me-2 fs-5"></i>
				<div>
				<h5 class="alert-heading">No hay productos</h5>
				<p class="mb-0">No se han agregado productos a la base de datos. Puede agregar uno usando el botón "Agregar Producto".</p>
				</div>
			</div>
			<?php } ?>
			</div>
		</div>

		<br><br><br><br><br><br><br><br><br><br>
	</div>
</div>





<script>
function exportProducts(format){
	window.location = "index.php?view=exportproducts&export-format="+format;
}
</script>
