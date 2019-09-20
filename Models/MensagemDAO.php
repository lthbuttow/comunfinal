<?php
namespace Models;

use Core\Model;
use Models\Mensagem;

class MensagemDAO extends Model {

    public function getAll(){

        $sql = $this->db->query("SELECT * FROM mensagens");
        $sql->execute();

        $resultado = $sql->fetchAll(\PDO::FETCH_OBJ);
        return $resultado;
    }

    public function enviarMensagem($mensagem) {

        $sql = $this->db->prepare("INSERT INTO mensagens (email, mensagem) VALUES (:email, :mensagem)");
        $sql->bindValue(":email", $mensagem->getEmail());
        $sql->bindValue(":mensagem", $mensagem->getMensagem());


        if($sql->execute()) {

            return true;
        } else {
            return false;
        }

    }

    public function getStatusMsg(){

		$sql = $this->db->query("SELECT * FROM mensagens WHERE checked = '0'");
		$sql->execute();

		$resultado = $sql->rowCount();
		return $resultado;
    }

    public function atualizaStatus(){
        $sql = $this->db->query("UPDATE mensagens SET checked = '1' WHERE checked = '0'");
		if($sql->execute()){            
            return true;
        } else{
            return false;
            }  
    }
}