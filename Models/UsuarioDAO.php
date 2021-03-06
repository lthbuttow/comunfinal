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

	public function adminIsLogged() {

		if(isset($_SESSION['admin']) && $_SESSION['admin'] == 'ativo') {
			return true;
		} else {
			return false;
		}

	}	
	
	public function fazerLogin($email, $senha) {

		$sql = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");		
		$sql->bindValue(":email", $email);
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
	
	public function getAdmin(){
		$sql = $this->db->prepare("SELECT id FROM usuarios WHERE admin = '1'");
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
	
	public function deactiveUser($id) {

		$sql = "UPDATE usuarios SET active = '1' WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);


		if($sql->execute()){

		return true;
	} else{
		return false;
		}

	}

	public function reactivateUser($id) {

		$sql = "UPDATE usuarios SET active = '0' WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);


		if($sql->execute()){

		return true;
	} else{
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
	
	// Admin functions
	public function fazerLoginAdmin($email, $senha) {

		$sql = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha AND admin = 1");		
		$sql->bindValue(":email", $email);
		$sql->bindValue(":senha", $senha);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();

			$_SESSION['login'] = $sql['id'];
			$_SESSION['nome'] = $sql['nome'];
			$_SESSION['admin'] = 'ativo';

			return true;
		} else {
			return false;
		}	

	}

	public function inserirUsuario($nome,$email,$senha){
		$sql = "INSERT INTO usuarios (nome,email,senha) VALUES (:nome,:email,:senha)";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':nome', $nome);
		$sql->bindValue(':email', $email);
		$sql->bindValue(':senha', $senha);
		
		if($sql->execute()){
		
		return true;

	} else{
		return false;
		}		
	}

	public function getDadosEditar($id_user){
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
	public function consultaUsers($user){
		$sql = "SELECT * FROM usuarios WHERE nome LIKE :user AND admin ='0' AND active = '0'";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':user', '%'.$user.'%');
	
		if($sql->execute()){

		$result = $sql->fetchAll();
		
		return $result;
	} else{
		return false;
		}
	}
	// Users pagination
	public function getUsuariosPagination($p,$qt_por_pag){
		$sql = "(SELECT * FROM usuarios WHERE admin ='0' AND active='0' LIMIT $qt_por_pag OFFSET $p) ORDER BY id DESC";
		$sql = $this->db->query($sql);
	
		if($sql){
		$result = $sql->fetchAll();
		
		return $result;
	} else{
		return false;
		}
	}	

	public function getTotalUsuarios(){
		$sql = "SELECT COUNT(id) AS contagem FROM usuarios WHERE admin =0";
		$sql = $this->db->query($sql);
	
		if($sql){

		$result = $sql->fetch();
		
		return $result;
	} else{
		return false;
		}
	}

	public function getEmailDestinario($id_para){
		$sql = "SELECT email FROM usuarios WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id_para);
	
		if($sql->execute()){

		$data = $sql->fetch();
		
		return $data;
	} else{
		return false;
		}
	}

	public function getEmailRemetente($id){
		$sql = "SELECT email FROM usuarios WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);
	
		if($sql->execute()){

		$data = $sql->fetch();
		
		return $data;
	} else{
		return false;
		}
	}
	
	public function getUsuariosDesativados(){
		$sql = "SELECT * FROM usuarios WHERE admin ='0' AND active='1' ORDER BY id DESC";
		$sql = $this->db->query($sql);
	
		if($sql){
		$result = $sql->fetchAll();
		
		return $result;
	} else{
		return false;
		}
	}
	
	public function emailExists($email){
		$sql = "SELECT * FROM usuarios WHERE email = :email";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":email", $email);
		$sql->execute();
	
		if($sql->rowCount() > 0) { 
		$sql = $sql->fetch();
		$id = $sql['id'];

		return $id;
	} else {
		return false;
		}
	}	

	public function createPassRecoverToken($userId, $token, $expiraEm) {
		$sql = "INSERT INTO usuarios_token (id_usuario, hash, expirado_em) VALUES (:id_usuario, :hash, :expirado_em)";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id_usuario", $userId);
		$sql->bindValue(":hash", $token);
		$sql->bindValue(":expirado_em", $expiraEm);
		if($sql->execute()) {
			return true;
		} else {
			return false;
		}
		
	}
}