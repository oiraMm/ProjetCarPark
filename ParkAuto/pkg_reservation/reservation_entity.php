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
    private $str_raison;
    private $str_com_start;
    private $str_com_current;
    private $str_com_end;




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

    /**
     * @return mixed
     */
    public function getStrRaison()
    {
        return $this->str_raison;
    }

    /**
     * @param mixed $str_raison
     */
    public function setStrRaison($str_raison)
    {
        $this->str_raison = $str_raison;
    }

    /**
     * @return mixed
     */
    public function getStrComStart()
    {
        return $this->str_com_start;
    }

    /**
     * @param mixed $str_com_start
     */
    public function setStrComStart($str_com_start)
    {
        $this->str_com_start = $str_com_start;
    }

    /**
     * @return mixed
     */
    public function getStrComCurrent()
    {
        return $this->str_com_current;
    }

    /**
     * @param mixed $str_com_current
     */
    public function setStrComCurrent($str_com_current)
    {
        $this->str_com_current = $str_com_current;
    }

    /**
     * @return mixed
     */
    public function getStrComEnd()
    {
        return $this->str_com_end;
    }

    /**
     * @param mixed $str_com_end
     */
    public function setStrComEnd($str_com_end)
    {
        $this->str_com_end = $str_com_end;
    }

}