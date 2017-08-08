<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 12/06/2017
 * Time: 17:32
 */
class reservation_controller
{
    //attribut privé de la classe
    //controller et model de la classe
    private $obj_reservation_model;
    private $obj_reservation_viewer;
    public function __construct($str_action = "")
    {
        $this->obj_reservation_model = new reservation_model();
        $this->obj_reservation_viewer = new reservation_viewer();
        
        
        if ($str_action == 'connexion') {
            $this->connexion();
            return 0;
        }
    }
   
     public function connexion()
    {
        //vérifie l'existance des données saisie
        if (isset($_POST['mail_connect']) && isset($_POST['mdp_connect']))
        {
            $_POST['connexion_reussi'] = $this->obj_reservation_model->verifConnexion($_POST['mail_connect'], $_POST['mdp_connect']);
            if ($_POST['connexion_reussi'] == false) {
                $this->obj_reservation_viewer->templateConnexion();
            }
            else{
                header('Location: index.php');
            }

        } else {
            $this->obj_reservation_viewer->templateConnexion();
        }

    }

    //TODO A optimiser dans switch case MODE
    //Ajouter menu déroulant sélection
    public function getTemplateValidation($withFilters=true,$dateDebut=null,$idVehicule=null,$idStatus=null,$idUser=0)
    {
        $str_template='';
        if (isset($_SESSION['current_user'])) {
            $int_id_current_user = $_SESSION['current_user'];
            $current_user_model = new utilisateur_model();
            $current_user = $current_user_model->loadUtilisateurById($int_id_current_user);
            if (isset($_POST['mode']))
            {
                switch ($_POST['mode']) {
                    case 'accept':
                        $res_req=$this->obj_reservation_model->changeReservationStatus($_POST['idReservationAccept'],'1');
                        $arr_reservation= $this->obj_reservation_model->loadReservations();
                        $str_template = $this->obj_reservation_viewer->templateValidation($arr_reservation);
                        break;
                    case 'refuse':
                        $res_req=$this->obj_reservation_model->changeReservationStatus($_POST['idReservationRefuse'],'2');
                        $arr_reservation= $this->obj_reservation_model->loadReservations();
                        $str_template = $this->obj_reservation_viewer->templateValidation($arr_reservation);
                        break;

                }
            }elseif($current_user->getObjRole()->getIntId()=='1' || $current_user->getObjRole()->getIntId()=='2'){
                $str_template='';
                if($withFilters){
                    $arr_filters=array('dateDebut','vehicule','user','status');
                    $str_template .= $this->getFilters($arr_filters,'valid');

                }

                $arr_reservation= $this->obj_reservation_model->loadReservations($current_user,$dateDebut,$idVehicule,$idStatus,$idUser);
                $str_template .= $this->obj_reservation_viewer->templateValidation($arr_reservation);
            }

        }
        return $str_template;
    }

    public function getTodayReservations(){
        $int_id_current_user = $_SESSION['current_user'];
        $current_user_model = new utilisateur_model();
        $current_user = $current_user_model->loadUtilisateurById($int_id_current_user);
        $date=date("Y-m-d");
        $arr_reservation=$this->obj_reservation_model->loadReservations($current_user,$date);
        if ($arr_reservation !=null) {
            $str_reservation_template= $this->obj_reservation_viewer->templateTodayReservation($arr_reservation);

            return $str_reservation_template;
        }
        else
        {
            return $this->obj_reservation_viewer->templateNoResa();
        }


        return $str_template;
    }

