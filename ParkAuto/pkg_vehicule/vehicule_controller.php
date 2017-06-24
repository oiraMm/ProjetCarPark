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
    public function __construct($str_action = "")
    {
        $this->obj_vehicule_model = new vehicule_model();
        $this->obj_vehicule_viewer = new vehicule_viewer();
    }

    
    public function getVehicule($arr_vehicules,$id){
        $mdl_vehicule=new vehicule_model();
        return $mdl_vehicule->getVehicule($arr_vehicules,$id);
    }
    
    public function getAllVehicules() {
        $mdl_vehicule=new vehicule_model();
        return $mdl_vehicule->loadAllVehicules();
        
    }
    /**
     * @return vehicule_model
     */
    public function getObjVehiculeModel()
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
    public function getObjVehiculeViewer()
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
    
    //Get un véhicule via son id
    public function getVehiculeById($id){
        return $this->obj_vehicule_model->getVehiculeById($id);
    }


}