<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 12/06/2017
 * Time: 17:28
 */
class status_reservation_model
{

    //retourne tous les status de reservation présent dans la base de donnée
    public function getAllStatus(){
        $obj_bdd = new bdd();
        $champ = '*';
        $table = 'status_reservation';
        $arr_result = $obj_bdd->select($champ, $table);

        $arr_status=null;
        foreach ($arr_result as $status){
            //instanciation du status
            $obj_status=new status_reservation_entity();
            $obj_status->setIntId($status['status_reservation_id']);
            $obj_status->setStrLibelle($status['status_reservation_libelle']);

            //ajout au tableau de status l'instance du nouveau status
            $arr_status[]=$obj_status;
        }

        return $arr_status;
    }

    //recherche d'un status via l'id dans un tableau de status
    public function getStatus($arr_status,$id){
        foreach ($arr_status as $status){
            if($status->getIntId()==$id){
                return $status;
            }
        }
        return null;
    }

    public function getStatusByID($id){
        $obj_bdd = new bdd();
        $champ = '*';
        $table = 'status_reservation';
        $condition = 'status_reservation_id = '. $id;
        $arr_result = $obj_bdd->select($champ, $table, $condition);


        foreach ($arr_result as $status)
        {
            $obj_status =  new status_reservation_entity();
            $obj_status->setIntId($status['status_reservation_id']);
            $obj_status->setStrLibelle($status['status_reservation_libelle']);
        }
        return $obj_status;
    }


}