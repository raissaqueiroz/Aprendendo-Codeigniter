<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Noticia extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->helper('form');
		$this->load->library('form_validation');
        $this->load->model('opcao_model', 'opcao');
        $this->load->model('noticia_model', 'noticia');
    }

    public function index(){
        redirect('noticia/listar');
    }

    public function listar(){
        //verificando login
        verifica_login();
    	//Carregar View
		$const['titulo'] = "RBTech | Noticias";
		$const['logo'] = $this->opcao->getOpcao('nome_site', 'LOGO DO SITE');
        $const['h2'] = "<h2 class='display-4 my-5 mb-5 text-center'>Listar Noticias</h2>";
        $const['tela'] = "listar"; //Listar | Cadastrar | Editar | Excluir
        $const['noticias'] = $this->noticia->get();
		$this->load->view('painel/header_view', $const);
		$this->load->view('painel/noticia_view');
		$this->load->view('inc/rodape_view');	
    }

    public function cadastrar(){
        //verificando login
        verifica_login();
        //Regras da Validação
        $this->form_validation->set_rules('titulo', 'TITULO', 'trim|required');
        $this->form_validation->set_rules('conteudo', 'CONTEUDO', 'trim|required');
        if($this->form_validation->run() == FALSE){
            if(validation_errors()){
                set_msg(validation_errors());
            } 
            
        }else {
            $this->load->library('upload', config_upload());
            if($this->upload->do_upload('imagem')){
                $upload = $this->upload->data();
                $dados = $this->input->post();
                $dados_insert['titulo'] = $dados['titulo'];
                $dados_insert['conteudo'] = to_db($dados['conteudo']);
                $dados_insert['imagem'] = $upload['file_name'];
                 
                //salvar no banco
                if($id = $this->noticia->salvar($dados_insert)){
                    set_msg("<p class='text-center'>Noticia Inserida com Sucesso!</p>");
                    redirect('noticia/listar');
                } else {
                    set_msg("<p class='text-center'>Erro ao Inserir Noticia!</p>");
                    redirect('noticia/listar');
                }
            } else {
                $msg = $this->upload->display_errors();
                set_msg("<p class='text-center'>{$msg}</p>");
            }
        }


    	//Carregar View
		$const['titulo'] = "RBTech | Noticias";
		$const['logo'] = $this->opcao->getOpcao('nome_site', 'LOGO DO SITE');
        $const['h2'] = "<h2 class='display-4 my-5 mb-5 text-center'>Cadastrar Noticias</h2>";
        $const['tela'] = "cadastrar"; //Listar | Cadastrar | Editar | Excluir
		$this->load->view('painel/header_view', $const);
		$this->load->view('painel/noticia_view');
		$this->load->view('inc/rodape_view');	
    }

    public function excluir(){
        //verificando login
        verifica_login();

        $id = $this->uri->segment(3);
        if($id >0){
            //id informado, prosseguir com exclusão
            if($noticias = $this->noticia->getSingle($id)){
                $const['noticia'] = $noticias;
            } else {
                set_msg("<p class='text-center'>Noticia inexistente. Escolha uma noticia para excluir!</p>");
                redirect('noticia/listar');
            }
        } else {
            set_msg("<p class='text-center'>Você deve escolher uma noticia para excluir!</p>");
            redirect('noticia/listar');
        }
        //regras de validação
        $this->form_validation->set_rules('excluir', 'EXCLUIR', 'trim|required');
        if($this->form_validation->run() == FALSE){
            if(validation_errors()){
                set_msg(validation_errors());
            } 
            
        }else {
            $imagem = 'dist/uploads/'.$noticias->imagem;
            if($this->noticia->excluir($id)){
                unlink($imagem);
                set_msg("<p class='text-center'>Noticia Excluida com Sucesso!</p>");
                redirect('noticia/listar');

            } else {
                set_msg("<p class='text-center'>Nenhuma Noticia foi Excluida!</p>");
            }
        }
        //Carregar View
		$const['titulo'] = "RBTech | Noticias";
		$const['logo'] = $this->opcao->getOpcao('nome_site', 'LOGO DO SITE');
        $const['h2'] = "<h2 class='display-4 my-5 mb-5 text-center'>Excluir Noticias</h2>";
        $const['tela'] = "excluir"; //Listar | Cadastrar | Editar | Excluir
		$this->load->view('painel/header_view', $const);
		$this->load->view('painel/noticia_view');
		$this->load->view('inc/rodape_view');	
    }

    public function editar(){
        //verificando login
        verifica_login();

        $id = $this->uri->segment(3);
        if($id >0){
            //id informado, prosseguir com edição
            if($noticias = $this->noticia->getSingle($id)){
                $const['noticia'] = $noticias;
                $update['id'] = $noticias->id;
            } else {
                set_msg("<p class='text-center'>Noticia inexistente. Escolha uma noticia para editar!</p>");
                redirect('noticia/listar');
            }
        } else {
            set_msg("<p class='text-center'>Você deve escolher uma noticia para editar!</p>");
            redirect('noticia/listar');
        }
        //regras de validação
        $this->form_validation->set_rules('titulo', 'TITULO', 'trim|required');
        $this->form_validation->set_rules('conteudo', 'CONTEUDO', 'trim|required');
        //verificação da validação
        if($this->form_validation->run() == FALSE){
            if(validation_errors()){
                set_msg(validation_errors());
            } 
            
        }else {
            $this->load->library('upload', config_upload());
            if(isset($_FILES['imagem']) && $_FILES['imagem']['name'] != ''){
                if($this->upload->do_upload('imagem')){
                    $image_delete = 'dist/uploads/'.$noticias->imagem;
                    $image_update = $this->upload->data();
                    $dados = $this->input->post();
                    $update['titulo'] = to_db($dados['titulo']);
                    $update['conteudo'] = to_db($dados['conteudo']);
                    $update['imagem'] = $image_update['file_name'];
                    if($this->noticia->salvar($update)){
                        unlink($image_delete);
                        set_msg("<p class='text-center'>Noticia Alterada com Sucesso!</p>");
                        $const['noticia']->imagem = $update['imagem'];
                    } else {
                        set_msg("<p class='text-center'>Nenhuma Alteração foi salva!</p>");
                    }

                } else {
                    $msg = $this->upload->display_errors();
                    set_msg("<p class='text-center'>{$msg}</p>");
                }
            } else {
                //alteração sem mudar imagem
                $dados = $this->input->post();
                $update['titulo'] = to_db($dados['titulo']);
                $update['conteudo'] = to_db($dados['conteudo']);
                if($this->noticia->salvar($update)){
                    set_msg("<p class='text-center'>Noticia Alterada com Sucesso!</p>");
                } else {
                    set_msg("<p class='text-center'>Nenhuma Alteração foi salva!</p>");
                }

            }
        }
        //Carregar View
		$const['titulo'] = "RBTech | Noticias";
		$const['logo'] = $this->opcao->getOpcao('nome_site', 'LOGO DO SITE');
        $const['h2'] = "<h2 class='display-4 my-5 mb-5 text-center'>Editar Noticias</h2>";
        $const['tela'] = "editar"; //Listar | Cadastrar | Editar | Excluir
		$this->load->view('painel/header_view', $const);
		$this->load->view('painel/noticia_view');
		$this->load->view('inc/rodape_view');	
    }
}