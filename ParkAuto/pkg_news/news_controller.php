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
            $arr_news_template = $this->obj_news_viewer->templateNewsMasse($arr_news);
            $str_news_template = '<ul class="list-group">';
            $bool_alterne = true;
            foreach ($arr_news_template as $news_template)
            {
                if ($bool_alterne == true) {
                    $str_news_template .= '<li class="list-group-item list-group-item-info">';
                    $bool_alterne = false;
                }
                else{
                    $str_news_template .= '<li class="list-group-item list-group-item-success">';
                    $bool_alterne = true;
                }
                $str_news_template .= $news_template;
                $str_news_template .= '</li>';
            }
            $str_news_template .= '</ul>';
            return $str_news_template;
        }
        else
        {
            return $this->obj_news_viewer->templateNoNews();
        }
    }

    /**
     * @return news_model
     */
    public function getObjNewsModel(): news_model
    {
        return $this->obj_news_model;
    }

    /**
     * @param news_model $obj_news_model
     */
    public function setObjNewsModel(news_model $obj_news_model)
    {
        $this->obj_news_model = $obj_news_model;
    }

    /**
     * @return news_viewer
     */
    public function getObjNewsViewer(): news_viewer
    {
        return $this->obj_news_viewer;
    }

    /**
     * @param news_viewer $obj_news_viewer
     */
    public function setObjNewsViewer(news_viewer $obj_news_viewer)
    {
        $this->obj_news_viewer = $obj_news_viewer;
    }


}