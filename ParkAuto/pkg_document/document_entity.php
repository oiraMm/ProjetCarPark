<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 12/06/2017
 * Time: 17:16
 */
class document_entity
{
    private $int_id;
    private $str_name;
    private $str_path;
    private $obj_vehicule;
    private $obj_salarie;

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
    public function getStrName()
    {
        return $this->str_name;
    }

    /**
     * @param mixed $str_name
     */
    public function setStrName($str_name)
    {
        $this->str_name = $str_name;
    }

    /**
     * @return mixed
     */
    public function getStrPath()
    {
        return $this->str_path;
    }

    /**
     * @param mixed $str_path
     */
    public function setStrPath($str_path)
    {
        $this->str_path = $str_path;
    }

    /**
     * @return mixed
     */
    public function getObjVehicule()
    {
        return $this->obj_vehicule;
    }

    /**
     * @param mixed $obj_vehicule
     */
    public function setObjVehicule($obj_vehicule)
    {
        $this->obj_vehicule = $obj_vehicule;
    }

    /**
     * @return mixed
     */
    public function getObjSalarie()
    {
        return $this->obj_salarie;
    }

    /**
     * @param mixed $obj_salarie
     */
    public function setObjSalarie($obj_salarie)
    {
        $this->obj_salarie = $obj_salarie;
    }

}