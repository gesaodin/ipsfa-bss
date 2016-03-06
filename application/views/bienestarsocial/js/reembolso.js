/**
*
*
*/
var Solicitud = [];
var i = 0;





/**
* Agregando selección de productos a una lista virtual
*
* @return mixed
*/
function agregarR(){
	var Pedido = {};
	var familiar = $('#familiar').val();
	var concepto = $('#concepto').val();
	var monto = $('#monto').val();
	monto = monto.replace(/\./g,'').replace(',','.');

	if($('#monto').val() == "0,00" || concepto == "0"){				
		Materialize.toast("Debe introducir un monto o seleccionar un concepto", 3000, 'rounded');
		iniciarElementos();
	}else{
		$('#total').val(parseFloat($('#total').val()) + parseFloat(monto));
		var linea = $('#concepto option:selected').text() + '|' + monto;
		var arr = familiar.split('|');
		Pedido['codigo'] = arr[0];
		Pedido['parentesco'] = arr[1];
		Pedido['nombre'] = $('#familiar option:selected').text();
		Pedido['concepto'] = $('#concepto option:selected').text();
		Pedido['monto'] = monto;
		Solicitud[i++] = Pedido;
		$('#htotal').html('Total ' + $('#total').val() + ' Bs.');		
		cadena = '<i class="material-icons red circle tooltipped waves-effect waves-light"' + 
		' onclick="eliminarR(' + i + ')" title="Eliminar Pedido">delete</i>';
		cadena += '<span class="title">' + $('#concepto option:selected').text();
		cadena += '</sapn><p>' + $('#familiar option:selected').text() ;
		cadena += '<br>MONTO: ' + $('#monto').val() + '</p>';		
		$('#dtReembolso').append('<li class="collection-item avatar" id="' + i + '">' + cadena + '</li>');		
		iniciarElementos();
	}
}

/**
* Iniciar elementos en cero
*
* @return mixed
*/
function iniciarElementos(){
	$('#monto').val('0,00');
	$('#concepto').val("0");
	$('select').material_select();
}

/**
* Enviar un mensaje por pantalla en caso de ir atras o al adjuntar documentos
*
* @return mixed
*/
function mensaje(codigo, tipo){
	if(tipo == 0){
		if(i > 0){
			$("#msj").html('Tiene productos seleccionados, ¿Desea eliminarlos e ir atras?');
			cadena = '<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat "' +  
				'onclick="atras()">Si</a><a href="#!" class="modal-action ' + 
				'modal-close waves-effect waves-green btn-flat">No</a>';	
		}else{
			atras();
			return true;
		}		
	}else{
		$("#msj").html('¿Está seguro que sus datos son correctos?, una vez realizada la solicitud no podrá realizar cambios');
		cadena = '<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat "' +  
		'onclick="salvarR(\'' + codigo + '\')">Si</a><a href="#!" class="modal-action ' + 
		'modal-close waves-effect waves-green btn-flat">No</a>';
	}	
	$("#acciones").html(cadena);
	$('#modal1').openModal();
}

/**
* volver a la pagina anterior
*
* @return mixed
*/
function atras(){	
	$(location).attr('href', sUrlP + "bienestar/1");	
}

/**
* volver a la pagina anterior
*
* @return mixed
*/
function salvarR(codigo){
	var Reembolso = {};
	Reembolso['Solicitud'] = Solicitud;
	Reembolso['Codigo'] = codigo;

	$.post( sUrlP + "salvarReembolso/", Reembolso)
		.done(function(data) {			
			Materialize.toast(data, 3000, 'rounded');
			$(location).attr('href', sUrlP + "adjuntos/" + codigo + "/" + 1);	
		})
		.fail(function(jqXHR, textStatus) {
	    	alert(jqXHR.responseText);
	});		
}

function eliminarR(id){		
	pos = parseInt(id) - 1;	
	$('#' + id).remove();
	Solicitud.splice(id,1);
	i--;
	$('#total').val('0');
	$('#dtReembolso').html('<li class="collection-header"><h5>Datos de selección</h5></li>');
	for(j=1; j<=i; j++){	
		$('#total').val(parseFloat($('#total').val()) + parseFloat(Solicitud[j].monto));		
		cadena = '<i class="material-icons red circle tooltipped waves-effect waves-light"';
		cadena += ' onclick="eliminarR(' + j + ')" title="Eliminar Pedido">delete</i>';		
		cadena += '<span class="title">' + Solicitud[j].concepto;
		cadena += '</sapn><p>' + Solicitud[j].nombre;		
		cadena += '<br>MONTO: ' + Solicitud[j].monto + '</p>';		
		$('#dtReembolso').append('<li class="collection-item avatar" id="' + j + '">' + cadena + '</li>');		
	}
	$('#htotal').html('Total ' + $('#total').val() + ' Bs.');
	Materialize.toast('Se ha eliminado un elemento de la lista', 4000, 'rounded');	
}