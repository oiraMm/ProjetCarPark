<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 12/06/2017
 * Time: 17:08
 */
class vehicule_viewer
{

    public function templateCrudVehiculeDefault($arr_vehicule, $mode = "")
    {
        //la trasmission d'info se fera via formulaire et champ caché (un formulaire pour le tableau, le click sur un bouton transmettra l'action et l'id de l'utilisateur concerné
        $obj_table = new STable();
        $obj_table->border = 1;
        $thead = $obj_table->thead()
            ->th("Marque")
            ->th("Modele")
            ->th("Immatriculation")
            ->th("Km")
            ->th("Carburant")
            ->th("Niveau d'essence")
            ->th("Etat");
        if ($mode == "") {
            $thead->th("Action");
        }
        elseif ($mode == "visu")
        {
            $thead->th("Status");
        }
        foreach ($arr_vehicule as $vehicule)
        {
            $status = "";
            $marque=($vehicule->getStrMarque()==null)?'-':$vehicule->getStrMarque();
            $modele=($vehicule->getStrModel()==null)?'-':$vehicule->getStrModel();
            $immatriculation=($vehicule->getStrImmatriculation()==null)?'-':$vehicule->getStrImmatriculation();
            $km=($vehicule->getIntKm()==null)?'-':$vehicule->getIntKm();
            $carburant=($vehicule->getObjTypeCarburant()==null)?'-':$vehicule->getObjTypeCarburant()->getStrLibelle();
            $niveauEssence=($vehicule->getObjNiveauCarburant()==null)?'-':$vehicule->getObjNiveauCarburant()->getStrLibelle();
            $etat=($vehicule->getObjEtat()==null)?'-':$vehicule->getObjEtat()->getStrLibelle();
            if ($mode == "") {
                $formEdit = new htmlForm('index.php', 'POST');
                $formEdit->addHidden('idVehiculeEdit', $vehicule->getIntId());
                $formEdit->addHidden('mode', 'edit');
                $formEdit->addBtSubmit('Editer vehicule', "Submit", "btn");
                $formDelete = new htmlForm('index.php', 'POST');
                $formDelete->addHidden('idVehiculeDelete', $vehicule->getIntId());
                $formDelete->addHidden('mode', 'delete');
                $formDelete->addBtSubmit('Supprimer vehicule', "Submit", "btn", "deleteVehicule");
            }
            elseif ($mode == "visu")
            {
                $obj_reservation_controller = new reservation_controller();
                $obj_reservation = $obj_reservation_controller->reservationByVehiculeId($vehicule->getIntId());
                if ($obj_reservation==null)
                {
                    $status='-';
                }
                elseif (is_array($obj_reservation))
                {
                    foreach ($obj_reservation as $one_objReservation) {
                        if ($one_objReservation->getObjStatus() != null) {
                            $today = date("Y/m/d H:m:s");

                            if (strtotime($one_objReservation->getDateDebut()) <= strtotime($today) && strtotime($one_objReservation->getDateFin()) >= strtotime($today)) {
                                if ($one_objReservation->getObjStatus()->getIntId() == 1) {
                                    if ($status != "")
                                    {
                                        $status .= '<br>';
                                    }
                                    $status .= 'Reservation en cours du ' . $one_objReservation->getDateDebut() . ' au ' . $one_objReservation->getDateFin();
                                } elseif($one_objReservation->getObjStatus()->getIntId() == 3) {
                                    if ($status != "")
                                    {
                                        $status .= '<br>';
                                    }
                                    $status .= 'Demande de reservation en attente pour la periode du ' . $one_objReservation->getDateDebut() . ' au ' . $one_objReservation->getDateFin();
                                }
                            }
                        }
                    }
                }/*
                elseif ($obj_reservation->getObjStatus() != null) {
                    $today = date("Y/m/d");
                    if(strtotime($obj_reservation->getDateDebut()) <= strtotime($today) && strtotime($obj_reservation->getDateFin()) >= strtotime($today)) {
                        if ($obj_reservation->getObjStatus()->getIntId() == 1) {
                            $status = 'Reservation en cours du ' . $obj_reservation->getDateDebut() . ' au ' . $obj_reservation->getDateFin();
                        } elseif($obj_reservation->getObjStatus()->getIntId() == 3
                        ) {
                            $status = 'Demande de reservation en attente pour la periode du ' . $obj_reservation->getDateDebut() . ' au ' . $obj_reservation->getDateFin();
                        }
                    }
                    else
                    {
                        $status='-';
                    }
                }*/
                else
                {
                    $status='-';
                }
                if ($status=='')
                {
                    $status='-';
                }
            }

            $tr = $obj_table->tr()
                ->td($marque)
                ->td($modele)
                ->td($immatriculation)
                ->td($km)
                ->td($carburant)
                ->td($niveauEssence)
                ->td($etat);
            if ($mode == "") {
                $tr->td($formEdit->render() . $formDelete->render());
            }
            elseif ($mode == "visu")
            {
                $tr->td($status);
            }
        }
        if ($mode == "visu")
        {
            $str_test = '<h1>Etat du parc</h1>';
        }
        else
        {
            $str_test = '<h1>Liste des vehicules</h1>';
        }
        if ($mode == "") {
        $formAdd = new htmlForm('index.php', 'POST');
            $formAdd->addHidden('mode', 'add');
            $formAdd->addBtSubmit('Ajouter vehicule', "Submit", "btn");
            $str_return = $str_test.$obj_table->getTable().$formAdd->render();
        }
        else{
            $str_return = $str_test.$obj_table->getTable();
        }
        return $str_return;
    }



