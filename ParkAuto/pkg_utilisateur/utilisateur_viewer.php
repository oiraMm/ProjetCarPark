<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 26/05/2017
 * Time: 11:33
 */
class utilisateur_viewer
{

    public function templateConnexion()
    {
        $myform=new htmlForm('index.php', 'POST');
        $myform->addFreeText('Email : ');
        $myform->addText('mail_connect', '', '', '');
        $myform->addFreeText('Mot de passe : ');
        $myform->addPassword('mdp_connect', '', '', '');
        $myform->addBtSubmit('valider');
        echo $myform->render();
    }

    public function templateConnexionAccept()
    {
        $myform=new htmlForm('index.php', 'POST');
        $myform->addFreeText('Connexion Réussi');
        echo  $myform->render();
    }
}