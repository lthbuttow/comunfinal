<?php
namespace Controllers;

use \Core\Controller;
use \Models\Usuario;
use \Models\UsuarioDAO;

class HomeController extends Controller {
	
	public function __construct() {
		parent::__construct();

	}
	
	public function index() {
		$array = array();

		// $usuarios = new Usuarios();
		// $array['lista'] = $usuarios->getAll();

		// $array['teste'] = 'blade muito louco';
 
		$this->loadTemplate('home', $array);
	}

}