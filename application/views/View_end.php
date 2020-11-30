           
<!DOCTYPE html>
<?php date_default_timezone_set("America/Phoenix"); ?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url()?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url()?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url()?>plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url()?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url()?>plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url()?>plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">



</head>

<div>
<?php 
        $nombre_riesgo_fisico = "Violencia Fisica";
        $nombre_riesgo_psicologica = "Violencia Psicológica";
        $nombre_riesgo_sexual = "Violencia Sexual";
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
          <center> <h1>ENCUESTA DE RIESGO DE VIOENCIA INSTITUCIONAL</h1></center>

          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="<?php echo base_url() ?>index.php/app/logout">Salir</a></li> -->


            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
         <div  class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">RESULTADOS DE ENCUESTA DE RIESGO DE VIOLENCIA INSTITUCIONAL </h3><br>


                <!-- <a href="<?php echo base_url()?>index.php/admin/supervisores" class="float-right" >Volver</a></li> -->
              </div>
              <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
              <div class="col-12 col-sm-12">
                <div class="tab-content" id="vert-tabs-right-tabContent">
                  <div class="tab-pane fade show active" id="vert-tabs-right-home" role="tabpanel" aria-labelledby="vert-tabs-right-home-tab">
                    <section class="content">
                        <div class="container-fluid">




                            <!-- row -->
                        <div class="row">
                            <div class="col-4">
                                <!-- jQuery Knob -->
                              <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                    <!-- <i class="far fa-chart-bar"></i> -->
                                    <b><?php  echo $nombre_riesgo_fisico; ?> </b>
                                    </h3>

                                
                             </div>
                                <!-- /.card-header -->

        
                          <?php if ($Vf == 1) { ?>
                                <div class="card-body">
                                    <div class="row">
                                    <!-- ./col -->
                                    <?php if ($RVf == 1) { ?>

                                        <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-success">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de <b>reincidencia</b> de violencia física es:</h3>



                                              <div class="card-tools">
                                               
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body ">
                                            <b>Bajo</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    <?php } ?>
                                    <?php if ($RVf == 2) { ?>
                                        <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-warning">
                                            <h3 class="card-title">El riesgo de <b>reincidencia</b> de violencia física es:</h3>
                                            <div class="card-header">


                                              <div class="card-tools">
                                               
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                            <b>Moderado</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    <?php } ?>
                                    <?php if ($RVf == 3) { ?>
                                                                               <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-orange">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de <b>reincidencia</b> de violencia física es:</h3>



                                              <div class="card-tools">
                                               
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                            <b>Alto</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    <?php } ?>
                                    <?php if ($RVf == 4) { ?>
                                        <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-danger">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de <b>reincidencia</b> de violencia física es:</h3>



                                              <div class="card-tools">
                                               
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                            <b>Muy Alto</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    <?php } ?>

                                </div>
                                    <!-- /.row -->
                                    <div class="row">
                                    <!-- ./col -->
                                    <?php if ($EVf == 1) { ?>

                                        <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-success">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de <b>escalabilidad</b> de violencia física es:</h3>
                                              <div class="card-tools">
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                            <b>Bajo</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->



                                    <?php } ?>
                                    <?php if ($EVf == 2) { ?>
                                        <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-warning">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de <b>escalabilidad</b> de violencia física es:</h3>



                                              <div class="card-tools">
                                               
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                            <b>Moderado</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    <?php } ?>
                                    <?php if ($EVf == 3) { ?>
                                                                               <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-orange">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de <b>escalabilidad</b> de violencia física es:</h3>
                                              <div class="card-tools">
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                             <b>Alto</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    <?php } ?>
                                    <?php if ($EVf == 4) { ?>
                                        <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-danger">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de <b>escalabilidad</b> de violencia física es:</h3>
                                              <div class="card-tools">
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                            <b>Muy Alto</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    <?php } ?>

                                </div>
                                    <!-- /.row -->
                     
                                    <!-- /.row -->
                                </div>
                                <!-- /.card-body -->
                              </div>
                                <!-- /.card -->
                          <?php } else { ?> 
                            <div class="card-body">
                                    <div class="row">
                                    <!-- ./col -->


                                        <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-gray">
                                            <div class="card-header">
                                            <h3 class="card-title"><?php echo  nl2br ("El riesgo de de violencia Fisica \n es: ");?> </h3>

                                              <div class="card-tools">
                                               
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body ">
                                            <b>Nulo</b>
                                            </div>
                                            <!-- /.card-body -->
                                            <!-- /.card-body -->

                                          </div>
                                          </div>
                                          </div>
                                          </div>

                                          <!-- /.card -->
                                          </div>
                                     
                                        <!-- /.col -->


                                        <!-- /.col -->
                            <?php } ?>
                            
                            </div>
                            

                            <!-- </div> -->
                            <!-- /.col -->

                            <div class="col-4">
                                <!-- jQuery Knob -->
                              <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                    <!-- <i class="far fa-chart-bar"></i> -->
                                    <b><?php  echo $nombre_riesgo_psicologica; ?> </b>
                                    </h3>

                                
                             </div>
                                <!-- /.card-header -->

        
                          <?php if ($Vp == 1) { ?>
                                <div class="card-body">
                                    <div class="row">
                                    <!-- ./col -->
                                    <?php if ($RVp == 1) { ?>

                                        <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-success">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de <b>reincidencia</b> de violencia psicológica es:</h3>



                                              <div class="card-tools">
                                               
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body ">
                                            <b>Bajo</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    <?php } ?>
                                    <?php if ($RVp == 2) { ?>
                                        <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-warning">
                                            <h3 class="card-title">El riesgo de <b>reincidencia</b> de violencia psicológica es:</h3>
                                            <div class="card-header">


                                              <div class="card-tools">
                                               
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                            <b>Moderado</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    <?php } ?>
                                    <?php if ($RVp == 3) { ?>
                                                                               <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-orange">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de <b>reincidencia</b> de violencia psicológica es:</h3>



                                              <div class="card-tools">
                                               
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                            <b>Alto</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    <?php } ?>
                                    <?php if ($RVp == 4) { ?>
                                        <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-danger">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de <b>reincidencia</b> de violencia psicológica es:</h3>



                                              <div class="card-tools">
                                               
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                            <b>Muy Alto</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    <?php } ?>

                                </div>
                                    <!-- /.row -->
                                    <div class="row">
                                    <!-- ./col -->
                                    <?php if ($EVp == 1) { ?>

       <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-success">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de <b>escalabilidad</b> de violencia psicológica es:</h3>
                                              <div class="card-tools">
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                            <b>Bajo</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->


                                    <?php } ?>
                                    <?php if ($EVp == 2) { ?>
                                        <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-warning">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de <b>escalabilidad</b> de violencia psicológica es:</h3>



                                              <div class="card-tools">
                                               
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                            <b>Moderado</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    <?php } ?>
                                    <?php if ($EVp == 3) { ?>
                                                                               <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-orange">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de <b>escalabilidad</b> de violencia psicológica es:</h3>
                                              <div class="card-tools">
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                             <b>Alto</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    <?php } ?>
                                    <?php if ($EVp == 4) { ?>
                                        <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-danger">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de <b>escalabilidad</b> de violencia psicológica es:</h3>
                                              <div class="card-tools">
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                            <b>Muy Alto</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    <?php } ?>

                                </div>
                                    <!-- /.row -->
                     
                                    <!-- /.row -->
                                </div>
                                <!-- /.card-body -->
                              </div>
                                <!-- /.card -->
                          <?php } else { ?> 
                            <div class="card-body">
                                    <div class="row">
                                    <!-- ./col -->


                                        <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-gray">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de de violencia Psicológica es:</h3>

                                              <div class="card-tools">
                                               
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body ">
                                            <b>Nulo</b>
                                            </div>
                                            <!-- /.card-body -->
                                            <!-- /.card-body -->

                                          </div>
                                          </div>
                                          </div>
                                          </div>

                                          <!-- /.card -->
                                          </div>
                                     
                                        <!-- /.col -->


                            <?php } ?>
                            
                            </div>


                            <div class="col-4">
                                <!-- jQuery Knob -->
                              <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                    <!-- <i class="far fa-chart-bar"></i> -->
                                    <b><?php  echo $nombre_riesgo_sexual; ?> </b>
                                    </h3>

                                
                             </div>

                   
                                <!-- /.card-header -->

        
                          <?php if ($Vs == 1) { ?>
                                <div class="card-body">
                                    <div class="row">
                                    <!-- ./col -->
                                    <?php if ($RVs == 1) { ?>
                                                                               <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-success">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de <b>reincidencia</b> de violencia sexual es:</h3>



                                              <div class="card-tools">
                                               
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                            <b>Bajo</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    <?php } ?>
                                    <?php if ($RVs == 2) { ?>
                                                                               <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-warning">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de <b>reincidencia</b> de violencia sexual es:</h3>



                                              <div class="card-tools">
                                               
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                            <b>Moderado</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    <?php } ?>
                                    <?php if ($RVs == 3) { ?>
                                                                               <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-orange">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de <b>reincidencia</b> de violencia sexual es:</h3>



                                              <div class="card-tools">
                                               
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                            <b>Alto</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    <?php } ?>
                                    <?php if ($RVs == 4) { ?>
                                        <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-danger">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de <b>reincidencia</b> de violencia sexual es:</h3>



                                              <div class="card-tools">
                                               
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                            <b>Muy Alto</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    <?php } ?>

                                </div>
                                    <!-- /.row -->
                                    <div class="row">
                                    <!-- ./col -->
                                    <?php if ($EVs == 1) { ?>
                                        <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-success">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de <b>escalabilidad</b> de violencia sexual es:</h3>



                                              <div class="card-tools">
                                               
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                            <b>Bajo</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    <?php } ?>
                                    <?php if ($EVs == 2) { ?>
                                        <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-warning">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de <b>escalabilidad</b> de violencia sexual es:</h3>



                                              <div class="card-tools">
                                               
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                            <b>Moderado</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    <?php } ?>
                                    <?php if ($EVs == 3) { ?>
                                                                               <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-orange">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de <b>escalabilidad</b> de violencia sexual es:</h3>
                                              <div class="card-tools">
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                             <b>Alto</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    <?php } ?>
                                    <?php if ($EVs == 4) { ?>
                                        <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-danger">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de <b>escalabilidad</b> de violencia sexual es:</h3>
                                              <div class="card-tools">
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                            <b>Muy Alto</b>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    <?php } ?>

                                </div>
                                    <!-- /.row -->
                     
                                    <!-- /.row -->
                                </div>
                                <!-- /.card-body -->
                              </div>
                                <!-- /.card -->
                          <?php } else { ?> 
                            <div class="card-body">
                                    <div class="row">
                                    <!-- ./col -->


                                        <!-- /.col -->
                                        <div class="col-md-12">
                                          <div class="card bg-gradient-gray">
                                            <div class="card-header">
                                            <h3 class="card-title">El riesgo de de violencia Sexual es:</h3>

                                              <div class="card-tools">
                                               
                                              </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body ">
                                            <b>Nulo</b>
                                            </div>
                                            <!-- /.card-body -->
                                            <!-- /.card-body -->

                                          </div>
                                          </div>
                                          </div>
                                          </div>

                                          <!-- /.card -->
                                          </div>
                                     
                                        <!-- /.col -->
                                        

                            <?php } ?>
                            
                            </div>
                            </div>
                            <!-- /.col -->
                        </div>
                    </section>




            </div>
          </div>
           		</div>
         	</div>
        </div>
     </section>
</div>



<!-- jQuery -->
<script src="<?php echo base_url()?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url()?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url()?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url()?>plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url()?>plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url()?>plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url()?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url()?>plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url()?>plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url()?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url()?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url()?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url()?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url()?>dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>dist/js/demo.js"></script>
