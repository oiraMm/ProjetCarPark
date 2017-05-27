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

    public function _construct()
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
    }

    public function connexion ()
    {
        //vérifie l'existance des données saisie
        if (isset($_POST['mailSaisie']) && isset($_POST['mdpSaisie']))
        {
            $_POST['connexion_reussi'] = $this->utilisateur_entity->getUtilisateurModel()->verifConnexion($_POST['mailSaisie'], $_POST['mdpSaisie']);
        }
    }

}