<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 12/06/2017
 * Time: 17:16
 */
class document_model
{
    public function saveDocument($obj_document)
    {
        $obj_bd = new bdd();
        $table = 'document';
        $arra_champ_value['document_name'] = '\''.$obj_document->getStrName().'\'';
        $arra_champ_value['document_path'] = '\''.$obj_document->getStrPath().'\'';
        if ($obj_document->getObjSalarie() != null)
        {
            $arra_champ_value['document_salarie'] = '\''.$obj_document->getObjSalarie()->getIntId().'\'';
        }
        if ($obj_document->getObjVehicule() != null)
        {
            $arra_champ_value['document_vehicule'] = '\''.$obj_document->getObjVehicule()->getIntId().'\'';
        }
        $obj_bd->insert($table, $arra_champ_value);
    }

    public function loadPathPermi($userId)
    {
        $obj_bdd = new bdd();
        $champ = '*';
        $table = 'document';
        $condition = 'document_salarie = "'.$userId.'"';
        $arr_result = $obj_bdd->select($champ, $table, $condition);
        $obj_document =  new document_entity();
        if (isset($arr_result[0])) {
            if ($arr_result[0] != null) {
                $obj_document->setIntId($arr_result[0]['document_id']);
                $obj_document->setStrName($arr_result[0]['document_name']);
                $obj_document->setStrPath($arr_result[0]['document_path']);
                if ($arr_result[0]['document_salarie'] != null)
                {
                    //instancie le modele de l'objet utilisateur
                    $obj_utilisateur_controller = new utilisateur_controller();
                    //utilise le model charger pour charger l'objet role de l'utilisateur
                    $obj_salarie = $obj_utilisateur_controller->getObjUtilisateurModel()->loadUtilisateurById($arr_result[0]['document_salarie']);
                    $obj_document->setObjSalarie($obj_salarie);
                }
            }
        }
        return $obj_document;
    }
}