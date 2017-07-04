<?php

/**
 * Created by PhpStorm.
 * User: Yael
 * Date: 28/06/2017
 * Time: 11:27
 */
class type_carburant_controller
{
    //attribut privé de la classe
    //controller et model de la classe
    private $obj_type_carburant_model;
    private $obj_type_carburant_viewer;
    public function __construct($str_action = "")
    {
        $this->obj_type_carburant_model = new type_carburant_model();
        $this->obj_type_carburant_viewer = new type_carburant_viewer();
    }

    public function loadTypeCarburantById($id)
    {
        $obj_type_carburant = $this->getObjTypeCarburantModel()->loadTypeCarburantById($id) ;
        return $obj_type_carburant;
    }

    public function getAllTypeCarburant ()
    {
        $arra_type_carburant = $this->getObjTypeCarburantModel()->loadAllTypeCarburant();
        return $arra_type_carburant;
    }

    /**
     * @return type_carburant_model
     */
    public function getObjTypeCarburantModel()
    {
        return $this->obj_type_carburant_model;
    }

    /**
     * @param type_carburant_model $obj_type_carburant_model
     */
    public function setObjTypeCarburantModel($obj_type_carburant_model)
    {
        $this->obj_type_carburant_model = $obj_type_carburant_model;
    }

    /**
     * @return type_carburant_viewer
     */
    public function getObjTypeCarburantViewer()
    {
        return $this->obj_type_carburant_viewer;
    }

    /**
     * @param type_carburant_viewer $obj_type_carburant_viewer
     */
    public function setObjTypeCarburantViewer($obj_type_carburant_viewer)
    {
        $this->obj_type_carburant_viewer = $obj_type_carburant_viewer;
    }

}