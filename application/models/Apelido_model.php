<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apelido_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function apelidei(){
		//método padrão do controller
		echo "Você apelidou esse model!";
	}
}