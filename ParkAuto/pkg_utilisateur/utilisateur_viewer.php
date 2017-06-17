<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 26/05/2017
 * Time: 11:33
 */
class utilisateur_viewer
{

    public function templateConnexion()
    {
        $myform=new htmlForm('index.php', 'POST');
        $myform->addFreeText("<h2 class=\"form-signin-heading\">Connexion</h2>");
        $myform->addFreeText("Email :");
        $myform->addText('mail_connect', '', '', '', '',"form-control","email");
        $myform->addFreeText("Mot de passe :");
        $myform->addPassword('mdp_connect', '', '', '', '',"form-control");
        $myform->addBtSubmit('valider',"Submit",'btn btn-lg btn-primary btn-block');

        //$page=str_replace("%form%",$myform->render(),file_get_contents("pkg_graphique/sign-in.html"));
        //echo $page;
        return $myform->render();
    }

    public function templateCrudUserDefault($arr_user)
    {
        //echo'<pre>';var_dump($arr_user);echo'</pre>';
        //TODO tableau contenant tout les utilisateur ainsi qu'une colonne action (edit, update, delete)
        //la trasmission d'info se fera via formulaire et champ caché (un formulaire pour le tableau, le click sur un bouton transmettra l'action et l'id de l'utilisateur concerné
        $obj_table = new STable();
        $obj_table->border = 1;
        $obj_table->thead()
            ->th("Nom")
            ->th("Prenom")
            ->th("E-mail")
            ->th("Date de naissance")
            ->th("Téléphone")
            ->th("Mot de passe")
            ->th("Service")
            ->th("Role")
            ->th("Responsable")
            ->th("Action");
        foreach ($arr_user as $user)
        {
            $nom=($user->getStrNom()==null)?'-':$user->getStrNom();
            $prenom=($user->getStrPrenom()==null)?'-':$user->getStrPrenom();
            $mail=($user->getStrMail()==null)?'-':$user->getStrMail();
            $dateNaissance=($user->getDteDateDeNaissance()==null)?'-':$user->getDteDateDeNaissance();
            $numTel=($user->getStrTelephone()==null)?'-':$user->getStrTelephone();
            $mdp=($user->getStrMotDePasse()==null)?'-':$user->getStrMotDePasse();
            $service=($user->getObjService()==null)?'-':$user->getObjService()->getObjChef()->__toString();
            $role=($user->getObjRole()==null)?'-':$user->getObjRole()->getStrLibelle();
            $reponsable=($user->getObjResponsable()==null)?'-':$user->getObjResponsable()->__toString();
            $formEdit = new htmlForm('index.php', 'POST');
            $formEdit->addHidden('idUserEdit', $user->getIntId());
            $formEdit->addHidden('mode', 'edit');
            $formEdit->addBtSubmit('Editer utilisateur',"Submit","btn");
            $formDelete = new htmlForm('index.php', 'POST');
            $formDelete->addHidden('idUserDelete', $user->getIntId());
            $formDelete->addHidden('mode', 'delete');
            $formDelete->addBtSubmit('Supprimer utilisateur',"Submit","btn");
            $obj_table->tr()
                ->td($nom)
                ->td($prenom)
                ->td($mail)
                ->td($dateNaissance)
                ->td($numTel)
                ->td($mdp)
                ->td($service)
                ->td($role)
                ->td($reponsable)
                ->td($formEdit->render().$formDelete->render());
        }
        $formAdd = new htmlForm('index.php', 'POST');
        $formAdd->addHidden('mode', 'add');
        $formAdd->addBtSubmit('Ajouter utilisateur',"Submit","btn");
        return $obj_table->getTable().$formAdd->render();

        //TODO détection de l'action delete pour afficher un message de confirmation si cette derniere à eu lieux
    }
    public function templateCrudUser($str_mode = 'add', $int_user_id = null)
    {
        //TODO Formulaire d'ajout d'utilisateur, pré-remplie grace à l'id si action édit sinon vide
        echo '<br><br><br>Mode : '.$str_mode;
        $formAdd = new htmlForm('index.php', 'POST');
        $formAdd->addHidden('addUser', 'addUser');
        $formAdd->addFreeText('Prénom : ');
        $formAdd->addText('prenomSaisi','', '', '',"form-control","prenomSaisi");
        $formAdd->addFreeText('Nom : ');
        $formAdd->addText('nomSaisi','', '', '',"form-control","nomSaisi");
        $formAdd->addFreeText('Adresse email : ');
        $formAdd->addText('mailSaisi','', '', '',"form-control","mailSaisi");
        $formAdd->addFreeText('Date de naissance : ');
        $formAdd->addText('dateSaisi',  '', 'datepicker', '', '');
        $formAdd->addFreeText('Téléphone : ');
        $formAdd->addText('telSaisi','', '', '',"form-control","telSaisi");
        $formAdd->addFreeText('Mot de passe : ');
        $formAdd->addPassword('mdpSaisi', '', '', '');
        $formAdd->addFreeText('Service : ');
        $formAdd->addBtSubmit('Valider',"Submit","btn");
        return $formAdd->render();
    }
}