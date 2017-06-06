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
}