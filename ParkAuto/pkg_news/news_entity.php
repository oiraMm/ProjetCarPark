<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 05/06/2017
 * Time: 15:16
 */
class news_entity
{
    //attribut privé de la classe
    private $int_id;
    private $str_contenu;
    private $obj_auteur;

    /**
     * @return mixed
     */
    public function getIntId()
    {
        return $this->int_id;
    }

    /**
     * @param mixed $int_id
     */
    public function setIntId($int_id)
    {
        $this->int_id = $int_id;
    }

    /**
     * @return mixed
     */
    public function getStrContenu()
    {
        return $this->str_contenu;
    }

    /**
     * @param mixed $str_contenu
     */
    public function setStrContenu($str_contenu)
    {
        $this->str_contenu = $str_contenu;
    }

    /**
     * @return mixed
     */
    public function getObjAuteur()
    {
        return $this->obj_auteur;
    }

    /**
     * @param mixed $str_auteur
     */
    public function setObjAuteur($obj_auteur)
    {
        $this->obj_auteur = $obj_auteur;
    }



}