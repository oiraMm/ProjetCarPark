<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 12/06/2017
 * Time: 17:32
 */
class reservation_controller
{
    //attribut privé de la classe
    //controller et model de la classe
    private $obj_reservation_model;
    private $obj_reservation_viewer;
    public function __construct($str_action = "", $roleId)
    {
        $this->obj_reservation_model = new reservation_model();
        $this->obj_reservation_viewer = new reservation_viewer();
    }
}