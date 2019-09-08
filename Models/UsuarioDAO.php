<?php
namespace Models;

use \Core\Model;
use \Model\Usuario;

class UsuarioDAO extends Model {
	
	public function isLogged() {

		if(isset($_SESSION['login']) && !empty($_SESSION['login'])) {
			return true;
		} else {
			return false;
		}

	}
	
	public function fazerLogin($nome, $senha) {

		$sql = $this->db->prepare("SELECT * FROM usuarios WHERE nome = :nome AND senha = :senha");		
		$sql->bindValue(":nome", $nome);
		$sql->bindValue(":senha", $senha);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();

			$_SESSION['login'] = $sql['id'];
			$_SESSION['nome'] = $sql['nome'];

			return true;
		} else {
			return false;
		}	

	}

	public function inserirUser($nome, $senha) {

		$sql = $this->db->prepare("INSERT INTO usuarios (name, senha)  VALUES (:nome, :senha)");		
		$sql->bindValue(":nome", $nome);
		$sql->bindValue(":senha", $senha);

		if($sql->execute()) {

			return true;
		} else {
			return false;
		}	

	}

	public function getDadosEditarUser($id_user){
		$sql = "SELECT * FROM usuarios WHERE id = :id_user";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_user', $id_user);
		
		if($sql->execute()){

		$result = $sql->fetch();
		
		return $result;
	} else{
		return false;
		}
	}
	
	public function editarUser($user){
		$sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha WHERE id = :id_user";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_user', $user->getId());
		$sql->bindValue(':nome', $user->getNome());
		$sql->bindValue(':email', $user->getEmail());
		$sql->bindValue(':senha', $user->getSenha());

		if($sql->execute()){

		return true;
	} else{
		return false;
		}
	}
	
	public function getSenhaPadrao($id_user){
		$sql = $this->db->prepare("SELECT senha FROM usuarios WHERE senha = '12345' AND admin ='0' AND id = :id_user");
		$sql->bindValue(":id_user", $id_user);
	
		if($sql->execute()){
		
		return true;
	} else{
		return false;
		}
	}	
	
	public function delete($id) {

		$sql = $this->db->prepare("DELETE FROM usuarios WHERE id= :id");		
		$sql->bindValue(":id", $id);
		
		if($sql->execute()) {

			return true;
		} else {
			return false;
		}	

	}	

	public function getAll() {
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM usuarios ORDER BY id DESC");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getUser($id) {
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM usuarios WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}	

}