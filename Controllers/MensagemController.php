<?php
namespace Controllers;

use \Core\Controller;
use \Models\Usuario;
use \Models\Mensagem;
use \Models\UsuarioDAO;
use \Models\MensagemDAO;


class MensagemController extends Controller {

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

        
        $array['msgs'] = $msg->getAll();
 
		$this->loadTemplate('msg', $array);
    }

    public function listagem() {
        $array = array();
        
        $msg = new MensagemDAO();

        
        $array['msgs'] = $msg->getAll();
 
		$this->loadTemplate('msg', $array);
    }
}