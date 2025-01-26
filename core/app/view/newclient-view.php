<div class="row">
  <div class="col-12">
    <div class="card mb-4 shadow-sm">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="cil-user-plus me-2"></i> Nuevo Cliente</h5>
      </div>
      <div class="card-body p-4">
        <form class="needs-validation" method="post" id="addproduct" action="index.php?view=addclient" novalidate>
          
          <div class="row g-4 mb-4">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" name="name" class="form-control form-control-lg" id="name" placeholder="Nombre" required>
                <label for="name"><i class="cil-user me-2"></i>Nombre*</label>
                <div class="invalid-feedback">Este campo es obligatorio</div>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" name="lastname" class="form-control form-control-lg" id="lastname" placeholder="Apellido" required>
                <label for="lastname"><i class="cil-user me-2"></i>Apellido*</label>
                <div class="invalid-feedback">Este campo es obligatorio</div>
              </div>
            </div>
          </div>

          <div class="row g-4 mb-4">
            <div class="col-12">
              <div class="form-floating">
                <input type="text" name="address1" class="form-control form-control-lg" id="address1" placeholder="Dirección" required>
                <label for="address1"><i class="cil-location-pin me-2"></i>Dirección*</label>
                <div class="invalid-feedback">Este campo es obligatorio</div>
              </div>
            </div>
          </div>

          <div class="row g-4 mb-4">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="email" name="email1" class="form-control form-control-lg" id="email1" placeholder="Email" required>
                <label for="email1"><i class="cil-envelope-closed me-2"></i>Email*</label>
                <div class="invalid-feedback">Ingrese un email válido</div>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-floating">
                <input type="tel" name="phone1" class="form-control form-control-lg" id="phone1" placeholder="Teléfono" required>
                <label for="phone1"><i class="cil-phone me-2"></i>Teléfono</label>
                <div class="invalid-feedback">Este campo es obligatorio</div>
              </div>
            </div>
          </div>

          <div class="alert alert-info d-flex align-items-center bg-light border-info mb-4" role="alert">
            <i class="cil-info me-3 text-info h4 mb-0"></i>
            <div>Los campos marcados con * son obligatorios</div>
          </div>

          <div class="text-end">
            <button type="submit" class="btn btn-primary btn-lg px-4">
              <i class="cil-save me-2"></i>Guardar Cliente
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