    public function templateCrudVehicule($str_mode = 'add', $int_vehicule_id = null)
    {
        //echo '<br><br><br>Mode : '.$str_mode;

        if ($int_vehicule_id != null)
        {
            $vehicule_controller = new vehicule_controller();
            $vehicule = $vehicule_controller->getVehiculeById($int_vehicule_id);
            $valId = $int_vehicule_id;
            $valKm = ($vehicule->getIntKm()!=null)?$vehicule->getIntKm():'';
            $valMarque = ($vehicule->getStrMarque()!=null)?$vehicule->getStrMarque():'';
            $valModele = ($vehicule->getStrModel()!=null)?$vehicule->getStrModel():'';
            $valImmatriculation = ($vehicule->getStrImmatriculation()!=null)?$vehicule->getStrImmatriculation():'';
            $valEtat = ($vehicule->getObjEtat()!=null)?$vehicule->getObjEtat()->getIntId():'';
            $valTypeCarburant = ($vehicule->getObjTypeCarburant()!=null)?$vehicule->getObjTypeCarburant()->getIntId():'';
            $valEssence = ($vehicule->getObjNiveauCarburant()!=null)?$vehicule->getObjNiveauCarburant()->getIntId():'';
        }
        else
        {
            $valKm = '';
            $valMarque = '';
            $valModele = '';
            $valImmatriculation = '';
            $valEtat = '';
            $valTypeCarburant = '';
            $valEssence='';
            $valId='';
        }
        $formAdd = new htmlForm('index.php', 'POST');
        $formAdd->addHidden('idVehicule', $valId, 'idVehicule');
        $formAdd->addFreeText('Marque : ');
        $formAdd->addText('marqueSaisi',$valMarque, '', '', '',"form-control", 'required');
        $formAdd->addFreeText('Modele : ');
        $formAdd->addText('modeleSaisi',$valModele, '', '', '',"form-control", 'required');
        $formAdd->addFreeText('Immatriculation : ');
        $formAdd->addText('immatriculationSaisi',$valImmatriculation, '', '', '',"form-control", 'required');
        $formAdd->addFreeText('Kilometrage : ');
        $formAdd->addText('kilometrageSaisi',$valKm, '', '', '',"form-control", 'required');
        $formAdd->addFreeText('Carburant : ');
        $obj_carburant_controller = new type_carburant_controller();
        $arr_typeCarburant = $obj_carburant_controller->getAllTypeCarburant();
        $formAdd->addSelect('type', "form-control", 'service_list', 'required');


        if ($valTypeCarburant == '')
        {
            $formAdd->addSelectOption('type', '0', '', true);
        }
        foreach ($arr_typeCarburant as $oneTypeCarburant)
        {
            if ($oneTypeCarburant != null){
                ($valTypeCarburant == $oneTypeCarburant->getIntId())?$selected = true:$selected = false;
                $formAdd->addSelectOption('type', $oneTypeCarburant->getIntId(), $oneTypeCarburant->getStrLibelle(), $selected);
            }
        }
        $formAdd->addFreeText('Niveau d\'essence : ');
        $obj_lvl_essence_controller = new niveau_carburant_controller();
        $arr_lvl_essence = $obj_lvl_essence_controller->getAllNiveauCarburant();
        $formAdd->addSelect('niveau', "form-control", '', 'required');
        if ($valEssence == '')
        {
            $formAdd->addSelectOption('niveau', '0', '', true);
        }
        foreach ($arr_lvl_essence as $oneLvlEssence)
        {
            if ($oneLvlEssence != null) {
                ($valEssence == $oneLvlEssence->getIntId()) ? $selected = true : $selected = false;
                $formAdd->addSelectOption('niveau', $oneLvlEssence->getIntId(), $oneLvlEssence->getStrLibelle(), $selected);
            }
        }


        $formAdd->addFreeText('Etat : ');
        $obj_etat_controller = new etat_vehicule_controller();
        $arr_etat = $obj_etat_controller->loadAllEtat();
        $formAdd->addSelect('etat', "form-control");
        if ($valEtat == '')
        {
            $formAdd->addSelectOption('etat', '0', '', true);
        }
        foreach ($arr_etat as $oneEtat)
        {
            if ($oneEtat != null) {
                ($valEtat == $oneEtat->getIntId()) ? $selected = true : $selected = false;
                $formAdd->addSelectOption('etat', $oneEtat->getIntId(), $oneEtat->getStrLibelle(), $selected);
            }
        }
        $formAdd->addHidden('vehiculeMode', 'saveVehicule');
        $formAdd->addBtSubmit('Valider',"Submit","btn");
        return $formAdd->render();
    }
}