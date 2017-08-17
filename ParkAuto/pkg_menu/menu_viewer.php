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

        //liste des titres principaux
        $listeAction=array('Accueil' =>'Simple' ,'Mes reservations'=>'Simple','Profil'=>'Simple','Deconnexion'=>'Simple');

        //liste des titres dropdown menu
        $listeActionDropDown=null;

        //Genere chaque formulaire en tenant compte des drop down menu...
        $collection=$this->generateMenu($listeAction,$listeActionDropDown);

        //retourne le code html de la navbar
        return $this->afficherMenu($collection);

    }
    public function templateMenuValidateur()
    {

        //liste des titres principaux
        $listeAction=array('Accueil' =>'Simple' ,'Etat du parc'=>'Simple','Mes reservations'=>'Simple','Validation'=>'Simple','Profil'=>'Simple','Deconnexion'=>'Simple');

        //liste des titres dropdown menu
        $listeActionDropDown=null;

        //Genere chaque formulaire en tenant compte des drop down menu...
        $collection=$this->generateMenu($listeAction,$listeActionDropDown);

        //retourne le code html de la navbar
        return $this->afficherMenu($collection);
    }
    public function templateMenuAdmin()
    {

        //liste des titres principaux
        $listeAction=array('Accueil' =>'Simple' ,'Etat du parc'=>'Simple','Mes reservations'=>'Simple','Validation'=>'Simple','Profil'=>'Simple','Administration'=>'DropDown','Deconnexion'=>'Simple');

        //liste des titres dropdown menu
        $listeActionDropDown=array('Gestion des utilisateurs'=> 'Administration','Gestion des vehicules'=> 'Administration');

        //Genere chaque formulaire en tenant compte des drop down menu...
        $collection=$this->generateMenu($listeAction,$listeActionDropDown);

        //retourne le code html de la navbar
        return $this->afficherMenu($collection);


    }

    public function generateMenu($listeAction,$listeActionDropDown){

        foreach ($listeAction as $item => $type){

            if($type == 'Simple'){
                $collection[$this->addItem($item)->render()]=$type;
            }
            elseif ($type == 'DropDown'){
                $collection[$this->addDropDownMenuItems($item,$listeActionDropDown)]='DropDownMenu';
            }

        }

        return $collection;
    }

    public function afficherMenu($collection,$navbar='true'){

        $menu="";
        foreach ($collection as $item => $type){
            if($type == 'Simple'){
                $menu.="<li class=\"nav-item\">".$item."</li>";
            }
            elseif ($type == 'DropDownMenu'){
                $menu.=$item;
            }
            elseif ($type == 'DropDownItem'){
                $menu.="<li class='dropdown-item'>".$item."</li>";
            }
        }

        if ($navbar){
            $navbar=str_replace("%menu%",$menu,file_get_contents("pkg_graphique/navbar.html"));
            return $navbar;
        }

        return $menu;

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
                $dropdown[$this->addItemDropDown($item)->render()]='DropDownItem';
            }
        }

        return "<li class=\"nav-item dropdown\">
                    <a class=\"nav-link dropdown-toggle\" id=\"dropdown01\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">".$TopItem." 
                        <span class=\"caret\"></span></a>
                    <ul class=\"dropdown-menu\">".$this->afficherMenu($dropdown,false)."</ul></li>";
    }
}