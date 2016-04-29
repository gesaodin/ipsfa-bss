<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * Seguridad MamonSoft C.A
 * 
 *
 * @package mamonsoft.modules.seguridad
 * @subpackage iniciar
 * @author Carlos Peña
 * @copyright	Derechos Reservados (c) 2014 - 2015, MamonSoft C.A.
 * @link		http://www.mamonsoft.com.ve
 * @since Version 1.0
 *
 */



class Iniciar extends CI_Model {

  var $token = null;

  function __construct() {
    $this -> load -> model('usuario/Usuario', 'Usuario');
  }

  function validarCuenta($arg = null) {
    $this -> Usuario -> sobreNombre = $arg['usuario'];
    $this -> Usuario -> clave = $arg['clave'];
 
    if ($this -> Usuario -> validar() == TRUE) {
      $this -> _entrar($this -> Usuario);
      return TRUE;
    } else {
      $this -> _salir();
      return FALSE;
    }
  }

  private function _entrar($usuario) {
    
    
  
    $this->session->set_userdata(array(
        'cedula' => $usuario->cedula,
        'nombreRango' => $usuario->nombre,
        'correo' => $usuario->correo,
        'estatus' => $usuario->estatus,
        'perfil' => $usuario->perfil,
        'ultimaConexion' => '', //$usuario->ultimaConexion()
      )
    );
    $this->load->model('comun/Dbipsfa');
    $arr = array(
      'cedu' => $usuario->cedula,
      'obse' => 'Inicio de Sesión',
      'fech' => 'now()',
      'app' => 'Panel',
      'tipo' => 0
      );

    $this->Dbipsfa->insertarArreglo('traza', $arr);
  }

  function token($token){
    $this->Usuario->cedula = $token->afi_nro_persona;
    $this->Usuario->nombre = "PRUEBA"; //$token->dmi_grado_ . '-' . $token->afi_nombre_primero . ' ' . $token->afi_nombre_segundo;
    $this->Usuario->correo = "gesaodin@gmail.com"; //$token->afi_correo;
    $this->Usuario->perfil = $token->dmi_situacion_;
    $this->Usuario->estatus = 0; //$token->afi_estatus;
    $this->_entrar($this->Usuario);

  }

  private function _salir() {
    redirect('Login/salir');
  }

  function __destruct() {
    unset($this -> Usuario);
  }

}
