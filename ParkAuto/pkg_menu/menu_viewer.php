<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 05/06/2017
 * Time: 18:16
 */
class menu_viewer
{
    public function templateMenuUser()
    {


        $listeAction=array('Accueil','Mes reservations','Signalement','Profil','Deconnexion');

        foreach ($listeAction as $item){
            $collection[]=$this->addItem($item);
        }

        $this->afficherMenu($collection);

    }
    public function templateMenuValidateur()
    {

        $listeAction=array('Accueil','Mes reservations','Validation','Signalement','Profil','Deconnexion');

        foreach ($listeAction as $item){
            $collection[]=$this->addItem($item);
        }

        $this->afficherMenu($collection);
    }
    public function templateMenuAdmin()
    {


        $listeAction=array('Accueil','Etat du parc','Mes reservations','Validation','Signalement','Profil','Administration','Deconnexion');

        foreach ($listeAction as $item){
            $collection[]=$this->addItem($item);
        }


        $this->afficherMenu($collection);


    }

    public function afficherMenu($collection){

        $menu="";
        foreach ($collection as $item){
            $menu.="<li class=\"nav-item\">".$item->render()."</li>";
        }

        $page=str_replace("%menu%",$menu,file_get_contents("pkg_graphique/navbarTest.html"));

        $page=str_replace("%title%","Accueil",$page);

        echo $page;

    }

    public function addItem($value){
        $item =new htmlForm('index.php', 'POST');
        $item->addBtSubmit($value,"Submit","btn btn-primary");
        return $item;
    }
}