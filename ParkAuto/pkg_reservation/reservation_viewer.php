<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 12/06/2017
 * Time: 17:33
 */
class reservation_viewer
{
    public function templateRendreVehicule($obj_resa){

        $ctrl_carburant=new niveau_carburant_controller();
        $arr_plein=$ctrl_carburant->getAllNiveauCarburant();

        $ctrl_etat=new etat_vehicule_controller();
        $arr_etat=$ctrl_etat->loadAllEtat();

        $str_template= '<h2>Restitution du véhicule '.$obj_resa->getObjVehicule()->getStrMarque().' '.$obj_resa->getObjVehicule()->getStrModel().' </h1>';
        $formAdd = new htmlForm('index.php', 'POST');
        $formAdd->addHidden('idResa', $obj_resa->getIntId());

        $formAdd->addFreeText('Kilometrage :</br> ');
        $formAdd->addText('kilometrage', '', '', '',"form-control");
        $formAdd->addFreeText('Km ');

        $formAdd->addFreeText('</br></br>Etat du plein :');
        $formAdd->addSelect('plein', "form-control", 'plein_list');


        foreach ($arr_plein as $niveau)
        {

            if($niveau!=null){
                ($niveau->getIntId() == '1')?$selected = true:$selected = false;
                $formAdd->addSelectOption('plein', $niveau->getIntId(), $niveau->getStrLibelle(), $selected);

            }

        }

        $formAdd->addFreeText('</br>Etat du Vehicule :');
        $formAdd->addSelect('etatVehicule', "form-control", 'etat_list');


        foreach ($arr_etat as $etat)
        {

            if($etat!=null){
                ($etat->getIntId() == '1')?$selected = true:$selected = false;
                $formAdd->addSelectOption('etatVehicule', $etat->getIntId(), $etat->getStrLibelle(), $selected);
            }

        }



        $formAdd->addFreeText('</br>Commentaires :');
        $formAdd->addTextarea('commentaire','',2,50);
        $formAdd->addHidden('reservationMode', 'saveRendreVehicule');
        $formAdd->addBtSubmit('Valider',"Submit","btn");

        $str_template .= $formAdd->render();

        return $str_template;

    }

    public function templateRecuperationVehicule($obj_resa){


        $ctrl_carburant=new niveau_carburant_controller();
        $arr_plein=$ctrl_carburant->getAllNiveauCarburant();

        $str_template= '<h2>Reception du véhicule '.$obj_resa->getObjVehicule()->getStrMarque().' '.$obj_resa->getObjVehicule()->getStrModel().' </h1>';
        $formAdd = new htmlForm('index.php', 'POST');
        $formAdd->addHidden('idResa', $obj_resa->getIntId());

        $formAdd->addFreeText('Kilometrage :</br> ');
        $formAdd->addText('kilometrage', $obj_resa->getObjVehicule()->getIntKm(), '', '',"form-control");
        $formAdd->addFreeText('Km ');

        $formAdd->addFreeText('</br>Etat du plein :');
        $formAdd->addSelect('plein', "form-control", 'plein_list');


        foreach ($arr_plein as $niveau)
        {

            if($niveau!=null){
                ($obj_resa->getObjVehicule()->getObjNiveauCarburant()->getIntId() == $niveau->getIntId())?$selected = true:$selected = false;
                $formAdd->addSelectOption('plein', $niveau->getIntId(), $niveau->getStrLibelle(), $selected);

            }

        }

        $formAdd->addFreeText('Commentaires :');
        $formAdd->addTextarea('commentaire','',2,50);
        $formAdd->addHidden('reservationMode', 'saveRecuperation');
        $formAdd->addBtSubmit('Valider',"Submit","btn");

        $str_template .= $formAdd->render();
        return $str_template;


    }


