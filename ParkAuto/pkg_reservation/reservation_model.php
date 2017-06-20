<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 12/06/2017
 * Time: 17:32
 */
class reservation_model
{

    public function __construct()
    {
    }
    
    public function loadReservations($salarie){
        
        $obj_bdd = new bdd();
        $champ = '*';
        $table = 'reservation';
        $condition = 'reservation_salarie = "'.$salarie->getIntId().'"';
        $arr_result = $obj_bdd->select($champ, $table, $condition);
        
        $obj_reservation = null;
        $arr_reservation = null;
        
        //repasser par le controller!!
        
        $mdl_vehicule=new vehicule_model();
        $arr_vehicules=$mdl_vehicule->loadAllVehicules();
        
        
        foreach ($arr_result as $user)
        {
            $obj_reservation =  new reservation_entity();
            $obj_reservation->setIntId(['reservation_id']);
            $obj_reservation->setDateDebut(['reservation_dateDebut']);
            $obj_reservation->setDateFin(['reservation_dateFin']);
            $obj_reservation->setObjSalarie($salarie);
            $obj_reservation->setObjVehicule($mdl_vehicule->getVehicule($arr_vehicules,['reservation_vehicule']));
            
            $arr_reservation[] = $obj_reservation;
        }


        
        
        
    }
}