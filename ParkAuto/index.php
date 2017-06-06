<?php
/**
 * Created by PhpStorm.
 * User: berne
 * Date: 26/05/2017
 * Time: 13:48
 */
include_once 'general_loader.php';
if (isset($_POST['Submit']) && isset($_SESSION['current_user']))
{
    $str_page_request = $_POST['Submit'];
    if ($str_page_request == 'Accueil')
    {
        echo '<p>HEADER</p>';
        $obj_menu = new menu_controller();
        $obj_news_controller = new news_controller('actionAfficheAllNews');
        echo '<p>FOOTER</p>';
    }
    elseif ($str_page_request == 'Etat du parc')
    {
        echo '<p>HEADER</p>';
        $obj_menu = new menu_controller();
        echo 'Etat du parc est un écran à venir';
        echo '<p>FOOTER</p>';
    }
    elseif ($str_page_request == 'Mes reservations')
    {
        echo '<p>HEADER</p>';
        $obj_menu = new menu_controller();
        echo 'Mes reservations est un écran à venir';
        echo '<p>FOOTER</p>';
    }
    elseif ($str_page_request == 'Signalement')
    {
        echo '<p>HEADER</p>';
        $obj_menu = new menu_controller();
        echo 'Signalement est un écran à venir';
        echo '<p>FOOTER</p>';
    }
    elseif ($str_page_request == 'Profil')
    {
        echo '<p>HEADER</p>';
        $obj_menu = new menu_controller();
        echo 'Profil est un écran à venir';
        echo '<p>FOOTER</p>';
    }
    elseif ($str_page_request == 'Administration')
    {
        echo '<p>HEADER</p>';
        $obj_menu = new menu_controller();
        echo 'Administration est un écran à venir';
        echo '<p>FOOTER</p>';
    }
    elseif ($str_page_request == 'Validation')
    {
        echo '<p>HEADER</p>';
        $obj_menu = new menu_controller();
        echo 'Validation est un écran à venir';
        echo '<p>FOOTER</p>';
    }
    elseif ($str_page_request == 'Deconnexion')
    {
        session_destroy();
        header('Location: index.php');
    }
}
else if (isset($_SESSION['current_user']))
{
    echo '<p>HEADER</p>';
    $obj_menu = new menu_controller();
    $obj_news_controller = new news_controller('actionAfficheAllNews');
    echo '<p>FOOTER</p>';
}
else
{
    if (isset($_POST['mail_connect']) && isset($_POST['mdp_connect']))
    {
        $obj_utilisateur_controller = new utilisateur_controller('connexion');
    }
    else
    {
        $obj_utilisateur_controller = new utilisateur_controller('actionAfficheConnexion');
    }
}