<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 12/06/2017
 * Time: 17:08
 */
class vehicule_model
{

    public function __construct()
    {
    }

    public function  loadAllVehiculesExcept($arr_vehicules){
        $strVehicule='(';
        $count = 1;
        foreach ($arr_vehicules as $idVehicule){
            if ($idVehicule != "") {
                if ($count == 1) {
                    $strVehicule .= $idVehicule;
                } else {
                    $strVehicule .= ',' . $idVehicule;
                }
                $count++;
            }
        }
        $strVehicule.=')';

        $obj_bdd=new bdd();
        $champ = '*';
        $table = 'vehicule';
        $condition = 'vehicule_id NOT IN '.$strVehicule;
        $arr_result = $obj_bdd->select($champ, $table, $condition);

        return $this->createVehicules($arr_result);
    }


    public function loadAllVehicules(){
        
        $obj_bdd = new bdd();
        $champ = '*';
        $table = 'vehicule';
        $arr_result = $obj_bdd->select($champ, $table);
        $obj_vehicule = null;
               
        $arr_vehicules=null;
        foreach ($arr_result as $vehicule)
        {
            $obj_vehicule =  new vehicule_entity();
            $obj_vehicule->setIntId($vehicule['vehicule_id']);
            $obj_vehicule->setIntKm($vehicule['vehicule_km']);
            $obj_vehicule->setStrMarque($vehicule['vehicule_marque']);
            $obj_vehicule->setStrModel($vehicule['vehicule_modele']);
            $obj_vehicule->setStrImmatriculation($vehicule['vehicule_immatriculation']);

            if (isset($vehicule['vehicule_etat'])) {
                if ($vehicule['vehicule_etat'] != null) {
                    $obj_etat_controller = new etat_vehicule_controller();
                    $obj_etat = $obj_etat_controller->loadEtatById($vehicule['vehicule_etat']);
                    $obj_vehicule->setObjEtat($obj_etat);
                }
            }
            if (isset($vehicule['vehicule_essence'])) {
                if ($vehicule['vehicule_essence'] != null) {
                    $obj_niveau_carburant_controller = new niveau_carburant_controller();
                    $obj_niveau_carburant = $obj_niveau_carburant_controller->loadNiveauById($vehicule['vehicule_essence']);
                    $obj_vehicule->setObjNiveauCarburant($obj_niveau_carburant);
                }
            }

            if (isset($vehicule['vehicule_type_carburant'])) {
                if ($vehicule['vehicule_type_carburant'] != null) {
                    $obj_vehicule_type_carburant_controller = new type_carburant_controller();
                    $obj_type_carburant = $obj_vehicule_type_carburant_controller->loadTypeCarburantById($vehicule['vehicule_type_carburant']);
                    $obj_vehicule->setObjTypeCarburant($obj_type_carburant);
                }
            }
            $arr_vehicules[] = $obj_vehicule;
        }


        return $arr_vehicules;
        
    }

    public function createVehicules($vehicules){

        foreach ($vehicules as $vehicule)
        {
            $obj_vehicule =  new vehicule_entity();
            $obj_vehicule->setIntId($vehicule['vehicule_id']);
            $obj_vehicule->setIntKm($vehicule['vehicule_km']);
            $obj_vehicule->setStrMarque($vehicule['vehicule_marque']);
            $obj_vehicule->setStrModel($vehicule['vehicule_modele']);
            $obj_vehicule->setStrImmatriculation($vehicule['vehicule_immatriculation']);

            if (isset($vehicule['vehicule_etat'])) {
                if ($vehicule['vehicule_etat'] != null) {
                    $obj_etat_controller = new etat_vehicule_controller();
                    $obj_etat = $obj_etat_controller->loadEtatById($vehicule['vehicule_etat']);
                    $obj_vehicule->setObjEtat($obj_etat);
                }
            }
            if (isset($vehicule['vehicule_essence'])) {
                if ($vehicule['vehicule_essence'] != null) {
                    $obj_niveau_carburant_controller = new niveau_carburant_controller();
                    $obj_niveau_carburant = $obj_niveau_carburant_controller->loadNiveauById($vehicule['vehicule_essence']);
                    $obj_vehicule->setObjNiveauCarburant($obj_niveau_carburant);
                }
            }
            if (isset($vehicule['vehicule_carburant'])) {
                if ($vehicule['vehicule_carburant'] != null) {
                    $obj_type_carburant_controller = new type_carburant_controller();
                    $obj_type_carburant = $obj_type_carburant_controller->loadTypeCarburantById($vehicule['vehicule_type_carburant']);
                    $obj_vehicule->setObjTypeCarburant($obj_type_carburant);
                }
            }
            $arr_vehicules[] = $obj_vehicule;
        }


        return $arr_vehicules;
    }


