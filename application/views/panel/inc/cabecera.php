<!DOCTYPE html>

  <html>
    <head>
      <!--Import Google Icon Font
      

      	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">	-->					
      <link type="text/css" href="<?php echo base_url(); ?>public/css/material.css" rel="stylesheet">
      
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>public/css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
    
      body {
	    display: flex;
	    min-height: 100vh;
	    flex-direction: column;
	  }
	
	  main {
	    flex: 1 0 auto;
	  }
      

    
	  /* label underline focus color */
	  .input-field input[id="search"]:focus {
	     border-bottom: 0px solid #000;
	     box-shadow: 0 0px 0 0 #000;
	  }
	  
      	
      .btns-add{background-color:#00345A;color:#FFF;font-size:14px;text-align:center;font-weight:bold;}
	  .btns{border:1px #E1E1E1 solid;padding:3px;background:#FEFBD3;color:#56000F;}
	
	  .input-field .btn {background-color:#00345A;}
	  .input-field .btn:hover { background-color:#990000;}

	  .file-path::-webkit-input-placeholder { color: #828282;; }
	  .file-path:-moz-placeholder { color: #828282;; }
	  .file-path::-moz-placeholder { color: #828282;; }
      .file-path:-ms-input-placeholder { color: #828282;; }

      .input-field input[type=text]:focus + label {color: #00345A;} 
	  .input-field input[type=text]:focus { border-bottom: #FF0000;box-shadow: 0 1px 0 0 #00345A;}
	  .input-field input[type=select]:focus { border-bottom: #FF0000;box-shadow: 0 1px 0 0 #00345A;}
	  .input-field label {color: #828282;}
	  .input-field input[type=text] {border-bottom: 1px solid #00345A;box-shadow: 0 1px 0 0 #00345A;color:#828282;}
	  .input-field input[type=select] {border-bottom: 1px solid #00345A;box-shadow: 0 1px 0 0 #00345A;color:#828282;}

      .botones-solicitud{height:auto;width:100%;box-shadow: 0 0 13px 1px #00345A;cursor:pointer;padding:1px;}
	  .botones-solicitud:hover{height:auto;width:100%;box-shadow: 0 0 25px 1px #FFB59F;cursor:pointer;padding:1px;}
	  .email-unread .email-title {font-weight: 500;}

	  /* Rules for sizing the icon. */
	  .material-icons.md-18 { font-size: 18px; }
	  .material-icons.md-24 { font-size: 24px; }
	  .material-icons.md-36 { font-size: 36px; }
	  .material-icons.md-48 { font-size: 48px; }
	  .material-icons.md-64 { font-size: 64px; }
	  .material-icons.md-100 { font-size: 100px; }
	  .material-icons.md-128 { font-size: 128px; }
	  .material-icons.md-200 { font-size: 200px; }
	  .material-icons.md-254 { font-size: 254px; }

		/* Rules for using icons as black on a light background. */
		.material-icons.md-dark { color: rgba(0, 0, 0, 0.54); }
		.material-icons.md-dark.md-inactive { color: rgba(0, 0, 0, 0.26); }

		/* Rules for using icons as white on a dark background. */
		.material-icons.md-light { color: rgba(255, 255, 255, 1); }
		.material-icons.md-light.md-inactive { color: rgba(255, 255, 255, 0.3); }


		.button { /* clase general */
		  border: 1px solid #dedede;
		  border-radius: 3px;
		  color: #555;
		  font: 12px/12px HelveticaNeue, Arial;
		  padding: 8px 11px;
		  text-decoration: none;
		}

		.ContactoDetalle{
			font-size: 12px;
			color: #ccc;
			overflow: hidden; height: 24px;
		}
		.ContactoDetalle span{
			float: left; 
			margin-top: -1.2em;
		}
		.ContactoDetalle a{
			font-size: 11px;
			color: blue;
		}



  </style>
  
    </head>

    <body class=" grey lighten-4">
	<main>

	<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper" style="background-color:#00345A">
				<a href="#" class="brand-logo">
					
					<img src="<?php echo base_url(); ?>public/img/logo-ipsfa.png" >

				</a>
				<a href="#" data-activates="nav-mobile" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only" style="background-color:#00345A" id="menuprincipal"><i class="mdi-navigation-menu"></i></a>
				
								
				<ul id="solicitudes1" class="dropdown-content " >				  			 
				  <li><a href="<?php echo base_url(); ?>index.php/Panel/farmacia/me">
						<font class="black-text" >Medicamentos</font><i class="mdi-maps-local-hospital left red-text "></i></a>
					</li>
											
					<li class="divider"></li>				
					<li><a href="<?php echo base_url(); ?>index.php/Panel
					/solicitudes">
						<font class="black-text" >Solicitudes</font><i class="mdi-action-alarm-add left blue-text text-darken-3"></i></a>							
					</li>
					<li><a href="<?php echo base_url(); ?>index.php/Panel/citas">
					<font class="black-text" >Citas</font><i class="mdi-action-lock left blue-text text-darken-3">
					</i></a></li>				
					

				</ul>
				
				<ul id="nav-mobile" class="side-nav">
					<br>	
					<!-- <img src="<?php echo base_url(); ?>public/img/ipsfa.png" class="responsive-img"> -->
					<li><a href="<?php echo base_url(); ?>index.php/Panel/index/">Principal
					<i class="mdi-action-home left blue-text"></i></a></li>
					
					
					<li><a href="<?php echo base_url(); ?>index.php/Panel/medicamentos">
						Medicamentos<i class="mdi-maps-local-hospital left blue-text"></i></a>
					</li>
											
					<li class="divider"></li>				
					<li><a href="<?php echo base_url(); ?>index.php/Panel/solicitudes">
						Solicitudes<i class="mdi-action-alarm-add left blue-text"></i></a>							
					</li>
					<li><a href="<?php echo base_url(); ?>index.php/Panel/tratamientos">
					Citas<i class="mdi-action-lock left blue-text"></i></a></li>
					<li><a href="<?php echo base_url(); ?>index.php/Panel/salir" class="tooltipped" data-position="top" data-delay="10" data-tooltip="Cerrar Sesión">
						Salir<i class="mdi-action-settings-power left red-text"></i> </a>
					</li>
				</ul>
				
				<ul class="right hide-off-med-and-down">

					<li><a href="<?php echo base_url(); ?>index.php/BienestarSocial/salir"
					class="tooltipped hide-on-large-only" data-position="bottom" data-delay="10" data-tooltip="Salir">
						<i class="mdi-action-settings-power"></i></a>
					</li>
					
				</ul>

				<ul class="right hide-on-med-and-down">
					<li>
						<i class="right"></i><?php echo $_SESSION['nombreRango'];?>
					</li>
					
					<li><a class="dropdown-panel" 
						   data-activates="notificaciones">						
						<i class="material-icons">notifications</i>

						</a>
					</li>
					
					<li><a class="dropdown-panel" href="#!" data-activates="panelControl">
						<i class="mdi-navigation-apps"></i></a>
					</li>
					<li><a  
					class="dropdown-panel btn-medium waves-effect waves-light" 
						   data-activates="datos" >
						<i class="material-icons">account_circle</i></a>
					</li>


				</ul>

				
				
				
			</div>
		</nav>
	</div>



	

	<div id="datos" class="dropdown-content" style="width: 350px; padding-top: 15px; padding-bottom: 0px;">
		
			<div style="padding: 1em; padding-left: 0px; float: left;  margin-bottom: 10px; overflow: hidden;">
				<i class="material-icons md-100  brown-text text-lighten-4">account_circle</i>
			</div>
			<div  class="ContactoDetalle">
				<span>Teniente Coronel</span>
			</div>
			<div  class="ContactoDetalle">
				<span>Telefono: XXXX-XXXXXXX</span></div>
			
			<div class="ContactoDetalle">
			<span>Correo: a@gmail.com</span></div>
		
			<div class="ContactoDetalle" style="height: 48px">
			<span style="float: right; padding-right: 30px"><a href="#!">+ Acerca de IpsfaNet</a></span></div>
			
			<div class="grey lighten-5" style="height: 48px; border: 1px solid #CCC">
				<span style="float: right; padding: 7px; padding-top: 9px; padding-right: 20px">
				<a class="button " href="#">Salir del Sistema</a></span>
				
			</div>
		
	</div>

	<div id="notificaciones" class="dropdown-content" style="width: 350px; padding-top: 15px; padding-bottom: 0px;">

		<div class="ContactoDetalle grey lighten-5" style="height: 36px; border: 1px solid #CCC">
				<span style="float: right; padding: 5px; padding-top: 6px; padding-right: 20px">
				<a href="#">+ ver más</a></span>			
		</div>
	</div>


	<ul id="panelControl" class="dropdown-content">
		<li>
			<a>
		    	<i class="material-icons light-blue-text text-darken-4 left">account_circle</i>Actualización de Datos
		    </a>
		</li>
		<li>
	      <a>
	      	<i class="material-icons lime-text text-darken-2 left">group</i>Afiliación
	      </a>
	    </li>
	    <li>
	      <a>
	      	<i class="material-icons red-text text-lighten-1 left">local_convenience_store</i>Bienestar Social
	      </a>
	    </li>
	    <li>
	    	<a>
	      		<i class="material-icons amber-text left">credit_card</i>Crédito
	      	</a>
	    </li>
	    <li>
	      <a>
	      	<i class="material-icons md-36 green-text left">access_alarms</i>Citas Automatizadas
	      </a>
	    </li>
	    <li>
	      <a>
	      	<i class="material-icons md-36 brown-text left">local_printshop</i>Impresión de Planillas y Netos
	      </a>
	    </li>
	 </ul>