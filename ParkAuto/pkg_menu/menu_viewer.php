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
        $case2 =new htmlForm('index.php', 'POST');
        $case2->addBtSubmit('Mes reservations');
        $case3 =new htmlForm('index.php', 'POST');
        $case3->addBtSubmit('Signalement');
        $case4 =new htmlForm('index.php', 'POST');
        $case4->addBtSubmit('Profil');
        $case5 =new htmlForm('index.php', 'POST');
        $case5->addBtSubmit('Deconnexion');
        //création d'un tableau html pour le rendu
        $table = new STable();
        $table->tr()
            ->td($case1->render())
            ->td($case2->render())
            ->td($case3->render())
            ->td($case4->render())
            ->td($case5->render());
        //affichage du tableau
        echo $table->getTable();
    }
    public function templateMenuValidateur()
    {
        $case1 =new htmlForm('index.php', 'POST');
        $case1->addBtSubmit('Accueil');
        $case2 =new htmlForm('index.php', 'POST');
        $case2->addBtSubmit('Mes reservations');
        $case3 =new htmlForm('index.php', 'POST');
        $case3->addBtSubmit('Validation');
        $case4 =new htmlForm('index.php', 'POST');
        $case4->addBtSubmit('Signalement');
        $case5 =new htmlForm('index.php', 'POST');
        $case5->addBtSubmit('Profil');
        $case6 =new htmlForm('index.php', 'POST');
        $case6->addBtSubmit('Deconnexion');
        //création d'un tableau html pour le rendu
        $table = new STable();
        $table->tr()
            ->td($case1->render())
            ->td($case2->render())
            ->td($case3->render())
            ->td($case4->render())
            ->td($case5->render())
            ->td($case6->render());
        //affichage du tableau
        echo $table->getTable();
    }
    public function templateMenuAdmin()
    {
        $case1 =new htmlForm('index.php', 'POST');
        $case1->addBtSubmit('Accueil');
        $case2 =new htmlForm('index.php', 'POST');
        $case2->addBtSubmit('Etat du parc');
        $case3 =new htmlForm('index.php', 'POST');
        $case3->addBtSubmit('Mes reservations');
        $case4 =new htmlForm('index.php', 'POST');
        $case4->addBtSubmit('Validation');
        $case5 =new htmlForm('index.php', 'POST');
        $case5->addBtSubmit('Signalement');
        $case6 =new htmlForm('index.php', 'POST');
        $case6->addBtSubmit('Profil');
        $case7 =new htmlForm('index.php', 'POST');
        $case7->addBtSubmit('Administration');
        $case8 =new htmlForm('index.php', 'POST');
        $case8->addBtSubmit('Deconnexion');
        //création d'un tableau html pour le rendu
        $table = new STable();
        $table->tr()
            ->td($case1->render())
            ->td($case2->render())
            ->td($case3->render())
            ->td($case4->render())
            ->td($case5->render())
            ->td($case6->render())
            ->td($case7->render())
            ->td($case8->render());
        //affichage du tableau
        echo $table->getTable();
    }
}