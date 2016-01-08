/**
 * @author Carlos Peña
 * @returns true
 */

var sUrl = 'http://' + window.location.hostname + '/ipsfa-bss';
var sUrlP = sUrl + '/index.php/BienestarSocial/';

function listarProductos(val) {
	$.getJSON(sUrlP + "listarProductosPG/" + val, function(data) {
		var cadena = '';
		var items = [];
		$(".collection-item").remove();
		$.each(data, function(key, val) {
			cadena = '<li class="collection-item avatar">' + 
			'<img src="' + sUrl +  '/public/img/productos/' + val.imag + '" alt="" class="materialboxed circle">' +
			'<span class="title">' + val.nomb + 
			'</span><p>' + val.obse + 
			'<a class="secondary-content btn-floating btn-small waves-effect waves-light blue"><i class="mdi-action-add-shopping-cart"></i></a>';		
			$(".collection").append(cadena);
		});
	}

	).done(function(msg) {
		//$("#pos").remove();
		$("#menuprincipal").focus();
	}).fail(function(jqXHR, textStatus) {
		alert(jqXHR.responseText);
	});
}
