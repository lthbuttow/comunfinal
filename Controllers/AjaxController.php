<?php
namespace Controllers;

use \Core\Controller;
use Models\UsuarioDAO;
use \Models\Usuarios;
use \Models\Mensagem;
use \Models\MensagemDAO;

class AjaxController extends Controller {

    private $mensagemDAO;

	public function __construct() {
		parent::__construct();
//        $u = new UsuarioDAO();
        $this->mensagemDAO = new MensagemDAO();
//
//        if(!$u->isLogged()) {
//        	header('Location: http://localhost/projetocomun/');
//        }
	}

	public function enviarMensagem() {

        if(isset($_POST['email']) && !empty($_POST['email'])) {
            $dados = array();

            $email = $_POST['email'];
            $mensagem = $_POST['message'];

            $newMensagem = new Mensagem();
            $newMensagem->setEmail($email);
            $newMensagem->setMensagem($mensagem);

            if ($this->mensagemDAO->enviarMensagem($newMensagem)) {
                $dados['status'] = 'OK';
            } else {
                $dados['status'] = 'ERRO';
            }

            echo json_encode($dados);

        }
    }
	

	public function delete() {
		$array = array();

        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = addslashes($_POST['id']);

            $usuario = new UsuarioDAO();
            $usuario->delete($id);
        }
 
	}

}