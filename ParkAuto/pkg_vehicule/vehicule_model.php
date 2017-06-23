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
            
            
            //$obj_vehicule->setObjEtat(['']);
            //$obj_vehicule->setObjNiveauCarburant(['']);
            
            $arr_vehicules[] = $obj_vehicule;
        }


        return $arr_vehicules;
        
    }
    
    public function getVehicule($arr_vehicules,$id){
        
        foreach ($arr_vehicules as $vehicule) {
            
            if($vehicule->getIntId()==$id){
                return $vehicule;
            }
        }
        return null;
    }
    
}