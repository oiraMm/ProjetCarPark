<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 12/06/2017
 * Time: 17:03
 */
class etat_vehicule_model
{

    public function loadEtatById($id)
    {
        //charge les donné de la news dont l'id est passez en paramètre
        $obj_bdd = new bdd();
        $champ = '*';
        $table = 'etat_vehicule';
        $condition = 'etat_vehicule_id = "'.$id.'"';
        $arr_result = $obj_bdd->select($champ, $table, $condition);
        $obj_etat =  new etat_vehicule_entity();
        if (isset($arr_result[0]))
        {
            if ($arr_result[0] != null)
            {
                $obj_etat->setIntId($arr_result[0]['etat_vehicule_id']);
                $obj_etat->setStrLibelle($arr_result[0]['etat_vehicule_libelle']);
            }
        }
        return $obj_etat;
    }

    public function loadAllEtat()
    {
        //charge les donné de la news dont l'id est passez en paramètre
        $obj_bdd = new bdd();
        $champ = '*';
        $table = 'etat_vehicule';
        $arr_result = $obj_bdd->select($champ, $table);
        $arr_etat = null;
        foreach ($arr_result as $oneEtat)
        {
            $obj_etat =  new type_carburant_entity();
            $obj_etat->setIntId($oneEtat['etat_vehicule_id']);
            $obj_etat->setStrLibelle($oneEtat['etat_vehicule_libelle']);
            $arr_etat[] = $obj_etat;
        }
        return $arr_etat;
    }
}