

 

<!DOCTYPE html>
<html>

  <?php


   $titulo_pagina = 'Riesgo de Violencia Istitucional'; 
   $verificar_respuesta = $this->M_entrevista->get_pregunta_from_entrevistado($no_control);
   if ($verificar_respuesta == False) {
      $separado_por_comas = "";
   }else {
      $no_pregunta = array_column($verificar_respuesta, 'id_pregunta');
      $separado_por_comas = implode(",", $no_pregunta);
   }


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
         <a href="<?php echo base_url()?>index.php/Application"> <img src="<?php echo base_url()?>/assets/img/1.png" class="img-circle elevation-0" alt="User Image"> </a>
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

<!-- 
      <li class="nav-item">
        <a class="nav-link"  data-slide="true" href="<?php echo base_url() ?>index.php/app/logout" role="button">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li> -->



    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- CREAR VISTA TEMPLETE PARA NAVBAR DE MODO ADMIN Y DE LOS DISTINTOS MODOS Y FUNCIONES -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-success elevation-0">
    <!-- Brand Logo -->
    <!-- <a href="#" class="brand-link">
      <img src="<?php echo base_url()?>/dist/img/iconsis2.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-0"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Encuesta
      </span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url()?>/assets/img/2.jpg" class="img-circle elevation-0" alt="User Image">
        </div>
        
        <div class="info">
          <a href="#" class="in-block"><?php echo $no_control?></a>
          <a href="#" class="in-block">

            

          </a>

        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="<?php echo base_url() ?>index.php/encuesta/pregunta2/<?php echo $no_control?>" class="nav-link">

              <i class="nav-icon fa fa-question-circle"></i>
              <p>
                Encuesta

              </p>
            </a>

          </li>

          <li class="nav-item">
            <a href="<?php echo base_url() ?>index.php/encuesta/preguntas/<?php echo $no_control?>" class="nav-link">
              <i class="fa-number-1"></i>
              <p>
                <?php if ( strpos($separado_por_comas, "1") !== False ) { ?>
                <span class="badge badge-success"> Pregunta 1 </span>
                <?php } else { ?>
                     <span class="badge badge-danger ">  Pregunta 1</span>
                <?php } ?>

              </p>
            </a>

          </li>
          
          <li class="nav-item">
            <a href="<?php echo base_url() ?>index.php/encuesta/pregunta2/<?php echo $no_control?>" class="nav-link">
              <p>
                <?php if ( strpos($separado_por_comas, "2") !== False) { ?>
                <span class="badge badge-success ">Pregunta 2 </span>
                <?php } else { ?>
                     <span class="badge badge-danger ">Pregunta 2 </span>
                <?php } ?>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url() ?>index.php/encuesta/pregunta3/<?php echo $no_control?>" class="nav-link">
              <p>
                <?php if (strpos($separado_por_comas, "3") !== false) { ?>
                <span class="badge badge-success ">Pregunta 3 </span>
                <?php } else { ?>
                     <span class="badge badge-danger ">Pregunta 3 </span>
                <?php } ?>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>index.php/encuesta/pregunta4/<?php echo $no_control?>" class="nav-link">
              <p>
                <?php if ( strpos($separado_por_comas, "4") !== false ) { ?>
                <span class="badge badge-success ">Pregunta 4 </span>
                <?php } else { ?>
                     <span class="badge badge-danger ">Pregunta 4 </span>
                <?php } ?>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url() ?>index.php/encuesta/pregunta5/<?php echo $no_control?>" class="nav-link">
              <p>
                <?php if ( strpos($separado_por_comas, "5") !== false ) { ?>
                <span class="badge badge-success ">Pregunta 5 </span>
                <?php } else { ?>
                     <span class="badge badge-danger ">Pregunta 5 </span>
                <?php } ?>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url() ?>index.php/encuesta/pregunta6/<?php echo $no_control?>" class="nav-link">
              <p>
                <?php if ( strpos($separado_por_comas, "6") !== false ) { ?>
                <span class="badge badge-success ">Pregunta 6 </span>
                <?php } else { ?>
                     <span class="badge badge-danger ">Pregunta 6 </span>
                <?php } ?>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url() ?>index.php/encuesta/pregunta7/<?php echo $no_control?>" class="nav-link">
              <p>
                <?php if ( strpos($separado_por_comas, "7") !== false ) { ?>
                <span class="badge badge-success ">Pregunta 7 </span>
                <?php } else { ?>
                     <span class="badge badge-danger ">Pregunta 7 </span>
                <?php } ?>
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="<?php echo base_url() ?>index.php/encuesta/pregunta8/<?php echo $no_control?>" class="nav-link">
              <p>
                <?php if ( strpos($separado_por_comas, "8") !== false ) { ?>
                <span class="badge badge-success ">Pregunta 8 </span>
                <?php } else { ?>
                     <span class="badge badge-danger ">Pregunta 8 </span>
                <?php } ?>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>index.php/encuesta/pregunta9/<?php echo $no_control?>" class="nav-link">
              <p>
                <?php if ( strpos($separado_por_comas, "9") !== false ) { ?>
                <span class="badge badge-success ">Pregunta 9 </span>
                <?php } else { ?>
                     <span class="badge badge-danger ">Pregunta 9 </span>
                <?php } ?>
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="<?php echo base_url() ?>index.php/encuesta/pregunta10/<?php echo $no_control?>" class="nav-link">
              <p>
                <?php if ( strpos($separado_por_comas, "10") !== false ) { ?>
                <span class="badge badge-success ">Pregunta 10 </span>
                <?php } else { ?>
                     <span class="badge badge-danger ">Pregunta 10 </span>
                <?php } ?>
              </p>
            </a>
          </li>



          <li class="nav-item">
            <a href="<?php echo base_url() ?>index.php/encuesta/pregunta11/<?php echo $no_control?>" class="nav-link">
              <p>
                <?php if ( strpos($separado_por_comas, "11") !== false ) { ?>
                <span class="badge badge-success ">Pregunta 11 </span>
                <?php } else { ?>
                     <span class="badge badge-danger ">Pregunta 11 </span>
                <?php } ?>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url() ?>index.php/encuesta/pregunta12/<?php echo $no_control?>" class="nav-link">
              <p>
                <?php if ( strpos($separado_por_comas, "12") !== false ) { ?>
                <span class="badge badge-success ">Pregunta 12 </span>
                <?php } else { ?>
                     <span class="badge badge-danger ">Pregunta 12 </span>
                <?php } ?>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>index.php/encuesta/pregunta13/<?php echo $no_control?>" class="nav-link">
              <p>
                <?php if ( strpos($separado_por_comas, "13") !== false ) { ?>
                <span class="badge badge-success ">Pregunta 13 </span>
                <?php } else { ?>
                     <span class="badge badge-danger ">Pregunta 13 </span>
                <?php } ?>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>index.php/encuesta/pregunta14/<?php echo $no_control?>" class="nav-link">
              <p>
                <?php if ( strpos($separado_por_comas, "14") !== false ) { ?>
                <span class="badge badge-success ">Pregunta 14 </span>
                <?php } else { ?>
                     <span class="badge badge-danger ">Pregunta 14 </span>
                <?php } ?>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>index.php/encuesta/pregunta15/<?php echo $no_control?>" class="nav-link">
              <p>
                <?php if ( strpos($separado_por_comas, "15") !== false ) { ?>
                <span class="badge badge-success ">Pregunta 15 </span>
                <?php } else { ?>
                     <span class="badge badge-danger ">Pregunta 15 </span>
                <?php } ?>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url() ?>index.php/encuesta/pregunta16/<?php echo $no_control?>" class="nav-link">
              <p>
                <?php if ( strpos($separado_por_comas, "16") !== false ) { ?>
                <span class="badge badge-success ">Pregunta 16 </span>
                <?php } else { ?>
                     <span class="badge badge-danger ">Pregunta 16 </span>
                <?php } ?>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>index.php/encuesta/pregunta17/<?php echo $no_control?>" class="nav-link">
              <p>
                <?php if ( strpos($separado_por_comas, "17") !== false ) { ?>
                <span class="badge badge-success ">Pregunta 17 </span>
                <?php } else { ?>
                     <span class="badge badge-danger ">Pregunta 17 </span>
                <?php } ?>
              </p>
            </a>
          </li>
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
