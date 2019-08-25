<?php


namespace Models;


use Core\Model;

class Conversa extends Model {
    private $id;
    private $id_de;
    private $id_para;
    private $mensagem;
    private $checked;

    public function __construct() {
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdDe()
    {
        return $this->id_de;
    }

    public function setIdDe($id_de)
    {
        $this->id_de = $id_de;
    }

    public function getIdPara()
    {
        return $this->id_para;
    }

    public function setIdPara($id_para)
    {
        $this->id_para = $id_para;
    }

    public function getMensagem()
    {
        return $this->mensagem;
    }

    public function setMensagem($mensagem)
    {
        $this->mensagem = $mensagem;
    }

    public function getChecked()
    {
        return $this->checked;
    }

    public function setChecked($checked)
    {
        $this->checked = $checked;
    }
}