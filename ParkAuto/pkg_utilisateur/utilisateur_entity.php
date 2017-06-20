<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 25/05/2017
 * Time: 15:25
 */
class utilisateur_entity
{
    //attribut privé de la classe
    private $int_id;
    private $str_nom;
    private $str_prenom;
    private $str_mail;
    private $dte_dateDeNaissance;
    private $str_telephone;
    private $str_motDePasse;
    private $obj_service;
    private $obj_role;
    private $obj_responsable;
    private $bool_isChefService;

    /**
     * @return mixed
     */
    public function getBoolIsChefService()
    {
        return $this->bool_isChefService;
    }

    /**
     * @param mixed $bool_isChefService
     */
    public function setBoolIsChefService($bool_isChefService)
    {
        $this->bool_isChefService = $bool_isChefService;
    }

    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getIntId()
    {
        return $this->int_id;
    }

    /**
     * @param mixed $int_id
     */
    public function setIntId($int_id)
    {
        $this->int_id = $int_id;
    }

    /**
     * @return mixed
     */
    public function getStrNom()
    {
        return $this->str_nom;
    }

    /**
     * @param mixed $str_nom
     */
    public function setStrNom($str_nom)
    {
        $this->str_nom = $str_nom;
    }

    /**
     * @return mixed
     */
    public function getStrPrenom()
    {
        return $this->str_prenom;
    }

    /**
     * @param mixed $str_prenom
     */
    public function setStrPrenom($str_prenom)
    {
        $this->str_prenom = $str_prenom;
    }

    /**
     * @return mixed
     */
    public function getStrMail()
    {
        return $this->str_mail;
    }

    /**
     * @param mixed $str_mail
     */
    public function setStrMail($str_mail)
    {
        $this->str_mail = $str_mail;
    }

    /**
     * @return mixed
     */
    public function getDteDateDeNaissance()
    {
        return $this->dte_dateDeNaissance;
    }

    /**
     * @param mixed $dte_dateDeNaissance
     */
    public function setDteDateDeNaissance($dte_dateDeNaissance)
    {
        $this->dte_dateDeNaissance = $dte_dateDeNaissance;
    }

    /**
     * @return mixed
     */
    public function getStrTelephone()
    {
        return $this->str_telephone;
    }

    /**
     * @param mixed $str_telephone
     */
    public function setStrTelephone($str_telephone)
    {
        $this->str_telephone = $str_telephone;
    }

    /**
     * @return mixed
     */
    public function getStrMotDePasse()
    {
        return $this->str_motDePasse;
    }

    /**
     * @param mixed $str_motDePasse
     */
    public function setStrMotDePasse($str_motDePasse)
    {
        $this->str_motDePasse = $str_motDePasse;
    }

    /**
     * @return mixed
     */
    public function getObjService()
    {
        return $this->obj_service;
    }

    /**
     * @param mixed $obj_service
     */
    public function setObjService($obj_service)
    {
        $this->obj_service = $obj_service;
    }

    /**
     * @return mixed
     */
    public function getObjRole()
    {
        return $this->obj_role;
    }

    /**
     * @param mixed $obj_role
     */
    public function setObjRole($obj_role)
    {
        $this->obj_role = $obj_role;
    }

    /**
     * @return mixed
     */
    public function getObjResponsable()
    {
        return $this->obj_responsable;
    }

    /**
     * @param mixed $obj_responsable
     */
    public function setObjResponsable($obj_responsable)
    {
        $this->obj_responsable = $obj_responsable;
    }

    function __toString()
    {
        return $this->getStrNom().' '.$this->getStrPrenom();
    }


}