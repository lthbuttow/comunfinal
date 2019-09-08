<?php
namespace Controllers;

use \Core\Controller;
use \Models\UsuarioDAO;
use \Models\Usuario;
use \Models\Mensagem;
use \Models\MensagemDAO;

class AjaxController extends Controller {

    private $usuarioDAO;
    private $mensagemDAO;

	public function __construct() {
		parent::__construct();
        $u = new UsuarioDAO();
        $this->usuarioDAO = new UsuarioDAO();
        $this->mensagemDAO = new MensagemDAO();

    //      if(!$u->isLogged()) {
    //     	header('Location: http://localhost/projetocomun/');
    //    }
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

	public function getDadosUser() {

            $result = array();

            $id_user = $_SESSION['login'];

            $result = $this->usuarioDAO->getDadosEditarUser($id_user);

            if($result != ''){
                echo json_encode($result);
        
            } else{
                $result = array('Status' => 'ERRO');
                echo json_encode($result);
            }     

    } 
    
	public function salvarAlteracoesUser() {

        $array = array();
        
            $user = new Usuario();

            $id = $_POST['id_user'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];


            
            $user->setNome($nome);
            $user->setId($id);
            $user->setEmail($email); 
            $user->setSenha($senha);

            
            $result = $this->usuarioDAO->editarUser($user);      
            
            if($result != '') {
            
            $array = array('Status' => 'OK' );
            
            } else {
        
            $array = array('Status' => 'ERRO' );

            }
            
        echo json_encode($array);    

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