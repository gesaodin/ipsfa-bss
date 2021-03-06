/**
* Mensaje en el caso de que un concepto exceda su limite
*
* @return mixed
*/
var familiar = '';
var motivo = 0;
var sucursal = 0;

function msjSucursal(){
	msj = '';
	cargarCampos();
	if(familiar !='' && motivo != '' && sucursal != ''){
		msj = '¿Está seguro que seleccionó la sucursal adecuada? Si es correcta presione continuar. ';
		acciones = '<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat" onclick="ruta()">' +
	      	'Continuar<i class="material-icons left green-text">check_circle</i></a>' +
	      	'<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">' +
	      	'Cancelar<i class="material-icons left red-text">cancel</i>' +
		  	'</a>';
		
	}else{
		msj = 'Verifique los campos indicados con (*) ya que estos son obligatorios para poder continuar';
		acciones = '<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">ACEPTAR<i class="material-icons left red-text">cancel</i>' +
		  	'</a>';
	}

	$("#msj").html(msj);
	$("#acciones").html(acciones);
	$('#modal1').openModal();
	

	return true;
}

function cargarCampos(){
	familiar = $("#familiar option:selected").val();
	motivo = $("#motivo option:selected").val();
	sucursal = $("#sucursal option:selected").val();
}



function anterior(){
	bPreguntar = false;
	$(location).attr('href', sUrlP + "renovacionCarnet");	
}

function continuar(id){
	$('ul.tabs').tabs('select_tab', id);
}

function guardar(){
	
	var inputFileImage = document.getElementById("inputFile[1]");
	var file = inputFileImage.files[0];	
	if(file == undefined) {
		msjSinFoto();
	}else{
		if(file.size < 1000000) {		
			var data = new FormData();
			data.append('file',file);
			data.append('oid', $("#oid").val());		
			
			$.ajax({
				url:sUrlP + "actualizarFoto/",
				type:'POST',
				contentType:false,
				data:data,
				processData:false,
				cache : false,
				success : function(res){	           
		               	Materialize.toast(res, 3000);             
		            },
		        error: function(e){
		        	Materialize.toast(e, 5000);
		        }
			});		
		}else{
			Materialize.toast('No se puede subir un archivo mayor a 1 MB', 3000);
		}
		salvarDireccion();	
		msjRenovacion();
	}
	
	//salvarDatosMedicos();
}



function msjSinFoto(){
	msj = 'No ha actualizado la foto si desea hacerlo pulse cancelar; sin embargo en caso que desee seguir con la foto actual pulse continuar.<br><br>';
	acciones = '<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat" onclick="guardarSinFoto()">' +
      	'Continuar<i class="material-icons left green-text">check_circle</i></a>' +
      	'<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">' +
      	'Cancelar<i class="material-icons left red-text">cancel</i>' +
	  	'</a>';
	$("#msj").html(msj);
	$("#acciones").html(acciones);
	$('#modal1').openModal();
	return true;
}

function guardarSinFoto(){
	salvarDireccion();
	msjRenovacion();
}

/**
* Mensaje de Renovación
*
* @access public
* @return mixed
*/
function msjRenovacion(){
	msj = 'Para la sustitución del carnet deberá efectuar su déposito en nuestras cuentas bancarias.<br><br>';
	acciones = '<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat" onclick="irConfirmarPago()">' +
      	'Confirmar Pagos<i class="material-icons left green-text">check_circle</i></a>' +
      	'<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">' +
      	'Cancelar<i class="material-icons left red-text">cancel</i>' +
	  	'</a>';
	$("#msj").html(msj);
	$("#acciones").html(acciones);

	return true;
}

function msjguardarConFoto(){

}
/**
* Validar Campos Existentes para salvar
*
* @access public
* @return mixed
*/
function validarCampos(){
	var valores = false;
	var sangre = $('#sangre').val();
	var expediente = $('#expediente').val();
	var organo = $('#organo').val();
	var alergia = $('#alergia').val();
	var enfermedad = $('#enfermedad').val();

	return valores;
}



/**
* Enrutar a segmentos de la pagina
*
* @access public
* @return mixed
*/
function ruta(){
	bPreguntar = false;
	$(location).attr('href', sUrlP + "adjuntar/" + familiar + "/" + motivo + "/" + sucursal);	
}

/**
* Enrutar a segmentos de la pagina Confirmar
*
* @access public
* @return mixed
*/
function irConfirmarPago(){
	bPreguntar = false;
	var id = $('#oid').val();
	$(location).attr('href', sUrlP + "confirmarPago/" + id);	
}



/**
* Salvar detalles de medicos y datos fisionomicos
*
* @access public
* @return mixed
*/
function salvarDatosMedicos(){
	var Datos = {};
	var Medicos = {};
	var Fisionomicos = {};

	Medicos['sangre'] = $('#sangre').val();
	Medicos['expediente'] = $('#expediente').val();
	Medicos['organo'] = $('#organo').val();
	Medicos['alergia'] = $('#alergia').val();
	Medicos['enfermedad'] = $('#enfermedad').val();

	Fisionomicos['piel'] = $('#piel').val();
	Fisionomicos['cabello'] = $('#cabello').val();
	Fisionomicos['ojos'] = $('#ojos').val();
	Fisionomicos['estatura'] = $('#estatura').val();
	Datos['oid'] =  $('#oid').val();
	Datos['Medicos'] = Medicos;
	Datos['Fisionomicos'] = Fisionomicos;
	$.post( sUrlP + "salvarDatosMedicos/", Datos)
			.done(function(data) {			
				Materialize.toast('Datos Fisionómicos y Medicos Guardados', 3000);
				
			})
			.fail(function(jqXHR, textStatus) {
		    	alert(jqXHR.responseText);
		});		
}


/**
* Confirmar Pago de Carnet's
*
* @access public
* @return mixed
*/
function confirmarPago(){
	var inputFileImage = document.getElementById("inputFile[1]");
	var file = inputFileImage.files[0];
	if(file == undefined ) {
		Materialize.toast('Debe adjuntar el imagen del voucher', 3000);
	}else{
		if(file.size < 1000000) {		
			var data = new FormData();
			data.append('file',file);
			data.append('oid', $("#oid").val());
			
			$.ajax({
				url:sUrlP + "actualizarFoto/",
				type:'POST',
				contentType:false,
				data:data,
				processData:false,
				cache : false,
				success : function(res){	           
		               	Materialize.toast(res, 3000);             
		            } 
			});		
		}else{
			Materialize.toast('No se puede subir un archivo mayor a 1 MB', 3000);
		}	
	}

}
