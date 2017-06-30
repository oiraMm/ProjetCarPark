<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 27/06/17
 * Time: 23:19
 */

include_once  '../../script_loader.php';
if (isset($_POST['ajaxSetCalendar'])) {
    if (isset($_POST['dateDebut'])) {
        if (isset($_POST['dateFin'])) {
            if (strtotime($_POST['dateFin']) < strtotime($_POST['dateDebut'])) {
                if($_POST['dateFin']!=''){
                    echo '';
                }else {
                    echo $_POST['modifField'];
                }
            }else{
                echo $_POST['modifField'];
            }

        }
    } else {
        echo $_POST['dateDebut'];
    }
}
if (isset($_POST['ajaxSetVehiculeList']))
{
    $mdl_reservation=new reservation_model();
    $vehicule_ctrl = new vehicule_controller();
    $arra_vehicule = $mdl_reservation->getListVehiculesDispo($_POST['dateDebut'],$_POST['dateFin']);
    $tabLD[$arra_vehicule[0]['vehicule_id']] = $arra_vehicule[0]['vehicule_marque'].' '.$arra_vehicule[0]['vehicule_modele'];
    echo json_encode($tabLD);


}
