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
                $page.='<div class="alert alert-danger">
                            <strong>Supression de la réservation éffectuée avec succès!</strong> Indicates a dangerous or potentially negative action.
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
            //->th("Responsable")
            ->th("Vehicule")
            ->th("Raison")
            ->th("Action");
        foreach ($arr_reservation as $reservation)
        {
            //chargemet du détails des reservations
            
            $id=($reservation->getIntId()==null)?'-':$reservation->getIntId();
            $dateDebut=($reservation->getDateDebut()==null)?'-':$reservation->getDateDebut();
            $dateFin=($reservation->getDateFin()==null)?'-':$reservation->getDateFin();
            $salarie=($reservation->getObjSalarie()==null)?'-':$reservation->getObjSalarie()->__toString();
            //$responsable=($reservation->getObjResponsable()==null)?'-':$reservation->getObjResponsable()->__toString();
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
            //$valStatus = ($reservation->getObjStatus()!=null)?$reservation->getObjStatus()->getIntId():'';
            $valRaison = ($reservation->getStrRaison()!=null)?$reservation->getStrRaison():'';
        }
        else
        {
            $valId = '';
            $valDateDebut = '';
            $valDateFin = '';
            $valSalarie = '';
            $valVehicule = '';
            //$valStatus = '';
            $valRaison = '';
            
        }
        $formAdd = new htmlForm('index.php', 'POST');
        $formAdd->addHidden('addUser', 'addUser');
        $formAdd->addHidden('idUser', $valId);
        $formAdd->addFreeText('Date de Debut : ');
        $formAdd->addDate('dateDebutSaisi',$valDateDebut, '', '', '',"form_datetime");
        $formAdd->addFreeText('Date de Fin : ');
        $formAdd->addDate('dateFinSaisi',$valDateFin, '', '', '',"form_datetime");
        $formAdd->addHidden('idSalarie', $valSalarie);
        
        $obj_vehicule_controller = new vehicule_controller();
        $arr_vehicule = $obj_vehicule_controller->getAllVehicules();
        $formAdd->addSelect('vehicule', "form-control", 'vehicule_list');
        foreach ($arr_vehicule as $vehicule)
        {
            ($valVehicule == $vehicule->getIntId())?$selected = true:$selected = false;
            $formAdd->addSelectOption('vehicule', $vehicule->getIntId(), $vehicule->getStrMarque().' '.$vehicule->getStrModel(), $selected);
        }
        
        //$formAdd->addHidden('idStatus', $valStatus);
        $formAdd->addFreeText('Raison deplacement : ');
        $formAdd->addText('raisonSaisi', $valRaison, '', '',"form-control");
        
        $formAdd->addBtSubmit('Valider',"Submit","btn");
        return $formAdd->render();
    }
}