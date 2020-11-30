<?php date_default_timezone_set("America/Phoenix"); ?>

<?php $input_id_pregunta = array( 
                'id_pregunta' => 12
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
                <h3 class="card-title">Favor de contestar las preguntas cuidadosamente</h3><br>
                <h3 class="card-title"><?php echo 'Numero de control: '.$no_control;?> </h3><br>

                <!-- <a href="<?php echo base_url()?>index.php/admin/supervisores" class="float-right" >Volver</a></li> -->
              </div>
              <!-- /.card-header -->
        		 <div class="card-body">
          

            <div class="row">
              <div class="col-7 col-sm-9">
                <div class="tab-content" id="vert-tabs-right-tabContent">
                  <div class="tab-pane fade show active" id="vert-tabs-right-home" role="tabpanel" aria-labelledby="vert-tabs-right-home-tab">


          					<h4 class="mt-4">Pregunta 12 </h4>

                    Durante su vida como estudiante, ¿alguna persona de las escuelas a las que asistió a estudiar, (sea maestra o maestro, director, prefecto, compañero de clases o alumno de la escuela, trabajador o persona de la escuela) la han ignorado o no la han tomado en cuenta por ser mujer?



		 			        <?php echo form_open('');?>

		                  <div class="form-group">
		                    <?php echo form_label('Selecciona una respuesa: '); ?>

		                     <select onchange="this.options[this.selectedIndex].getAttribute('isred');" name="1" id="1" class="form-control col-sm-7 ">
		                    <option isred="0" value="0">  No </option>		    

		                    <option isred="1" value="1">  Si </option>

		                    </select>
		                  </div>






 				     <div class="form-group forms select2-orange  col-sm-7">
                    <?php echo form_label('12.1) ¿Qué personas de la siguiente lista la han ignorado no la han tomado en cuenta por ser mujer? (señale las casillas necesarias)'); ?>

                  <select class="select2 " multiple="multiple" data-placeholder="Selecciona una o más opciones" name="12_1[]" id="12_1">

 					          <option value="1">Maestra</option>
                    <option value="2">Maestro</option>
                    <option value="4">Compañero</option>
                    <option value="8">Compañera</option>
                    <option value="16">Director(a)</option>
                    <option value="32">Trabajador de la escuela</option>
                    <option value="64">Persona desconocida de la escuela</option>
                    <option value="128">Otra persona de la escuela</option>
                    <option value="256">No especificado</option>


                  </select>
                </div>




 				       <div class="form-group forms select2-orange  col-sm-7">

                    <?php echo form_label('12.2) ¿Dónde sucedió que alguien la ha ignorado o no la ha tomado en cuenta por ser mujer? (señale las casillas necesarias)'); ?>

                  <select class="select2" multiple="multiple" data-placeholder="Selecciona una o más opciones" name="12_2[]" id="12_2">
                  	<option value="1">La escuela</option>
                    <option value="2">La calle, parque o lugar público, cerca de la escuela</option>
                    <option value="4">La calle, parque o lugar público, lejos de la escuela</option>
                    <option value="8">El transporte público</option>
                    <option value="16">Una casa particular</option>
                    <option value="32">No especificado</option>
                    <option value="64">Otro</option>
                   

                  </select>
                </div>

 			    	<div class="form-group forms select2-orange  col-sm-7">
                    <?php echo form_label('12.3) ¿Con qué frecuencia le ha ocurrido que alguien la ha ignorado o no la ha tomado en cuenta por ser mujer desde que ingresó a la escuela? (favor de marcar únicamente una casilla)'); ?>

                  <select class="select2" multiple="multiple" data-placeholder="Selecciona una o más opciones" name="12_3[]" id="12_3">
                  	<option value="1">Muchas veces</option>
                    <option value="2">Pocas veces</option>
                    <option value="4">Una vez</option>
                  
                  </select>
                </div>

                <?php echo form_hidden($input_id_pregunta);?>




<?php $input_btn_guardar_ingreso = array(
                'name' => 'btn_guardar_ingreso',
                'id' => 'btn_guardar_ingreso',
                'value' => 'Guardar',
                'type' => 'button',
                'class' => 'btn btn-block btn-success btn-flat float-right col-sm-3 '

        );?>

                
                <div >
                  	<?php echo form_submit('btn_siguiente','Siguiente', $input_btn_guardar_ingreso);?>
		              <?php echo form_close(); ?>

                </div>

				</div> 
				<!-- ESTE DIV DE ARRIBA OCULTA LO QUE HAY ARRIBA DE EL -->



                </div>
              </div> 
            </div>
          </div>
          <!-- /.card -->
           		</div>
         	</div>
        </div>
     </section>
</div>


 <script type="text/javascript">

    $(function() {
        var e = $("#1").find(':selected').attr('isred'); //BANDERA DE PESAJE 

        // window.alert(x);
        if(e == 1) {
            $(".forms").show().parent().find('#' + e).show().addClass('form-active');
        } else {
            $(".forms").hide().parent().find('#' + e).hide()
        }


    $("#1").change(function() {

        // var x = $(this).val();
        var e = $("#1").find(':selected').attr('isred'); //BANDERA DE PESAJE 

        // window.alert(x);
        if(e == 1) {
            $(".forms").show().parent().find('#' + e).show().addClass('form-active');
        } else {
            $(".forms").hide().parent().find('#' + e).hide()
        }
    });
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

});

  </script>