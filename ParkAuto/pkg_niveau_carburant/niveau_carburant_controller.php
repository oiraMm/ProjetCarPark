<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 12/06/2017
 * Time: 16:59
 */
class niveau_carburant_controller
{
    //attribut privé de la classe
    //controller et model de la classe
    private $obj_niveau_carburant_model;
    private $obj_niveau_carburant_viewer;
    public function __construct($str_action = "", $roleId)
    {
        $this->obj_niveau_carburant_model = new niveau_carburant_model();
        $this->obj_niveau_carburant_viewer = new niveau_carburant_viewer();
    }
}