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
        $case1->addBtSubmit('Accueil',"btn .btn-primary");
        $collection[]=$case1;
        $case2 =new htmlForm('index.php', 'POST');
        $case2->addBtSubmit('Etat du parc',"btn .btn-primary");
        $collection[]=$case2;
        $case3 =new htmlForm('index.php', 'POST');
        $case3->addBtSubmit('Mes reservations',"btn .btn-primary");
        $collection[]=$case3;
        $case4 =new htmlForm('index.php', 'POST');
        $case4->addBtSubmit('Validation',"btn .btn-primary");
        $collection[]=$case4;
        $case5 =new htmlForm('index.php', 'POST');
        $case5->addBtSubmit('Signalement',"btn .btn-primary");
        $collection[]=$case5;
        $case6 =new htmlForm('index.php', 'POST');
        $case6->addBtSubmit('Profil',"btn .btn-primary");
        $collection[]=$case6;
        $case7 =new htmlForm('index.php', 'POST');
        $case7->addBtSubmit('Administration',"btn .btn-primary");
        $collection[]=$case7;
        $case8 =new htmlForm('index.php', 'POST');
        $case8->addBtSubmit('Deconnexion',"btn .btn-primary");
        $collection[]=$case8;
        //création d'un tableau html pour le rendu
        $menu="";
        foreach ($collection as $item){
            $menu.="<li class=\"nav-item\">".$item->render()."</li>";
        }

        $page=str_replace("%menu%",file_get_contents("../pkg_graphique/navbarTest.html"),$menu);

        echo $page;

    }
}