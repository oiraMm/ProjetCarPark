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
    public function __construct($str_action = "")
    {
        $this->obj_niveau_carburant_model = new niveau_carburant_model();
        $this->obj_niveau_carburant_viewer = new niveau_carburant_viewer();
    }

    public function loadNiveauById($id)
    {
        $obj_niveau = $this->getObjNiveauCarburantModel()->loadNiveauById($id);
        return $obj_niveau;
    }

    /**
     * @return niveau_carburant_model
     */
    public function getObjNiveauCarburantModel()
    {
        return $this->obj_niveau_carburant_model;
    }

    /**
     * @param niveau_carburant_model $obj_niveau_carburant_model
     */
    public function setObjNiveauCarburantModel(niveau_carburant_model $obj_niveau_carburant_model)
    {
        $this->obj_niveau_carburant_model = $obj_niveau_carburant_model;
    }

    /**
     * @return niveau_carburant_viewer
     */
    public function getObjNiveauCarburantViewer()
    {
        return $this->obj_niveau_carburant_viewer;
    }

    /**
     * @param niveau_carburant_viewer $obj_niveau_carburant_viewer
     */
    public function setObjNiveauCarburantViewer(niveau_carburant_viewer $obj_niveau_carburant_viewer)
    {
        $this->obj_niveau_carburant_viewer = $obj_niveau_carburant_viewer;
    }

}