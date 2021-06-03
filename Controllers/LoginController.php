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
  
  public function esqueciSenha() {
        $dados = array();

        $user = new UsuarioDAO();

        if(!empty($_POST['email'])) {

	      $email = $_POST['email'];
        
        $userId = $user->emailExists($email);

        $dados['debug'] = $userId;

        if($userId) {

          $token = md5(time().rand(0, 99999).rand(0, 99999));
          $expira = date('Y-m-d H:i', strtotime('+1 hour'));

          $result = $user->createPassRecoverToken($userId, $token, $expira);

          if($result) {
            $link = 'http://localhost:8888/projetocomun/login/redefinirSenha?token='.$token;

            $dados['mensagem'] = "O link para recuperação de senha foi enviado em seu e-mail, obrigado!";
          } else {
            $dados['mensagem'] = "E-mail encontrado, mas não foi possível prosseguir com a recuperação de senha";
          }
          
        } else {
          $dados['mensagem'] = "Não foi encontrado nenhum usuário com este e-mail :(";
        }
      
        }
        
        $this->loadTemplate('esqueciSenha', $dados);
    }

}