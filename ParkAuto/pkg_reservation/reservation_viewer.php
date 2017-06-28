<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 12/06/2017
 * Time: 17:33
 */
class reservation_viewer
{

    
    public function templateCrudReservationDefault($arr_reservation,$message=null)
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
        $obj_table->thead()
            ->th("ID")
            ->th("Date de debut")
            ->th("Date de fin")
            ->th("Salarié")
            ->th("Vehicule")
            ->th("Raison")
            ->th("Status")
            ->th("Action");
        foreach ($arr_reservation as $reservation)
        {
            //chargemet du détails des reservations
            
            $id=($reservation->getIntId()==null)?'-':$reservation->getIntId();
            $dateDebut=($reservation->getDateDebut()==null)?'-':$reservation->getDateDebut();
            $dateFin=($reservation->getDateFin()==null)?'-':$reservation->getDateFin();
            $salarie=($reservation->getObjSalarie()==null)?'-':$reservation->getObjSalarie()->__toString();
            $status=($reservation->getObjStatus()==null)?'-':$reservation->getObjStatus()->getStrLibelle();
            $vehicule=($reservation->getObjVehicule()==null)?'-':$reservation->getObjVehicule()->getStrMarque().' '.$reservation->getObjVehicule()->getStrModel();
            $raison=($reservation->getStrRaison()==null)?'-':$reservation->getStrRaison();
            
            
            
            $formEdit = new htmlForm('index.php', 'POST');
            $formEdit->addHidden('idReservationEdit', $reservation->getIntId());
            $formEdit->addHidden('mode', 'edit');
            $formEdit->addBtSubmit('Editer la reservation',"Submit","btn");
            $formDelete = new htmlForm('index.php', 'POST');
            $formDelete->addHidden('idReservationDelete', $reservation->getIntId());
            $formDelete->addHidden('mode', 'delete');
            $formDelete->addBtSubmit('Supprimer la reservation',"Submit","btn");
            $obj_table->tr()
                ->td($id)
                ->td($dateDebut)
                ->td($dateFin)
                ->td($salarie)
                ->td($vehicule)
                ->td($raison)
                ->td($status)
                ->td($formEdit->render().$formDelete->render());
        }
        $formAdd = new htmlForm('index.php', 'POST');
        $formAdd->addHidden('mode', 'add');        
        $formAdd->addBtSubmit('Nouvelle demande de reservation',"Submit","btn");
        

        
        $page.=$obj_table->getTable().$formAdd->render();
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
        foreach ($arr_vehicule as $vehicule)
        {
            ($valVehicule == $vehicule->getIntId())?$selected = true:$selected = false;
            $formAdd->addSelectOption('vehicule', $vehicule->getIntId(), $vehicule->getStrMarque().' '.$vehicule->getStrModel(), $selected);
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
        $obj_table->thead()
            ->th("ID")
            ->th("Date de debut")
            ->th("Date de fin")
            ->th("Salarié")
            ->th("Vehicule")
            ->th("Raison")
            ->th("Status")
            ->th("Action");
        foreach ($arr_reservation as $reservation)
        {
            //chargemet du détails des reservations

            $id=($reservation->getIntId()==null)?'-':$reservation->getIntId();
            $dateDebut=($reservation->getDateDebut()==null)?'-':$reservation->getDateDebut();
            $dateFin=($reservation->getDateFin()==null)?'-':$reservation->getDateFin();
            $salarie=($reservation->getObjSalarie()==null)?'-':$reservation->getObjSalarie()->__toString();
            $status=($reservation->getObjStatus()==null)?'-':$reservation->getObjStatus()->getStrLibelle();
            $vehicule=($reservation->getObjVehicule()==null)?'-':$reservation->getObjVehicule()->getStrMarque().' '.$reservation->getObjVehicule()->getStrModel();
            $raison=($reservation->getStrRaison()==null)?'-':$reservation->getStrRaison();



            $formAccept = new htmlForm('index.php', 'POST');
            $formAccept->addHidden('idReservationAccept', $reservation->getIntId());
            $formAccept->addHidden('mode', 'accept');
            $formAccept->addBtSubmit('Accepter la demande de reservation',"Submit","btn");
            $formRefuse = new htmlForm('index.php', 'POST');
            $formRefuse->addHidden('idReservationRefuse', $reservation->getIntId());
            $formRefuse->addHidden('mode', 'refuse');
            $formRefuse->addBtSubmit('Refuser la demande de reservation',"Submit","btn");
            $obj_table->tr()
                ->td($id)
                ->td($dateDebut)
                ->td($dateFin)
                ->td($salarie)
                ->td($vehicule)
                ->td($raison)
                ->td($status)
                ->td($formAccept->render().$formRefuse->render());
        }




        $page.=$obj_table->getTable();
        return $page;

    }
}