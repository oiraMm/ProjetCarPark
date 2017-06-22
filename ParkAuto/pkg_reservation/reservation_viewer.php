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
                $page+='<div class="alert alert-danger">
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
                ->td($formEdit->render().$formDelete->render());
        }
        $formAdd = new htmlForm('index.php', 'POST');
        $formAdd->addHidden('mode', 'add');        
        $formAdd->addBtSubmit('Nouvelle demande de reservation',"Submit","btn");
        

        
        $page+=$obj_table->getTable().$formAdd->render();
        return $page;
    }
}