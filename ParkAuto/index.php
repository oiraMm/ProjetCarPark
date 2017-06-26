<?php
/**
 * Created by PhpStorm.
 * User: berne
 * Date: 26/05/2017
 * Time: 13:48
 */

include_once 'general_loader.php';
$page=file_get_contents("pkg_graphique/page.html");
$str_page_request = retrievePostData();
//Attention on peu rentrer dans cette boucle en passant un argument!!!
//Vérification que l'utilisateur est connecté OBLIGATOIRE pour rentrer dans le premier if
if ($str_page_request != null)
{
    switch ($str_page_request){
        case 'Accueil':
            $page = acceuil($page);
            break;
        case 'Etat du parc':
            $page = etatPark($page);
            break;
        case 'Mes reservations':        
        case 'Editer la reservation':
        case 'Supprimer la reservation':
        case 'Nouvelle demande de reservation':
        case 'saveReservation':
            $page = reservation($page);
            break;
        case 'Signalement':
            $page = signalement($page);
            break;
        case 'Profil':
            $page = profil($page);
            break;
        case 'Gestion des utilisateurs':
        case 'Editer utilisateur':
        case 'Supprimer utilisateur':
        case 'Ajouter utilisateur':
        case 'saveUser':
            $page = gestionUtilisateur($page);
            break;
        case 'Gestion des vehicules':
            $page = gestionVehicules($page);
            break;
        case 'Validation':
        case 'Accepter la demande de reservation' :
        case 'Refuser la demande de reservation' :
            $page = validation($page);
            break;
        case'Deconnexion':
            session_destroy();
            header('Location: index.php');
            break;
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

function retrievePostData()
{
    if (isset($_POST['reservationMode'])){
        $str_page_request = $_POST['reservationMode'];
    }
    elseif (isset($_POST['userMode']))
    {
        $str_page_request = $_POST['userMode'];
    }
    elseif (isset($_POST['addUser']))
    {
        $str_page_request = $_POST['addUser'];
    }
    else if (isset($_POST['Submit']) && isset($_SESSION['current_user']))
    {
        $str_page_request = $_POST['Submit'];
    }
    else
    {
        $str_page_request = null;
    }
    return $str_page_request;
}

function gestionUtilisateur($page)
{
    $obj_menu = new menu_controller();
    $obj_utilisateur_controller = new utilisateur_controller();
    $page=str_replace("%navbar%",$obj_menu->getTemplateMenu(),$page);
    $page=str_replace("%content%",$obj_utilisateur_controller->getTemplateCrudUser(),$page);
    $page=str_replace("%title%",'Gestion utilisateur',$page);
    return $page;
}
function gestionVehicules($page)
{
    $obj_menu = new menu_controller();
    $page=str_replace("%navbar%",$obj_menu->getTemplateMenu(),$page);
    $page=str_replace("%content%",'Gestion vehicule est un écran à venir',$page);
    $page=str_replace("%title%",'Gestion vehicule',$page);
    return $page;
}
function acceuil($page)
{
    $obj_menu = new menu_controller();
    $page=str_replace("%navbar%",$obj_menu->getTemplateMenu(),$page);
    $obj_news_controller = new news_controller();
    $page=str_replace("%content%",$obj_news_controller->getTemplateNews(),$page);
    $page=str_replace("%title%",'Accueil',$page);
    return $page;
}

function etatPark($page)
{
    $obj_menu = new menu_controller();
    $page=str_replace("%navbar%",$obj_menu->getTemplateMenu(),$page);
    $page=str_replace("%content%",'Etat du parc est un écran à venir',$page);
    $page=str_replace("%title%",'Etat du parc',$page);
    return $page;
}
function reservation($page)
{
    $obj_menu = new menu_controller();
    $page=str_replace("%navbar%",$obj_menu->getTemplateMenu(),$page);
    $obj_reservation_controller=new reservation_controller();
    $page=str_replace("%content%",$obj_reservation_controller->getTemplateCrudReservation(),$page);
    $page=str_replace("%title%",'Mes reservations',$page);
    return $page;
}
function signalement($page)
{
    $obj_menu = new menu_controller();
    $page=str_replace("%navbar%",$obj_menu->getTemplateMenu(),$page);
    $page=str_replace("%content%",'Signalement est un écran à venir',$page);
    $page=str_replace("%title%",'Signalement',$page);
    return $page;
}
function profil($page)
{
    $obj_menu = new menu_controller();
    $page=str_replace("%navbar%",$obj_menu->getTemplateMenu(),$page);
    $page=str_replace("%content%",'Profil est un écran à venir',$page);
    $page=str_replace("%title%",'Profil',$page);
    return $page;
}
function validation($page)
{
    $obj_menu = new menu_controller();
    $page=str_replace("%navbar%",$obj_menu->getTemplateMenu(),$page);
    $obj_reservation_controller=new reservation_controller();
    $page=str_replace("%content%",$obj_reservation_controller->getTemplateValidation(),$page);
    $page=str_replace("%title%",'Validation',$page);
    return $page;
}