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
        $myform->addPassword('mdp_connect', '', '', '', "form-control");
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
        //echo '<br><br><br>Mode : '.$str_mode;
        if ($int_user_id != null)
        {
            $user_controller = new utilisateur_controller();
            $user = $user_controller->getUserById($int_user_id);
            $valId = $int_user_id;
            $valPrenom = $user->getStrPrenom();
            $valNom = $user->getStrNom();
            $valMail = $user->getStrMail();
            $valDate = $user->getDteDateDeNaissance();
            $valTel = $user->getStrTelephone();
            $valMdp = $user->getStrMotDePasse();
            //$valService = $user->getObjService()->getIntId();
            $valService='';
        }
        else
        {
            $valId = '';
            $valPrenom = '';
            $valNom = '';
            $valMail = '';
            $valDate = '';
            $valTel = '';
            $valMdp='';
            $valService='';
        }
        $formAdd = new htmlForm('index.php', 'POST');
        $formAdd->addHidden('addUser', 'addUser');
        $formAdd->addHidden('idUser', $valId);
        $formAdd->addFreeText('Prénom : ');
        $formAdd->addText('prenomSaisi',$valPrenom, '', '', '',"form-control");
        $formAdd->addFreeText('Nom : ');
        $formAdd->addText('nomSaisi',$valNom, '', '', '',"form-control");
        $formAdd->addFreeText('Adresse email : ');
        $formAdd->addText('mailSaisi',$valMail, '', '', '',"form-control");
        $formAdd->addFreeText('Date de naissance : ');
        $formAdd->addText('dateSaisi',$valDate, '', '', '',"form-control");
        $formAdd->addFreeText('Téléphone : ');
        $formAdd->addText('telSaisi',$valTel, '', '', '',"form-control");
        $formAdd->addFreeText('Mot de passe : ');
        $formAdd->addPassword('mdpSaisi', $valMdp, '', '',"form-control");
        $formAdd->addFreeText('Service : ');
        $obj_service_controller = new service_controller();
        $arr_service = $obj_service_controller->getAllService();
        $formAdd->addSelect('service', "form-control");
        foreach ($arr_service as $oneService)
        {
            /*if ($valService == $oneService->getIntId())
            {
                $selected = true;
            }
            else
            {
                $selected = false;
            }*/
            $formAdd->addSelectOption('service', $oneService->getIntId(), $oneService->getStrLibelle()/*, $selected*/);
        }
        $formAdd->addFreeText('Role : ');
        $obj_role_controller = new role_controller();
        $arr_role = $obj_role_controller->getAllRole();
        $formAdd->addSelect('role', "form-control");
        foreach ($arr_role as $oneRole)
        {
            $formAdd->addSelectOption('role', $oneRole->getIntId(), $oneRole->getStrLibelle());
        }


        $formAdd->addFreeText('Responsable : ');
        $obj_utilisateur_controller = new utilisateur_controller();
        $arr_utilisateur = $obj_utilisateur_controller->getAllUser();
        $formAdd->addSelect('utilisateur', "form-control");
        foreach ($arr_utilisateur as $oneUtilisateur)
        {
            $formAdd->addSelectOption('utilisateur', $oneUtilisateur->getIntId(), $oneUtilisateur->__ToString());
        }
        $formAdd->addBtSubmit('Valider',"Submit","btn");
        return $formAdd->render();
    }
}