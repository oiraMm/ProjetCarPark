<?php

/**
 * Created by PhpStorm.
 * User: Yael
 * Date: 06/06/2017
 * Time: 14:57
 */
class service_entity
{
    //attribut privé de la classe
    private $int_id;
    private $str_libelle;
    private $obj_chef;

    /**
     * @return mixed
     */
    public function getIntId()
    {
        return $this->int_id;
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
    public function getObjChef()
    {
        return $this->obj_chef;
    }

    /**
     * @param mixed $obj_chef
     */
    public function setObjChef($obj_chef)
    {
        $this->obj_chef = $obj_chef;
    }


}