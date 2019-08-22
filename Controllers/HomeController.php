<?php
namespace Controllers;

use \Core\Controller;
use \Models\Usuarios;

class HomeController extends Controller {
	
	public function __construct() {
		parent::__construct();
        $u = new Usuarios();

        // if(!$u->isLogged()) {
        // 	header('Location: http://localhost/mvc_psr4/login');
        // }
	}
	
	public function index() {
		$array = array();

		// $usuarios = new Usuarios();
		// $array['lista'] = $usuarios->getAll();

		// $array['teste'] = 'blade muito louco';
 
		$this->loadTemplate('home', $array);
	}

	public function addUser() {
        $dados = array();
        
        if(isset($_POST['nome']) && !empty($_POST['nome'])) {

            $nome = addslashes($_POST['nome']);
            $senha = $_POST['senha'];

            $u = new Usuarios();

            if($u->inserirUser($nome, $senha)) {
                header('Location: http://localhost/mvc_psr4/');
            }
        }

        
        $this->loadTemplate('AddUser', $dados);
	}

	public function editUser($id) {
        $dados = array();
        
        if($id != '') {
			$u = new Usuarios();

			$data = $u->getUser($id);

			if($data != ''){
                $dados['nome'] = $data['name'];
                $dados['senha'] = $data['senha'];
			}

            if(isset($_POST['nome']) && !empty($_POST['senha'])) {
                $newNome = $_POST['nome'];
                $newSenha = $_POST['senha'];

                if($u->editarUser($id, $newNome, $newSenha)) {
                    header('Location: http://localhost/mvc_psr4/');
                }
            }

            // if($u->inserirUser($nome, $senha)) {
            //     header('Location: http://localhost/mvc_psr4/');
            // }
        }

        
        $this->loadTemplate('editUser', $dados);
	}

}