<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		//aqui vai entrar meus models
	}
	public function index(){
		//passando valores
		$const['titulo'] = "Dashboard | ";


		//método padrão do controller
		$this->load->view('inc/topo_view', $const);
		$this->load->view('conteudo_view');
		$this->load->view('inc/rodape_view');
	}
}
