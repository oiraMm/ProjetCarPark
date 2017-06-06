<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 25/05/2017
 * Time: 16:32
 */
class utilisateur_model
{
    public function __construct()
    {
    }

    public function loadUtilisateurById($id)
    {
        //charge les donné de l'utilisateur connecté dans l'objet utilisateur en fonction de l'identifiant fournie
        $obj_bdd = new bdd();
        $str_select = 'SELECT * FROM utilisateur WHERE utilisateur_id = '.$id;
        $arr_result = $obj_bdd->select($str_select);
        $obj_utilisateur =  new utilisateur_entity();
        if (isset($arr_result[0]))
        {
            if ($arr_result[0] != null)
            {
                $obj_utilisateur->setIntId($arr_result[0]['utilisateur_id']);
                $obj_utilisateur->setStrNom($arr_result[0]['utilisateur_nom']);
                $obj_utilisateur->setStrPrenom($arr_result[0]['utilisateur_prenom']);
                $obj_utilisateur->setStrMail($arr_result[0]['utilisateur_id']);
                $obj_utilisateur->setDteDateDeNaissance($arr_result[0]['utilisateur_mail']);
                $obj_utilisateur->setStrTelephone($arr_result[0]['utilisateur_telephone']);
                $obj_utilisateur->setStrMotDePasse($arr_result[0]['utilisateur_motDePasse']);
                $obj_utilisateur->setObjService($arr_result[0]['utilisateur_service']);
                //instancie le modele de l'objet utilisateur
                $obj_role_model = new role_model();
                //utilise le model charger pour charger l'objet role de l'utilisateur
                $obj_role = $obj_role_model->roleOf($arr_result[0]['utilisateur_role']);
                $obj_utilisateur->setObjRole($obj_role);
                $obj_utilisateur->setObjResponsable($arr_result[0]['utilisateur_responsable']);
            }
        }
        return $obj_utilisateur;
    }

    public function verifConnexion($mail, $motDePasse)
    {
        //vérifie si un utilisateur exist avec ce couple de mail/mdp et renvoie son id si il existe
        $obj_bdd = new bdd();
        $str_select = 'SELECT utilisateur_id FROM utilisateur WHERE utilisateur_mail = "'.$mail .'" AND utilisateur_motDePasse="'. $motDePasse.'"';
        $arr_result = $obj_bdd->select($str_select);
        if (isset($arr_result[0]))
        {
            if ($arr_result[0]['utilisateur_id'] != null)
            {
                $int_utilisateur_id = $arr_result[0]['utilisateur_id'];
                $obj_current_user = $this->loadUtilisateurById($int_utilisateur_id);
                $_SESSION['current_user'] = $obj_current_user->getIntId();
                return true;
            }
        }
        return false;
    }
}