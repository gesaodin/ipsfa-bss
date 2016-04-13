<?php
$this->load->view ( "bienestarsocial/inc/cabecera.php" );

?>
<script type="text/javascript"
	src="<?php echo base_url(); ?>application/views/bienestarsocial/js/farmacia.js"></script>

<br>
<div class="container">

  <div class="row">
  <div class="col s12 card-panel blue lighten-2">
    
        <ol><li><b>Recuerde que debe adjuntar el recipe médico</b></li></ol>
      
  </div>
  </div>

  <ul class="collection with-header" id='producto'>
   <li class="collection-header"><h5>Médicamentos Seleccionados</h5></li>
    <?php
    
    foreach ($data as $key => $val) {
      

      $cadena = '<li class="collection-item avatar" id="' . $val['rowid'] . '">' .
        '<span class="title truncate">' . $val['name'] . 
        '</span><p class="truncate"> Cantidad: ' . $val['qty'] . ' <br> Prioridad: ' . prioridad($val['prioridad']) .
        '<a href="javascript:Eliminar(\'' . $val['rowid'] .  '\');" class="secondary-content">
        <i class="material-icons right red-text">cancel</i></a>';   
        echo $cadena;
    }
    
    function prioridad($val){
      switch ($val) {
        case 0:
          return 'Baja';
          break;
        case 1:
          return 'Media';
          break;
        case 2:
          return 'Alta';
          break;
        default:
          return 'Baja';
          break;
      }
    }
  ?>

</ul>
<br>


  <h5>Recipe Medico</h5>
  <form class="col s12" enctype="multipart/form-data" id="frmCorreo" method="post">
      <div class="row white">

        <div class="col s12 m6 l4 white" >        
          <div style="width: 120px;height: 120px; margin:0px " id="view-1" >
            <img style="width: 120px;height: 120px; margin-left: 0px" class="file-path-wrapper-pre-view" id="pre-view-1" />
          </div>
          <!-- -->
          <div class="file-field input-field col file-field-input-field" >
              <div class="file-path-wrapper file-path-wrapper-sopor">
                <input class="file-path validate" type="text"  placeholder="Recipe Médico">
              </div>
                    
              <div class="btn btns-rd-c">
                <input type="file" name='recipe' id="inputFile[1]"  accept="image/gif, image/jpeg, image/png" onchange="readURL(this, 1, 'img');">
                <i class="material-icons">file_upload </i>
              </div>
            </div>
        </div>  
      </div>
         
          
      <div class="row" style="display: none">
        <div class="input-field col s12">
          <i class="material-icons prefix">mode_edit</i>
          <textarea id="Observa" class="materialize-textarea" length="256"></textarea>
          <label for="Observa">Observaciones</label>
        </div>
      </div> 
      
    </form>
    <div class="row">
        <div class="col s12">
          <button class="btn-large medium waves-effect waves-light "  style="background-color:#00345A" onclick="Salvar()">Solicitar
            <i class="material-icons right">send</i>
          </button>
        </div>
      </div>
</div>


<?php
$this->load->view ( "bienestarsocial/inc/pie.php" );
?>
