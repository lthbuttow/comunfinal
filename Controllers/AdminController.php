<?php
namespace Controllers;

use \Core\Controller;
use \Models\Usuario;
use \Models\UsuarioDAO;
use \Models\MensagemDAO;

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
        
        $msg = new MensagemDAO();

        $idUser = $_SESSION['login'];
        
        $array['nrMsgs'] = $msg->getStatusMsg();
 
		$this->loadTemplate('adminHome', $array);
    }
   
    
	public function mensagem() {
        $array = array();
        
        $msg = new MensagemDAO();

        
        $array['msgs'] = $msg->getAll();
 
		$this->loadTemplate('msg', $array);
    }

    public function listagemUsuarios() {
        $array = array();

        $total_users = $this->user->getTotalUsuarios();
        $total_users = $total_users['contagem'];
        $qt_por_pag = 6;
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