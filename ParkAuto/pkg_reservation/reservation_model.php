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
    
    
    
    public function deleteReservation($id){
        $obj_bdd = new bdd();
        //$champ = '*';
        $table = 'reservation';
        $condition = 'reservation_id = "'.$id.'"';
        $arr_result = $obj_bdd->delete($table, $condition);
        return $arr_result;
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
        
        $ctrl_vehicule=new vehicule_controller();
        $arr_vehicules=$ctrl_vehicule->getAllVehicules();
        
        
        foreach ($arr_result as $reservation)
        {
            $obj_reservation =  new reservation_entity();
            $obj_reservation->setIntId($reservation['reservation_id']);
            $obj_reservation->setDateDebut($reservation['reservation_dateDebut']);
            $obj_reservation->setDateFin($reservation['reservation_dateFin']);
            $obj_reservation->setObjSalarie($salarie);
            $obj_reservation->setObjVehicule($ctrl_vehicule->getVehicule($arr_vehicules,$reservation['reservation_vehicule']));
            $obj_reservation->setStrRaison($reservation['reservation_raison']);
            
            $arr_reservation[] = $obj_reservation;
        }


        
        return $arr_reservation;
        
    }
    
    public function loadReservationById($id){
        $ctrl_user= new utilisateur_controller();
        $ctrl_vehicule= new vehicule_controller();
        
 
        $obj_bdd = new bdd();
        $champ = '*';
        $table = 'reservation';
        $condition = 'reservation_id = "'.$id.'"';
        $arr_result = $obj_bdd->select($champ, $table, $condition);
        $obj_reservation = null;
        
        foreach ($arr_result as $reservation)
        {
            $obj_reservation =  new reservation_entity();
            $obj_reservation->setIntId($reservation['reservation_id']);
            $obj_reservation->setDateDebut($reservation['reservation_dateDebut']);
            $obj_reservation->setDateFin($reservation['reservation_dateFin']);
            $obj_reservation->setObjSalarie($ctrl_user->getUserById($reservation['reservation_salarie']));      
            $obj_reservation->setObjVehicule($ctrl_vehicule->getVehiculeById($reservation['reservation_vehicule']));
            $obj_reservation->setStrRaison($reservation['reservation_raison']);
        }
        
        
        return $obj_reservation;
    }
}