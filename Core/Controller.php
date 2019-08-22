<?php
namespace Core;

require "vendor/autoload.php";

Use eftec\bladeone\BladeOne;

define("BLADEONE_MODE",1);

class Controller {
 
	protected $blade;

	public function __construct($views = 'Views', $cache = 'cache') {
		$this->blade = new bladeone($views,$cache);
	} 
	public function loadView($viewName, $viewData = array()) {
		extract($viewData);
		require 'Views/'.$viewName.'.php';
	}

	public function loadTemplate($viewName, $viewData = array()) {
		require 'Views/template.blade.php';
	}

	public function loadViewInTemplate($viewName, $viewData = array()) {
		echo $this->blade->run($viewName, $viewData);
	}

}