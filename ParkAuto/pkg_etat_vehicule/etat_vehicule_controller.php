<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 12/06/2017
 * Time: 17:03
 */
class etat_vehicule_controller
{
    //attribut privé de la classe
    //controller et model de la classe
    private $obj_etat_vehicule_model;
    private $obj_etat_vehicule_viewer;
    public function __construct($str_action = "", $roleId)
    {
        $this->obj_etat_vehicule_model = new etat_vehicule_model();
        $this->obj_etat_vehicule_viewer = new etat_vehicule_viewer();
    }

    /**
     * @return etat_vehicule_model
     */
    public function getObjEtatVehiculeModel()
    {
        return $this->obj_etat_vehicule_model;
    }

    /**
     * @param etat_vehicule_model $obj_etat_vehicule_model
     */
    public function setObjEtatVehiculeModel(etat_vehicule_model $obj_etat_vehicule_model)
    {
        $this->obj_etat_vehicule_model = $obj_etat_vehicule_model;
    }

    /**
     * @return etat_vehicule_viewer
     */
    public function getObjEtatVehiculeViewer()
    {
        return $this->obj_etat_vehicule_viewer;
    }

    /**
     * @param etat_vehicule_viewer $obj_etat_vehicule_viewer
     */
    public function setObjEtatVehiculeViewer(etat_vehicule_viewer $obj_etat_vehicule_viewer)
    {
        $this->obj_etat_vehicule_viewer = $obj_etat_vehicule_viewer;
    }

}