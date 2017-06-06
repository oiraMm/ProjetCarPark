<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 05/06/2017
 * Time: 18:25
 */
class menu_controller
{
    //attribut privé de la classe
    //viewer de la classe
    private $obj_menu_viewer;

    public function __construct($str_action = "")
    {
        $this->obj_menu_viewer = new menu_viewer();
        //test le role de l'utilisateur $_session['current_user'] pour lancer l'affichage du menu correspondant
        if (isset($_SESSION['current_user']))
        {//session_destroy();
            //$obj_current_user = new utilisateur_entity();
            $int_id_current_user = $_SESSION['current_user'];
            $current_user_model = new utilisateur_model();
            $current_user = $current_user_model->loadUtilisateurById($int_id_current_user);
            $obj_role = $current_user->getObjRole();
            if ($current_user->getObjRole()->getStrLibelle() == 'admin')
            {
                $this->obj_menu_viewer->templateMenuAdmin();
            }
            elseif ($current_user->getObjRole()->getStrLibelle() == 'validateur')
            {
                $this->obj_menu_viewer->templateMenuValidateur();
            }
            elseif ($current_user->getObjRole()->getStrLibelle() == 'user')
            {
                $this->obj_menu_viewer->templateMenuUser();
            }
        }
    }
}