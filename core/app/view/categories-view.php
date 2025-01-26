<div class="row">
	<div class="col-md-12">
		<div class="card mb-4">
			<div class="card-header bg-primary">
				<div class="d-flex justify-content-between align-items-center">
					<div class="text-white d-flex align-items-center">
						<i class="fas fa-tags fa-lg me-2"></i>
						<h5 class="mb-0">Categorías</h5>
					</div>
					<a href="index.php?view=newcategory" class="btn btn-light btn-sm d-flex align-items-center">
						<i class="fas fa-plus-circle me-2"></i>
						Nueva Categoría
					</a>
				</div>
			</div>
			<div class="card-body">
				<?php
				$users = CategoryData::getAll();
				if(count($users)>0):
				?>
				<div class="table-responsive">
					<table class="table table-hover table-striped table-bordered align-middle">
						<thead class="bg-light">
							<tr>
								<th scope="col" class="text-dark">
									<i class="fas fa-folder me-2"></i>Nombre
								</th>
								<th scope="col" class="text-center" style="width: 200px;">
									<i class="fas fa-cogs me-2"></i>Acciones
								</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($users as $user): ?>
							<tr>
								<td>
									<div class="d-flex align-items-center py-2">
										<span class="bg-primary bg-opacity-10 p-2 rounded me-3">
											<i class="fas fa-folder text-primary"></i>
										</span>
										<span class="fw-medium"><?php echo $user->name." ".$user->lastname; ?></span>
									</div>
								</td>
								<td class="text-center">
									<div class="btn-group btn-group-sm">
										<a href="index.php?view=editcategory&id=<?php echo $user->id;?>" 
										   class="btn btn-outline-warning" data-coreui-toggle="tooltip" 
										   title="Editar categoría">
											<i class="fas fa-edit"></i>
										</a>
										<a href="index.php?view=delcategory&id=<?php echo $user->id;?>" 
										   class="btn btn-outline-danger" data-coreui-toggle="tooltip"
										   title="Eliminar categoría">
											<i class="fas fa-trash-alt"></i>
										</a>
									</div>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				<?php else: ?>
				<div class="alert alert-info d-flex align-items-center border-0 bg-light-info" role="alert">
					<div class="bg-info text-white p-2 rounded me-3">
						<i class="fas fa-info-circle"></i>
					</div>
					<div>No hay categorías registradas</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-coreui-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
		return new coreui.Tooltip(tooltipTriggerEl)
	});
});
</script>