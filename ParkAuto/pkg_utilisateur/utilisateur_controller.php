<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 25/05/2017
 * Time: 16:32
 */
class utilisateur_controller
{
    //attribut privé de la classe
    //controller et model de la classe
    private $obj_utilisateur_model;
    private $obj_utilisateur_viewer;

    public function __construct($str_action = "")
    {
        $this->obj_utilisateur_model = new utilisateur_model();
        $this->obj_utilisateur_viewer = new utilisateur_viewer();

        /*if ($str_action == 'actionAfficheConnexion') {
            return $this->obj_utilisateur_viewer->templateConnexion();
        }
        else*/if ($str_action == 'connexion') {
            $this->connexion();
            return 0;
        }
    }

    public function connexion()
    {
        //vérifie l'existance des données saisie
        if (isset($_POST['mail_connect']) && isset($_POST['mdp_connect']))
        {
            $_POST['connexion_reussi'] = $this->obj_utilisateur_model->verifConnexion($_POST['mail_connect'], $_POST['mdp_connect']);
            if ($_POST['connexion_reussi'] == false) {
                $this->obj_utilisateur_viewer->templateConnexion();
            }
            else{
                header('Location: index.php');
            }

        } else {
            $this->obj_utilisateur_viewer->templateConnexion();
        }

    }

    public function getTemplateConnexion()
    {
        return $this->obj_utilisateur_viewer->templateConnexion();
    }

    public function getTemplateCrudUser()
    {
        if (isset($_POST['mode']))
        {
            switch ($_POST['mode']) {
                case 'edit' :
                    $str_template = $this->obj_utilisateur_viewer->templateCrudUser('edit', $_POST['idUserEdit']);
                    break;
                case 'add' :
                    $str_template = $this->obj_utilisateur_viewer->templateCrudUser('add');
                    break;
                case 'delete' :
                    $delete = $this->getObjUtilisateurModel()->deleteUser($_POST['idUserDelete']);
                    $arr_user = $this->obj_utilisateur_model->loadAllUser();
                    $str_template = $this->obj_utilisateur_viewer->templateCrudUserDefault($arr_user);
                    break;
            }
        }
        elseif (isset($_POST['userMode']))
        {
            $obj_user = $this->retrievePostData();
            $saveUser = $this->getObjUtilisateurModel()->saveUser($obj_user);
            if ($_FILES["permis"]["name"])
            {
                $obj_document = $this->retrieveUploadFilesData($obj_user);
                $obj_document_controller=new document_controller();
                $obj_document_controller->saveDocument($obj_document);
            }
            $arr_user = $this->obj_utilisateur_model->loadAllUser();
            $str_template = $this->obj_utilisateur_viewer->templateCrudUserDefault($arr_user);
        }
        else
        {
            $arr_user = $this->obj_utilisateur_model->loadAllUser();
            $str_template = $this->obj_utilisateur_viewer->templateCrudUserDefault($arr_user);
        }
        return $str_template;
    }

    public function retrieveUploadFilesData($obj_user_temp)
    {
        //recupération de l'id
        $obj_user = $this->obj_utilisateur_model->loadUtilisateurByNameMail($obj_user_temp->getStrNom(), $obj_user_temp->getStrPrenom(), $obj_user_temp->getStrMail());
        $obj_document = new document_entity();
        $obj_document->setObjSalarie($obj_user);
        $arra_name = explode(".", $_FILES["permis"]["name"]);
        $today = date('j-m-y-h-i-s');
        $file_name = $arra_name[0].$today.'.'.$arra_name[1];
        $obj_document->setStrName($file_name);
        $stri_path = "/upload/".$file_name;
        $obj_document->setStrPath($stri_path);
        move_uploaded_file($_FILES["permis"]["tmp_name"], "./".$stri_path);
        return $obj_document;
    }

    public function retrievePostData()
    {
        $obj_user = new utilisateur_entity();
        $obj_user->setIntId($_POST['idUser']);
        $obj_user->setStrNom($_POST['nomSaisi']);
        $obj_user->setStrPrenom($_POST['prenomSaisi']);
        $obj_user->setStrMail($_POST['mailSaisi']);
        $dateNaissance = date( "Y-m-d", strtotime( $_POST['dateSaisi'] ));
        $obj_user->setDteDateDeNaissance($dateNaissance);
        $obj_user->setStrTelephone($_POST['telSaisi']);
        $obj_bdd = new bdd();
        $obj_user->setStrMotDePasse($_POST['mdpSaisi']);
        $obj_service_controller = new service_controller();
        $obj_user->setObjService($obj_service_controller->getServiceById($_POST['service']));
        $obj_role_controller = new role_controller();
        $obj_user->setObjRole($obj_role_controller->roleOf($_POST['role']));
        $obj_user_controller = new utilisateur_controller();
        $obj_user->setObjResponsable($obj_user_controller->getUserById($_POST['utilisateurResp']));
        $obj_user->setBoolIsChefService($_POST['isChefServiceHidden']);
        return $obj_user;
    }

    public function aUserIsChefService($idService)
    {
        $boolTest = $this->getObjUtilisateurModel()->aUserIsChefService($idService);
        return $boolTest;
    }

    public function getAllUser()
    {
        $arr_user = $this->getObjUtilisateurModel()->loadAllUser();
        return $arr_user;
    }

    public function loadAllUserExeptResp($idUser)
    {
        $arr_user = $this->getObjUtilisateurModel()->loadAllUserExeptResp($idUser);
        return $arr_user;
    }

    public function getUserById($id)
    {
        $user = $this->getObjUtilisateurModel()->loadUtilisateurById($id);
        return $user;
    }

    /**
     * @return utilisateur_model
     */
    public function getObjUtilisateurModel()
    {
        return $this->obj_utilisateur_model;
    }

    /**
     * @param utilisateur_model $obj_utilisateur_model
     */
    public function setObjUtilisateurModel(utilisateur_model $obj_utilisateur_model)
    {
        $this->obj_utilisateur_model = $obj_utilisateur_model;
    }

    /**
     * @return utilisateur_viewer
     */
    public function getObjUtilisateurViewer()
    {
        return $this->obj_utilisateur_viewer;
    }

    /**
     * @param utilisateur_viewer $obj_utilisateur_viewer
     */
    public function setObjUtilisateurViewer(utilisateur_viewer $obj_utilisateur_viewer)
    {
        $this->obj_utilisateur_viewer = $obj_utilisateur_viewer;
    }


}
