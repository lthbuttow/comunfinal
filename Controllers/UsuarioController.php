<?php
namespace Controllers;

use \Core\Controller;
use \Models\Usuario;
use \Models\UsuarioDAO;
use \Models\Arquivo;
use \Models\ArquivoDAO;

require("log/logs.php");

class UsuarioController extends Controller {
	
	public function __construct() {
		parent::__construct();
        $u = new UsuarioDAO();

        if(!$u->isLogged()) {
        	header('Location: http://localhost:8888/projetocomun/login');
        }
	}
	
	public function index() {
        $array = array();
        
        $idUser = $_SESSION['login'];

        $user = new UsuarioDAO();

        if ($user->getSenhaPadrao($idUser)) {
            $array['situacaoSenha'] = 'padrao';
        } else {
            $array['situacaoSenha'] = 'alterada';
        }

        $dados = array();
        // $id_admin = $_SESSION['login'];
        // $id_user = $id_para;

        $arquivo = new ArquivoDAO();

        if (isset($_FILES['arquivo']) && !empty($_FILES['arquivo'])) {
            $file = $_FILES['arquivo'];

            $id_para = $user->getAdmin();
            $id_de = $idUser;
            $comentario = $_POST['comment'];
            // $comentario = $_POST['comment'];
            // $nome = $_SESSION['nome'];
            $nome = 'Nome teste';
            
            $nome_arquivo = 'default.jpg';

            //Pega o remetente do arquivo
            $emailDest = $user->getEmailRemetente($id_de);
            if($emailDest) {
                $emailDest = $emailDest['email'];
            } else {
                $emailDest = 'undefinedUser';
            }

            if (isset($file['tmp_name']) && !empty($file['tmp_name'])) {
                
                $tipo = $file['type'];

                if (in_array($tipo, array('image/jpeg', 'image/jpg', 'image/png'))) {
                    
                    $nm = explode(' ',$nome);
                    $nm_concat = implode($nm);
                    $nm_final = strtolower($nm_concat);

                    $nome_arquivo = 'doc'.$nm_final.rand(0,99999).'.jpg';
                    // print_r($file);
                    move_uploaded_file($file['tmp_name'], 'arquivos/'.$nome_arquivo);

                    $result = $arquivo->addArquivo($id_de,$id_para,$nome_arquivo,$comentario);
                    if ($result === true) {
                        $_SESSION['mensagem'] = '
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong>Sucesso!</strong> Arquivo enviado!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>';
                        $texto = $emailDest."enviou o arquivo ".$nome_arquivo." com sucesso para Admin";
                        logs($texto);
                        } else{
                            $_SESSION['mensagem'] = '
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>ERRO!</strong> Não foi possível enviar o arquivo, tente novamente!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';
                            $texto = $emailDest." O arquivo ".$file['name']." não foi enviado com sucesso para Admin";
                            logs($texto);		
                        }
                
                }
            } else{
                $_SESSION['mensagem'] = '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Olá!</strong> Não esqueça de selecionar algum arquivo!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            }

        $_SESSION['unreadFiles'] = $arquivo->getUnreadCountUser($idUser);

        //setar arquivos como visualizados
        $arquivo->setAsReadUser($idUser);
        
        
        }
        $this->loadTemplate('userHome', $array);
    }

	public function addUser() {
        $dados = array();
        
        if(isset($_POST['nome']) && !empty($_POST['nome'])) {

            $nome = addslashes($_POST['nome']);
            $senha = $_POST['senha'];

            $u = new Usuario();

            if($u->inserirUser($nome, $senha)) {
                header('Location: http://localhost/mvc_psr4/');
            }
        }

        
        $this->loadTemplate('AddUser', $dados);
    }
    
    public function arquivosRecebidosUsuario($id_para) {
        $dados = array();

        $arquivo = new ArquivoDAO();
        $dados['arquivos']= $arquivo->userArquivos($id_para);

        //setar arquivos como visualizados
        $arquivo->setAsReadUser($idUser);

        $this->loadTemplate('arquivosUser', $dados);
	}

	// public function editUser($id) {
    //     $dados = array();
        
    //     if($id != '') {
	// 		$u = new Usuario();

	// 		$data = $u->getUser($id);

	// 		if($data != ''){
    //             $dados['nome'] = $data['name'];
    //             $dados['senha'] = $data['senha'];
	// 		}

    //         if(isset($_POST['nome']) && !empty($_POST['senha'])) {
    //             $newNome = $_POST['nome'];
    //             $newSenha = $_POST['senha'];

    //             if($u->editarUser($id, $newNome, $newSenha)) {
    //                 header('Location: http://localhost/mvc_psr4/');
    //             }
    //         }

    //     }

        
    //     $this->loadTemplate('editUser', $dados);
	// }

}