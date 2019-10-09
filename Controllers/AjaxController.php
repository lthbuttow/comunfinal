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

    public function atualizarStatusMensagens() {
       $result = $this->mensagemDAO->atualizaStatus();
	
	
	if ($result === true) {
	
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

            if($this->usuarioDAO->delete($id)) {
                echo 'Exclusão realizada com sucesso';
                $_SESSION['mensagem'] = '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>Sucesso!</strong> O usuário foi deletado.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
            else {
                echo 'Erro ao excluir';
                $_SESSION['mensagem'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Algo deu errado!</strong> Não foi possível deletar o usuário.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
            
        }
 
    }
    
    public function addUsuario() {
        if (!empty($_POST['email']) && !empty($_POST['nome'])) {

            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha= $_POST['senha'];
            
            } else {
                $array = array('Status' => 'ERRO' );
            }
            
            
            $resultado = $this->usuarioDAO->inserirUsuario($nome,$email,$senha);
                
                
                if ($resultado == true) {
                
                $array = array('Status' => 'ok' );
                
                } else {
            
                $array = array('Status' => 'ERRO' );
                }
            
                echo json_encode($array);
    }

}