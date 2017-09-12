<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 12/06/2017
 * Time: 17:28
 */
class status_reservation_controller
{
    //attribut privé de la classe

    //controller et model de la classe
    private $obj_status_reservation_model;
    private $obj_status_reservation_viewer;
    public function __construct($str_action = "")
    {
        $this->obj_status_reservation_model = new status_reservation_model();
        $this->obj_status_reservation_viewer = new status_reservation_viewer();
    }

    /**
     * @return status_reservation_model
     */
    public function getObjStatusReservationModel()
    {
        return $this->obj_status_reservation_model;
    }

    /**
     * @param status_reservation_model $obj_status_reservation_model
     */
    public function setObjStatusReservationModel(status_reservation_model $obj_status_reservation_model)
    {
        $this->obj_status_reservation_model = $obj_status_reservation_model;
    }

    /**
     * @return status_reservation_viewer
     */
    public function getObjStatusReservationViewer()
    {
        return $this->obj_status_reservation_viewer;
    }

    /**
     * @param status_reservation_viewer $obj_status_reservation_viewer
     */
    public function setObjStatusReservationViewer(status_reservation_viewer $obj_status_reservation_viewer)
    {
        $this->obj_status_reservation_viewer = $obj_status_reservation_viewer;
    }

    public function getAllStatus(){
        return $this->obj_status_reservation_model->getAllStatus();
    }

    public function getStatusWithID($arr_status,$id){
        return $this->obj_status_reservation_model->getStatus($arr_status,$id);
    }
    public function getStatusByID($id){
        return $this->obj_status_reservation_model->getStatusByID($id);
    }

}