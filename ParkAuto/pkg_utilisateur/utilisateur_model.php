<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 25/05/2017
 * Time: 16:32
 */
class utilisateur_model
{
    public function _construct()
    {
    }

    public function loadUtilisateurById($id)
    {
        //charge les donné de l'utilisateur connecté dans l'objet utilisateur en fonction de l'identifiant fournie
        $obj_bdd = new bdd();
        $str_select = 'SELECT * FROM utilisateur WHERE utilisateur_id = '.$id;
        $arr_result = $obj_bdd->select($str_select);
        $obj_utilisateur =  new utilisateur_entity();
        if (isset($obj_utilisateur[0]))
        {
            if ($obj_utilisateur[0] != null)
            {
                $obj_utilisateur->setIntId($obj_utilisateur[0]['utilisateur_id']);
                $obj_utilisateur->setStrNom($obj_utilisateur[0]['utilisateur_nom']);
                $obj_utilisateur->setStrPrenom($obj_utilisateur[0]['utilisateur_prenom']);
                $obj_utilisateur->setStrMail($obj_utilisateur[0]['utilisateur_id']);
                $obj_utilisateur->setDteDateDeNaissance($obj_utilisateur[0]['utilisateur_mail']);
                $obj_utilisateur->setStrTelephone($obj_utilisateur[0]['utilisateur_telephone']);
                $obj_utilisateur->setStrMotDePasse($obj_utilisateur[0]['utilisateur_motDePasse']);
                $obj_utilisateur->setObjService($obj_utilisateur[0]['utilisateur_service']);
                $obj_utilisateur->setObjRole($obj_utilisateur[0]['utilisateur_role']);
                $obj_utilisateur->setObjResponsable($obj_utilisateur[0]['utilisateur_responsable']);
            }
        }
        return $obj_utilisateur;
    }

    public function verifConnexion($mail, $motDePasse)
    {
        //vérifie si un utilisateur exist avec ce couple de mail/mdp et renvoie son id si il existe
        $obj_bdd = new bdd();
        $str_select = 'SELECT utilisateur_id FROM utilisateur WHERE utilisateur_mail = '.$mail .' AND utilisateur_motDePasse='. $motDePasse;
        $arr_result = $obj_bdd->select($str_select);
        if (isset($obj_utilisateur[0]))
        {
            if ($obj_utilisateur[0]['utilisateur_id'] != null)
            {
                $int_utilisateur_id = $obj_utilisateur[0]['utilisateur_id'];
                $obj_current_user = $this->loadUtilisateurById($int_utilisateur_id);
                $_SESSION['current_user'] = $obj_current_user;
                return true;
            }
        }
    }
}