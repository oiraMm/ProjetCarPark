<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 05/06/2017
 * Time: 15:21
 */
class news_controller
{
    //attribut privé de la classe
    //controller et model de la classe
    private $obj_news_model;
    private $obj_news_viewer;

    public function __construct($str_action = "")
    {
        $this->obj_news_model = new news_model();
        $this->obj_news_viewer = new news_viewer();
        //si on à l'action pour afficher toutes les news (page d'acceuil)
        if ($str_action == 'actionAfficheAllNews') {
            $arr_news = $this->obj_news_model->loadAllNews();
            if ($arr_news !=null) {
                $this->obj_news_viewer->templateNewsMasse($arr_news);
            }
            else
            {
                $this->obj_news_viewer->templateNoNews();
            }
        }
    }
}