<?php
namespace Controllers;

use \Core\Controller;
use \Models\Usuario;
use \Models\UsuarioDAO;

class LoginController extends Controller {

	public function __construct() {
		parent::__construct();
	}
    public function index() {
        $dados = array();
        
        if(isset($_POST['nome']) && !empty($_POST['nome'])) {

            $nome = addslashes($_POST['nome']);
            $senha = $_POST['senha'];

            $u = new Usuarios();

            if($u->fazerLogin($nome, $senha)) {
                header('Location: http://localhost/projetocomun/');
            }
        }

        
        $this->loadTemplate('login', $dados);
    }

    public function loginUser() {
        $dados = array();
        
        if(isset($_POST['nome']) && !empty($_POST['nome'])) {

            $nome = $_POST['nome'];
            $senha = $_POST['senha'];

            $u = new UsuarioDAO();

            if($u->fazerLogin($nome, $senha)) {
                header('Location: http://localhost/projetocomun/usuario');
            }
            else {
                header('Location: http://localhost/projetocomun/');
            }
        }
        else {
            header('Location: http://localhost/projetocomun/'); 
        }
    
        // $this->loadTemplate('login', $dados);
    }    

	public function logout() {
        unset($_SESSION['login']);
        header('Location: http://localhost/projetocomun/');

	}    


}