<?php

/**
 * Created by PhpStorm.
 * User: Yael
 * Date: 06/06/2017
 * Time: 10:26
 */
class role_model
{
    public function roleOf($id)
    {
        //charge les donné de la news dont l'id est passez en paramètre
        $obj_bdd = new bdd();
        $champ = '*';
        $table = 'role';
        $condition = 'role_id = "'.$id.'"';
        $arr_result = $obj_bdd->select($champ, $table, $condition);
        $obj_role =  new role_entity();
        if (isset($arr_result[0]))
        {
            if ($arr_result[0] != null)
            {
                $obj_role->setIntId($arr_result[0]['role_id']);
                $obj_role->setStrLibelle($arr_result[0]['role_libelle']);
            }
        }
        return $obj_role;
    }
}