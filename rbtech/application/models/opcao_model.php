<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opcao_model extends CI_Model {

	function __construct(){
		parent::__construct();
        
	}
	/****************************************************
	 *      		          				 			*
	 ****************************************************/
    public function getOpcao($opcaoName, $defaultOpcao=NULL){
        $this->db->where('nome', $opcaoName);
		$query = $this->db->get('options', 1);
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->valor;
		} else {
			return $defaultOpcao;
		}
	}
	
	public function updateOpcao($nome, $valor){
		$this->db->where('nome', $nome);
		$query = $this->db->get('options', 1);
		if($query->num_rows() == 1){
			//opção já existe, devo atualizar
			$this->db->set('valor', $valor);
			$this->db->where('nome', $nome);
			$this->db->update('options');
			return $this->db->affected_rows();
			
		} else {
			//opção não existe, devo inserir
			$dados = array(
				'nome' => $nome,
				'valor' => $valor
			);

			$this->db->insert('options', $dados);
			return $this->db->insert_id();
		}
	}
	
}