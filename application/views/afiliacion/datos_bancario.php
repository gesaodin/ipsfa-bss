<?php 
$this->load->view("afiliacion/inc/cabecera.php");
?>
<script type="text/javascript"
  src="<?php echo base_url(); ?>application/views/afiliacion/js/datos.js"></script>
<br><br>
<div class="container .hide-on-small-only">

  
 <div class="row">
	 

      <h5>Datos Bancarios</h5>
      <li class="divider"></li>
     <div class="row">
      <div class="input-field col s12 m6 l6">
          <input  disabled  id="banco" type="text" class="validate" value="<?php echo $Militar->Persona->banco?>">
          <label for="canco">Banco</label>
        </div>
        
        <div class="input-field col s6 m6 l6">
          <input  disabled id="cuenta" type="text" class="validate" value="<?php echo $Militar->Persona->cuenta?>">
          <label for="cuenta">Cuenta Bancaria</label>
        </div>

        <div class="input-field col s6">
          <input  disabled  id="cuenta" type="text" class="validate" value="<?php echo $Militar->Persona->obtenerTipoCuenta()?>">
          <label for=" disabled">Tipo de Cuenta</label>
        </div>
        
     </div>      
      <div class="row">
        <h5>Notas: </h5><div class="divider"></div>
              
        <div class="row">
          <div class="col s12 card-panel blue lighten-2">
            <p style="text-align: justify;">
              <ol>
                <li>En caso de que
                detecte algún dato errado y no pueda ser actualizado, favor dirigirse a la Gerencia de Afiliación del 
                IPSFA en cualquiera de sus sucursales.</li>
                <li>
                  Si sus datos son correctos presione actualizar.
                </li>
              </ol>        
            </p>    
          </div>
          </div>    
        </div>

      <br><br>      
      <div class="row">
        <div class="col s6" >
        <a  class="btn-large waves-effect waves-light" style="background-color:#00345A"   href="#" >Actualizar
            <i class="material-icons left">swap_vertical_circle</i>
        </a>
        </div>

        <div class="col s6" >
        <a class="btn-large waves-effect waves-light" style="background-color:#00345A" 
        href="<?php echo base_url(); ?>index.php/Panel/index">Ir al Inicio
            <i class="material-icons left">home</i>
        </a>
        </div>
      </div>         
    </form>
</div>




  <!-- Modal Structure -->
  <div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>Notificar!!!</h4>
     


     <form class="col s12" id="reportar" method="post" name="reportar">
       <div class="row">
         <div class="col s12">
          <p style="text-align: justify;">
            Bienvenidos al sistema de reportes.<br>
            ¿Los datos presentados en el anterior formulario son correctos?
          </p>    
         </div>
       </div>
      
       <div class="section" style="display: none">
          <h5>Datos Personales</h5>
          <div class="divider"></div>
          <br>
           <div class="row">
              <div class="col s12 m4">
                <input type="checkbox" id="chNombre" />
                <label for="chNombre" >Nombre y Apellido</label>
              </div>

              <div class="col s12 m4">
                <input type="checkbox" id="chSexo" />
                <label for="chSexo">Sexo o Genero</label>
              </div>

              <div class="col s12 m4">
                <input type="checkbox" id="chFecha" />
                <label for="chFecha">Fecha de Nacimiento</label>
              </div>
           </div>

           <br>
           <h5>Datos Militares</h5>
           <div class="divider"></div>
           <br>
           <div class="row">
              <div class="col s12 m4">
                <input type="checkbox" id="chComponente" />
                <label for="chComponente">Componente</label>
              </div>
              <div class="col s12 m4">
                <input type="checkbox" id="chRango" />
                <label for="chRango">Rango Militar</label>
              </div>

           </div>

          <br>
           <h5>Datos Bancarios</h5>
           <div class="divider"></div>
           <br>
           <div class="row">
              <div class="col s12 m4">
                <input type="checkbox" id="chBanco" />
                <label for="chBanco">Cuenta Bancario</label>
              </div>

           </div>
          <br>

           
      </div>
    </form>
    </div>
    <div class="modal-footer">
      <a class="modal-action modal-close waves-effect waves-blue btn-flat" onclick="Salvar()">NO</a>  
      <a href="#!" class="modal-action modal-close waves-effect waves-blue btn-flat">SI</a>
    </div>
  </div>
    
      


<?php 
$this->load->view("afiliacion/inc/pie.php");
?>