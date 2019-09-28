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
        
        $this->loadTemplate('login', $dados);
    }

    public function loginUser() {
        $dados = array();
        
        if(isset($_POST['nome']) && !empty($_POST['nome'])) {

            $nome = $_POST['nome'];
            $senha = $_POST['senha'];

            $u = new UsuarioDAO();

            if($u->fazerLogin($nome, $senha)) {
<<<<<<< HEAD
                header('Location: https://projetocomun.com/usuario');
            }
            else {
                header('Location: https://projetocomun.com/');
            }
        }
        else {
            header('Location: https://projetocomun.com/'); 
=======
                header('Location: http://localhost:8888/projetocomun/usuario');
            }
            else {
                header('Location: http://localhost:8888/projetocomun/');
            }
        }
        else {
            header('Location: http://localhost:8888/projetocomun/'); 
>>>>>>> development
        }
    
        // $this->loadTemplate('login', $dados);
    }
    
    public function loginAdmin() {
        $dados = array();
        
        if(isset($_POST['email']) && !empty($_POST['email'])) {

            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $u = new UsuarioDAO();

            if($u->fazerLoginAdmin($email, $senha)) {
<<<<<<< HEAD
                header('Location: https://projetocomun.com/admin');
            }
            else {
                header('Location: https://projetocomun.com/');
            }
        }
        else {
            header('Location: https://projetocomun.com/'); 
=======
                header('Location: http://localhost:8888/projetocomun/admin');
            }
            else {
                header('Location: http://localhost:8888/projetocomun/');
            }
        }
        else {
            header('Location: http://localhost:8888/projetocomun/'); 
>>>>>>> development
        }
    
        // $this->loadTemplate('login', $dados);
    }    

	public function logout() {
        session_destroy();
<<<<<<< HEAD
        header('Location: https://projetocomun.com');
=======
        header('Location: http://localhost:8888/projetocomun/');
>>>>>>> development

	}    


}