<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 05/06/2017
 * Time: 15:22
 */
class news_model
{
    public function loadAllNews()
    {
        //charge les donné de l'utilisateur connecté dans l'objet utilisateur en fonction de l'identifiant fournie
        $obj_bdd = new bdd();
        $champ = 'news_id';
        $table = 'news';
        $order = 'news_createdAt DESC';
        $arr_result = $obj_bdd->select($champ, $table, '', $order);
        $arr_obj_news = null;
        if (isset($arr_result))
        {
            foreach ($arr_result as $id)
            {
                $arr_obj_news[] = $this->loadNewsById($id);
            }
        }
        return $arr_obj_news;
    }

    public function loadNewsById($id)
    {
        //charge les donné de la news dont l'id est passez en paramètre
        $obj_bdd = new bdd();
        $str_select = 'SELECT * FROM news WHERE news_id = '.$id ["news_id"];
        $champ = '*';
        $table = 'news';
        $condition = 'news_id = "'.$id ["news_id"].'"';
        $arr_result = $obj_bdd->select($champ, $table, $condition);
        $obj_news =  new news_entity();
        if (isset($arr_result[0]))
        {
            if ($arr_result[0] != null)
            {
                $obj_news->setIntId($arr_result[0]['news_id']);
                $obj_news->setStrContenu($arr_result[0]['news_contenu']);
                //instancie le modele de l'objet utilisateur
                $obj_utilisateur_controller = new utilisateur_controller();
                //utilise le model charger pour charger l'utilisateur qui est auteur de la news par son ID
                $obj_auteur = $obj_utilisateur_controller->getObjUtilisateurModel()->loadUtilisateurById($arr_result[0]['news_auteur']);
                $obj_news->setObjAuteur($obj_auteur);
            }
        }
        return $obj_news;
    }
}