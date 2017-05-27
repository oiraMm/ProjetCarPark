<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 25/05/2017
 * Time: 16:32
 */
class utilisateur_controller
{
    //attribut privé de la classe //controller et model de la classe
    private $obj_utilisateur_model;
    private $obj_utilisateur_viewer;

    public function __construct($str_action = "")
    {
        $this->obj_utilisateur_model = new utilisateur_model();
        $this->obj_utilisateur_viewer = new utilisateur_viewer();
        if (isset($_POST['mail_connect']) && isset($_POST['mdp_connect']))
        {
            $this->connexion();
        }
        if (isset($_POST['connexion_reussi']))
        {
            if ($_POST['connexion_reussi'] == true)
            {

            }
            else
            {

            }
        }
        if ($str_action == 'actionAfficheConnexion')
        {
            $this->obj_utilisateur_viewer->templateConnexion();
        }
    }

    public function connexion ()
    {
        //vérifie l'existance des données saisie
        if (isset($_POST['mail_connect']) && isset($_POST['mdp_connect']))
        {
            $_POST['connexion_reussi'] = $this->obj_utilisateur_model->verifConnexion($_POST['mail_connect'], $_POST['mdp_connect']);
            if( $_POST['connexion_reussi']){
                $this->obj_utilisateur_viewer->templateConnexionAccept();
            }else{
                $this->obj_utilisateur_viewer->templateConnexion();
            }
        }
    }

}