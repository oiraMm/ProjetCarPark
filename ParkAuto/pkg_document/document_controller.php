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
    public function __construct()
    {
        $this->obj_document_model = new document_model();
        $this->obj_document_viewer = new document_viewer();
    }

    /**
     * @return document_model
     */
    public function getObjDocumentModel()
    {
        return $this->obj_document_model;
    }

    /**
     * @param document_model $obj_document_model
     */
    public function setObjDocumentModel(document_model $obj_document_model)
    {
        $this->obj_document_model = $obj_document_model;
    }

    /**
     * @return document_viewer
     */
    public function getObjDocumentViewer()
    {
        return $this->obj_document_viewer;
    }

    /**
     * @param document_viewer $obj_document_viewer
     */
    public function setObjDocumentViewer(document_viewer $obj_document_viewer)
    {
        $this->obj_document_viewer = $obj_document_viewer;
    }

    public function saveDocument($document)
    {
        $this->obj_document_model->saveDocument($document);
    }

    public function loadPathPermi($userId)
    {
        return $this->obj_document_model->loadPathPermi($userId);
    }

}