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
    }

    public function getTemplateNews()
    {
        $arr_news = $this->obj_news_model->loadAllNews();
        if ($arr_news !=null) {
            return $this->obj_news_viewer->templateNewsMasse($arr_news);
        }
        else
        {
            return $this->obj_news_viewer->templateNoNews();
        }
    }
}