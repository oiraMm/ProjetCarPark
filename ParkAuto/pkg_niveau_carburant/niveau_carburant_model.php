<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 12/06/2017
 * Time: 17:00
 */
class niveau_carburant_model
{
    public function loadNiveauById($id)
    {
        //charge les donné de la news dont l'id est passez en paramètre
        $obj_bdd = new bdd();
        $champ = '*';
        $table = 'niveau_carburant';
        $condition = 'niveau_carburant_id = "'.$id.'"';
        $arr_result = $obj_bdd->select($champ, $table, $condition);
        $obj_niveau =  new niveau_carburant_entity();
        if (isset($arr_result[0]))
        {
            if ($arr_result[0] != null)
            {
                $obj_niveau->setIntId($arr_result[0]['niveau_carburant_id']);
                $obj_niveau->setStrLibelle($arr_result[0]['niveau_carburant_libelle']);
            }
        }
        return $obj_niveau;
    }
}