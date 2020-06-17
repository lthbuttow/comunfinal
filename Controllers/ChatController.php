<?php
namespace Controllers;

use \Core\Controller;
use \Models\Usuario;
use \Models\UsuarioDAO;
use \Models\MensagemDAO;
use \Models\ArquivoDAO;
use \Models\Chat;
use \Models\ChatDAO;

class ChatController extends Controller {
	

  public function conversa($id_para) {

    $array = array();

    $_SESSION['id_para'] = $id_para;
    
 
		$this->loadTemplate('conversa', $array);
  }

}