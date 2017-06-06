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
        $case1 =new htmlForm('index.php', 'POST');
        $case1->addBtSubmit('Accueil');
        echo $case1->render();
        $case2 =new htmlForm('index.php', 'POST');
        $case2->addBtSubmit('Mes reservations');
        echo $case2->render();
        $case3 =new htmlForm('index.php', 'POST');
        $case3->addBtSubmit('Signalement');
        echo $case3->render();
        $case4 =new htmlForm('index.php', 'POST');
        $case4->addBtSubmit('Profil');
        echo $case4->render();
        $case6 =new htmlForm('index.php', 'POST');
        $case6->addBtSubmit('Deconnexion');
        echo $case6->render();
    }
    public function templateMenuValidateur()
    {
        $case1 =new htmlForm('index.php', 'POST');
        $case1->addBtSubmit('Accueil');
        echo $case1->render();
        $case2 =new htmlForm('index.php', 'POST');
        $case2->addBtSubmit('Mes reservations');
        echo $case2->render();
        $case5 =new htmlForm('index.php', 'POST');
        $case5->addBtSubmit('Validation');
        echo $case5->render();
        $case4 =new htmlForm('index.php', 'POST');
        $case4->addBtSubmit('Signalement');
        echo $case4->render();
        $case5 =new htmlForm('index.php', 'POST');
        $case5->addBtSubmit('Profil');
        echo $case5->render();
        $case6 =new htmlForm('index.php', 'POST');
        $case6->addBtSubmit('Deconnexion');
        echo $case6->render();
    }
    public function templateMenuAdmin()
    {
        $case1 =new htmlForm('index.php', 'POST');
        $case1->addBtSubmit('Accueil');
        echo $case1->render();
        $case2 =new htmlForm('index.php', 'POST');
        $case2->addBtSubmit('Etat du parc');
        echo $case2->render();
        $case3 =new htmlForm('index.php', 'POST');
        $case3->addBtSubmit('Mes reservations');
        echo $case3->render();
        $case5 =new htmlForm('index.php', 'POST');
        $case5->addBtSubmit('Validation');
        echo $case5->render();
        $case4 =new htmlForm('index.php', 'POST');
        $case4->addBtSubmit('Signalement');
        echo $case4->render();
        $case5 =new htmlForm('index.php', 'POST');
        $case5->addBtSubmit('Profil');
        echo $case5->render();
        $case6 =new htmlForm('index.php', 'POST');
        $case6->addBtSubmit('Administration');
        echo $case6->render();
        $case6 =new htmlForm('index.php', 'POST');
        $case6->addBtSubmit('Deconnexion');
        echo $case6->render();
    }
}