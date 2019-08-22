<?php
namespace Controllers;

use \Core\Controller;
use \Models\Usuarios;

class ajaxController extends Controller {
	
	public function __construct() {
		parent::__construct();
        $u = new Usuarios();

        if(!$u->isLogged()) {
        	header('Location: http://localhost/projetocomun/');
        }
	}
	

	public function delete() {
		$array = array();

        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = addslashes($_POST['id']);

            $usuario = new Usuarios();
            $usuario->delete($id);
        }
 
	}

}