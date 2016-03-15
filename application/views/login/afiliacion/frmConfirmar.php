<?php 
$this->load->view("login/afiliacion/inc/cabecera.php");
?>


    <div class="container">
        <br>
		<div class="row center">
          <div class="col s12 m3 l3">&nbsp;</div>
          <div class="col s12 m6 l6">           
				<form action="<?php echo base_url(); ?>index.php/Login/crear" method="POST">
				 <div class="row">
			        <div class="col s12">
			          <div class="card white" >
			            <div class="card-image purple"><br><h6 class="white-text"  style="font-weight: 800">Responde las Preguntas</h6>
			              <i class="material-icons md-128 purple-text text-lighten-1" style="padding: 0px">live_help</i>		               	
			            </div>
			            <div class="card-content" style="padding: 0px">
			              <p>
	                      <div class="input-field col s12" style="padding-top: 0px">
	                        <input id="promocion" name="promocion" type="text" class="validate">
	                        <label for="promocion">Año de promoción (1830)</label>
	                      </div>
	                      <div class="input-field col s12">                        
	                        <select id="componente"  name="componente">
	                        	<option value="AV">Aviación</option>
	                        	<option value="AR">Marina</option>
	                        	<option value="EJ">Ejercito</option>
	                        	<option value="GN">Guardia Nacional</option>
	                        </select>
	                        <label>Seleccione su componente</label>
	                      </div>
	                      <div class="input-field col s12">                        
	                        <select id="apellido"  name="apellido">
	                        	<option value=2>----</option>
	                        	<option value="SI">SI</option>
	                        	<option value="NO">NO</option>
	                        </select>
	                        <label>¿SU APELLIDO ES <?php echo $apellido;?>?</label>
	                      </div>
	                      <div class="input-field col s12">                        
	                        <select id="afiliado" name="afiliado">
	                        	<option value=2>-------------</option>
	                        	<option value="SI">SI</option>
	                        	<option value="NO">NO</option>
	                        </select>
	                        <label>¿ES <?php echo $afiliado?> SU AFILIADO?</label>
	                      </div>
	                    </p>
			            </div>
			            <div class="card-action" style="text-align: right; padding: 8px">
			              <button class="btn waves-effect waves-light purple" type="submit">Continuar</button>
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