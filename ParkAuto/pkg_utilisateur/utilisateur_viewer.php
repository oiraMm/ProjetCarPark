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
        $myform->addFreeText("<h2 class=\"form-signin-heading\">Please sign in</h2>");
        $myform->addFreeText("Email :");
        $myform->addText('mail_connect', '', '', '',"form-control","email");
        $myform->addFreeText("Mot de passe :");
        $myform->addPassword('mdp_connect', '', '', '',"form-control");
        $myform->addBtSubmit('valider',"Submit",'btn btn-lg btn-primary btn-block');

        //$page=str_replace("%form%",$myform->render(),file_get_contents("pkg_graphique/sign-in.html"));



        //echo $page;
        return $myform->render();
    }
/*
    public function templateConnexionAccept()
    {
        //$myform=new htmlForm('index.php', 'POST');
        //$myform->addFreeText('Connexion Réussi');
        //echo  $myform->render();
        echo "ok you're connected";
    }*/
}