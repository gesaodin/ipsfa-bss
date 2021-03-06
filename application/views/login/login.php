<!DOCTYPE html>

  <html>
  <title>Ipsfa en linea</title>
    <head>			
      <link type="text/css" href="<?php echo base_url(); ?>public/css/material.css" rel="stylesheet" />
      <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>public/css/materialize.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>public/css/afiliado/estilo.css"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body class="white lighten-4">
		<main>			
			<div class="container">
				<div class="row center">
		          <div class="col s12 m3 l3">&nbsp;</div>
		          <div class="col s12 m6 l6">
		            <h4 class="bold">Ipsfa en Linea</h4>
						
						<form action="<?php echo base_url(); ?>index.php/Login/validarUsuario" method="POST">
						 <div class="row">
					        <div class="col s12">
					          <div class="card white">
					            <div class="card-image blue-ipsfa"><br><h6 class="white-text" style="font-weight: 800">Bienvenido al Panel</h6>
					              <center>
					              	<img src="<?php echo base_url(); ?>public/img/logo-central-I.png" style="width:150px;">
					              </center>
					            </div>
					            <div class="card-content" style="padding: 0px">	              		
			                      <div class="input-field col s12">
			                        <input id="usuario" name="usuario" type="text" class="validate" required>
			                        <label for="usuario">Usuario</label>
			                      </div>
			                      <div class="input-field col s12">                        
			                        <input id="clave" name="clave" type="password" class="validate" required>
			                        <label for="clave">Clave</label>
			                      </div>
			                      <div class="input-field col s12"> 
			                       <!-- <div class="g-recaptcha" data-sitekey="6LcwWR0TAAAAANJJMXvw84XKe0L1ttZipoG43n1i"></div>	-->		 
			                      </div>                  
					            </div>
					           
					            <div class="card-action" style="text-align: right; padding: 8px">
					              <button class="btn waves-effect waves-light blue-ipsfa" type="submit" onclick="validarUsuario()">Entrar</button>
					            </div>
					          </div>
					        </div>
					      </div>
						</form>
						<a href="<?php echo base_url(); ?>index.php/Login/recuperar">¿Olvido su contraseña?</a>
			  			
		          </div>
		          <div class="col s12 m3 l3">&nbsp;</div>
		        </div>   									
			</div>
		</main>
		<?php 
			$this->load->view("js/rutas.js.php");
		?>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/login/js/login.js"></script>	
	</body>
</html>