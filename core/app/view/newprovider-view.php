<div class="container-lg">
  <div class="row mb-4">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb border-0 m-0 px-0">
          <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Inicio</a></li>
          <li class="breadcrumb-item active" aria-current="page">Nuevo Proveedor</li>
        </ol>
      </nav>
      <h2 class="text-primary fw-bold">Nuevo Proveedor</h2>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent border-bottom">
          <div class="d-flex align-items-center">
            <i class="cil-user me-2 text-primary"></i>
            <strong>DATOS DEL PROVEEDOR</strong>
          </div>
        </div>
        <div class="card-body p-4">
          <form method="post" id="addproduct" action="index.php?view=addprovider">
            <div class="row g-4">
              <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" name="name" class="form-control border-0 bg-light" id="name" placeholder="Nombre" required>
                  <label for="name" class="text-muted">Nombre*</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" name="lastname" class="form-control border-0 bg-light" id="lastname" placeholder="Apellido" required>
                  <label for="lastname" class="text-muted">Apellido*</label>
                </div>
              </div>
              <div class="col-12">
                <div class="form-floating">
                  <input type="text" name="address1" class="form-control border-0 bg-light" id="address1" placeholder="Dirección" required>
                  <label for="address1" class="text-muted">Dirección*</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating">
                  <input type="email" name="email1" class="form-control border-0 bg-light" id="email1" placeholder="Email" required>
                  <label for="email1" class="text-muted">Email*</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating">
                  <input type="tel" name="phone1" class="form-control border-0 bg-light" id="phone1" placeholder="Teléfono" required>
                  <label for="phone1" class="text-muted">Teléfono*</label>
                </div>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-12">
                <div class="alert alert-info bg-light border-start border-info border-3 d-flex align-items-center" role="alert">
                  <i class="cil-info text-info me-2"></i>
                  <small>Los campos marcados con * son obligatorios</small>
                </div>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-12 d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-light-dark px-4" onclick="history.back()">
                  <i class="cil-x me-2"></i>Cancelar
                </button>
                <button type="submit" class="btn btn-primary px-4">
                  <i class="cil-save me-2"></i>Guardar Proveedor
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
