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
            $link = 'http://localhost:8888/projetocomun/login/redefinirSenha?token='.$token;

            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'suporte@projetocomun.com';                     //SMTP username
                $mail->Password   = '77BUttow98';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients
                $mail->setFrom('suporte@projetocomun.com', 'Suporte Projeto Comun');
                $mail->addAddress($email);               //Name is optional


                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Recuperação de Senha';
                $mail->Body    = 'Olá, clique no link a seguir para poder recuperar sua senha <br>'.$link;

                $mail->send();
                $dados['mensagem'] = "O link para recuperação de senha foi enviado em seu e-mail, obrigado!";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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