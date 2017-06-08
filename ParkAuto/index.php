<?php
/**
 * Created by PhpStorm.
 * User: berne
 * Date: 26/05/2017
 * Time: 13:48
 */
include_once 'general_loader.php';
$page=file_get_contents("pkg_graphique/page.html");

if (isset($_POST['Submit']) && isset($_SESSION['current_user']))
{
    $str_page_request = $_POST['Submit'];
    if ($str_page_request == 'Accueil')
    {
        $obj_menu = new menu_controller();
        $page=str_replace("%navbar%",$obj_menu->getTemplateMenu(),$page);
        $obj_news_controller = new news_controller();
        $page=str_replace("%content%",$obj_news_controller->getTemplateNews(),$page);
        $page=str_replace("%title%",'Accueil',$page);
    }
    elseif ($str_page_request == 'Etat du parc')
    {
        $obj_menu = new menu_controller();
        $page=str_replace("%navbar%",$obj_menu->getTemplateMenu(),$page);
        $page=str_replace("%content%",'Etat du parc est un écran à venir',$page);
        $page=str_replace("%title%",'Etat du parc',$page);
    }
    elseif ($str_page_request == 'Mes reservations')
    {

        $obj_menu = new menu_controller();
        $page=str_replace("%navbar%",$obj_menu->getTemplateMenu(),$page);
        $page=str_replace("%content%",'Mes reservations est un écran à venir',$page);
        $page=str_replace("%title%",'Mes reservations',$page);
    }
    elseif ($str_page_request == 'Signalement')
    {
        $obj_menu = new menu_controller();
        $page=str_replace("%navbar%",$obj_menu->getTemplateMenu(),$page);
        $page=str_replace("%content%",'Signalement est un écran à venir',$page);
        $page=str_replace("%title%",'Signalement',$page);
    }
    elseif ($str_page_request == 'Profil')
    {
        $obj_menu = new menu_controller();
        $page=str_replace("%navbar%",$obj_menu->getTemplateMenu(),$page);
        $page=str_replace("%content%",'Profil est un écran à venir',$page);
        $page=str_replace("%title%",'Profil',$page);
    }
    elseif ($str_page_request == 'Administration')
    {
        $obj_menu = new menu_controller();
        $page=str_replace("%navbar%",$obj_menu->getTemplateMenu(),$page);
        $page=str_replace("%content%",'Administration est un écran à venir',$page);
        $page=str_replace("%title%",'Administration',$page);
    }
    elseif ($str_page_request == 'Validation')
    {
        $obj_menu = new menu_controller();
        $page=str_replace("%navbar%",$obj_menu->getTemplateMenu(),$page);
        $page=str_replace("%content%",'Validation est un écran à venir',$page);
        $page=str_replace("%title%",'Validation',$page);
    }
    elseif ($str_page_request == 'Deconnexion')
    {
        session_destroy();
        header('Location: index.php');
    }
}
else if (isset($_SESSION['current_user']))
{
    $obj_menu = new menu_controller();
    $page=str_replace("%navbar%",$obj_menu->getTemplateMenu(),$page);
    $obj_news_controller = new news_controller();
    $page=str_replace("%content%",$obj_news_controller->getTemplateNews(),$page);
    $page=str_replace("%title%",'Accueil',$page);
}
else
{
    if (isset($_POST['mail_connect']) && isset($_POST['mdp_connect']))
    {
        $obj_utilisateur_controller = new utilisateur_controller('connexion');
        if (! isset($_SESSION['current_user']))
        {
            $obj_utilisateur_controller = new utilisateur_controller();
            $form=str_replace("%form%",$obj_utilisateur_controller->getTemplateConnexion(),file_get_contents("pkg_graphique/sign-in.html"));
            $page=str_replace("%navbar%",'<div class="alert alert-danger">Mot de passe ou mail incorrect</div>',$page);
            $page=str_replace("%content%",$form,$page);
            $page=str_replace("%title%",'Connexion',$page);

        }
    }
else
    {
        $obj_utilisateur_controller = new utilisateur_controller();
        $form=str_replace("%form%",$obj_utilisateur_controller->getTemplateConnexion(),file_get_contents("pkg_graphique/sign-in.html"));
        $page=str_replace("%navbar%",'',$page);
        $page=str_replace("%content%",$form,$page);
        $page=str_replace("%title%",'Connexion',$page);
    }
}


echo $page;