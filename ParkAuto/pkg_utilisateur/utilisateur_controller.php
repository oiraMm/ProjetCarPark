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
                    echo 'edit';
                    $str_template = $this->obj_utilisateur_viewer->templateCrudUser('edit');
                    break;
                case 'add' :
                    $str_template = $this->obj_utilisateur_viewer->templateCrudUser('add');
                    break;
                default:
                    $arr_user = $this->obj_utilisateur_model->loadAllUser();
                    $str_template = $this->obj_utilisateur_viewer->templateCrudUserDefault($arr_user);
            }
        }
        else
        {
            $arr_user = $this->obj_utilisateur_model->loadAllUser();
            $str_template = $this->obj_utilisateur_viewer->templateCrudUserDefault($arr_user);
        }
        return $str_template;
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
