<?php $input_numero_control = array(
                'name' => 'numero_control',
                'id' => 'numero_control',
               'class' => 'form-control col-3'
        );?>


<?php $input_btn_guardar_ingreso = array(
                'name' => 'btn_guardar',
                'id' => 'btn_guardar',
                'value' => 'Guardar',
                'type' => 'button',
                'class' => 'btn  btn-success btn-flat float-right col-sm-3'

        );?>


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
         <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Rellena los campos correctamente:</h3>
                <!-- <a href="<?php echo base_url()?>index.php/admin/supervisores" class="float-right" >Volver</a></li> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <?php echo form_open('');?>

                  <div class="form-group">
                    <?php echo form_label('Ingresar numero de control: '); ?>
                    <?php echo form_input($input_numero_control);?> 
                    <?php echo form_error('numero_control') ?> 
                  </div>
                  
                  <div class="form-group">
                    <?php echo form_label('Seleccionar sexo: '); ?>

                        <select class="form-control col-3" name="sexo" id="sexo" >
                          <option value="0">Femenino</option>
                          <option value="1">Masculino</option>
            
                        </select>

                  </div>

                <?php echo form_submit('btn_guardar','Siguiente', $input_btn_guardar_ingreso);?>
                <?php echo form_close(); ?>


               
                La información recolectada en esta pantalla es solo para fines analiticos
            
            </div>
          </div>
      </div>

  </div><!-- /.container-fluid -->
</section>

    <!-- /.content -->

