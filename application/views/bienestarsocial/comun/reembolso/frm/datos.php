<script type="text/javascript"
     src="<?php echo base_url(); ?>application/views/bienestarsocial/js/reembolso.js"></script>
<div class="row">
	 <div class="input-field col s12 m4 l5">
          <select id="familiar">
          	<?php 
          		$cadena = '<option value="' . $Militar->Persona->oid . '|TITULAR">' .  $Militar->Persona->nombreApellidoCompleto() . '</option>';
          		echo $cadena;

          		foreach ($Militar->Persona->Familiares as $key => $val) {
          			$cadena = '<option value="' . $val->oid . '|' . $val->parentesco . '">' .  
                                   $val->nombreApellidoCompleto() . '(' . $val->parentesco . ')</option>';
          			echo $cadena;
          		}
          	?>
          </select>
          <label for="familiar">Nombre del Familiar</label>
     </div>
	 <div class="input-field col s12 m4 l4">
          <select id="concepto">
          	<option value="0">------------------------</option>
          	<?php 
          		
          		foreach ($Concepto as $key => $val) {
          			$cadena = '<option value="' . $val->codigo . '">' .  strtoupper($val->nombre) . '</option>';
          			echo $cadena;
          		}

          	?>
          </select>
          <label for="concepto">Seleccione un concepto</label>
     </div>
     <div class="input-field col s9 m2 l2">
            <input id="monto" type="text" class="validate" value="" placeholder="Introduzca un Monto">

          <label for="monto">Monto Solicitado</label>
     </div>

     <div class="input-field col s3 m2 l1">
           <a class="btn-floating tooltipped waves-effect waves-light green" 
           data-position="top" data-delay="10" data-tooltip="Agregar Pedido" onclick="agregarR()"><i class="material-icons">add</i></a>
     </div>
</div>