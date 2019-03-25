<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		//aqui vai entrar meus models
		$this->load->model('opcao_model', 'opcao');
	}
	/****************************************************
	 *      		Página Inicial						*
	 ****************************************************/
	public function index(){
		//passando valores
		$const['titulo'] = "RBTech | Página Inicial";
		$const['logo'] = $this->opcao->getOpcao('nome_site', 'LOGO DO SITE');
		//método padrão do controller
		$this->load->view('inc/topo_view', $const);
		$this->load->view('home_view');
		$this->load->view('inc/rodape_view');
	}

	/****************************************************
	 *      			   Clientes						*
	 ****************************************************/
	public function clientes(){
		//passando valores
		$const['titulo'] = "RBTech | Clientes";
		$const['logo'] = $this->opcao->getOpcao('nome_site', 'LOGO DO SITE');
		//método padrão do controller
		$this->load->view('inc/topo_view', $const);
		$this->load->view('clientes_view');
		$this->load->view('inc/rodape_view');
	}

	/****************************************************
	 *      				Contato						*
	 ****************************************************/
	public function contato(){
		//helpers
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->email->initialize();

		//definir regras de validação:
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required'); //seta a validação
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('assunto', 'Assunto', 'trim|required');
		$this->form_validation->set_rules('mensagem', 'Mensagem', 'trim|required');
		//verificação da validação
		if($this->form_validation->run() == FALSE){ //run() é o metodo responsável por executar a validação do form
			$const['formerrors'] = validation_errors();
		} else {
			//recuperar informações digitadas
			$dados = $this->input->post();
			//print_r($dados);
			
			$this->email->from($dados['email'], $dados['nome']);
			$this->email->to('remotework2k19@gmail.com');
			$this->email->reply_to('remotework2k19@gmail.com');
			$this->email->subject($dados['assunto']);
			$this->email->message($dados['mensagem']);
			if($this->email->send()){
				$const['formerrors'] = "<p class='alert alert-success'>Email enviado com sucesso!</p>";
			} else {
				$const['formerrors'] = $this->email->print_debugger();
			}
		}
		//passando valores
		$const['titulo'] = "RBTech | Contato";
		$const['logo'] = $this->opcao->getOpcao('nome_site', 'LOGO DO SITE');
		//método padrão do controller
		$this->load->view('inc/topo_view', $const);
		$this->load->view('contato_view');
		$this->load->view('inc/rodape_view');
	}
}