    public function getVehiculeById($id){
        
        $obj_bdd = new bdd();
        $champ = '*';
        $table = 'vehicule';
        $condition='vehicule_id = "'.$id.'"';
        $arr_result = $obj_bdd->select($champ, $table,$condition);
        
        foreach ($arr_result as $vehicule)
        {
            $obj_vehicule =  new vehicule_entity();
            $obj_vehicule->setIntId($vehicule['vehicule_id']);
            $obj_vehicule->setIntKm($vehicule['vehicule_km']);
            $obj_vehicule->setStrMarque($vehicule['vehicule_marque']);
            $obj_vehicule->setStrModel($vehicule['vehicule_modele']);
            $obj_vehicule->setStrImmatriculation($vehicule['vehicule_immatriculation']);

            if (isset($vehicule['vehicule_etat'])) {
                if ($vehicule['vehicule_etat'] != null) {
                    $obj_etat_controller = new etat_vehicule_controller();
                    $obj_etat = $obj_etat_controller->loadEtatById($vehicule['vehicule_etat']);
                    $obj_vehicule->setObjEtat($obj_etat);
                }
            }

            if (isset($vehicule['vehicule_essence'])) {
                if ($vehicule['vehicule_essence'] != null) {
                    $obj_niveau_carburant_controller = new niveau_carburant_controller();
                    $obj_niveau_carburant = $obj_niveau_carburant_controller->loadNiveauById($vehicule['vehicule_essence']);
                    $obj_vehicule->setObjNiveauCarburant($obj_niveau_carburant);
                }
            }
            if (isset($vehicule['vehicule_type_carburant'])) {
                if ($vehicule['vehicule_type_carburant'] != null) {
                    $obj_vehicule_type_carburant_controller = new type_carburant_controller();
                    $obj_type_carburant = $obj_vehicule_type_carburant_controller->loadTypeCarburantById($vehicule['vehicule_type_carburant']);
                    $obj_vehicule->setObjTypeCarburant($obj_type_carburant);
                }
            }
        }
        return $obj_vehicule;
        
        
    }
    
    public function getVehicule($arr_vehicules,$id){
        
        foreach ($arr_vehicules as $vehicule) {
            
            if($vehicule->getIntId()==$id){
                return $vehicule;
            }
        }
        return null;
    }




    public function saveVehicule($obj_vehicule)
    {//echo'<br><br><br><pre>';var_dump($obj_vehicule);echo'</pre>';
        $obj_bd = new bdd();
        $table = 'vehicule';
        $km = str_replace(' ', '', $obj_vehicule->getIntKm());
        $arra_champ_value['vehicule_km'] = $km;
        $arra_champ_value['vehicule_marque'] = '\''.$obj_vehicule->getStrMarque().'\'';
        $arra_champ_value['vehicule_modele'] = '\''.$obj_vehicule->getStrModel().'\'';
        $arra_champ_value['vehicule_immatriculation'] = '\''.$obj_vehicule->getStrImmatriculation().'\'';

        if ($obj_vehicule->getObjEtat() != null){
            if ($obj_vehicule->getObjEtat()->getIntId() != 0){
                $arra_champ_value['vehicule_etat'] = $obj_vehicule->getObjEtat()->getIntId();}
        }
        if ($obj_vehicule->getObjTypeCarburant() != null){
            if ($obj_vehicule->getObjTypeCarburant()->getIntId() != 0){
                $arra_champ_value['vehicule_type_carburant'] = $obj_vehicule->getObjTypeCarburant()->getIntId();}
        }
        if ($obj_vehicule->getObjNiveauCarburant() != null){
            if ($obj_vehicule->getObjNiveauCarburant()->getIntId() != 0){
                $arra_champ_value['vehicule_essence'] = $obj_vehicule->getObjNiveauCarburant()->getIntId();}
        }

        if ($obj_vehicule->getIntId() != null )
        {
            $condition = 'vehicule_id = "'.$obj_vehicule->getIntId().'"';
            $arra_champ_value['vehicule_id'] = $obj_vehicule->getIntId();
            $obj_bd->update($table, $arra_champ_value, $condition);
        }
        else
        {
            $obj_bd->insert($table, $arra_champ_value);
        }
    }
    public function deleteVehicule ($id)
    {
        $obj_bdd = new bdd();
        $champ = 'document_name';
        $table = 'document';
        $condition = 'document_vehicule = "'.$id.'"';
        $arr_result = $obj_bdd->select($champ, $table, $condition);
        foreach ($arr_result as $name)
        {
            unlink('./upload/'.$name["document_name"]);
        }
        //suppression des documents de l'utilisateur de la base
        $obj_bdd = new bdd();
        $table = 'document';
        $condition = 'document_vehicule =  "'.$id.'"';
        $res_req = $obj_bdd->delete($table, $condition);
        $obj_bdd = new bdd();
        //$champ = '*';
        $table = 'vehicule';
        $condition = 'vehicule_id = "'.$id.'"';
        $res_req = $obj_bdd->delete($table, $condition);
        if($res_req){
            return 'delete';
        }else{
            return 'delete-fail';
        }
        return $res_req;
    }

