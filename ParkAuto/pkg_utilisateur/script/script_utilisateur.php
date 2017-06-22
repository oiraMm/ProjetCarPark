<?php
/**
 * Created by PhpStorm.
 * User: berne
 * Date: 22/06/2017
 * Time: 19:23
 */
include_once  '../utilisateur_model.php';
include_once  '../../pkg_mysql/bdd.php';
if (isset($_POST['ajaxVerifChef']))
{
    $obj_model = new utilisateur_model();
    $bool_test = $obj_model->aUserIsChefService($_POST['id_service']);
    if ($bool_test == true)
    {
        echo 'true';
    }
    else
    {
        echo 'fasle';
    }
}
