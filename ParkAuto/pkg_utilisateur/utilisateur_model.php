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
                $obj_utilisateur->setStrMail($arr_result[0]['utilisateur_mail']);
                $obj_utilisateur->setDteDateDeNaissance($arr_result[0]['utilisateur_dateDeNaissance']);
                $obj_utilisateur->setStrTelephone($arr_result[0]['utilisateur_telephone']);
                $obj_utilisateur->setStrMotDePasse($arr_result[0]['utilisateur_motDePasse']);
                if ($arr_result[0]['utilisateur_service'] != null) {
                    //instancie le modele de l'objet utilisateur
                    $obj_service_controller = new service_controller();
                    //utilise le model charger pour charger l'objet role de l'utilisateur
                    $obj_service = $obj_service_controller->serviceOf($arr_result[0]['utilisateur_service']);
                    $obj_utilisateur->setObjService($obj_service);
                }
                //instancie le modele de l'objet utilisateur
                $obj_role_controller = new role_controller();
                //utilise le model charger pour charger l'objet role de l'utilisateur
                $obj_role = $obj_role_controller->roleOf($arr_result[0]['utilisateur_role']);
                $obj_utilisateur->setObjRole($obj_role);
                if ($arr_result[0]['utilisateur_responsable'] != null){
                    //instancie le modele de l'objet utilisateur
                    $obj_utilisateur_controller = new utilisateur_controller();
                    //utilise le model charger pour charger l'objet role de l'utilisateur
                    $obj_responsable = $obj_utilisateur_controller->getObjUtilisateurModel()->loadUtilisateurById($arr_result[0]['utilisateur_responsable']);
                    $obj_utilisateur->setObjResponsable($obj_responsable);
                }
                $obj_utilisateur->setBoolIsChefService($arr_result[0]['utilisateur_isChef']);
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
        $condition = 'utilisateur_mail = "'.$mail .'" AND utilisateur_motDePasse="'. $obj_bdd->HashData($motDePasse). '"';
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
    public function loadAllUser()
    {
        $obj_bdd = new bdd();
        $champ = '*';
        $table = 'utilisateur';
        $arr_result = $obj_bdd->select($champ, $table);
        $arr_user = null;
        foreach ($arr_result as $user)
        {
            $obj_utilisateur =  new utilisateur_entity();
            $obj_utilisateur->setIntId($user['utilisateur_id']);
            $obj_utilisateur->setStrNom($user['utilisateur_nom']);
            $obj_utilisateur->setStrPrenom($user['utilisateur_prenom']);
            $obj_utilisateur->setStrMail($user['utilisateur_mail']);
            $obj_utilisateur->setDteDateDeNaissance($user['utilisateur_dateDeNaissance']);
            $obj_utilisateur->setStrTelephone($user['utilisateur_telephone']);
            $obj_utilisateur->setStrMotDePasse($user['utilisateur_motDePasse']);
            if ($user['utilisateur_service'] != null) {
                //instancie le modele de l'objet utilisateur
                $obj_service_controller = new service_controller();
                //utilise le model charger pour charger l'objet role de l'utilisateur
                $obj_service = $obj_service_controller->serviceOf($user['utilisateur_service']);
                $obj_utilisateur->setObjService($obj_service);
            }
            //instancie le modele de l'objet utilisateur
            $obj_role_controller = new role_controller();
            //utilise le model charger pour charger l'objet role de l'utilisateur
            $obj_role = $obj_role_controller->getObjRoleModel()->roleOf($user['utilisateur_role']);
            $obj_utilisateur->setObjRole($obj_role);
            if ($user['utilisateur_responsable'] != null){
                //instancie le modele de l'objet utilisateur
                $obj_utilisateur_controller = new utilisateur_controller();
                //utilise le model charger pour charger l'objet role de l'utilisateur
                $obj_responsable = $obj_utilisateur_controller->getObjUtilisateurModel()->loadUtilisateurById($user['utilisateur_responsable']);
                $obj_utilisateur->setObjResponsable($obj_responsable);
            }
            $obj_utilisateur->setBoolIsChefService($user['utilisateur_isChef']);
            $arr_user[] = $obj_utilisateur;
        }


        return $arr_user;
    }
    public function aUserIsChefService($idService)
    {
        $obj_bdd = new bdd();
        $champ = 'utilisateur_isChef';
        $table = 'utilisateur';
        $condition = 'utilisateur_service = "'.$idService.'"';
        $arr_result = $obj_bdd->select($champ, $table, $condition);
        //echo '<br><br><br>Mode : '.$arr_result;
        //echo '<pre>';var_dump($arr_result);echo'<pre>';die();
        foreach ($arr_result as $result)
        {
            if ($result["utilisateur_isChef"] == true)
            {
                return true;
            }
        }
        return false;
    }

    public function whoIsChefService($idService)
    {

        $obj_bdd = new bdd();
        $champ = 'utilisateur_id';
        $table = 'utilisateur';
        $condition = 'utilisateur_service = "'.$idService.'" AND utilisateur_isChef = 1';
        $arr_result = $obj_bdd->select($champ, $table, $condition);
        //echo '<br><br><br>Mode : '.$arr_result;
        //echo '<pre>';var_dump($arr_result[0]['utilisateur_id']);echo'<pre>';die();
        $id = (isset($arr_result[0]['utilisateur_id']))?$arr_result[0]['utilisateur_id']:'-1';
        return $id;
    }

    public function saveUser($obj_user)
    {
        $obj_bd = new bdd();
        $table = 'utilisateur';
        $arra_champ_value['utilisateur_nom'] = '\''.$obj_user->getStrNom().'\'';
        $arra_champ_value['utilisateur_prenom'] = '\''.$obj_user->getStrPrenom().'\'';
        $arra_champ_value['utilisateur_mail'] = '\''.$obj_user->getStrMail().'\'';
        $arra_champ_value['utilisateur_dateDeNaissance'] = '\''.$obj_user->getDteDateDeNaissance().'\'';
        $arra_champ_value['utilisateur_telephone'] = '\''.$obj_user->getStrTelephone().'\'';
        if ($this->testMdp($obj_user->getIntId(),$obj_user->getStrMotDePasse())== true){
            $obj_bdd = new bdd();
            $arra_champ_value['utilisateur_motDePasse'] = '\''.$obj_bdd->HashData($obj_user->getStrMotDePasse()).'\'';}
        if ($obj_user->getObjService() != null){
            if ($obj_user->getObjService()->getIntId() != null){
                $arra_champ_value['utilisateur_service'] = $obj_user->getObjService()->getIntId();}
        }
        if ($obj_user->getObjRole() != null){
            if ($obj_user->getObjRole()->getIntId() != null){
                $arra_champ_value['utilisateur_role'] = $obj_user->getObjRole()->getIntId();}
        }
        if ($obj_user->getObjResponsable() != null){
            if ($obj_user->getObjResponsable()->getIntId() != null){
                $arra_champ_value['utilisateur_responsable'] = $obj_user->getObjResponsable()->getIntId();}
        }
        $arra_champ_value['utilisateur_isChef'] = ($obj_user->getBoolIsChefService()==true)?1:0;
        if ($obj_user->getIntId() != null )
        {
            $condition = 'utilisateur_id = "'.$obj_user->getIntId().'"';
            $arra_champ_value['utilisateur_id'] = $obj_user->getIntId();
            $obj_bd->update($table, $arra_champ_value, $condition);
        }
        else
        {
            $obj_bd->insert($table, $arra_champ_value);
        }
    }
    public function deleteUser ($id)
    {

        $obj_bdd = new bdd();
        //$champ = '*';
        $table = 'utilisateur';
        $condition = 'utilisateur_id = "'.$id.'"';
        $res_req = $obj_bdd->delete($table, $condition);
        if($res_req){
            return 'delete';
        }else{
            return 'delete-fail';
        }
        return $res_req;
    }
    //verifie si le Hash passez en parametre est le meme que celui stocker en base
    public function testMdp ($idUser, $mdp)
    {
        $obj_bdd = new bdd();
        $champ = 'utilisateur_motDePasse';
        $table = 'utilisateur';
        $condition = 'utilisateur_id = "'.$idUser.'"';
        $arr_result = $obj_bdd->select($champ, $table, $condition);
        if ($arr_result[0]['utilisateur_motDePasse'] == $mdp)
        {
            return false;
        }
        return true;
    }
}