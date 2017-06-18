<?php

/**
 * Created by PhpStorm.
 * User: Yael
 * Date: 06/06/2017
 * Time: 14:58
 */
class service_model
{
    public function serviceOf($id)
    {
        //charge les donné de la news dont l'id est passez en paramètre
        $obj_bdd = new bdd();
        $champ = '*';
        $table = 'service';
        $condition = 'service_id = "'.$id.'"';
        $arr_result = $obj_bdd->select($champ, $table, $condition);
        $obj_service =  new service_entity();
        if (isset($arr_result[0]))
        {
            if ($arr_result[0] != null)
            {
                $obj_service->setIntId($arr_result[0]['service_id']);
                $obj_service->setStrLibelle($arr_result[0]['service_libelle']);
                //instancie le modele de l'objet utilisateur
                $obj_utilisateur_controller = new utilisateur_controller();
                //utilise le model charger pour charger l'objet role de l'utilisateur
                $obj_utilisateur = $obj_utilisateur_controller->getObjUtilisateurModel()->loadUtilisateurById($arr_result[0]['service_chef']);
                $obj_service->setObjChef($obj_utilisateur);
            }
        }
        return $obj_service;
    }
    public function loadAllService()
    {
        //charge les donné de la news dont l'id est passez en paramètre
        $obj_bdd = new bdd();
        $champ = '*';
        $table = 'service';
        $arr_result = $obj_bdd->select($champ, $table);
        $arr_service = null;
        foreach ($arr_result as $oneService)
        {
            $obj_service =  new service_entity();
            $obj_service->setIntId($oneService['service_id']);
            $obj_service->setStrLibelle($oneService['service_libelle']);
            //instancie le modele de l'objet utilisateur
            $obj_utilisateur_controller = new utilisateur_controller();
            //utilise le model charger pour charger l'objet role de l'utilisateur
            $obj_utilisateur = $obj_utilisateur_controller->getObjUtilisateurModel()->loadUtilisateurById($oneService['service_chef']);
            $obj_service->setObjChef($obj_utilisateur);
            $arr_service[] = $obj_service;
        }
        return $arr_service;
    }

}