    public function rendreVehicule($idResa){

        $ctrl_niveau_carburant=new niveau_carburant_controller();
        $ctr_statuts=new status_reservation_controller();
        $ctrl_vehicule=new vehicule_controller();
        $ctrl_etat_vehicule=new etat_vehicule_controller();

        $obj_resa=$this->getObjReservationModel()->loadReservationById($idResa);
        $obj_niveau_carburant=$ctrl_niveau_carburant->loadNiveauById($_POST['plein']);
        $obj_resa->getObjVehicule()->setObjNiveauCarburant($obj_niveau_carburant);
        $obj_etat_vehicule=$ctrl_etat_vehicule->loadEtatById($_POST['etatVehicule']);
        $obj_resa->getObjVehicule()->setObjEtat($obj_etat_vehicule);
        $obj_resa->getObjVehicule()->setIntKm($_POST['kilometrage']);
        $obj_resa->setObjStatus($ctr_statuts->getStatusByID(6));


        $ctrl_vehicule->saveVehicule($obj_resa->getObjVehicule());
        $this->getObjReservationModel()->saveReservation($obj_resa);


    }

    public function recuperationVehicule($idResa)
    {
        //TODO déléguer une partie au model

        if ($_POST['reservationMode'] == 'saveRecuperation') {
            $ctrl_niveau_carburant=new niveau_carburant_controller();
            $ctr_statuts=new status_reservation_controller();
            $ctrl_vehicule=new vehicule_controller();

            $obj_resa=$this->getObjReservationModel()->loadReservationById($idResa);
            $obj_niveau_carburant=$ctrl_niveau_carburant->loadNiveauById($_POST['plein']);
            $obj_resa->getObjVehicule()->setObjNiveauCarburant($obj_niveau_carburant);
            $obj_resa->getObjVehicule()->setIntKm($_POST['kilometrage']);
            $obj_resa->setObjStatus($ctr_statuts->getStatusByID(5));


            $ctrl_vehicule->saveVehicule($obj_resa->getObjVehicule());
            $this->getObjReservationModel()->saveReservation($obj_resa);
            
            $str_template='inserted';

        }elseif (!isset($_POST['reservationMode'])){
            $obj_resa = $this->getReservationById($idResa);
            $str_template = $this->obj_reservation_viewer->templateRecuperationVehicule($obj_resa);
        } elseif($_POST['reservationMode'] == 'rendreVehicule') {
            $obj_resa = $this->getReservationById($idResa);
            $str_template = $this->obj_reservation_viewer->templateRendreVehicule($obj_resa);
        }
        elseif($_POST['reservationMode'] == 'saveRendreVehicule'){
            $this->rendreVehicule($idResa);
            $str_template = 'inserted';

        }
        return $str_template;
    }

    public function getTemplateCrudReservation($withFilters=true,$dateDebut=null, $idVehicule=null, $idStatus=null, $idUser=null){
       
        //TODO Verification des requetes en base
        if (isset($_SESSION['current_user']))    
        {
            $int_id_current_user = $_SESSION['current_user'];
            $current_user_model = new utilisateur_model();
            $current_user = $current_user_model->loadUtilisateurById($int_id_current_user);
            
            if (isset($_POST['mode']))
            {
                switch ($_POST['mode']) {
                    case 'edit' :
                        $str_template = $this->obj_reservation_viewer->templateCrudReservation('edit', $_POST['idReservationEdit']);
                        break;
                    case 'add' :
                        $str_template = $this->obj_reservation_viewer->templateCrudReservation('add');
                        break;
                    case 'delete':
                        $resReq=$this->obj_reservation_model->deleteReservation($_POST['idReservationDelete']);
                        $arr_reservation= $this->obj_reservation_model->loadReservations($current_user);
                        $str_template = $this->obj_reservation_viewer->templateCrudReservationDefault($arr_reservation,$resReq);
                        break;
                    
                }
            }
            elseif (isset($_POST['reservationMode']))
            {
                switch ($_POST['reservationMode']) {
                    case 'saveReservation':

                        $obj_reservation = $this->retrievePostData();
                        $save = $this->obj_reservation_model->saveReservation($obj_reservation);
                        $arr_reservation = $this->obj_reservation_model->loadReservations($current_user,$save);
                        $str_template = $this->obj_reservation_viewer->templateCrudReservationDefault($arr_reservation,$save);
                        break;
                }
            }
            else{
                if($dateDebut!=null){
                    $dateDebut=substr($dateDebut,0,10);

                }
                $arr_reservation= $this->obj_reservation_model->loadReservations($current_user,$dateDebut,$idVehicule,$idStatus,$idUser);

                $str_template='';
                if($withFilters){
                    $arr_filters=array('dateDebut','vehicule','status');
                    $str_template .= $this->getFilters($arr_filters);


                }
                $str_template .= $this->obj_reservation_viewer->templateCrudReservationDefault($arr_reservation,null,$withFilters);
            }               
            
        }
        return $str_template;
    }

