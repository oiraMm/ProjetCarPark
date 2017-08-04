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
    public function getTemplateValidation()
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
                $arr_reservation= $this->obj_reservation_model->loadReservations();
                $str_template = $this->obj_reservation_viewer->templateValidation($arr_reservation);
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
            print_r($obj_resa);

            $ctrl_vehicule->saveVehicule($obj_resa->getObjVehicule());
            $this->getObjReservationModel()->saveReservation($obj_resa);
            
            $str_template='inserted';

        } else{

            $obj_resa = $this->getReservationById($idResa);
            $str_template = $this->obj_reservation_viewer->templateRecuperationVehicule($obj_resa);
        }
        return $str_template;
    }

    public function getTemplateCrudReservation(){
       
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
                $arr_reservation= $this->obj_reservation_model->loadReservations($current_user);
            
            
                $str_template = $this->obj_reservation_viewer->templateCrudReservationDefault($arr_reservation);
            }               
            
        }
        return $str_template;
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

        $obj_reservation=new reservation_entity();
        $obj_reservation->setIntId($_POST['idReservation']);
        $obj_reservation->setDateDebut($_POST['dateDebutSaisi']);
        $obj_reservation->setDateFin($_POST['dateFinSaisi']);
        $obj_reservation->setObjSalarie($_POST['idSalarie']);
        //$obj_reservation->setObjStatus($_POST['']);
        $obj_reservation->setObjVehicule($_POST['vehicule']);
        $obj_reservation->setStrRaison($_POST['raisonSaisi']);

        return $obj_reservation;
    }

}