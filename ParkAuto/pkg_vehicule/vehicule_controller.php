<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 12/06/2017
 * Time: 17:08
 */
class vehicule_controller
{
    //attribut privé de la classe
    //controller et model de la classe
    private $obj_vehicule_model;
    private $obj_vehicule_viewer;
    public function __construct($str_action = "")
    {
        $this->obj_vehicule_model = new vehicule_model();
        $this->obj_vehicule_viewer = new vehicule_viewer();
    }

    public function saveVehicule($obj_vehicule){
        $this->getObjVehiculeModel()->saveVehicule($obj_vehicule);
    }

    public function getTemplateCrudVehicule()
    {
        if (isset($_POST['DeleteCG']))
        {
            $delete = $this->getObjVehiculeModel()->deleteCgOf($_POST['idVehicule']);
            if (isset($_POST['mode'])) {
                if ($_POST['mode'] != 'delete') {
                    $_POST['mode'] = 'edit';
                }
            }
            else{
                $_POST['mode'] = 'edit';
            }
            $_POST['idVehiculeEdit'] = $_POST['idVehicule'];
        }
        if (isset($_POST['mode']))
        {
            switch ($_POST['mode']) {
                case 'edit' :
                    $str_template = $this->obj_vehicule_viewer->templateCrudVehicule('edit', $_POST['idVehiculeEdit']);
                    break;
                case 'add' :
                    $str_template = $this->obj_vehicule_viewer->templateCrudVehicule('add');
                    break;
                case 'visu' :
                    $arr_vehicule = $this->obj_vehicule_model->loadAllVehicules();
                    $str_template = $this->obj_vehicule_viewer->templateCrudVehiculeDefault($arr_vehicule,'visu');
                    break;
                case 'delete' :
                    $delete = $this->getObjVehiculeModel()->deleteVehicule($_POST['idVehiculeDelete']);
                    $arr_vehicule = $this->obj_vehicule_model->loadAllVehicules();
                    $str_template = $this->obj_vehicule_viewer->templateCrudVehiculeDefault($arr_vehicule);
                    break;
            }
        }
        elseif (isset($_POST['vehiculeMode']))
        {
            $obj_vehicule = $this->retrievePostData();
            $save = $this->getObjVehiculeModel()->saveVehicule($obj_vehicule);
            if (isset($_FILES["cg"]))
            {
                if ($_FILES["cg"]["name"])
                {
                    $obj_document = $this->retrieveUploadFilesData($obj_vehicule);
                    $obj_document_controller=new document_controller();
                    $obj_document_controller->saveDocument($obj_document);
                }
            }
            $arr_vehicule = $this->obj_vehicule_model->loadAllVehicules();
            $str_template = $this->obj_vehicule_viewer->templateCrudVehiculeDefault($arr_vehicule);
        }
        else
        {
            $arr_vehicule = $this->obj_vehicule_model->loadAllVehicules();
            $str_template = $this->obj_vehicule_viewer->templateCrudVehiculeDefault($arr_vehicule);
        }
        return $str_template;
    }


    public function retrieveUploadFilesData($obj_vehicule_temp)
    {
        //recupération de l'id
        $obj_vehicule = $this->obj_vehicule_model->loadVehiculeByMarqueModelImmat($obj_vehicule_temp->getStrMarque(), $obj_vehicule_temp->getStrModel(), $obj_vehicule_temp->getStrImmatriculation());
        $obj_document = new document_entity();
        $obj_document->setObjVehicule($obj_vehicule);
        $arra_name = explode(".", $_FILES["cg"]["name"]);
        $today = date('j-m-y-h-i-s');
        $file_name = $arra_name[0].$today.'.'.$arra_name[1];
        $obj_document->setStrName($file_name);
        $stri_path = "/upload/".$file_name;
        $obj_document->setStrPath($stri_path);
        move_uploaded_file($_FILES["cg"]["tmp_name"], "./".$stri_path);
        return $obj_document;
    }

    public function retrievePostData()
    {
        $obj_vehicule = new vehicule_entity();
        $obj_vehicule->setIntId($_POST['idVehicule']);
        $obj_vehicule->setStrMarque($_POST['marqueSaisi']);
        $obj_vehicule->setStrModel($_POST['modeleSaisi']);
        $obj_vehicule->setStrImmatriculation($_POST['immatriculationSaisi']);
        $obj_vehicule->setIntKm($_POST['kilometrageSaisi']);
        $obj_type_carburant_controller = new type_carburant_controller();
        $obj_vehicule->setObjTypeCarburant($obj_type_carburant_controller->loadTypeCarburantById($_POST['type']));
        $obj_niveau_essence = new niveau_carburant_controller();
        $obj_vehicule->setObjNiveauCarburant($obj_niveau_essence->loadNiveauById($_POST['niveau']));
        $obj_etat_controller = new etat_vehicule_controller();
        $obj_vehicule->setObjEtat($obj_etat_controller->loadEtatById($_POST['etat']));
        return $obj_vehicule;
    }

    public function getVehicule($arr_vehicules,$id){
        $mdl_vehicule=new vehicule_model();
        return $mdl_vehicule->getVehicule($arr_vehicules,$id);
    }
    
    public function getAllVehicules() {
        $mdl_vehicule=new vehicule_model();
        return $mdl_vehicule->loadAllVehicules();
        
    }

    //Permet de récupérer tous les véhicules excepté ceux présents dans le tableau d'identifiants $arr_vehicules
    public function getAllVehiculeExcept($arr_vehicules){
        $mdl_vehicule=new vehicule_model();
        return $mdl_vehicule->loadAllVehiculesExcept($arr_vehicules);
    }
    /**
     * @return vehicule_model
     */
    public function getObjVehiculeModel()
    {
        return $this->obj_vehicule_model;
    }

    /**
     * @param vehicule_model $obj_vehicule_model
     */
    public function setObjVehiculeModel(vehicule_model $obj_vehicule_model)
    {
        $this->obj_vehicule_model = $obj_vehicule_model;
    }

    /**
     * @return vehicule_viewer
     */
    public function getObjVehiculeViewer()
    {
        return $this->obj_vehicule_viewer;
    }

    /**
     * @param vehicule_viewer $obj_vehicule_viewer
     */
    public function setObjVehiculeViewer(vehicule_viewer $obj_vehicule_viewer)
    {
        $this->obj_vehicule_viewer = $obj_vehicule_viewer;
    }
    
    //Get un véhicule via son id
    public function getVehiculeById($id){
        return $this->obj_vehicule_model->getVehiculeById($id);
    }


}