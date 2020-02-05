<?php
namespace Models;

use Core\Model;
use Models\Arquivo;

class ArquivoDAO extends Model {

    public function getAll(){

        $sql = $this->db->query("SELECT * FROM arquivos");
        $sql->execute();

        $resultado = $sql->fetchAll(\PDO::FETCH_OBJ);
        return $resultado;
    }

    public function meusArquivosAdminPag($id_de,$id_para,$p,$qt_por_pag){
        $sql = $this->db->prepare("SELECT * FROM arquivos WHERE id_de = :id_de AND id_para = :id_para ORDER BY data_envio DESC");
        // $sql = $this->db->prepare("(SELECT * FROM arquivos WHERE id_de = :id_de AND id_para = :id_para LIMIT $qt_por_pag OFFSET $p) ORDER BY data_envio DESC");
        $sql->bindValue(":id_de", $id_de);
        $sql->bindValue(":id_para", $id_para);
        
        if($sql->execute()){

            $resultado = $sql->fetchAll();
            return $resultado;
        } else{
            return false;
        }       
    } 

    public function getTotalArquivos($id_de){
        $sql = $this->db->prepare("SELECT COUNT(id) as contagem FROM arquivos WHERE id_para ='1' AND id_de = :id_de");
        $sql->bindValue(":id_de", $id_de);
	
		if($sql->execute()){

		$result = $sql->fetch();
		
		return $result;
	} else{
		return false;
		}
    } 
    
    public function addArquivo($id_de,$id_para,$link,$comentario){
        $sql = $this->db->prepare("INSERT INTO arquivos (id_de,id_para,url,comentario,data_envio) VALUES (:id_de, :id_para, :link, :comentario, NOW())");
        $sql->bindValue(":id_de", $id_de);
        $sql->bindValue(":id_para", $id_para);
        $sql->bindValue(":link", $link);
        $sql->bindValue(":comentario", $comentario);
        
        if($sql->execute()){

            return true;
        } else{
            return false;
        }   
    }

    public function userArquivos($id_para){
        $sql = $this->db->prepare("SELECT * FROM arquivos WHERE id_para = :id_para");
        $sql->bindValue(":id_para", $id_para);
        
        if($sql->execute()){

            $resultado = $sql->fetchAll();
            return $resultado;
        } else{
            return false;
        }       
    }
}