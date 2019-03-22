<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
	}
	public function index(){
		//parametros
		$dados['title'] = ""
		//método padrão do controller
		$this->load->view('login');
	}
}
