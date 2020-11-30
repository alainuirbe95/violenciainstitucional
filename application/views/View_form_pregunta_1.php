<?php date_default_timezone_set("America/Phoenix"); ?>
<!-- <?php echo 'Numero de control: '.$no_control_entrevistado; ?> -->


<?php $input_id_pregunta = array( 
                'id_pregunta' => 1
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
              <div class="col-7 col-sm-12">
                <div class="tab-content" id="vert-tabs-right-tabContent">
                  <div class="tab-pane fade show active" id="vert-tabs-right-home" role="tabpanel" aria-labelledby="vert-tabs-right-home-tab">
					         <h4 class="mt-4">Pregunta 1 </h4>
                     Durante su vida como estudiante, ¿alguna persona de las escuelas a las que asistió a estudiar, (sea maestra o maestro, director, prefecto, compañero de clases o alumno de la escuela, trabajador o persona de la escuela) la han pateado o golpeado con el puño?

		 			            <?php echo form_open('');?>

		                  <div class="form-group">
		                    <?php echo form_label('Selecciona una respuesa: '); ?>

		                     <select onchange="this.options[this.selectedIndex].getAttribute('isred');" name="1" id="1" class="form-control col-sm-7 ">
		                    <option isred="0" value="0">  No </option>		    

		                    <option isred="1" value="1">  Si </option>

		                    </select>
		                  </div>






 				             <div class="form-group forms select2-orange col-sm-7 ">
                     <?php echo form_label('1.1) ¿Qué personas de la siguiente lista la han pateado o golpeado con un puño?'); ?>

                      <select class="select2 " multiple="multiple" data-placeholder="Selecciona una o más opciones" name="1_1[]" id="1_1">

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




 				             <div class="form-group forms select2-orange col-sm-7">
                    <?php echo form_label('1.2)¿Dónde sucedió que alguien la haya pateado o golpeado con un puño?'); ?>

                  <select class="select2 " multiple="multiple" data-placeholder="Selecciona una o más opciones" name="1_2[]" id="1_2">
                  	<option value="1">La escuela</option>
                    <option value="2">La calle, parque o lugar público, cerca de la escuela</option>
                    <option value="4">La calle, parque o lugar público, lejos de la escuela</option>
                    <option value="8">El transporte público</option>
                    <option value="16">Una casa particular</option>
                    <option value="32">No especificado</option>
                    <option value="64">Otro</option>
                   

                  </select>
                </div>

 				           <div class="form-group forms select2-orange col-sm-7">
                    <?php echo form_label('1.3)¿Con qué frecuencia le ha ocurrido que alguien la haya pateado o golpeado con un puño desde que ingresó a la escuela?'); ?>

                  <select class="select2 " multiple="multiple" data-placeholder="Selecciona una o más opciones" name="1_3[]" id="1_3">
                  	<option value="1">Muchas veces</option>
                    <option value="2">Pocas veces</option>
                    <option value="4">Una vez</option>
                  
                  </select>
                </div>

                <?php echo form_hidden($input_id_pregunta);?>




<?php 
// $input_btn_guardar_ingreso = array(
//                 'name' => 'btn_siguiente',
//                 'id' => 'vert-tabs-right-profile-tab',
//                 // 'value' => 'Guardar',
//                 'type' => 'button',
//                 'class' => 'btn  btn-success btn-flat float-right col-sm-3',
//                 'data-toggle' => 'pill',
//                 'href' => '#vert-tabs-right-profile',
//                 'role' => 'tab',
//                 'aria-controls' => 'vert-tabs-right-profile',
//                 'aria-selected' => 'false',


//         );
        ?>

<?php $input_btn_guardar_ingreso = array(
                'name' => 'btn_guardar_ingreso',
                'id' => 'btn_guardar_ingreso',
                'value' => 'Guardar',
                'type' => 'button',
                'class' => 'btn btn-block btn-success btn-flat float-right col-sm-3 ',

        );?>

                
                <div >
<!--                   <a class="nav-link float-right col-sm-3" id="vert-tabs-right-profile-tab" data-toggle="pill" href="#vert-tabs-right-profile" role="tab" aria-controls="vert-tabs-right-profile" aria-selected="false">
                    <button type="button" class="btn btn-block btn-success btn-flat">Success</button></a> -->

                  	<?php echo form_submit('btn_siguiente','Siguiente', $input_btn_guardar_ingreso);?>
		              <?php echo form_close(); ?> 

                </div>

				</div> 
				<!-- ESTE DIV DE ARRIBA OCULTA LO QUE HAY ARRIBA DE EL -->

<!--                   <div class="tab-pane fade" id="vert-tabs-right-profile" role="tabpanel" aria-labelledby="vert-tabs-right-profile-tab">
                     Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam. 

                
                <div >
                  <a class="nav-link active" id="vert-tabs-right-home-tab" data-toggle="pill" href="#vert-tabs-right-home" role="tab" aria-controls="vert-tabs-right-home" aria-selected="true">
                    <button type="button" class="btn btn-block btn-success btn-flat">Anterior</button></a>

  
                </div>
                  </div>
 -->

<!--                   <div class="tab-pane fade" id="vert-tabs-right-messages" role="tabpanel" aria-labelledby="vert-tabs-right-messages-tab">
                     Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna. 
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-right-settings" role="tabpanel" aria-labelledby="vert-tabs-right-settings-tab">
                     Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis. 
                  </div> -->
                </div>
              </div>


<!--               <div class="col-5 col-sm-3">
                <div class="nav flex-column nav-tabs nav-tabs-right h-100" id="vert-tabs-right-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="vert-tabs-right-home-tab" data-toggle="pill" href="#vert-tabs-right-home" role="tab" aria-controls="vert-tabs-right-home" aria-selected="true">Pregunta 1</a>
                  
                  <a class="nav-link" id="vert-tabs-right-profile-tab" data-toggle="pill" href="#vert-tabs-right-profile" role="tab" aria-controls="vert-tabs-right-profile" aria-selected="false">Profile</a>


                  <a class="nav-link" id="vert-tabs-right-messages-tab" data-toggle="pill" href="#vert-tabs-right-messages" role="tab" aria-controls="vert-tabs-right-messages" aria-selected="false">Messages</a>
                  <a class="nav-link" id="vert-tabs-right-settings-tab" data-toggle="pill" href="#vert-tabs-right-settings" role="tab" aria-controls="vert-tabs-right-settings" aria-selected="false">Settings</a>
                </div>
              </div> -->
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