    public function deleteCgOf($vehiculeId)
    {
        $obj_bdd = new bdd();
        $champ = 'document_name';
        $table = 'document';
        $condition = 'document_vehicule = "'.$vehiculeId.'"';
        $arr_result = $obj_bdd->select($champ, $table, $condition);
        foreach ($arr_result as $name)
        {
            unlink('./upload/'.$name["document_name"]);
        }
        //suppression des documents de l'utilisateur de la base
        $obj_bdd = new bdd();
        $table = 'document';
        $condition = 'document_vehicule =  "'.$vehiculeId.'"';
        $res_req = $obj_bdd->delete($table, $condition);
    }

    public function loadVehiculeByMarqueModelImmat($marque, $model, $immat){

        $obj_bdd = new bdd();
        $champ = '*';
        $table = 'vehicule';
        $condition='vehicule_marque = "'.$marque.'" AND vehicule_modele = "'.$model.'" AND vehicule_immatriculation = "'.$immat.'"';
        $arr_result = $obj_bdd->select($champ, $table,$condition);

        foreach ($arr_result as $vehicule)
        {
            $obj_vehicule =  new vehicule_entity();
            $obj_vehicule->setIntId($vehicule['vehicule_id']);
            $obj_vehicule->setIntKm($vehicule['vehicule_km']);
            $obj_vehicule->setStrMarque($vehicule['vehicule_marque']);
            $obj_vehicule->setStrModel($vehicule['vehicule_modele']);
            $obj_vehicule->setStrImmatriculation($vehicule['vehicule_immatriculation']);

            if (isset($vehicule['vehicule_etat'])) {
                if ($vehicule['vehicule_etat'] != null) {
                    $obj_etat_controller = new etat_vehicule_controller();
                    $obj_etat = $obj_etat_controller->loadEtatById($vehicule['vehicule_etat']);
                    $obj_vehicule->setObjEtat($obj_etat);
                }
            }

            if (isset($vehicule['vehicule_essence'])) {
                if ($vehicule['vehicule_essence'] != null) {
                    $obj_niveau_carburant_controller = new niveau_carburant_controller();
                    $obj_niveau_carburant = $obj_niveau_carburant_controller->loadNiveauById($vehicule['vehicule_essence']);
                    $obj_vehicule->setObjNiveauCarburant($obj_niveau_carburant);
                }
            }
            if (isset($vehicule['vehicule_type_carburant'])) {
                if ($vehicule['vehicule_type_carburant'] != null) {
                    $obj_vehicule_type_carburant_controller = new type_carburant_controller();
                    $obj_type_carburant = $obj_vehicule_type_carburant_controller->loadTypeCarburantById($vehicule['vehicule_type_carburant']);
                    $obj_vehicule->setObjTypeCarburant($obj_type_carburant);
                }
            }
        }
        return $obj_vehicule;


    }
}