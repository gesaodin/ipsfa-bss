<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * IPSFA Bienestar y Seguridad Social 
 * 
 * Persona 
 *
 *
 * @package ipsfa-bss\application\model
 * @subpackage saman
 * @author Carlos Peña
 * @copyright Derechos Reservados (c) 2015 - 2016, MamonSoft C.A.
 * @link http://www.mamonsoft.com.ve
 * @since version 1.0
 */
class Persona extends CI_Model{

	/**
	* @var string
	*/
	var $oid = '';
	
	/**
	* @var string
	*/
	var $cedula = '';

	/**
	* @var string
	*/
	var $nacionalidad = "";

	/**
	* @var string
	*/
	var $sexo = '';

	/**
	* @var string
	*/
	var $primerNombre = "";
	
	/**
	* @var string
	*/
	var $segundoNombre = "";
	
	/**
	* @var string
	*/
	var $segundoApellido = "";

	/**
	* @var string
	*/
	var $primerApellido = "";

	/**
	* AAAA/MM/DD
	*
	* @var string
	*/
	var $fechaNacimiento = "";

	/**
	* @var string
	*/
	var $correoElectronico = '';

	/**
	* @var string
	*/
	var $estadoCivil = '';

	/**
	* @var string
	*/	
	var $codigoDireccion = '';

	/**
	* @var string
	*/
	var $direccion = '';

	/**
	* @var string
	*/
	var $banco = '';

	/**
	* @var string
	*/
	var $cuenta = '';

	/**
	* @var string
	*/
	var $tipoCuenta = '';

	/**
	* @var Telefono
	*/
	var $Telefonos = array();

	/**
	* @var Denpendiente
	*/
	var $Familiares = array();

	/**
	* Iniciando la clase, Cargando Elementos BD SAMAN
	*
	* @access public
	* @return void
	*/
	function __construct(){
		parent::__construct();
		$this->load->model('saman/Dbsaman', 'Dbsaman');

	}

	/**
	* Permite Mapear un objeto (personas) 
	* 
	* @access public
	* @param string
	* @return Persona
	*/
	function mapear($cedula = NULL){
		return TRUE;
	}

	/**
	* Consultar Persona 
	* 
	* @access protected
	* @param string
	* @param string
	* @return object
	*/
	function consultar($cedula, $codigo = null){
		$obj = $this->Dbsaman->consultar($this->generarSelectPersonas($cedula,$codigo));
		if($obj->code == 0){
			foreach ($obj->rs as $clv => $val) {
				$this->oid = $val->nropersona;
				$this->nacionalidad = $val->tipnip;
				$this->cedula = $val->codnip;				
				$this->sexo = $val->sexocod;
				$this->estadoCivil = $val->edocivilnombre;
				$this->primerNombre = $val->nombreprimero;
				$this->segundoNombre = $val->nombresegundo;
				$this->primerApellido = $val->apellidoprimero;
				$this->segundoApellido = $val->apellidosegundo;
				$this->fechaNacimiento = $val->fechanacimiento;
				$this->correoElectronico = $val->email1;
				$this->codigoDireccion = $val->direccioncod;
				$this->direccion = $val->direccion1;
				//$this->tipoTelefono = $val->telefonotipcod;
				//$this->codigoTelefono = $val->telefonocodigoarea;
				//$this->telefono = $val->telefononumero;
				$this->banco = $val->instfinannombre;
				$this->cuenta = $val->nrocuenta;
				$this->tipoCuenta = $val->tipcuentacod;
			}
			$this->cargarTelefonos();
			$this->cargarFamiliares();

		}
		return $obj;
	}

	/**
	* Gerar consulta dependiendo de la cedula o el codigo
	* 
	* @access protected
	* @param string
	* @param string
	* @return string
	*/
	protected function generarSelectPersonas($cedula, $codigo = null){
		$sConsulta = 'SELECT * FROM personas
		LEFT JOIN telefono_correo ON personas.nropersona=telefono_correo.nropersona
		LEFT JOIN edo_civil ON personas.edocivilcod=edo_civil.edocivilcod
		LEFT JOIN direcciones ON personas.nropersona=direcciones.nropersona 
		LEFT JOIN pers_cta_bancarias ON personas.nropersona=pers_cta_bancarias.nropersona
		LEFT JOIN inst_financieras ON pers_cta_bancarias.instfinancod=inst_financieras.instfinancod ';
		if(!$codigo){
			$sConsulta .= 'WHERE personas.codnip=\'' . $cedula . '\' LIMIT 1';

		}else{
			$sConsulta .= 'WHERE personas.nropersona=' . $codigo . ' LIMIT 1';
		}
		
		return $sConsulta;
	}


