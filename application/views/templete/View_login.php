


<?php $input_btn_guardar = array(
       'name' => 'btn_guardar',
       'id' => 'btn_guardar',
       'type' => 'submit',
       'class' => 'btn btn-block btn-primary btn-flat bg-orange'

);?>


<div class="login-box bg-orange">

<?php echo form_open('App/ajax_attempt_login', ['class' => 'std-form', 'name' => 'form', 'id' => 'form']); ?>

    <div class="login-logo">

         <a href="<?php echo base_url()?>index.php/Application"> <img src="<?php echo base_url()?>/assets/img/2.jpg" class="img-circle elevation-0" class="img-circle elevation-0" alt="User Image">Riesgo de Violencia Institucional </a>

    </div>
    <!-- /.login-logo -->
    <div class="login-box-body ">
        <p class="login-box-msg">Iniciar sesión</p>

        <div class="form-group has-feedback">
            <input name="login_string" id="login_string" class="form-control" placeholder="Ingresa Usuario" type="text">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input name="login_pass" id="login_pass" class="form-control" placeholder="Contraseña" type="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <!-- /.col -->
            <div class="col-12">
            </div>
            <!-- /.col -->
        </div>
        <input type="hidden" id="max_allowed_attempts" value="<?php echo config_item('max_allowed_attempts'); ?>" />
        <input type="hidden" id="mins_on_hold" value="<?php echo ( config_item('seconds_on_hold') / 60 ); ?>" />

        <!-- <a href="#">Olvide contraseña</a><br> -->
        <!-- <a href="register.html" class="text-center">Registrarse</a> -->
    </div>
    <?php echo form_submit('btn_guardar','Iniciar sesion', $input_btn_guardar);?>
</form>



    <!-- /.login-box-body -->
</div>
<script>
    $(document).ready(function () {
        $(document).on('submit', 'form', function (e) {
            $.ajax({
                type: 'post',
                cache: false,
                url: '<?php echo base_url()?>index.php/App/ajax_attempt_login',
                data: {
                    'login_string': $('[id="login_string"]').val(),
                    'login_pass': $('[id="login_pass"]').val(),
                    'loginToken': $('[id="token"]').val()
                },
                dataType: 'json',
                success: function (response) {
                    $('[name="loginToken"]').val(response.token);
                    console.log(response);
                    if (response.status == 1) {
                        window.location.href = '<?php echo base_url()?>index.php/Application';

                    } else if (response.status == 0 && response.on_hold) {
                        $('form').hide();
                        $('#on-hold-message').show();
                        alert('Intentos de inicio de sesión excesivos.');
                    } else {
                        alert('Login fallido', 'Login fallido ' + response.count + ' de ' + $('#max_allowed_attempts').val(), 'error');
                    }
                }
            });
            return false;
        });
    });
</script>


