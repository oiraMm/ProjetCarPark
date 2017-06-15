<?php

/**
 * Created by PhpStorm.
 * User: Yael
 * Date: 06/06/2017
 * Time: 14:57
 */
class service_controller
{

    //attribut privé de la classe
    //controller et model de la classe
    private $obj_service_model;
    private $obj_service_viewer;
    public function __construct($str_action = "")
    {
        $this->obj_service_model = new service_model();
        $this->obj_service_viewer = new service_viewer();
    }

    /**
     * @return service_model
     */
    public function getObjServiceModel()
    {
        return $this->obj_service_model;
    }

    /**
     * @param service_model $obj_service_model
     */
    public function setObjServiceModel(service_model $obj_service_model)
    {
        $this->obj_service_model = $obj_service_model;
    }

    /**
     * @return service_viewer
     */
    public function getObjServiceViewer()
    {
        return $this->obj_service_viewer;
    }

    /**
     * @param service_viewer $obj_service_viewer
     */
    public function setObjServiceViewer(service_viewer $obj_service_viewer)
    {
        $this->obj_service_viewer = $obj_service_viewer;
    }

}