<div class="container-lg">
	<div class="row mb-4">
		<div class="col-md-12">
			<div class="d-flex justify-content-between align-items-center">
				<h1 class="text-primary">
					<i class="fas fa-user-friends fa-fw"></i> 
					Directorio de Clientes
				</h1>
				<div class="d-flex gap-3">
					<a href="index.php?view=newclient" class="btn btn-primary d-flex align-items-center">
						<i class="bi bi-person-plus-fill me-2"></i> Nuevo Cliente
					</a>
					<div class="dropdown">
						<button class="btn btn-outline-primary dropdown-toggle d-flex align-items-center" type="button" data-coreui-toggle="dropdown" aria-expanded="false">
							<i class="bi bi-file-earmark-arrow-down me-2"></i>
							Exportar
						</button>
						<ul class="dropdown-menu dropdown-menu-end">
							
							<li>
								<a class="dropdown-item d-flex align-items-center" href="?view=exportclients&export-format=excel">
									<i class="bi bi-file-earmark-excel me-2"></i> Exportar a Excel
								</a>
							</li>
							<li>
								<a class="dropdown-item d-flex align-items-center" href="?view=exportclients&export-format=pdf">
									<i class="bi bi-file-earmark-pdf me-2"></i> Exportar a PDF
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="card shadow-sm border-0">
		<div class="card-header bg-light py-3">
			<div class="d-flex align-items-center">
				<i class="fas fa-address-card fa-2x text-primary me-2"></i>
				<h5 class="card-title mb-0">Listado de Clientes</h5>
			</div>
		</div>
		<div class="card-body">
			<?php
			$users = PersonData::getClients();
			if(count($users)>0):
			?>
			<div class="table-responsive">
				<table class="table table-hover align-middle border">
					<thead class="bg-light">
						<tr>
							<th class="py-3"><i class="fas fa-user fa-fw text-primary"></i> Nombre completo</th>
							<th class="py-3"><i class="fas fa-map-marker-alt fa-fw text-danger"></i> Dirección</th>
							<th class="py-3"><i class="fas fa-envelope fa-fw text-success"></i> Email</th>
							<th class="py-3"><i class="fas fa-phone-alt fa-fw text-info"></i> Teléfono</th>
							<th class="py-3"><i class="fas fa-tools fa-fw text-secondary"></i> Acciones</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($users as $user): ?>
						<tr>
							<td class="py-3">
								<div class="d-flex align-items-center">
									<div class="avatar avatar-lg rounded-circle bg-primary-subtle me-3">
										<i class="fas fa-user fa-lg text-primary"></i>
									</div>
									<div>
										<h6 class="mb-0"><?php echo htmlspecialchars($user->name." ".$user->lastname); ?></h6>
										<small class="text-muted">Cliente #<?php echo $user->id; ?></small>
									</div>
								</div>
							</td>
							<td class="py-3">
								<div class="d-flex align-items-center">
									<i class="fas fa-location-dot fa-fw text-danger me-2"></i>
									<span><?php echo htmlspecialchars($user->address1); ?></span>
								</div>
							</td>
							<td class="py-3">
								<div class="d-flex align-items-center">
									<i class="fas fa-envelope fa-fw text-success me-2"></i>
									<a href="mailto:<?php echo htmlspecialchars($user->email1); ?>" class="text-decoration-none">
										<?php echo htmlspecialchars($user->email1); ?>
									</a>
								</div>
							</td>
							<td class="py-3">
								<div class="d-flex align-items-center">
									<i class="fas fa-phone fa-fw text-info me-2"></i>
									<a href="tel:<?php echo htmlspecialchars($user->phone1); ?>" class="text-decoration-none">
										<?php echo htmlspecialchars($user->phone1); ?>
									</a>
								</div>
							</td>
							<td class="py-3">
								<div class="btn-group btn-group-sm">
									<a href="index.php?view=editclient&id=<?php echo $user->id;?>" 
									   class="btn btn-ghost-primary" 
									   data-coreui-toggle="tooltip"
									   title="Editar">
										<i class="bi bi-pencil"></i>
									</a>
									<a href="index.php?view=delclient&id=<?php echo $user->id;?>" 
									   class="btn btn-ghost-danger"
									   data-coreui-toggle="tooltip" 
									   title="Eliminar">
										<i class="bi bi-trash"></i>
									</a>
								</div>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<?php else: ?>
				<div class="alert alert-warning d-flex align-items-center shadow-sm">
					<i class="fas fa-exclamation-circle fa-2x me-3"></i>
					<div>No hay clientes registrados en el sistema</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>