	/**
	* Concatenar primer y segundo nombre para devolverlo en Mayuscula
	* 
	* @access public
	* @return string
	*/
	function cargarTelefonos(){
		$this->load->model('saman/Telefono', 'Telefono');
		$sConsulta = 'SELECT * from telefono_correo WHERE nropersona=' . $this->oid;
		$obj = $this->Dbsaman->consultar($sConsulta);
		if($obj->code == 0){
			foreach ($obj->rs as $c => $v) {
				$Telefono = new $this->Telefono;
				$Telefono->tipo = $v->telefonotipcod;				
				$Telefono->codigoPais = $v->telefonocodigopais;
				$Telefono->codigoArea = $v->telefonocodigoarea;
				$Telefono->numero = $v->telefononumero;
				$this->Telefonos[] = $Telefono; 
			}
		}
	}

	/**
	* Concatenar primer y segundo nombre para devolverlo en Mayuscula
	* 
	* @access public
	* @return string
	*/
	function cargarFamiliares(){
		$this->load->model('saman/Persona', 'Persona');
		$sConsulta = 'SELECT * FROM pers_relaciones 
		INNER JOIN pers_relacs_tipo ON pers_relaciones.persrelstipcod=pers_relacs_tipo.persrelstipcod
		INNER JOIN personas ON pers_relaciones.nropersonarel=personas.nropersona
		LEFT JOIN edo_civil ON personas.edocivilcod=edo_civil.edocivilcod
		LEFT JOIN direcciones ON personas.nropersona=direcciones.nropersona 
		WHERE pers_relaciones.nropersona= ' . $this->oid;		
		$obj = $this->Dbsaman->consultar($sConsulta);
		
		if($obj->code == 0){
			foreach ($obj->rs as $key => $val) {					
				$Persona = new $this->Persona();
				
				$Persona->oid = $val->nropersonarel;
				$Persona->nacionalidad = $val->tipnip;
				$Persona->cedula = $val->codnip;				
				$Persona->sexo = $val->sexocod;
				$Persona->estadoCivil = $val->edocivilnombre;
				$Persona->primerNombre = $val->nombreprimero;
				$Persona->segundoNombre = $val->nombresegundo;
				$Persona->primerApellido = $val->apellidoprimero;
				$Persona->segundoApellido = $val->apellidosegundo;
				$Persona->fechaNacimiento = $val->fechanacimiento;
				$Persona->correoElectronico = $val->email1;
				$Persona->codigoDireccion = $val->direccioncod;
				$Persona->direccion = $val->direccion1;
				$Persona->parentesco = strtoupper($val->persrelstipnombre);
				$this->Familiares[] = $Persona;
			}
		}	
	}


	/**
	* Concatenar primer y segundo nombre para devolverlo en Mayuscula
	* 
	* @access public
	* @return string
	*/
	public function nombreCompleto(){
		return strtoupper($this->primerNombre . ' ' . $this->segundoNombre);
	}

	/**
	* Concatenar primer y segundo apellido para devolverlo en Mayuscula
	* 
	* @access public
	* @return string
	*/
	public function apellidoCompleto(){
		return strtoupper($this->primerApellido . ' ' . $this->segundoApellido);
	}

	/**
	* Concatena nombres y apellidos para devolverlo en Mayuscula
	* 
	* @access public
	* @return string
	*/
	public function nombreApellidoCompleto(){
		return strtoupper($this->nombreCompleto() . ' ' . $this->apellidoCompleto());
	}

	/**
	* Evalua el sexo por caracter y retorna el nombre
	* 
	* @access public
	* @return string
	*/
	public function obtenerSexo(){
		if($this->sexo == 'M'){
			return 'MASCULINO';
		}else{
			return 'FEMENINO';
		}
	}
	
	/**
	* Evalua el tipo de Cuenta
	* 
	* @access public
	* @return string
	*/
	public function obtenerTipoCuenta(){
		if($this->tipoCuenta == 'CC'){
			return 'CUENTA CORRIENTE';
		}else{
			return 'CUENTA DE AHORRO';
		}
	}

	/**
	* Actualizar Objeto Persona en las tablas 
	* Direccion | Telefonos | Correos
	*
	* @var Persona
	* @return bool
	*/
	public function actualizar($arg = array()){
		$this->consultar($arg['cedula']);

		$sConsulta = 'UPDATE direcciones SET direccion1=\'' . $arg['direccion'] . '\' WHERE direccioncod=\'' . $this->codigoDireccion . '\';';

		$sConsulta = 'UPDATE personas SET email1=\'' . $arg['correo'] . '\' WHERE nropersona=\'' . $this->oid . '\';';		

	}

	/**
	*
	*
	*/
	function __destruct(){
		unset($this->Persona);
	}

}
