<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndexControler extends CI_Controller {
    
    private $dadosEmpresa = null;

    public function __construct() {
        parent::__construct();

        $this->load->model('IndexModel');
        $this->dadosEmpresa = $this->IndexModel->carregaRegistro('configuracoes', array('id' => 1));
    }

	public function index() {
        $data['parceiros'] = $this->IndexModel->listar('parceiros', array('atividade' => 1));
        $data['Cart'] = isset($_COOKIE['Cart']) ? json_decode($_COOKIE['Cart']) : [];
        
		$this->load->view('index', $data);
	}

    function CarregaCategorias() {
        $res = $this->IndexModel->listaCategorias('categorias');
        
        echo json_encode($res);
    }

    function listaProdutos() {
        $id = $this->input->post('id');
        $res = $this->IndexModel->listaProdutos($id);
        
        echo json_encode($res);
    }

}
