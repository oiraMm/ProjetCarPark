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



    public function getListVehiculesDispo($dateDebut,$dateFin,$idReservation=null){


        //$ctrl_vehicule=new vehicule_controller();
        $obj_bdd = new bdd();
        $champ = 'distinct reservation_vehicule';
        $table = 'reservation';
        $condition =    '( reservation_dateDebut > \''.$dateDebut.'\' AND reservation_dateDebut < \''.$dateFin.
                        '\' OR reservation_dateFin > \''.$dateDebut.'\' AND reservation_dateFin < \''.$dateFin.
                        '\' OR reservation_dateDebut < \''.$dateDebut.'\' AND reservation_dateFin > \''.$dateFin.'\') AND reservation_status = "1"';
        $arr_result = $obj_bdd->select($champ, $table, $condition);


        if($arr_result!=null) {


            $vehicules[] = '';
            foreach ($arr_result as $vehicule) {
                $vehicules[] = $vehicule['reservation_vehicule'];
            }

            $ctrl_vehicule = new vehicule_controller();
            return $ctrl_vehicule->getAllVehiculeExcept($vehicules);

            // $res=$ctrl_vehicule->getAllVehicules();

        }
        $ctrl_vehicule = new vehicule_controller();
        return $ctrl_vehicule->getAllVehicules();



    }

    public function changeReservationStatus($idReservation,$idStatus){
        $objreservation=$this->loadReservationById($idReservation);
        $obj_bdd = new bdd();
        //$champ = '*';
        $table = 'reservation';
        $condition = 'reservation_id = "'.$idReservation.'"';

        $arr_vehicules=$this->getListVehiculesDispo($objreservation->getDateDebut(),$objreservation->getDateFin());
        $is_reserv=true;
        foreach ($arr_vehicules as $vehicule){
            if($objreservation->getObjVehicule()->getIntId() == $vehicule->getIntId()){
                $is_reserv=false;
            }
        }
        if(! $is_reserv){
            $arra_champ_value['reservation_status']=$idStatus;
            $res_Req=$obj_bdd->update($table,$arra_champ_value,$condition);
            return $res_Req;
        }

        return false;

    }

    public function saveReservation($obj_reservation){


        $obj_reservation;
        //TODO Vérification de l'intégrité des données et code retour!!!
        $obj_bdd = new bdd();
        $table= 'reservation';
        $arra_champ_value['reservation_dateDebut']='\''.$obj_reservation->getDateDebut().'\'';
        $arra_champ_value['reservation_dateFin']='\''.$obj_reservation->getDateFin().'\'';
        //Attention ici l'attribut OBJ salarie n'a pas été instancié (inutile) ==> la variable contient donc seulement l'id du salarié
        $arra_champ_value['reservation_salarie']=$obj_reservation->getObjSalarie();
        //Même remarque pour le véhicule
        if($obj_reservation!=''){
            $arra_champ_value['reservation_vehicule']=$obj_reservation->getObjVehicule();
        }else{
            return 'mod-fail';
        }
        //Même remarque pour le status

        if ($obj_reservation->getObjStatus()!=null){
            $arra_champ_value['reservation_status'] = $obj_reservation->getObjStatus()->getIntId();
        }else{
            $arra_champ_value['reservation_status'] = '3';
        }

        if($obj_reservation->getStrRaison()!=null){
            $arra_champ_value['reservation_raison']='\''.$obj_reservation->getStrRaison().'\'';
        }else{
            $arra_champ_value['reservation_raison']='Raison non spécifié';
        }

        if ($obj_reservation->getIntId() != null )
        {
            $condition = 'reservation_id = "'.$obj_reservation->getIntId().'"';
            $arra_champ_value['reservation_id'] = $obj_reservation->getIntId();
            $res_req=$obj_bdd->update($table, $arra_champ_value, $condition);
            if($res_req){
                return 'mod';
            }else{
                return 'mod-fail';
            }
        }
        else
        {
           $res_req=$obj_bdd->insert($table, $arra_champ_value);
           if($res_req){
               return 'add';
           }else{
               return 'add-fail';
           }
        }
    }

    public function deleteReservation($id){
        $obj_bdd = new bdd();
        //$champ = '*';
        $table = 'reservation';
        $condition = 'reservation_id = "'.$id.'"';
        $res_req = $obj_bdd->delete($table, $condition);
        if($res_req){
            return 'delete';
        }else{
            return 'delete-fail';
        }
        return $res_req;
    }

    //Permet de chargé les réservations d'un salarié
    //Si aucun paramètre n'est passé, il renvoie la liste de toutes les reservations
    public function loadReservations($salarie=null,$date=null){
        
        $obj_bdd = new bdd();
        $champ = '*';
        $table = 'reservation';

        if($salarie!=null){
            if($date == null) {
                $condition = 'reservation_salarie = "' . $salarie->getIntId() . '"';
                $arr_result = $obj_bdd->select($champ, $table, $condition);
            }else {
                $condition = 'reservation_salarie = "' . $salarie->getIntId() . '" AND reservation_dateDebut BETWEEN "'.$date.' 00:00:00" AND "'.$date.' 23:59:59"';
                $arr_result = $obj_bdd->select($champ, $table, $condition);
            }
        }else{
            $arr_result = $obj_bdd->select($champ, $table);
        }

        $obj_reservation = null;
        $arr_reservation = null;
        
        //repasser par le controller!!
        
        $ctrl_vehicule=new vehicule_controller();
        $arr_vehicules=$ctrl_vehicule->getAllVehicules();

        $ctrl_status=new status_reservation_controller();
        $arr_status=$ctrl_status->getAllStatus();

        $ctrl_utilisateur=new utilisateur_controller();

        foreach ($arr_result as $reservation)
        {


            $obj_reservation =  new reservation_entity();
            $obj_reservation->setIntId($reservation['reservation_id']);
            $obj_reservation->setDateDebut($reservation['reservation_dateDebut']);
            $obj_reservation->setDateFin($reservation['reservation_dateFin']);
            $obj_reservation->setObjStatus($ctrl_status->getStatusWithID($arr_status,$reservation['reservation_status']));
            $obj_reservation->setObjSalarie($ctrl_utilisateur->getUserById($reservation['reservation_salarie']));
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

    public function reservationByVehiculeId($id)
    {
        $ctrl_user= new utilisateur_controller();
        $ctrl_vehicule= new vehicule_controller();
        $ctrl_statusReservation= new status_reservation_controller();
        $obj_bdd = new bdd();
        $champ = '*';
        $table = 'reservation';
        $condition = 'reservation_vehicule = "'.$id.'" ';
        $arr_result = $obj_bdd->select($champ, $table, $condition);

        $obj_reservation = null;
        $tabObjReservation = null;

        foreach ($arr_result as $reservation)
        {
            $obj_reservation =  new reservation_entity();
            $obj_reservation->setIntId($reservation['reservation_id']);
            $obj_reservation->setDateDebut($reservation['reservation_dateDebut']);
            $obj_reservation->setDateFin($reservation['reservation_dateFin']);
            $obj_reservation->setObjSalarie($ctrl_user->getUserById($reservation['reservation_salarie']));
            $obj_reservation->setObjVehicule($ctrl_vehicule->getVehiculeById($reservation['reservation_vehicule']));
            $obj_reservation->setObjStatus($ctrl_statusReservation->getStatusByID($reservation['reservation_status']));
            $obj_reservation->setStrRaison($reservation['reservation_raison']);
            $tabObjReservation[] = $obj_reservation;
        }
        return $tabObjReservation;
    }
}