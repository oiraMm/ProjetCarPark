<?php

/**
 * Created by PhpStorm.
 * User: Yael
 * Date: 28/06/2017
 * Time: 11:27
 */
class type_carburant_model
{

    public function loadTypeCarburantById($id)
    {
        //charge les donné de la news dont l'id est passez en paramètre
        $obj_bdd = new bdd();
        $champ = '*';
        $table = 'type_carburant';
        $condition = 'type_carburant_id = "'.$id.'"';
        $arr_result = $obj_bdd->select($champ, $table, $condition);
        $obj_type_carburant =  new type_carburant_entity();
        if (isset($arr_result[0]))
        {
            if ($arr_result[0] != null)
            {
                $obj_type_carburant->setIntId($arr_result[0]['type_carburant_id']);
                $obj_type_carburant->setStrLibelle($arr_result[0]['type_carburant_libelle']);
            }
        }

        return $obj_type_carburant;
    }

    public function loadAllTypeCarburant()
    {
        //charge les donné de la news dont l'id est passez en paramètre
        $obj_bdd = new bdd();
        $champ = '*';
        $table = 'type_carburant';
        $arr_result = $obj_bdd->select($champ, $table);
        $arr_typeCarburant[] = null;
        foreach ($arr_result as $typeCarburant)
        {
            $obj_type_carburant =  new type_carburant_entity();
            $obj_type_carburant->setIntId($typeCarburant['type_carburant_id']);
            $obj_type_carburant->setStrLibelle($typeCarburant['type_carburant_libelle']);
            $arr_typeCarburant[] = $obj_type_carburant;
        }
        return $arr_typeCarburant;
    }
}