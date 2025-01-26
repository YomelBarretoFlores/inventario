<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <div class="card-header">
        <strong>Nueva Categoría</strong>
        <small class="text-muted">Complete los datos para agregar una categoría</small>
      </div>
      <div class="card-body">
        <form class="needs-validation" method="post" id="addcategory" action="index.php?view=addcategory" novalidate>
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" 
                     class="form-control" 
                     id="name" 
                     name="name" 
                     placeholder="Nombre de la categoría"
                     required>
                <label for="name">Nombre de la categoría</label>
                <div class="invalid-feedback">
                  Por favor ingrese un nombre para la categoría
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary px-4">
                <i class="cil-save me-2"></i>Guardar Categoría
              </button>
              <a href="index.php?view=categories" class="btn btn-outline-secondary px-4">
                <i class="cil-x me-2"></i>Cancelar
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
// Validación del formulario
(function () {
  'use strict'
  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })
})()
</script>