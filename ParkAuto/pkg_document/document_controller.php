<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 12/06/2017
 * Time: 17:16
 */
class document_controller
{
    //attribut privé de la classe
    //controller et model de la classe
    private $obj_document_model;
    private $obj_document_viewer;
    public function __construct($str_action = "", $roleId)
    {
        $this->obj_document_model = new document_model();
        $this->obj_document_viewer = new document_viewer();
    }
}