    public function templateNoResa(){

        $str_template = '<h1>Réservations du jour</h1></br><div class = "news"> <p>Aucune réservation pour aujourd\'hui</p></div>';
        return $str_template;

    }
    public function templateTodayReservation($arr_reservation){

        $str_resa_template = '</br><h1>Réservations du jour</h1></br><ul class="list-group">';

        foreach ($arr_reservation as $resa)
        {

            $status=$resa->getObjStatus()->getIntId();
            if ($status == 1) {
                $str_resa_template .= '<li class="list-group-item list-group-item-success">';
                $formAdd = new htmlForm('index.php', 'POST');
                $formAdd->addHidden('idResa', $resa->getIntId());
                $formAdd->addBtSubmit('Récupération du véhicule',"Submit","btn");
                $btn=$formAdd->render();

            }elseif ($status == 5){
                $str_resa_template .= '<li class="list-group-item list-group-item-warning">';
                $formAdd = new htmlForm('index.php', 'POST');
                $formAdd->addHidden('reservationMode','rendreVehicule');
                $formAdd->addHidden('idResa', $resa->getIntId());
                $formAdd->addBtSubmit('Rendre le véhicule',"Submit","btn");
                $btn=$formAdd->render();
            }
            elseif ($status == 6){
                $str_resa_template .= '<li class="list-group-item list-group-item-info">';
                $btn='';
            }else{
                $str_resa_template .= '<li class="list-group-item list-group-item-danger">';
                $btn='';

            }
            $str_resa_template .= '<div class = "news" id='.$resa->getIntId().' <p><b>Raison : </b>';
            $str_resa_template .= $resa->getStrRaison();
            $str_resa_template .= '</p><p><b>Déplacement effectué avec: </b>';
            $str_resa_template .= $resa->getObjVehicule()->getStrMarque() .' '.$resa->getObjVehicule()->getStrModel().' jusqu\'au '. substr($resa->getDateFin(),0,10).' à '.substr($resa->getDateFin(),11,5);
            $str_resa_template .= '</p><p><b>Status : </b>'.$resa->getObjStatus()->getStrLibelle() .'</p>'.$btn;
            $str_resa_template .= '</div>';
            $str_resa_template .= '</li>';
        }
        $str_resa_template .= '</ul>';
        return $str_resa_template;
    }

    public function templateCrudReservationDefault($arr_reservation,$message=null,$withNewBtn=true)
    {
        //echo'<pre>';var_dump($arr_user);echo'</pre>';
        //la trasmission d'info se fera via formulaire et champ caché (un formulaire pour le tableau, le click sur un bouton transmettra l'action et l'id de l'utilisateur concerné
        
        $page='';
        switch ($message) {
            case 'delete':
                $page.='<div class="alert alert-success">
                            <strong>Suppression de la réservation éffectuée avec succès!</strong>
                        </div>';
                break;
            case 'delete-fail':
                $page.='<div class="alert alert-danger">
                            <strong>Suppression de la réservation échouée!</strong>
                        </div>';
                break;
            case 'add' :
                $page.='<div class="alert alert-success">
                            <strong>Ajout de la réservation éffectuée avec succès!</strong>
                        </div>';
                break;
            case 'add-fail' :
                $page.='<div class="alert alert-danger">
                            <strong>Ajout de la réservation n\'a pas été effectuée !</strong> 
                        </div>';
                break;
            case 'mod-fail' :
                $page.='<div class="alert alert-danger">
                            <strong>Modification de la réservation échouée!</strong>
                        </div>';
                break;
            case 'mod' :
                $page.='<div class="alert alert-success">
                            <strong>Modification de la réservation éffectuée avec succès!</strong> 
                        </div>';
                break;

        }



        $obj_table = new STable();
        $obj_table->border = 1;
        $obj_table->id='Reservations';
        $obj_table->thead()
            ->th("ID")
            ->th("Date de debut")
            ->th("Date de fin")
            ->th("Salarié")
            ->th("Vehicule")
            ->th("Raison")
            ->th("Status")
            ->th("Action");
        if($arr_reservation!=null) {


            foreach ($arr_reservation as $reservation) {
                //chargemet du détails des reservations

                $id = ($reservation->getIntId() == null) ? '-' : $reservation->getIntId();
                $dateDebut = ($reservation->getDateDebut() == null) ? '-' : $reservation->getDateDebut();
                $dateFin = ($reservation->getDateFin() == null) ? '-' : $reservation->getDateFin();
                $salarie = ($reservation->getObjSalarie() == null) ? '-' : $reservation->getObjSalarie()->__toString();
                $status = ($reservation->getObjStatus() == null) ? '-' : $reservation->getObjStatus()->getStrLibelle();
                $vehicule = ($reservation->getObjVehicule() == null) ? '-' : $reservation->getObjVehicule()->getStrMarque() . ' ' . $reservation->getObjVehicule()->getStrModel();
                $raison = ($reservation->getStrRaison() == null) ? '-' : $reservation->getStrRaison();


                if ($reservation->getObjStatus()->getIntId() == 3) {
                    $formEdit = new htmlForm('index.php', 'POST');
                    $formEdit->addHidden('idReservationEdit', $reservation->getIntId());
                    $formEdit->addHidden('mode', 'edit');
                    $formEdit->addBtSubmit('Editer la reservation', "Submit", "btn");
                    $editForm = $formEdit->render();
                    $formDelete = new htmlForm('index.php', 'POST');
                    $formDelete->addHidden('idReservationDelete', $reservation->getIntId());
                    $formDelete->addHidden('mode', 'delete');
                    $formDelete->addBtSubmit('Supprimer la reservation', "Submit", "btn");
                    $delForm=$formDelete->render();
                } else {
                    $editForm = '';
                    $delForm=' -- ';
                }

                $obj_table->tr()
                    ->td($id)
                    ->td($dateDebut)
                    ->td($dateFin)
                    ->td($salarie)
                    ->td($vehicule)
                    ->td($raison)
                    ->td($status)
                    ->td($editForm . $delForm );
            }
        }

        $form='';
        if($withNewBtn){
            $formAdd = new htmlForm('index.php', 'POST');
            $formAdd->addHidden('mode', 'add');
            $formAdd->addBtSubmit('Nouvelle demande de reservation',"Submit","btn");
            $form=$formAdd->render();
        }
        

        
        $page.=$obj_table->getTable().$form;
        return $page;
    }
    
