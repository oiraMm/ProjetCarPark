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

        return $this->afficherMenu($collection);

    }
    public function templateMenuValidateur()
    {

        $listeAction=array('Accueil','Mes reservations','Validation','Signalement','Profil','Deconnexion');

        foreach ($listeAction as $item){
            $collection[]=$this->addItem($item);
        }

        return $this->afficherMenu($collection);
    }
    public function templateMenuAdmin()
    {

        //liste des titres principaux
        $listeAction=array('Accueil' =>'Simple' ,'Etat du parc'=>'Simple','Mes reservations'=>'Simple','Validation'=>'Simple','Signalement'=>'Simple','Profil'=>'Simple','Administration'=>'DropDown','Deconnexion'=>'Simple');

        //liste des titres dropdown menu
        $listeActionDropDown=array('Gestion des utilisateurs'=> 'Administration','Gestion des vehicules'=> 'Administration');


        foreach ($listeAction as $item => $type){

            if($type == 'Simple'){
                $collection[$this->addItem($item)->render()]=$type;
            }
            elseif ($type == 'DropDown'){
                //$collection[$this->addDropDownMenuItems($item,$listeActionDropDown)]='DropDownMenu';
            }

        }


        return $this->afficherMenu($collection);


    }

    public function afficherMenu($collection){

        $menu="";
        foreach ($collection as $item => $type){
            if($type == 'Simple'){
                $menu.="<li class=\"nav-item\">".$item."</li>";
            }
            elseif ($type == 'DropDownMenu'){
                $menu.="<li class=\"nav-item dropdown\"><a class=\"nav-link dropdown-toggle\" href=\"http://example.com\" id=\"navbarDropdownMenuLink\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
          Dropdown link
        </a><div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">".$item."</div></li>";
            }
            elseif ($type == 'DropDownItem'){

            }
        }

        $navbar=str_replace("%menu%",$menu,file_get_contents("pkg_graphique/navbar.html"));

        return $navbar;

    }

    public function addItem($value){
        $item =new htmlForm('index.php', 'POST');
        $item->addBtSubmit($value,"Submit","btn btn-primary");
        return $item;
    }

    public function addItemDropDown($value){
        $item =new htmlForm('index.php', 'POST');
        $item->addBtSubmit($value,"Submit","dropdown-item");
        return $item;
    }

    public function addDropDownMenuItems($TopItem,$collection){

        foreach ($collection as $item => $title ){
            if($title == $TopItem){
                $dropdown[$this->addItemDropDown($item)->render()]='Simple';
            }
        }

        return $this->afficherMenu($dropdown);
    }
}