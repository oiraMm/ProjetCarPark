<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 12/06/2017
 * Time: 17:08
 */
class vehicule_controller
{
    //attribut privé de la classe
    //controller et model de la classe
    private $obj_vehicule_model;
    private $obj_vehicule_viewer;
    public function __construct($str_action = "", $roleId)
    {
        $this->obj_vehicule_model = new vehicule_model();
        $this->obj_vehicule_viewer = new vehicule_viewer();
    }

    /**
     * @return vehicule_model
     */
    public function getObjVehiculeModel(): vehicule_model
    {
        return $this->obj_vehicule_model;
    }

    /**
     * @param vehicule_model $obj_vehicule_model
     */
    public function setObjVehiculeModel(vehicule_model $obj_vehicule_model)
    {
        $this->obj_vehicule_model = $obj_vehicule_model;
    }

    /**
     * @return vehicule_viewer
     */
    public function getObjVehiculeViewer(): vehicule_viewer
    {
        return $this->obj_vehicule_viewer;
    }

    /**
     * @param vehicule_viewer $obj_vehicule_viewer
     */
    public function setObjVehiculeViewer(vehicule_viewer $obj_vehicule_viewer)
    {
        $this->obj_vehicule_viewer = $obj_vehicule_viewer;
    }


}