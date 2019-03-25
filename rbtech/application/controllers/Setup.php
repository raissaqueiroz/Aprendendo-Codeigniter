<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->helper('form');
				$this->load->library('form_validation');
				$this->load->model('opcao_model', 'opcao');
	}
	/****************************************************
	 *      		Página Inicial						*
	 ****************************************************/
		public function index(){
		//passando valores
			if($this->opcao->getOpcao('setup_executado') == 1){
				//setup ok
				redirect('setup/alterar');
			} else {
				//não instalado
				redirect('setup/instalar');

			}
		
		}
		
		public function instalar(){
			//se setup já tiver sido iniciado, ou seja, se já houver usuário cadastrado
			if($this->opcao->getOpcao('setup_executado') == 1){
				redirect('setup/alterar');
			}
			//validando
			$this->form_validation->set_rules('login', 'NOME', 'trim|required');
			$this->form_validation->set_rules('email', 'EMAIL', 'trim|required|valid_email');
			$this->form_validation->set_rules('senha', 'SENHA', 'trim|required');
			$this->form_validation->set_rules('senhab', 'REPITA A SENHA', 'trim|required|matches[senha]');

			if($this->form_validation->run() == FALSE){
				if(validation_errors()){
					set_msg(validation_errors());
				} 
				
			}else {
				$dados = $this->input->post(); //cria um array com todos os valores vindos dos input dos forms
				$this->opcao->updateOpcao('user_login', $dados['login']);
				$this->opcao->updateOpcao('email_login', $dados['email']);
				//TEM Q CRIPTOGRAFAR A SENHA -> USANDO FUNÇÃO DO PHP: password(senha, tipo de criptografia)
				$this->opcao->updateOpcao('pass_login', password_hash($dados['senha'], PASSWORD_DEFAULT));
				$inserido = $this->opcao->updateOpcao('setup_executado', 1);
				if($inserido){
					set_msg("<p class='lead'>Sistema Instalado! Utilize os dados cadastrados para logar.</p>");
					redirect('setup/login');
				}
			}
			//Carregar View
			$const['titulo'] = "RBTech | Cadastro";
			$const['logo'] = $this->opcao->getOpcao('nome_site', 'LOGO DO SITE');
			$const['h2'] = "<h2 class='display-4 my-5 mb-5 text-center'>Cadastrar Login</h2>";
			$this->load->view('inc/topo_view', $const);
			$this->load->view('painel/setup_view');
			$this->load->view('inc/rodape_view');	
		}

		public function login(){
			//É o primeiro acesso, então o setup não está instalado. Redirecionar usuário para tela de instalação
			if($this->opcao->getOpcao('setup_executado') != 1){
				redirect('setup/instalar');
			}
			//validando
			$this->form_validation->set_rules('login', 'NOME', 'trim|required');
			$this->form_validation->set_rules('senha', 'SENHA', 'trim|required');

			if($this->form_validation->run() == FALSE){
				if(validation_errors()){
					set_msg(validation_errors());
				} 
				
			}else {
				$dados = $this->input->post(); //cria um array com todos os valores vindos dos input dos forms
				//validando usuário
				if($this->opcao->getOpcao('user_login') == $dados['login']){
					//verifica a senha
					if(password_verify($dados['senha'], $this->opcao->getOpcao('pass_login'))){
						//senha ok -- pode logar
						$this->session->set_userdata('logged', TRUE);
						$this->session->set_userdata('user_login', $dados['login']);
						$this->session->set_userdata('user_email', $this->opcao->getOpcao('email_login'));
						//fazer redirect para a home do painel
						redirect('setup/alterar');
					
					} else {
						set_msg("<p class='lead'>Senha inválida!</p>");
					}
				} else {
					//usuario n existe
					set_msg("<p class='lead'>Usuário não existe!</p>");

				}
			}
			//Carregar View
			$const['titulo'] = "RBTech | Login";
			$const['logo'] = $this->opcao->getOpcao('nome_site', 'LOGO DO SITE');
			$const['h2'] = "<h2 class='display-4 my-5 mb-5 text-center'>Login</h2>";
			$this->load->view('inc/topo_view', $const);
			$this->load->view('painel/login_view');
			$this->load->view('inc/rodape_view');	
		}

		public function alterar(){
			//verificar o login do usuário
			verifica_login();
			//validando
			$this->form_validation->set_rules('login', 'NOME', 'trim|required');
			$this->form_validation->set_rules('email', 'EMAIL', 'trim|required|valid_email');
			$this->form_validation->set_rules('senha', 'SENHA', 'trim');
			$this->form_validation->set_rules('nome_site', 'NOME DO SITE', 'trim|required');
			if(isset($_POST['senha']) && $_POST['senha'] != ''){
				$this->form_validation->set_rules('senhab', 'REPITA A SENHA', 'trim|required|matches[senha]');
			}
			//verificando validação
			if($this->form_validation->run() == FALSE){
				if(validation_errors()){
					set_msg(validation_errors());
				} 
				
			}else {
				$dados = $this->input->post();
				$this->opcao->updateOpcao('user_login', $dados['login']);
				$this->opcao->updateOpcao('email_login', $dados['email']);
				$this->opcao->updateOpcao('nome_site', $dados['nome_site']);
				if(isset($dados['senha']) && $dados['senha'] != ''){
					//TEM Q CRIPTOGRAFAR A SENHA -> USANDO FUNÇÃO DO PHP: password(senha, tipo de criptografia)
					$this->opcao->updateOpcao('pass_login', password_hash($dados['senha'], PASSWORD_DEFAULT));
				}
				set_msg("<p class='lead'>Dados alterados com sucesso!</p>");
			}
			//carrega view
			$_POST['login'] = $this->opcao->getOpcao('user_login');
			$_POST['email'] = $this->opcao->getOpcao('email_login');
			$_POST['nome_site'] = $this->opcao->getOpcao('nome_site');
			$const['titulo'] = "RBTech | Configuração do Sistema";
			$const['logo'] = $this->opcao->getOpcao('nome_site', 'LOGO DO SITE');
			$const['h2'] = "<h2 class='h1 my-5 mb-5 text-center lead' style='font-size: 26px;'>Alterar Configuração Básica</h2>";
			$this->load->view('painel/header_view', $const);
			$this->load->view('painel/config_view');
			$this->load->view('inc/rodape_view');	
		}

		public function logout(){
			//destruindo dados de sessão
			$this->session->unset_userdata('logged');
			$this->session->unset_userdata('user_login');
			$this->session->unset_userdata('login_email');
			//seto a mensagem e redireciono para a página de login
			set_msg("<p class='lead'>Você saiu do sistema!</p>");
			redirect('setup/login');
		}

    
}