<?php $user = PersonData::getById($_GET["id"]);?>
<div class="container-lg px-4 py-4">
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php?view=clients">Clientes</a></li>
          <li class="breadcrumb-item active">Editar Cliente</li>
        </ol>
      </nav>
      
      <div class="card mb-4">
        <div class="card-header bg-primary text-white">
          <h5 class="card-title mb-0"><i class="cil-user me-2"></i>Editar Cliente</h5>
        </div>
        <div class="card-body">
          <form method="post" action="index.php?view=updateclient">
            
            <div class="row g-3">
              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <input type="text" name="name" value="<?php echo $user->name;?>" class="form-control" id="name" placeholder="Nombre" required>
                  <label for="name">Nombre*</label>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <input type="text" name="lastname" value="<?php echo $user->lastname;?>" class="form-control" id="lastname" placeholder="Apellido" required>
                  <label for="lastname">Apellido*</label>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-floating mb-3">
                  <input type="text" name="address1" value="<?php echo $user->address1;?>" class="form-control" id="address" placeholder="Dirección" required>
                  <label for="address">Dirección*</label>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <input type="email" name="email1" value="<?php echo $user->email1;?>" class="form-control" id="email" placeholder="Email" required>
                  <label for="email">Email*</label>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <input type="tel" name="phone1" value="<?php echo $user->phone1;?>" class="form-control" id="phone" placeholder="Teléfono">
                  <label for="phone">Teléfono</label>
                </div>
              </div>
            </div>

            <div class="alert alert-info" role="alert">
              <i class="cil-info me-2"></i>Los campos marcados con * son obligatorios
            </div>

            <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
            
            <div class="text-end">
              <a href="index.php?view=clients" class="btn btn-outline-secondary me-2">Cancelar</a>
              <button type="submit" class="btn btn-primary">
                <i class="cil-save me-2"></i>Actualizar Cliente
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
