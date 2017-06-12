<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 12/06/2017
 * Time: 17:07
 */
class vehicule_entity
{
    private $int_id;
    private $int_km;
    private $str_marque;
    private $str_model;
    private $str_immatriculation;
    private $obj_etat;
    private $obj_niveau_carburant;

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
    public function getIntKm()
    {
        return $this->int_km;
    }

    /**
     * @param mixed $int_km
     */
    public function setIntKm($int_km)
    {
        $this->int_km = $int_km;
    }

    /**
     * @return mixed
     */
    public function getStrMarque()
    {
        return $this->str_marque;
    }

    /**
     * @param mixed $str_marque
     */
    public function setStrMarque($str_marque)
    {
        $this->str_marque = $str_marque;
    }

    /**
     * @return mixed
     */
    public function getStrModel()
    {
        return $this->str_model;
    }

    /**
     * @param mixed $str_model
     */
    public function setStrModel($str_model)
    {
        $this->str_model = $str_model;
    }

    /**
     * @return mixed
     */
    public function getStrImmatriculation()
    {
        return $this->str_immatriculation;
    }

    /**
     * @param mixed $str_immatriculation
     */
    public function setStrImmatriculation($str_immatriculation)
    {
        $this->str_immatriculation = $str_immatriculation;
    }

    /**
     * @return mixed
     */
    public function getObjEtat()
    {
        return $this->obj_etat;
    }

    /**
     * @param mixed $obj_etat
     */
    public function setObjEtat($obj_etat)
    {
        $this->obj_etat = $obj_etat;
    }

    /**
     * @return mixed
     */
    public function getObjNiveauCarburant()
    {
        return $this->obj_niveau_carburant;
    }

    /**
     * @param mixed $obj_niveau_carburant
     */
    public function setObjNiveauCarburant($obj_niveau_carburant)
    {
        $this->obj_niveau_carburant = $obj_niveau_carburant;
    }


}