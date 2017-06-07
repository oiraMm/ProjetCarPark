<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 05/06/2017
 * Time: 15:22
 */
class news_viewer
{
    public function templateNewsMasse($arrNews)
    {
        foreach ($arrNews as $obj_news)
        {
            $arraNews = $this->templateNewsUnitaire($obj_news);
        }
        return $arraNews;
    }

    public function templateNewsUnitaire($obj_news)
    {
        $str_template = '<div class = "news" id="news_'. $obj_news->getIntId() .'"> <p>';
        $str_template .= $obj_news->getStrContenu();
        $str_template .= '</p><p>By ';
        $str_template .= $obj_news->getObjAuteur()->getStrNom() .' '.$obj_news->getObjAuteur()->getStrPrenom();
        $str_template .= '</p>';
        $str_template .= '</div>';
        return $str_template;
    }
    public function templateNoNews ()
    {
        $str_template = '<div class = "news"> <p>Aucune news n\'as été publier</p></div>';
        return $str_template;
    }
}