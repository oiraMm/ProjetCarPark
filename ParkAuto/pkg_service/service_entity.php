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
    private $obj_chef;

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