<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 12/06/2017
 * Time: 17:32
 */
class reservation_entity
{
    private $int_id;
    private $date_debut;
    private $date_fin;
    private $obj_salarie;
    private $obj_vehicule;
    private $obj_status;

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
    public function getDateDebut()
    {
        return $this->date_debut;
    }

    /**
     * @param mixed $date_debut
     */
    public function setDateDebut($date_debut)
    {
        $this->date_debut = $date_debut;
    }

    /**
     * @return mixed
     */
    public function getDateFin()
    {
        return $this->date_fin;
    }

    /**
     * @param mixed $date_fin
     */
    public function setDateFin($date_fin)
    {
        $this->date_fin = $date_fin;
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
    public function getObjStatus()
    {
        return $this->obj_status;
    }

    /**
     * @param mixed $obj_status
     */
    public function setObjStatus($obj_status)
    {
        $this->obj_status = $obj_status;
    }


}