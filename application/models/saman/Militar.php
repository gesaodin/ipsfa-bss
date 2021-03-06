<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * IPSFA Bienestar y Seguridad Social 
 * 
 * Militar 
 *
 *
 * @package ipsfa-bss\application\model
 * @subpackage saman
 * @author Carlos Peña
 * @copyright Derechos Reservados (c) 2015 - 2016, MamonSoft C.A.
 * @link http://www.mamonsoft.com.ve
 * @since version 1.0
 */
class Militar extends CI_Model{
	
	/**
	* @var Persona
	*/
	var $Persona;	

	/**
	* @var Persona
	*/
	var $situacion = '';


	/**
	* @var Persona
	*/
	var $codigosituacion = '';

	/**
	* @var Persona
	*/
	var $fechaIngreso = '';

	/**
	* @var Persona
	*/
	var $fechaAscenso = '';

	/**
	* @var Persona
	*/
	var $fechaPromocion = '';

	/**
	* @var Persona
	*/
	var $categoria = '';
	
	/**
	* @var Persona
	*/
	var $clase = '';

	/**
	* @var Componente
	*/
	var $Componente;


	/**
	*	Listado de Dependientes
	*	@var Dependiente
	*/
	//var $Dependientes;

	/**
	*	Listado de Dependientes
	*	@var array
	*/
	var $Solicitudes = array();

	/**
	*	Constructor de la Calse
	*
	*/


	public function __construct(){
		parent::__construct();
		$this->load->model('saman/Dbsaman', 'Dbsaman');	

		$this->load->model('saman/Persona', 'MPersona');	
		$this->load->model('saman/Dependiente', 'Dependiente');
		$this->load->model('saman/Componente', 'MComponente');
		
		$this->Persona = new  $this->MPersona();
		$this->Componente = new $this->MComponente();
		//$this->Dependientes = new $this->Dependiente();
	}


	/**
	* Consultar y Mapear un objeto (personas) de la BD SAMAN
	*
	* @access public
	* @param string
	* @return Persona
	*/
	function consultar($cedula = NULL){
		$this->Persona->consultar($cedula);	

		$this->Componente->cargar($this->Persona->oid);
		$sConsulta = 'SELECT * FROM pers_dat_militares 
			INNER JOIN ipsfa_pers_situac ON pers_dat_militares.perssituaccod=ipsfa_pers_situac.perssituaccod
			INNER JOIN ipsfa_pers_clase ON pers_dat_militares.persclasecod=ipsfa_pers_clase.persclasecod
			INNER JOIN ipsfa_pers_categ ON pers_dat_militares.perscategcod=ipsfa_pers_categ.perscategcod
			WHERE pers_dat_militares.nropersona=' . $this->Persona->oid . ' LIMIT 1';

		$arr = $this->Dbsaman->consultar($sConsulta);
		if($arr->code == 0){
			foreach ($arr->rs as $clv => $val) {		
				$this->categoria = $val->perscategnombre;
				$this->situacion = $val->perssituacnombre;
				$this->codigosituacion = $val->perssituaccod;
				$this->clase = $val->persclasenombre;
				$this->fechaIngreso = $val->fchingcomponente;
				$this->fechaAscenso = $val->fchultimoascenso;
			}
		}		
		return $arr;
	}

	/**
	* Obtener un objeto de tipo Militar
	*
	* @access public
	* @param string
	* @return Persona
	*/
	public function obtener($codigo){
		$sConsulta = 'SELECT * FROM pers_dat_militares 
		INNER JOIN ipsfa_pers_categ ON pers_dat_militares.perscategcod=ipsfa_pers_categ.perscategcod
		WHERE nropersona = \'' . $codigo . '\' LIMIT 1';
		$arr = $this->Dbsaman->consultar($sConsulta);
		if($arr->code == 0){
			foreach ($arr->rs as $clv => $val) {
				$Componente = new $this->MComponente;
				$Componente->codigo = $val->componentecod;
				$Componente->codigoRango = strtoupper($val->gradocod);

				$this->Componente = $Componente;	
				$this->codigosituacion = $val->perssituaccod;
				$this->fechaIngreso = $val->fchingcomponente;
				$this->fechaAscenso = $val->fchultimoascenso;
				$this->fechaPromocion = $val->fchpromocion;
				
			}
		}		
		return $this;
	}

}
