<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aula extends CI_Controller {

	function __construct(){
		parent::__construct();
	}
	public function index($i=NULL){
		//método padrão do controller
		//$this->load->view('welcome_message');
		if($i == 1){
			$this ->listar();
		} else if($i == 2){
			$this -> adicionar();
		} else if($i == 3) {
			$this->alterar();
		}
	}

	public function adicionar(){
		//método padrão do controller
		//$this->load->view('welcome_message');
		echo "adicionar";
	}

	public function alterar(){
		//método padrão do controller
		//$this->load->view('welcome_message');
		echo "alterar";
	}

	public function listar(){
		//método padrão do controller
		//$this->load->view('welcome_message');
		echo "listar";

	}
}
