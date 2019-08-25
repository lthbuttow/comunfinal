<?php
namespace Models;

use \Core\Model;

class Usuario extends Model {
	
    private $id;
    private $nome;
    private $email;
    private $admin;

    public function __construct() {
        
    }
    public function getId() {
        return $this->id;
    }
    public function getNome() {
        return $this->nome;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getAdmin() {
        return $this->admin;
    }    
    public function setId($id) {
        $this->$id = $id;
    }
    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setAdmin($admin) {
        $this->admin = $admin;
    }
}