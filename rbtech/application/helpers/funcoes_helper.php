<?php 
    defined('BASEPATH') OR exit('No direct script access allowed'); 
    if(!function_exists('set_msg')){
        //SETA UMA MSG VIA SESSÃO
        function set_msg($msg=NULL){
            //pegando a classe que está em execução quando a função for chamada
            $ci = & get_instance();
            $ci->session->set_userdata('aviso', $msg);
        }
    }

    if(!function_exists('get_msg')){
        //RETORNA MENSAGEM DEFINIDA PELA FUNÇÃO SET_MSG
        function get_msg($destroy=TRUE){
            //pegando a classe que está em execução quando a função for chamada
            $ci = & get_instance();
            $retorno = $ci->session->userdata('aviso');
            if($destroy) $ci->session->unset_userdata('aviso');
            return $retorno;
        }
    }

    if(!function_exists('verifica_login')){
        //RETORNA MENSAGEM DEFINIDA PELA FUNÇÃO SET_MSG
        function verifica_login($redirect = 'setup/login'){
            $ci = & get_instance();
            if($ci->session->userdata('logged') != TRUE){
                set_msg("<p class='lead'>Acesso Restrito! Faça login para acessa o sistema.</p>");
                redirect($redirect);
            }
        }
    }

    if(!function_exists('config_upload')){
        function config_upload($path = './dist/uploads/', $types = 'jpg|png', $size=512){
           $config['upload_path'] = $path;
           $config['allowed_types'] = $types;
           $config['max_size'] = $size;
           return $config;
        }
    }

    if(!function_exists('to_db')){
        function to_db($string=NULL){ 
           return htmlentities($string);
        }
    }

    if(!function_exists('to_html')){
        function to_html($string=NULL){
           return html_entity_decode($string);
        }
    }






?>
