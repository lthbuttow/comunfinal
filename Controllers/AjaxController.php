<?php
namespace Controllers;

use \Core\Controller;
use \Models\UsuarioDAO;
use \Models\Usuario;
use \Models\Mensagem;
use \Models\MensagemDAO;
use \Models\Chat;
use \Models\ChatDAO;

class AjaxController extends Controller {

    private $usuarioDAO;
    private $mensagemDAO;
    private $chatDAO;

	public function __construct() {
		parent::__construct();
        $u = new UsuarioDAO();
        $this->usuarioDAO = new UsuarioDAO();
        $this->mensagemDAO = new MensagemDAO();
        $this->chatDAO = new ChatDAO();

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

    public function reativarUser() {
		$array = array();

        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = addslashes($_POST['id']);

            if($this->usuarioDAO->reactivateUser($id)) {
                $_SESSION['mensagem'] = '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>Sucesso!</strong> O usuário foi reativado.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
            else {
                $_SESSION['mensagem'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Algo deu errado!</strong> Não foi possível reativar o usuário.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
            
        }
 
    }

    public function deactivateUser() {
		$array = array();

        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = addslashes($_POST['id']);

            if($this->usuarioDAO->deactiveUser($id)) {
                $_SESSION['mensagem'] = '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>Sucesso!</strong> O usuário foi desativado.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
            else {
                $_SESSION['mensagem'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Algo deu errado!</strong> Não foi possível desativar o usuário.
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

    public function buscaUsers() {

	//Recuperar o valor da palavra
	$usuario = $_POST['palavra'];
	$p = $_SESSION['p'];
	$qt_por_pag = $_SESSION['qt_por_pag'];
	
	
	//Pesquisar no banco de dados nome do curso referente a palavra digitada pelo usuário
	if($usuario == ''){
        $result = $this->usuarioDAO->getUsuariosPagination($p,$qt_por_pag);
        
		
		// $result = $result->fetchAll();
		
		foreach($result as $user){
			$html = '
			<tr>
            <td scope="row">'.$user['id'].'</td>
            <td>'.$user['nome'].'</td>
            <td>'.$user['email'].'</td>
            <td><a id="edita_adm" href="editarusuario/'.$user['id'].'"><i class="fa-2x far fa-edit hv"></i></a></td>
            <td><a class="excluir" onclick="deleteUser('.$user['id'].')"><i class="fa-2x far fa-minus-square hv"></i></a></td>
            <td><a><i class="fa-2x far fa-comment-alt hv"></i></a></td>                   
            <td><a class="acessa hv" href="arquivosAdmin/'.$user['id'].'"><i class="fa-2x far fa-folder hv"></i></a></td>
            </tr>';
			echo $html;
			}		
    } 
        else{
        $result = $this->usuarioDAO->consultaUsers($usuario);
        
        if($result) {
            
            foreach($result as $user){
                $html = '
                <tr>
                <td scope="row">'.$user['id'].'</td>
                <td>'.$user['nome'].'</td>
                <td>'.$user['email'].'</td>
                <td><a id="edita_adm" href="editarusuario/'.$user['id'].'"><i class="fa-2x far fa-edit hv"></i></a></td>
                <td><a class="excluir" onclick="deleteUser('.$user['id'].')"><i class="fa-2x far fa-minus-square hv"></i></a></td>
                <td><a><i class="fa-2x far fa-comment-alt hv"></i></a></td>                   
                <td><a class="acessa hv" href="arquivosAdmin/'.$user['id'].'"><i class="fa-2x far fa-folder hv"></i></a></td>
                </tr>';
                echo $html;
                    }
        } 
            else {
            echo "Nenhum usuário encontrado...";
            }    

        }
    }

    public function getMessages() {
        $id_de = $_SESSION['login'];
        $id_para = $_SESSION['id_para'];

        

        $resultado = $this->chatDAO->consultaMsg($id_de,$id_para);

            if ($resultado->rowCount() <= 0) {
                echo "<code>Diga olá!</code>";
            } else {
                while ( $row = $resultado->fetch()) {
            ?>

                <?php
                if ($row['id_de'] == $id_de) {
                ?>
                <div align="right"><p class="chat-i"><?php echo $row['mensagem']; ?></p></div>	
                <?php
                }else if ($row['id_de'] == $id_para) {
                ?>
                <div align="left"><p class="chat-you"><?php echo $row['mensagem']; ?></p></div>
                <?php
                }
            }
        }
    }
    public function sendMessage() {
        $id_de = $_SESSION['login'];
        $id_para = $_SESSION['id_para'];


        if (isset($_POST['mensagem']) && !empty($_POST['mensagem'])) {
		$mensagem = $_POST['mensagem'];

		if (empty($mensagem)) {
			echo "<code>Digite sua mensagem</code>";
		} else {
			$result = $this->chatDAO->addMsg($id_de,$id_para,$mensagem);
			}
			if ($result == true) {
				echo "Mensagem enviada";
			} else {
				echo "<code>Erro ao enviar sua mensagem</code>";	
			}
		}
    }                
}