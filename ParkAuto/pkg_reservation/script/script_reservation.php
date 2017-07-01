<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 27/06/17
 * Time: 23:19
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

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


    foreach ($arra_vehicule as $value)
    {
        $tabLD[$value->getIntId()] = $value->getStrMarque().' '.$value->getStrModel();
    }




    echo json_encode($tabLD);


}