     public function templateCrudReservation($str_mode = 'add', $int_reservation_id = null)
    {
        //TODO Formulaire d'ajout d'utilisateur, pré-remplie grace à l'id si action édit sinon vide
        //echo '<br><br><br>Mode : '.$str_mode;
        if ($int_reservation_id != null)
        {
            
            $reservation_controller = new reservation_controller();
            $reservation = $reservation_controller->getReservationById($int_reservation_id);
            $valId = $int_reservation_id;
            $valDateDebut = ($reservation->getDateDebut()!=null)?$reservation->getDateDebut():'';
            $valDateFin = ($reservation->getDateFin()!=null)?$reservation->getDateFin():'';
            $valSalarie = ($reservation->getObjSalarie()!=null)?$reservation->getObjSalarie()->getIntId():'';
            $valVehicule = ($reservation->getObjVehicule()!=null)?$reservation->getObjVehicule()->getIntId():'';
            $valStatus = ($reservation->getObjStatus()!=null)?$reservation->getObjStatus()->getIntId():'';
            $valRaison = ($reservation->getStrRaison()!=null)?$reservation->getStrRaison():'';
        }
        else
        {
            $valId = '';
            $valDateDebut = '';
            $valDateFin = '';
            $valSalarie = $_SESSION['current_user'];
            $valVehicule = '';
            $valStatus = '';
            $valRaison = '';
            
        }
        $formAdd = new htmlForm('index.php', 'POST');
        $formAdd->addHidden('idReservation', $valId);
        $formAdd->addFreeText('Date de Debut : ');
        $formAdd->addDate('dateDebutSaisi',$valDateDebut, 'dateDebutSaisi', '', '',"form_datetime");
        $formAdd->addFreeText('Date de Fin : ');
        $formAdd->addDate('dateFinSaisi',$valDateFin, 'dateFinSaisi', '', '',"form_datetime");
        $formAdd->addHidden('idSalarie', $valSalarie);
        $formAdd->addHidden('idStatus', $valStatus);
        $obj_vehicule_controller = new vehicule_controller();
        $arr_vehicule = $obj_vehicule_controller->getAllVehicules();
        $formAdd->addSelect('vehicule', "form-control", 'vehicule_list');
        if($valVehicule == '') {
            $formAdd->addSelectOption('vehicule', '', '- Selectionnez un véhicule -', true);
        }else{
            $formAdd->addSelectOption('vehicule', '', '- Selectionnez un véhicule -', false);
            foreach ($arr_vehicule as $vehicule)
            {
                ($valVehicule == $vehicule->getIntId())?$selected = true:$selected = false;
                if($selected){
                    $formAdd->addSelectOption('vehicule', $vehicule->getIntId(), $vehicule->__toString(), $selected);
                }
            }
        }

        
        $formAdd->addHidden('idStatus', $valStatus);
        $formAdd->addFreeText('Raison deplacement : ');
        $formAdd->addText('raisonSaisi', $valRaison, '', '',"form-control");
        $formAdd->addHidden('reservationMode', 'saveReservation');
        $formAdd->addBtSubmit('Valider',"Submit","btn");
        return $formAdd->render();
    }


