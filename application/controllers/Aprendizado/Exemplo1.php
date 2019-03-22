<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exemplo1 extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Exemplo1_model');
		//apelidando model -- é útil pra vc tirar o "model" do nome do model
		$this->load->model('Apelido_model', 'apelido');

	}
	public function index(){
		//método padrão do controller
		//criando parametros para imprimir na view
		$dados['titulo'] = "Bem vindo(a) a view do exemplo 1!";
		$dados['conteudo'] = "Exemplo elaborado para praticar apreindizado da aula 4. Para abrir não esqueça de adicionar index.php antes do nome do controller.";
		//chamando view
		$this->load->view('exemplo1', $dados);
	}

	public function login(){
		//método padrão do controller
		echo $this->uri->segment(3); #pega o parametro na 3 posição da URL
	}
	public function testemodel(){
		//nome do model -> metodo
		$this->Exemplo1_model->salvar();
	}
	public function apelidando(){
		//nome do model -> metodo
		$this->apelido->apelidei();
	}
}
