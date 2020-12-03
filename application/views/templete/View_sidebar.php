

 

<!DOCTYPE html>
<html>

<?php


$titulo_pagina = 'Riesgo de Violencia Istitucional'; 



?>



  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo($titulo_pagina)?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>dist/css/adminlte.min.css">

  <link rel="stylesheet" href="<?php echo base_url()?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url()?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">



</head>
<body class="hold-transition sidebar-mini sidebar">
<!-- Site wrapper -->
<div class="wrapper">


  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li> -->
<!--       <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url()?>index.php/admin/crear_departamento" class="nav-link">Crear Departamento</a>
      </li>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url()?>index.php/admin/crear_supervisor" class="nav-link">Crear Supervisor</a>
      </li> -->
    </ul>

    <!-- SEARCH FORM -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item d-none d-sm-inline-block">
         <a href="<?php echo base_url()?>index.php/Encuesta"> <img src="<?php echo base_url()?>/assets/img/1.png" class="img-circle elevation-0" alt="User Image"> </a>
      </li> 
    
    </ul>
<!-- 

          <div class="brand-image">
            <img src="<?php echo base_url()?>/dist/img/logosis2.png" class="img-circle elevation-0" alt="User Image">
        </div>

 -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
<!--       </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url()?>index.php/admin/crear_proveedor" class="nav-link">Crear Proveedor</a>
      </li> 

      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url()?>index.php/admin/crear_acceso" class="nav-link">Crear Acceso</a>
      </li> -->


      <li class="nav-item">
      <a class="nav-link"  data-slide="true" href="<?php echo base_url() ?>index.php/App/" role="button">
          <i class="fas fa-sign-in-alt"></i>
        </a>
        <!-- <a class="nav-link"  data-slide="true" href="<?php echo base_url() ?>index.php/app/logout" role="button">
          <i class="fas fa-sign-out-alt"></i>
        </a> -->
      </li>



    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- CREAR VISTA TEMPLETE PARA NAVBAR DE MODO ADMIN Y DE LOS DISTINTOS MODOS Y FUNCIONES -->

  <!-- Main Sidebar Container -->
  <?php
  
  ?>






  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-0">
    <!-- Brand Logo -->
    <!-- <a href="../../index3.html" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
          <img src="<?php echo base_url()?>/assets/img/2.jpg" class="img-circle elevation-0" alt="User Image">
        </div>
        <div class="info">
          <!-- <a href="#" class="d-block">Alexander Pierce</a> -->
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

<!-- ------------COPIA DE AQUI PARA ABAJO ---------------- -->
<!-- ./wrapper -->
</div> 
<!-- jQuery -->
<script src="<?php echo base_url() ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>dist/js/demo.js"></script>
<script src="<?php echo base_url() ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<script src="<?php echo base_url() ?>plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?php echo base_url() ?>plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url() ?>plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url() ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url() ?>plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url() ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->










</body>
</html>