    //TODO Voir optimisation avec crudReservation
    public function templateValidation($arr_reservation){

        $page='';
        $obj_table = new STable();
        $obj_table->border = 1;
        $obj_table->id='Reservations';
        $obj_table->thead()
            ->th("ID")
            ->th("Date de debut")
            ->th("Date de fin")
            ->th("Salarié")
            ->th("Vehicule")
            ->th("Raison")
            ->th("Status")
            ->th("Action");
        if($arr_reservation != null) {


            foreach ($arr_reservation as $reservation) {
                //chargemet du détails des reservations

                $id = ($reservation->getIntId() == null) ? '-' : $reservation->getIntId();
                $dateDebut = ($reservation->getDateDebut() == null) ? '-' : $reservation->getDateDebut();
                $dateFin = ($reservation->getDateFin() == null) ? '-' : $reservation->getDateFin();
                $salarie = ($reservation->getObjSalarie() == null) ? '-' : $reservation->getObjSalarie()->__toString();
                $status = ($reservation->getObjStatus() == null) ? '-' : $reservation->getObjStatus()->getStrLibelle();
                $vehicule = ($reservation->getObjVehicule() == null) ? '-' : $reservation->getObjVehicule()->getStrMarque() . ' ' . $reservation->getObjVehicule()->getStrModel();
                $raison = ($reservation->getStrRaison() == null) ? '-' : $reservation->getStrRaison();


                $formAccept = new htmlForm('index.php', 'POST');
                $formAccept->addHidden('idReservationAccept', $reservation->getIntId());
                $formAccept->addHidden('mode', 'accept');
                $formAccept->addBtSubmit('Accepter la demande de reservation', "Submit", "btn");
                $formRefuse = new htmlForm('index.php', 'POST');
                $formRefuse->addHidden('idReservationRefuse', $reservation->getIntId());
                $formRefuse->addHidden('mode', 'refuse');
                $formRefuse->addBtSubmit('Refuser la demande de reservation', "Submit", "btn");
                $obj_table->tr()
                    ->td($id)
                    ->td($dateDebut)
                    ->td($dateFin)
                    ->td($salarie)
                    ->td($vehicule)
                    ->td($raison)
                    ->td($status)
                    ->td($formAccept->render() . $formRefuse->render());
            }
        }




        $page.=$obj_table->getTable();
        return $page;

    }



    public function templateVehiculeFilter($arr_vehicules){
        $str_template='<div class="col">';
        $formAdd=new htmlForm('index.php', 'POST');
        $formAdd->addFreeText('Vehicule');
        $formAdd->addSelect('vehicule', "form-control", 'resa_vehicule_list');
        $formAdd->addSelectOption('vehicule', '*', 'Tous', true);
        foreach ($arr_vehicules as $vehicule){
            $formAdd->addSelectOption('vehicule', $vehicule->getIntId(), $vehicule->__toString(), false);
        }

        $str_template.=$formAdd->render().'</div>';

        return $str_template;


    }

    public function templateUserFilter($arr_users){
        $str_template='<div class="col">';
        $formAdd=new htmlForm('index.php', 'POST');
        $formAdd->addFreeText('Salarié : ');
        $formAdd->addSelect('user', "form-control", 'resa_user_list');
        $formAdd->addSelectOption('user', '0', 'Tous', true);
        foreach ($arr_users as $user){
            $formAdd->addSelectOption('user', $user->getIntId(), $user->__toString(), false);

        }

        $str_template.=$formAdd->render().'</div>';
        return $str_template;
    }
    
    public  function templateStatusFilter($arr_status){
        $str_template='<div class="col">';
        $formAdd=new htmlForm('index.php', 'POST');
        $formAdd->addFreeText('Status : ');
        $formAdd->addSelect('status', "form-control", 'resa_status_list');
        $formAdd->addSelectOption('status', '*', 'Tous', true);
        foreach ($arr_status as $status){
            $formAdd->addSelectOption('status', $status->getIntId(), $status->getStrLibelle(), false);
        }

        $str_template.=$formAdd->render().'</div>';
        return $str_template;
        
    }

    //periode= Fin ou Debut
    public function templateDateFilter($periode){

        $str_template='<div class="col">';
        $formAdd=new htmlForm('index.php', 'POST');
        $formAdd->addFreeText('Réservation en cours au : ');
        $formAdd->addDate('resa_date'.$periode,'','resa_date'.$periode, '', '',"form_datetime");
        $str_template.=$formAdd->render().'</div>';
        return $str_template;
    }
}