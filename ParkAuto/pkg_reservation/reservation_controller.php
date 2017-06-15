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

    /**
     * @return reservation_model
     */
    public function getObjReservationModel(): reservation_model
    {
        return $this->obj_reservation_model;
    }

    /**
     * @param reservation_model $obj_reservation_model
     */
    public function setObjReservationModel(reservation_model $obj_reservation_model)
    {
        $this->obj_reservation_model = $obj_reservation_model;
    }

    /**
     * @return reservation_viewer
     */
    public function getObjReservationViewer(): reservation_viewer
    {
        return $this->obj_reservation_viewer;
    }

    /**
     * @param reservation_viewer $obj_reservation_viewer
     */
    public function setObjReservationViewer(reservation_viewer $obj_reservation_viewer)
    {
        $this->obj_reservation_viewer = $obj_reservation_viewer;
    }

}