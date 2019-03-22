<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {

	function __construct(){
		parent::__construct();
	}
	public function index(){
		//método padrão do controller
		//$this->load->view('welcome_message');
	}
}
