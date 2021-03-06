
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>FreeBook.com</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/css/app.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="./img/logo.png" alt="" class="brand-image img-box elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">FreeBook.com</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3  d-flex">
        <div class="image">
          <img src="./img/user.png" class="img-circle elevation-2">
        </div>
        <div class="info">
          <a href="/profile" class="d-block">
          {{Auth::user()->name}}
          <p><small>{{Auth::user()->type}}</small></p>
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <router-link to="/dashboard" class="nav-link" id="btn_dashboard">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </router-link>
            </li>
            @can('isAdmin')
                <li class="nav-item has-treeview menu-close">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-cog"></i>
                      <p>
                        Configuración
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <router-link to="/users" href="#" class="nav-link" id="btn_users">
                          <i class="fas fa-users nav-icon"></i>
                          <p>Usuarios</p>
                        </router-link>
                      </li>
                    </ul>
                </li>
            @endcan
            <li class="nav-item">
              <router-link to="/profile" class="nav-link" id="btn_profile">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Perfil
                </p>
              </router-link >
            </li>
            <!-- aqui agrego la subida de archivos -->
            <li class="nav-item has-treeview menu-close">
                    <a href="#" class="nav-link" id="btn_files">
                      <i class="nav-icon fas fa-archive"></i>
                      <p>
                        Manejador de Archivos
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <router-link to="/view-fil" class="nav-link" id="btn_viewfile">
                          <i class="nav-icon fas fa-folder-open"></i>
                          <p>
                            Ver Archivo
                          </p>
                        </router-link >
                      </li>
                      <li class="nav-item">
                        <router-link to="/upload-fil" class="nav-link" id="btn_updatefile">
                          <i class="nav-icon fas fa-arrow-alt-circle-up"></i>
                          <p>
                            Subir Archivos
                          </p>
                        </router-link >
                      </li>
                    </ul>
                </li>
            @can('isAdmin')
                <li class="nav-item">
                  <router-link to="/developer" class="nav-link">
                    <i class="nav-icon fas fa-cog"></i>
                    <p>
                      Herramientas
                    </p>
                  </router-link >
                </li>
            @endcan

            <li class="nav-item">
               <a class="nav-link" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();" id="btn_logout">
                  <i class="nav-icon fa fa-power-off red"></i>
                    <p>
                        {{ __('Cerrar Sesión') }}
                    </p>
               </a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 @csrf
               </form>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
       <router-view></router-view>
       <vue-progress-bar></vue-progress-bar>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer sticky">
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 FreeBook.com.</strong> Todos los derechos reservados.
  </footer>
</div>
<!-- ./wrapper -->

@auth
<script>
    window.user = @json(auth()->user())
</script>
@endauth

<!-- REQUIRED SCRIPTS -->
<script src="js/app.js"></script>
</body>
</html>
