<?php 
$this->load->view("login/afiliacion/inc/cabecera.php");
?>


    <div class="container">
        <br>
		<div class="row center">
          <div class="col s12 m3 l3">&nbsp;</div>
          <div class="col s12 m6 l6">            
				<form action="<?php echo base_url(); ?>index.php/Login/confirmar" method="POST">
				 <div class="row">
			        <div class="col s12">
			          <div class="card white">
			            <div class="card-image blue-ipsfa"><br><h6 class="white-text" style="font-weight: 800">Ayudanos a indentificarte</h6>
			              <center>
					              	<img src="<?php echo base_url(); ?>public/img/logo-central-I.png" style="width:150px;">
					              </center>
			            </div>
			            <div class="card-content" style="padding: 0px">	              		
	                      <div class="input-field col s12">
	                        <input id="cedula" name="cedula" type="text" class="validate" required>
	                        <label for="cedula">Cédula de Identidad</label>
	                      </div>
	                      <div class="input-field col s12">                        
	                        <input id="fecha" name="fecha" type="date" class="datepicker blue-ipsfa" required>
	                        <label for="fecha">Fecha de Nacimiento</label>
	                      </div>
	                    
			            </div>
			            <div class="card-action" style="text-align: right; padding: 8px">
			              <button class="btn waves-effect waves-light blue-ipsfa" type="submit">Continuar</button>
			            </div>
			          </div>
			        </div>
			      </div>
				</form>
          </div>
          <div class="col s12 m3 l3">&nbsp;</div>
        </div>            
<?php 
$this->load->view("login/afiliacion/inc/pie.php");
?>