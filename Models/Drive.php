<?php


namespace Models;


use Core\Model;

class Drive extends Model {
    private $id;
    private $id_user;
    private $url;
    private $dt_envio;

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

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    public function getDtEnvio()
    {
        return $this->dt_envio;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function setDtEnvio($dt_envio)
    {
        $this->dt_envio = $dt_envio;
    }



}