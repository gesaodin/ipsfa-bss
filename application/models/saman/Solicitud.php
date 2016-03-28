<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * IPSFA Bienestar y Seguridad Social
 * 
 * Solicitud
 * 
 *
 * @package ipsfa-bss\application\model
 * @subpackage saman
 * @author Carlos Peña
 * @copyright Derechos Reservados (c) 2015 - 2016, MamonSoft C.A.
 * @link http://www.mamonsoft.com.ve
 * @since version 1.0
 */
class Solicitud extends CI_Model{

	/**
	* Iniciando la clase, Cargando Elementos BD SAMAN
	*
	* @access public
	* @return void
	*/
	function __construct() {
    	parent::__construct();
    	$this->load->model("comun/Dbipsfa");
  	}
	

  	/**
  	* Crear Solicitudes
  	* Esquema 
  	*	$arr = array(
	*		'codigo' => '',
	*		'numero' => '', 
	*		'certi' => '', 
	*		'detalle' => '', //Esquema Json Opcional
	*		'recipes' => '', //Esquema Json Opcional
	*		'fecha' => '', 
	*		'tipo' => '', 
	*		'estatus' => ''
	*	);
  	* @param array 
  	*/
	function crear($arr = array()){		
		$sConsulta = "INSERT INTO solicitud (codigo, numero, certi, detalle, recipes, fecha, tipo, estatus, fcita) 
		VALUES ('" . $arr['codigo'] . "', '" . $arr['numero'] . "', '" . $arr['certi'] . "', '" . 
		$arr['detalle'] . "','" . $arr['recipes'] . "', now(), '" . $arr['tipo'] . "', '" . 
		$arr['estatus'] . "', '" . $arr['fcita'] . "' )";

		$obj = $this->Dbipsfa->consultar($sConsulta);
		return $obj;
	}

	function listarMedicamentos($codigo = ''){
		$sConsulta = "SELECT * FROM solicitud WHERE tipo=3 AND estatus=1 AND codigo= '" . $codigo . "'";
		$obj = $this->Dbipsfa->consultar($sConsulta);
		return $obj;
	}

	function exportarSAMAN(){

	}


	function importarSolicitudesSaman(Militar $Militar){
		$this->load->model('saman/Dbsaman');		
		$sConsulta = 'SELECT * FROM ci_reembolso_solic 
		INNER JOIN ci_reembolso_tipo ON ci_reembolso_solic.reembtipocod=ci_reembolso_tipo.reembtipocod
		INNER JOIN canal_liquidacion ON ci_reembolso_solic.canalliquidcod=canal_liquidacion.canalliquidcod
		WHERE nropersonaafilmil = ' . $Militar->Persona->oid . ' ORDER BY reembfchsolicitud DESC';
		$obj = $this->Dbsaman->consultar($sConsulta);		
		if($obj->code == 0){
			foreach ($obj->rs as $key => $val) {
				$Militar->Solicitudes[] = array(
					'solicitud' => (object)array(
						'codigo' => $val->reembsolicnro, 
						'tipo' => $val->reembtiponombre,
						'montoSolicitado' => $val->ordenpagomonto,
						'montoAprobado' => $val->reembconcmontoapr,
						'fechaSolicitado' => $val->reembfchsolicitud,
						'fechaAprobado' => $val->reembfchaprobacion,
						'canalLiquidacion' => $val->canalliquidnombre,
						'detalle' => $this->importarDetalleSolicitudSaman($val->reembsolicnro, $Militar->Persona)->detalleSolicitud
					)
					
				);
			}
		}
		$obj->Militar = $Militar;
		return $obj;
	}

	function importarDetalleSolicitudSaman($codigo, Persona $Persona){
		$this->load->model('saman/Dbsaman');
		$detalleSolicitud = array();

		$sConsulta = 'SELECT * FROM ci_reembolso_det 
			INNER JOIN ci_reembolso_det_clase ON ci_reembolso_det.reembclasecod=ci_reembolso_det_clase.reembclasecod
			INNER JOIN ci_reembolso_concep ON ci_reembolso_det.reembconccod=ci_reembolso_concep.reembconccod
			INNER JOIN personas ON ci_reembolso_det.nropersafilfam=personas.nropersona
		WHERE ci_reembolso_det.reembsolicnro = ' . $codigo;
		$obj = $this->Dbsaman->consultar($sConsulta);
		if($obj->code == 0){
			foreach ($obj->rs as $key => $val) {				
				$parentesco = $this->validarTitular($val->nropersafilfam, $Persona, $this->Dbsaman);				
				$detalleSolicitud[] = (object)array(
					'codigoConcepto' => $val->reembconccod,
					'concepto' => $val->reembconcnombre,					
					'nombre' => $parentesco->Dependiente->Persona->nombreApellidoCompleto(),										
					'parentesco' => $parentesco->Dependiente->parentesco,
					'monto' => $val->reembconcmonto,
					'porcentaje' => $val->reembconcporc,
					'dependiente' => $parentesco->Dependiente		
				);
			}
		}
		$obj->detalleSolicitud = $detalleSolicitud;
		return $obj;
	}

	/**
	* @var string
	* @var Persona
	* @var DbSaman
	* @return Dependiente
	*/
	function validarTitular($oid, Persona $Persona, Dbsaman $Dbsaman){
		$this->load->model('saman/Dependiente', 'Dependiente');
		
		$obj = $Dbsaman;
		if($oid == $Persona->oid){
			$this->Dependiente->Persona = $Persona;
			$this->Dependiente->parentesco = 'TITULAR';
		}else {
			$this->Dependiente->consultar($oid, $Persona);
		}		
		$obj->Dependiente = $this->Dependiente;		
		return $obj;
	}

	/**
	* Listar Solicitudes por Cedula
	*
	*/
	function listarPorCodigo($codigo){
		$sConsulta = 'SELECT * FROM solicitud WHERE codigo=\'' . $codigo . '\' AND estatus=0';
		$obj = $this->Dbipsfa->consultar($sConsulta);
		return $obj;
	}

	function listarSolicitudes($numero){
		$sConsulta = 'SELECT * FROM solicitud WHERE numero=\'' . $numero . '\' AND estatus=0';
		$obj = $this->Dbipsfa->consultar($sConsulta);
		
		return $obj;
	}

	function listarTodo(){
		$sConsulta = 'SELECT * FROM solicitud';
		$obj = $this->Dbipsfa->consultar($sConsulta);
		return $obj;
	}

	function salir(){
		$sConsulta = 'SELECT * FROM solicitud';
		$obj = $this->Dbipsfa->consultar($sConsulta);
		return $obj;
	}

	function quitar($codigo){		
		$sConsulta = 'DELETE * FROM solicitud WHERE codigo =\'' . $codigo . '\'';
		$obj = $this->Dbipsfa->consultar($sConsulta);
		return $obj;
	}

	function imprimirHoja($cedula){		
		return true;
	}

	function generarCitaTratamientoProlongado(){
		$fecha = $this->seleccionarUltimoDia();
		if($this->contarCitas($fecha) >= 50 ){
			$fecha = $this->sumarDias($fecha);
		}
		return $fecha;
	}
	


	function seleccionarUltimoDia(){
		$sConsulta = 'SELECT * FROM solicitud WHERE tipo = 4 ORDER BY fcita DESC LIMIT 1;';
		$obj = $this->Dbipsfa->consultar($sConsulta);
		if($obj->code != 0){
			$fecha = $obj->rs[0]->fcita;	
		}else{
			$fecha = date('Y-m-j');
		}
		
		return substr($fecha, 0, 10);
	}

	function contarCitas($fecha){
		$sConsulta = 'SELECT count(codigo) AS cantidad FROM solicitud WHERE fcita > \'' . $fecha . '\'::DATE;';
		$obj = $this->Dbipsfa->consultar($sConsulta);
		return $obj->rs[0]->cantidad;
	}

	function sumarDias($fecha){		
		$nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
		$nuevafecha = date ( 'Y-m-j' , $nuevafecha );		 
		return $nuevafecha;
	}
}