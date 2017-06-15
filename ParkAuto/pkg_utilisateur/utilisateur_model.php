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
        $champ = '*';
        $table = 'utilisateur';
        $condition = 'utilisateur_id = "'.$id.'"';
        $arr_result = $obj_bdd->select($champ, $table, $condition);
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
                if ($arr_result[0]['utilisateur_responsable'] != null) {
                    //instancie le modele de l'objet utilisateur
                    $obj_service_controller = new service_controller();
                    //utilise le model charger pour charger l'objet role de l'utilisateur
                    $obj_service = $obj_service_controller->get->serviceOf($arr_result[0]['utilisateur_service']);
                    $obj_utilisateur->setObjService($obj_service);
                }
                //instancie le modele de l'objet utilisateur
                $obj_role_model = new role_model();
                //utilise le model charger pour charger l'objet role de l'utilisateur
                $obj_role = $obj_role_model->roleOf($arr_result[0]['utilisateur_role']);
                $obj_utilisateur->setObjRole($obj_role);
                if ($arr_result[0]['utilisateur_responsable'] != null){
                    //instancie le modele de l'objet utilisateur
                    $obj_utilisateur_model = new utilisateur_model();
                    //utilise le model charger pour charger l'objet role de l'utilisateur
                    $obj_responsable = $obj_utilisateur_model->loadUtilisateurById($arr_result[0]['utilisateur_responsable']);
                    $obj_utilisateur->setObjResponsable($obj_responsable);
                }
            }
        }
        return $obj_utilisateur;
    }

    public function verifConnexion($mail, $motDePasse)
    {
        //vérifie si un utilisateur exist avec ce couple de mail/mdp et renvoie son id si il existe
        $obj_bdd = new bdd();
        $champ = 'utilisateur_id';
        $table = 'utilisateur';
        $condition = 'utilisateur_mail = "'.$mail .'" AND utilisateur_motDePasse="'. $motDePasse. '"';
        $arr_result = $obj_bdd->select($champ, $table, $condition);
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