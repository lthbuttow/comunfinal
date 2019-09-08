<?php
namespace Controllers;

use \Core\Controller;
use \Models\Usuario;
use \Models\UsuarioDAO;

class AdminController extends Controller {

    private $user;
	
	public function __construct() {
		parent::__construct();
        $this->user = new UsuarioDAO();

        if(!$this->user->adminIsLogged()) {
        	header('Location: http://localhost/projetocomun');
        }
	}
	
	public function index() {
        $array = array();
        
        $idUser = $_SESSION['login'];                
 
		$this->loadTemplate('adminHome', $array);
	}

	public function addUser() {
        $dados = array();
        
        if(isset($_POST['nome']) && !empty($_POST['nome'])) {

            $nome = addslashes($_POST['nome']);
            $senha = $_POST['senha'];

            $u = new Usuario();

            if($u->inserirUser($nome, $senha)) {
                header('Location: http://localhost/mvc_psr4/');
            }
        }

        
        $this->loadTemplate('AddUser', $dados);
	}

	// public function editUser($id) {
    //     $dados = array();
        
    //     if($id != '') {
	// 		$u = new Usuario();

	// 		$data = $u->getUser($id);

	// 		if($data != ''){
    //             $dados['nome'] = $data['name'];
    //             $dados['senha'] = $data['senha'];
	// 		}

    //         if(isset($_POST['nome']) && !empty($_POST['senha'])) {
    //             $newNome = $_POST['nome'];
    //             $newSenha = $_POST['senha'];

    //             if($u->editarUser($id, $newNome, $newSenha)) {
    //                 header('Location: http://localhost/mvc_psr4/');
    //             }
    //         }

    //     }

        
    //     $this->loadTemplate('editUser', $dados);
	// }

}