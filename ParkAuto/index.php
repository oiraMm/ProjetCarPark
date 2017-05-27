<?php
/**
 * Created by PhpStorm.
 * User: berne
 * Date: 26/05/2017
 * Time: 13:48
 */
include_once './pkg_utilisateur/utilisateur_loader.php';
if (isset($_SESSION['current_user']))
{
    echo 'CONNEXION EFFECTUER';
    unset($_SESSION['current_user']);
    session_destroy();
}
else
{
    $obj_utilisateur_controller = new utilisateur_controller('actionAfficheConnexion');
}
