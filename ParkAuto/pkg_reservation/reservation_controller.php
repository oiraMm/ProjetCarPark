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
    public function getTemplateCrudReservation(){
       
        
        if (isset($_SESSION['current_user']))    
        {
            $int_id_current_user = $_SESSION['current_user'];
            $current_user_model = new utilisateur_model();
            $current_user = $current_user_model->loadUtilisateurById($int_id_current_user);
            
            if (isset($_POST['mode']))
            {
                switch ($_POST['mode']) {
                    case 'edit' :
                        //$str_template = $this->obj_utilisateur_viewer->templateCrudReservation('edit', $_POST['idReservationEdit']);
                        break;
                    case 'add' :
                        //$str_template = $this->obj_utilisateur_viewer->templateCrudReservation('add');
                        break;
                    case 'delete':
                        echo '<br><br><br>test'.$_POST['idReservationDelete'];
                        $resReq=$this->obj_reservation_model->deleteReservation($_POST['idReservationDelete']);
                        print_r($resReq);
                        echo 'okok';
                        $arr_reservation= $this->obj_reservation_model->loadReservations($current_user);
                        $str_template = $this->obj_reservation_viewer->templateCrudReservationDefault($arr_reservation);
                        print_r($str_template);
                        echo 'okokokokokokokok';
                        break;
                    
                }
            }
            elseif (isset($_POST['addUser']))
            {
                switch ($_POST['addUser']) {
                    
                    
                }
            }
            else{
                $arr_reservation= $this->obj_reservation_model->loadReservations($current_user);
            
            
                $str_template = $this->obj_reservation_viewer->templateCrudReservationDefault($arr_reservation);
            }               
            
        }
        return $str_template;
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

}