    public function getFilters($arr_filters,$arg=''){
        $str_template ='<div class="container" id="wrapper'.$arg.'"><div class="row">';
        foreach ($arr_filters as $filter){
            switch ($filter){
                case 'vehicule':
                    $str_template.=$this->getVehiculeFilter();
                    break;
                case 'user':
                    $str_template.=$this->userFilter();
                    break;
                case 'status':
                    $str_template.=$this->statusFilter();
                    break;
                case 'dateDebut':
                    $str_template.=$this->dateFilter('Debut');
                    break;
                case 'dateFin':
                    $str_template.=$this->dateFilter('Fin');
                    break;
            }
        }

        $str_template .= '</div></div>';
        return $str_template;

    }

    public function getVehiculeFilter(){
        $ctrl_vehicule=new vehicule_controller();
        $arr_vehicules=$ctrl_vehicule->getAllVehicules();
        return $this->obj_reservation_viewer->templateVehiculeFilter($arr_vehicules);

    }

    public function userFilter(){
        $ctrl_user=new utilisateur_controller();
        $arr_users=$ctrl_user->getAllUser();
        return $this->obj_reservation_viewer->templateUserFilter($arr_users);
    }

    public function statusFilter(){
        $ctrl_status=new status_reservation_controller();
        $arr_status=$ctrl_status->getAllStatus();
        return $this->obj_reservation_viewer->templateStatusFilter($arr_status);

    }

    //Periode = Fin ou Debut Obligatoire!
    public function dateFilter($periode){
        return $this->obj_reservation_viewer->templateDateFilter($periode);

    }

    //Permet de récupérer une réservation via son ID
    public function getReservationById($id){

        return $this->obj_reservation_model->loadReservationById($id);

    }

    //Permet de récupérer les reservation en cours pour un véhicule
    public function reservationByVehiculeId($id){
        
        return $this->obj_reservation_model->reservationByVehiculeId($id);
        
    }
    /**
     * @return reservation_model
     */
    public function getObjReservationModel()
    {
        return $this->obj_reservation_model;
    }

    /**
     * @param reservation_model $obj_reservation_model
     */
    public function setObjReservationModel(reservation_model $obj_reservation_model)
    {
        $this->obj_reservation_model = $obj_reservation_model;
    }

    /**
     * @return reservation_viewer
     */
    public function getObjReservationViewer()
    {
        return $this->obj_reservation_viewer;
    }

    /**
     * @param reservation_viewer $obj_reservation_viewer
     */
    public function setObjReservationViewer(reservation_viewer $obj_reservation_viewer)
    {
        $this->obj_reservation_viewer = $obj_reservation_viewer;
    }

    public function retrievePostData(){

        $ctrl_vehicule=new vehicule_controller();
        $ctrl_salarie=new utilisateur_controller();

        $obj_reservation=new reservation_entity();
        $obj_reservation->setIntId($_POST['idReservation']);
        $obj_reservation->setDateDebut($_POST['dateDebutSaisi']);
        $obj_reservation->setDateFin($_POST['dateFinSaisi']);
        $obj_reservation->setObjSalarie($ctrl_salarie->getUserById($_POST['idSalarie']));
        //$obj_reservation->setObjStatus($_POST['']);
        $obj_reservation->setObjVehicule($ctrl_vehicule->getVehiculeById($_POST['vehicule']));
        $obj_reservation->setStrRaison($_POST['raisonSaisi']);

        return $obj_reservation;
    }

}