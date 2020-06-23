<?php
namespace Controllers;

use \Core\Controller;
use \Models\Usuario;
use \Models\UsuarioDAO;
use \Models\MensagemDAO;
use \Models\ArquivoDAO;

 require("log/logs.php");

class AdminController extends Controller {

    private $user;
	
	public function __construct() {
		parent::__construct();
        $this->user = new UsuarioDAO();

        if(!$this->user->adminIsLogged()) {
        	header('Location: http://localhost:8888/projetocomun');
        }
	}
	
	public function index() {
        $array = array();
        
        $msg = new ArquivoDAO();

        $idUser = $_SESSION['login'];
        
        $array['unreadFilesCount'] = $msg->getUnreadCount();

        $_SESSION['unreadFiles'] = $msg->getUnreadCount();
 
		$this->loadTemplate('adminHome', $array);
    }
   
    
	public function notificacoes() {
        $array = array();
        
        $notificacao = new ArquivoDAO();

        
        $array['notificacoes'] = $notificacao->getUnread();
 
		$this->loadTemplate('notificacoes', $array);
    }

    public function listagemUsuarios() {
        $array = array();

        $msg = new ArquivoDAO();    
        $_SESSION['unreadFiles'] = $msg->getUnreadCount();

        $total_users = $this->user->getTotalUsuarios();
        $total_users = $total_users['contagem'];
        $qt_por_pag = 10;
        $paginas = $total_users / $qt_por_pag;
        
        $pg = 1;
        if(isset($_GET['p']) && !empty($_GET['p'])){
          $pg = $_GET['p'];
        }

        $p = ($pg-1) * $qt_por_pag;

        $array['total'] = $total_users;
        $array['paginas'] = $paginas;
        $array['listagem'] = $this->user->getUsuariosPagination($p,$qt_por_pag);
        $_SESSION['p'] = $p;
        $_SESSION['qt_por_pag'] = $qt_por_pag;        

        $this->loadTemplate('menuUsers', $array);
    }

	public function adicionarUsuario() {
        $dados = array();

        
        $this->loadTemplate('AddUser', $dados);
    }

	public function arquivosAdmin($id_de) {
        $dados = array();
        $id_admin = $_SESSION['login'];
        $id_user = $id_de;

        $id_para = $id_admin;

        $arquivo = new ArquivoDAO();

        $total_arquivos = $arquivo->getTotalArquivos($id_user);
        $total_arquivos = $total_arquivos['contagem'];
        $qt_por_pag = 4;
        $paginas = $total_arquivos / $qt_por_pag;
        $pg = 1;
        if(isset($_GET['p']) && !empty($_GET['p'])){
            $pg = $_GET['p'];
        }

        $dados['id_para'] = $id_user;
        $dados['total'] = $total_arquivos;
        $dados['paginas'] = $paginas;

        $p = ($pg-1) * $qt_por_pag;      
        $result = $arquivo->meusArquivosAdminPag($id_de,$id_para,$p,$qt_por_pag);
        
        $dados['result'] = $result;

        //setar arquivos como visualizados
        $arquivo->setAsRead($id_user);

        $this->loadTemplate('arquivosAdmin', $dados);
    }

    public function enviaArquivosAdmin($id_to) {
        $dados = array();
        $id_admin = $_SESSION['login'];
        // $id_user = $id_para;

        $arquivo = new ArquivoDAO();
        $usuario = new UsuarioDAO();

        if (isset($_FILES['arquivo']) && !empty($_FILES['arquivo'])) {
            $file = $_FILES['arquivo'];

            $id_para = $id_to;
            $id_de = $id_admin;
            $comentario = $_POST['comment'];

            $nome = 'Nome teste';
            
            $nome_arquivo = 'default.jpg';

            //Pega o destinatario do arquivo
            $emailDest = $usuario->getEmailDestinario($id_para);
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

                        
                        $texto = "Admin enviou o arquivo ".$nome_arquivo." com sucesso para ".$emailDest;
                        logs($texto);
                        }
                    } else{
                        $_SESSION['mensagem'] = '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>ERRO!</strong> Não foi possível enviar o arquivo, tente novamente!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>';
                        $texto = "Admin - O arquivo".$file['name']." não foi enviado com sucesso para ".$emailDest;
                        logs($texto);		
                    }
                
                }
            }

         else{
            $_SESSION['mensagem'] = '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Olá!</strong> Não esqueça de selecionar algum arquivo!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>';
        }
        
        $this->loadTemplate('enviaArquivosAdmin', $dados);
    }

    public function editarUsuario($id_user) {
        $dados = array();

        if($id_user != '') {

			$data = $this->user->getDadosEditar($id_user);

			if($data != ''){
                // $dados['nome'] = $data['name'];
                // $dados['senha'] = $data['senha'];
                $dados['dados'] = $data;
			}

            // if(isset($_POST['nome']) && !empty($_POST['senha'])) {
            //     $newNome = $_POST['nome'];
            //     $newSenha = $_POST['senha'];

            //     if($u->editarUser($id, $newNome, $newSenha)) {
            //         header('Location: http://localhost/mvc_psr4/');
            //     }
            // }
            }
        $this->loadTemplate('editaUser', $dados);
	}

	public function usuariosDesativados() {
        $array = array();

        
        $array['listagem'] = $this->user->getUsuariosDesativados();
     

        $this->loadTemplate('usersDesativados', $array);
    }

}