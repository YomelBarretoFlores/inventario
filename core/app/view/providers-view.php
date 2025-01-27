<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<!-- Header Section -->
			<div class="header-wrapper bg-light p-4 rounded mb-4">
				<div class="d-flex justify-content-between align-items-center">
					<div>
						<h2 class="h4 mb-2">Directorio de Proveedores</h2>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0">
								<li class="breadcrumb-item"><a href="index.php" class="text-decoration-none"><i class="bi bi-house me-1"></i>Inicio</a></li>
								<li class="breadcrumb-item active">Proveedores</li>
							</ol>
						</nav>
					</div>
					<div class="d-flex gap-2">
						<div class="dropdown">
							<button class="btn btn-outline-primary dropdown-toggle d-flex align-items-center" type="button" data-coreui-toggle="dropdown" aria-expanded="false">
								<i class="bi bi-file-earmark-arrow-down me-2"></i>Exportar
							</button>
							<ul class="dropdown-menu dropdown-menu-end">
								<li>
									<a class="dropdown-item d-flex align-items-center" href="?view=exportproviders&export-format=excel">
										<i class="bi bi-file-earmark-excel me-2"></i>Exportar a Excel
									</a>
								</li>
								<li>
									<a class="dropdown-item d-flex align-items-center" href="?view=exportproviders&export-format=pdf">
										<i class="bi bi-file-earmark-pdf me-2"></i>Exportar a PDF
									</a>
								</li>
							</ul>
						</div>
						<a href="index.php?view=newprovider" class="btn btn-primary d-flex align-items-center">
							<i class="bi bi-truck me-2"></i>Nuevo Proveedor
						</a>
					</div>
				</div>
			</div>

			<!-- Main Content -->
			<div class="card border-0 shadow-sm">
				<div class="card-header bg-transparent border-bottom-0">
					<h5 class="card-title mb-0"><i class="bi bi-people me-2"></i>PROVEEDORES</h5>
				</div>
				<div class="card-body">
					<?php
					$users = PersonData::getProviders();
					if(count($users) > 0){
					?>
					<div class="table-responsive">
						<table class="table table-hover align-middle border">
							<thead class="bg-light">
								<tr>
									<th><i class="bi bi-person me-2"></i>Nombre completo</th>
									<th><i class="bi bi-geo-alt me-2"></i>Dirección</th>
									<th><i class="bi bi-envelope me-2"></i>Email</th>
									<th><i class="bi bi-telephone me-2"></i>Teléfono</th>
									<th class="text-center">Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($users as $user): ?>
								<tr>
									<td class="fw-medium"><?php echo htmlspecialchars($user->name . " " . $user->lastname); ?></td>
									<td><?php echo htmlspecialchars($user->address1); ?></td>
									<td><?php echo htmlspecialchars($user->email1); ?></td>
									<td><?php echo htmlspecialchars($user->phone1); ?></td>
									<td class="text-center">
										<div class="btn-group btn-group-sm">
											<a href="index.php?view=editprovider&id=<?php echo $user->id;?>" 
											   class="btn btn-ghost-primary" 
											   data-coreui-toggle="tooltip" 
											   title="Editar">
												<i class="bi bi-pencil"></i>
											</a>
											<a href="index.php?view=delprovider&id=<?php echo $user->id;?>" 
											   class="btn btn-ghost-danger" 
											   data-coreui-toggle="tooltip" 
											   title="Eliminar"
											   onclick="return confirm('¿Está seguro de eliminar este proveedor?');">
												<i class="bi bi-trash"></i>
											</a>
										</div>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<?php
					} else {
					?>
					<div class="text-center py-5">
						<i class="bi bi-truck display-1 text-muted mb-3"></i>
						<p class="h5 text-muted mb-3">No hay proveedores registrados</p>
						<a href="index.php?view=newprovider" class="btn btn-primary">
							<i class="bi bi-plus-lg me-1"></i>Agregar primer proveedor
						</a>
					</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-coreui-toggle="tooltip"]'))
	tooltipTriggerList.map(function (tooltipTriggerEl) {
		return new coreui.Tooltip(tooltipTriggerEl)
	})
});
</script>
