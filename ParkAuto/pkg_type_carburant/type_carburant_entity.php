<?php

/**
 * Created by PhpStorm.
 * User: Yael
 * Date: 28/06/2017
 * Time: 11:27
 */
class type_carburant_entity
{
    //attribut privé de la classe
    private $int_id;
    private $str_libelle;

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
    public function getStrLibelle()
    {
        return $this->str_libelle;
    }

    /**
     * @param mixed $str_libelle
     */
    public function setStrLibelle($str_libelle)
    {
        $this->str_libelle = $str_libelle;
    }



}