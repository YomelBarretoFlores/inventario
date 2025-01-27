<!DOCTYPE html>

<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>Inventario Lite</title>
    <link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="assets/css/vendors/simplebar.css">
    <!-- Main styles for this application-->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-icons/bootstrap-icons.css">
    <script type="text/javascript" src="assets/jquery/jquery.min.js"></script>
    <link href="vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">
  </head>
  <body>
<?php if(!isset($_SESSION["user_id"])):?>
<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="card-group d-block d-md-flex row">
<div class="card col-md-12 p-4 mb-0">
<div class="card-body">
<h1>INVENTIO <b>LITE</b></h1>
<br>
<p class="text-medium-emphasis">Iniciar Sesion al Sistema</p>
<form method="post" action="./?action=processlogin">
<div class="input-group mb-3"><span class="input-group-text">
<svg class="icon">
<use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
</svg></span>
<input class="form-control" type="text" name="username" placeholder="Email">
</div>
<div class="input-group mb-4"><span class="input-group-text">
<svg class="icon">
<use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
</svg></span>
<input class="form-control" name="password" type="password" placeholder="Password">
</div>
<div class="row">
<div class="col-6">
<button class="btn btn-primary px-4" type="submit">Iniciar Sesion</button>
</div>
</div>
</form>
<br><br><br>

</div>
</div>

</div>
</div>
</div>
</div>
</div>
<?php else:?>
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">

<div class="sidebar-brand d-none d-md-flex">
<div class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">

<h4><a href="./" style="color: white;">INVENTIO<b>LITE</b></a></h4>

</div>
<div class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
<h4><a href="./" style="color: white;">I<b>L</b></a></h4>

</div>
</div>









      <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item mt-2">
          <a class="nav-link d-flex align-items-center" href="./">
        <svg class="nav-icon text-white">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-home"></use>
        </svg> 
        <span class="ms-2">Inicio</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="./?view=sell">
        <svg class="nav-icon text-success">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-dollar"></use>
        </svg>
        <span class="ms-2">Vender</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="./?view=sells">
        <svg class="nav-icon text-info">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-basket"></use>
        </svg>
        <span class="ms-2">Ventas</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="./?view=box">
        <svg class="nav-icon text-warning">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bank"></use>
        </svg>
        <span class="ms-2">Caja</span>
          </a>
        </li>

        <li class="nav-group mt-3">
          <a class="nav-link nav-group-toggle d-flex align-items-center" href="#">
        <svg class="nav-icon text-info">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-list"></use>
        </svg>
        <span class="ms-2">Catálogos</span>
          </a>
          <ul class="nav-group-items ps-3">
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="./?view=products">
            <svg class="nav-icon text-white" style="width: 1rem;">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-gift"></use>
            </svg>
            <span class="ms-2">Productos</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="./?view=categories">
            <svg class="nav-icon text-white" style="width: 1rem;">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-tags"></use>
            </svg>
            <span class="ms-2">Categorías</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="./?view=clients">
            <svg class="nav-icon text-white" style="width: 1rem;">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-people"></use>
            </svg>
            <span class="ms-2">Clientes</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="./?view=providers">
            <svg class="nav-icon text-white" style="width: 1rem;">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-truck"></use>
            </svg>
            <span class="ms-2">Proveedores</span>
          </a>
        </li>
          </ul>
        </li>

        <li class="nav-group">
          <a class="nav-link nav-group-toggle d-flex align-items-center" href="#">
        <svg class="nav-icon text-success">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-storage"></use>
        </svg>
        <span class="ms-2">Inventario</span>
          </a>
          <ul class="nav-group-items ps-3">
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="./?view=inventary">
            <svg class="nav-icon text-white" style="width: 1rem;">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-briefcase"></use>
            </svg>
            <span class="ms-2">Inventario</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="./?view=re">
            <svg class="nav-icon text-white" style="width: 1rem;">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cart"></use>
            </svg>
            <span class="ms-2">Hacer Compra</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="./?view=res">
            <svg class="nav-icon text-white" style="width: 1rem;">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-history"></use>
            </svg>
            <span class="ms-2">Compras</span>
          </a>
        </li>
          </ul>
        </li>

        <li class="nav-group">
          <a class="nav-link nav-group-toggle d-flex align-items-center" href="#">
        <svg class="nav-icon text-warning">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
        </svg>
        <span class="ms-2">Administración</span>
          </a>
          <ul class="nav-group-items ps-3">
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="./?view=users&opt=all">
            <svg class="nav-icon text-white" style="width: 1rem;">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
            </svg>
            <span class="ms-2">Usuarios</span>
          </a>
        </li>
          </ul>
        </li>
      </ul>

      <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
      </div>

      <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <header class="header header-sticky mb-4 shadow-sm">
          <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button" 
          onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
          <svg class="icon icon-lg">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
          </svg>
        </button>

        <ul class="header-nav ms-auto">
          <li class="nav-item dropdown">
            <a class="nav-link py-0 pe-4" data-coreui-toggle="dropdown" href="#" role="button">
          <div class="avatar avatar-md">
            <img class="avatar-img rounded-circle border" src="assets/img/user.png" alt="user">
          </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end pt-0 shadow">
          <div class="dropdown-header bg-light py-2">
            <div class="fw-semibold text-muted">Mi Cuenta</div>
          </div>
          <a class="dropdown-item" href="#">
            <svg class="icon me-2 text-primary">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
            </svg> Configuración
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="./logout.php">
            <svg class="icon me-2 text-danger">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
            </svg> Cerrar Sesión
          </a>
            </div>
          </li>
        </ul>
          </div>
          
          <div class="header-divider"></div>
          
          <div class="container-fluid">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
          <span>Home</span>
            </li>
            <li class="breadcrumb-item active"><span>Dashboard</span></li>
          </ol>
        </nav>
          </div>
        </header>

        <div class="body flex-grow-1 px-3">
          <div class="container-fluid">
        <?php View::load("index");?>
          </div>
        </div>
      </div>
    <?php endif; ?>
    <!-- CoreUI and necessary plugins-->
    <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="vendors/simplebar/js/simplebar.min.js"></script>
    <!-- Plugins and scripts required by this view-->
    
    <script src="vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
    <script src="vendors/@coreui/utils/js/coreui-utils.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
    </script>

  </body>
</html>