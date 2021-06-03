<?php
namespace Controllers;

use \Core\Controller;
use \Models\Usuario;
use \Models\UsuarioDAO;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
                header('Location: https://projetocomun.com/usuario');
            }
            else {
                $_SESSION['mensagem'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Algo deu errado!</strong> Verifique suas informações.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
                header('Location: https://projetocomun.com/');
            }
        }
        else {
            $_SESSION['mensagem'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Algo deu errado!</strong> Verifique suas informações.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            header('Location: https://projetocomun.com/'); 
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
                header('Location: https://projetocomun.com/admin');
            }
            else {
                $_SESSION['mensagem'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Algo deu errado!</strong> Verifique suas informações.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
                header('Location: https://projetocomun.com/');
            }
        }
        else {
            $_SESSION['mensagem'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Algo deu errado!</strong> Verifique suas informações.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            header('Location: https://projetocomun.com/'); 
        }
    
        // $this->loadTemplate('login', $dados);
    }    

	public function logout() {
        session_destroy();
        header('Location: https://projetocomun.com/');

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
            $link = 'https://www.projetocomun.com/login/redefinirSenha?token='.$token;

            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 2;
            $mail->Host = 'smtp.hostinger.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Username = 'suporte@projetocomun.com';
            $mail->Password = '77BUttow98';
            $mail->setFrom('suporte@projetocomun.com', 'Equipe Comun');
            $mail->addReplyTo('suporte@projetocomun.com', 'Equipe Comun');
            $mail->addAddress($email, 'Usuário');
            $mail->Subject = 'Recuperação de Senha';
            $mail->Body = 'Acesse este link para recuperar sua senha: '.$link;
            if (!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                $dados['mensagem'] = "Não foi possível prosseguir com a recuperação de senha. Entre em contato conosco via chat!";
            } else {
                $dados['mensagem'] = "Um e-mail com o link para a recuperação de senha foi enviado. Obrigado!";
            }

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