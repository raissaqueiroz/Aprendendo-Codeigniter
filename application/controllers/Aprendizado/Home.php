<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		//aqui vai entrar meus models
	}
	public function index(){
		//método padrão do controller
		//$this->load->view('welcome_message');
	}
}
