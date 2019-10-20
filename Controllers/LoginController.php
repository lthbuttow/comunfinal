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
        
        if(isset($_POST['email']) && !empty($_POST['email'])) {

            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $u = new UsuarioDAO();

            if($u->fazerLogin($email, $senha)) {
                header('Location: http://localhost:8888/projetocomun/usuario');
            }
            else {
                $_SESSION['mensagem'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Algo deu errado!</strong> Verifique suas informações.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
                header('Location: http://localhost:8888/projetocomun/');
            }
        }
        else {
            $_SESSION['mensagem'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Algo deu errado!</strong> Verifique suas informações.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            header('Location: http://localhost:8888/projetocomun/'); 
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
                header('Location: http://localhost:8888/projetocomun/admin');
            }
            else {
                $_SESSION['mensagem'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Algo deu errado!</strong> Verifique suas informações.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
                header('Location: http://localhost:8888/projetocomun/');
            }
        }
        else {
            $_SESSION['mensagem'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Algo deu errado!</strong> Verifique suas informações.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            header('Location: http://localhost:8888/projetocomun/'); 
        }
    
        // $this->loadTemplate('login', $dados);
    }    

	public function logout() {
        session_destroy();
        header('Location: http://localhost:8888/projetocomun/');

	}    


}