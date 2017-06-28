<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 27/06/17
 * Time: 23:19
 */

include_once  '../reservation_model.php';
include_once  '../../pkg_mysql/bdd.php';
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
if (isset($_POST['ajaxVerifChefIsMe']))
{
    $obj_model = new utilisateur_model();
    if ($_POST['id_user'] == $obj_model->whoIsChefService($_POST['id_service']))
    {
        echo 'true';
    }
    else
    {
        echo 'false';
    }
}
