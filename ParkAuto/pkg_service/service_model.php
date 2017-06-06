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
        $str_select = 'SELECT * FROM service WHERE service_id = '.$id;
        $arr_result = $obj_bdd->select($str_select);
        $obj_service =  new service_entity();
        if (isset($arr_result[0]))
        {
            if ($arr_result[0] != null)
            {
                $obj_service->setIntId($arr_result[0]['service_id']);
                //instancie le modele de l'objet utilisateur
                $obj_utilisateur_model = new utilisateur_model();
                //utilise le model charger pour charger l'objet role de l'utilisateur
                $obj_utilisateur = $obj_utilisateur_model->loadUtilisateurById($arr_result[0]['service_chef']);
                $obj_service->setObjChef($obj_utilisateur);
            }
        }
        return $obj_service;
    }

}