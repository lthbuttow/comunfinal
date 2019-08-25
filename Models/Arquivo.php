<?php


namespace Models;


use Core\Model;

class Arquivo extends Model {
    private $id;
    private $id_de;
    private $id_para;
    private $url;
    private $checked;
    private $comentario;
    private $data_envio;

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

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getChecked()
    {
        return $this->checked;
    }

    public function setChecked($checked)
    {
        $this->checked = $checked;
    }

    public function getComentario()
    {
        return $this->comentario;
    }

    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }

    public function getDataEnvio()
    {
        return $this->data_envio;
    }

    public function setDataEnvio($data_envio)
    {
        $this->data_envio = $data_envio;
    }


}