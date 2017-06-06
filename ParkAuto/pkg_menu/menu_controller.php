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
        $this->obj_menu_viewer->templateMenuAdmin();
    }
}