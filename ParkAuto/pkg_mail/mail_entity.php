<?php

/**
 * Created by PhpStorm.
 * User: mario
 * Date: 12/09/17
 * Time: 09:32
 */
class mail_entity
{
    private $addresse;
    private $subject;
    private $content;

    /**
     * @return mixed
     */
    public function getAddresse()
    {
        return $this->addresse;
    }

    /**
     * @param mixed $addresse
     */
    public function setAddresse($addresse)
    {
        $this->addresse = $addresse;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * mail_entity constructor.
     */
    public function __construct()
    {
    }

    public function newReservation($obj_reservation){
        $this->setSubject('Nouvelle Reservation');
        $this->setContent('Nouvelle demande de reseravtion de '.$obj_reservation->getObjSalarie()->getStrPrenom().' '.$obj_reservation->getObjSalarie()->getStrNom().
            ' du '.$obj_reservation->getDateDebut().' au '.$obj_reservation->getDateFin().
            ' avec le véhicule '.$obj_reservation->getObjVehicule()->getStrMarque().' '.$obj_reservation->getObjVehicule()->getStrModel().
            ' pour la raison suivante :
                            '.$obj_reservation->getStrRaison().'
                            
                            Connectez vous à la plateforme beta.mavril.fr pour accepter ou refuser la demande de reservation');
        $this->setAddresse($obj_reservation->getObjSalarie()->getObjResponsable()->getStrMail());
        $this->sendMail();
    }

    public function modReservation($obj_reservation){
        $this->setSubject('Rervation de '.$obj_reservation->getObjSalarie()->getStrPrenom().' '.$obj_reservation->getObjSalarie()->getStrNom().' modifiée');
        $this->setContent('Modification de reseravtion de '.$obj_reservation->getObjSalarie()->getStrPrenom().' '.$obj_reservation->getObjSalarie()->getStrNom().
            ' du '.$obj_reservation->getDateDebut().' au '.$obj_reservation->getDateFin().
            ' avec le véhicule '.$obj_reservation->getObjVehicule()->getStrMarque().' '.$obj_reservation->getObjVehicule()->getStrModel().
            ' pour la raison suivante :
                            '.$obj_reservation->getStrRaison().'
                            
                            Connectez vous à la plateforme beta.mavril.fr pour accepter ou refuser la demande de reservation');
        $this->setAddresse($obj_reservation->getObjSalarie()->getObjResponsable()->getStrMail());
        $this->sendMail();

    }

    public function acceptedReservation($obj_reservation){
        $this->setSubject('Rervation acceptée');
        $this->setContent('Felicitations votre réservation à été acceptée! 
        Pour rappel votre réservation débute le '.$obj_reservation->getDateDebut().' jusqu\'au '.$obj_reservation->getDateFin().
            ' avec le véhicule '.$obj_reservation->getObjVehicule()->getStrMarque().' '.$obj_reservation->getObjVehicule()->getStrModel().
            ' pour la raison suivante :
                            '.$obj_reservation->getStrRaison().'
                            
                            Connectez vous à la plateforme beta.mavril.fr pour effectuer la récupération du véhicule');
        $this->setAddresse($obj_reservation->getObjSalarie()->getStrMail());
        $this->sendMail();
    }

    public function refusedReservation($obj_reservation){
        $this->setSubject('Rervation refusée');
        $this->setContent('Malheureusement votre réservation à été refusée! 
        Pour rappel votre réservation débutais le '.$obj_reservation->getDateDebut().' jusqu\'au '.$obj_reservation->getDateFin().
            ' avec le véhicule '.$obj_reservation->getObjVehicule()->getStrMarque().' '.$obj_reservation->getObjVehicule()->getStrModel().
            ' pour la raison suivante :
                            '.$obj_reservation->getStrRaison().'
                            
                            Connectez vous à la plateforme beta.mavril.fr pour effectuer une nouvelle demande de réservation ou contactez votre responsable');
        $this->setAddresse($obj_reservation->getObjSalarie()->getStrMail());
        $this->sendMail();

    }

    private function sendMail(){

        //$mail=$this->getAddresse();
        //Laissé pour test
        $mail = 'max.nos@hotmail.fr'; // Déclaration de l'adresse de destination.
        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
        {
            $passage_ligne = "\r\n";
        }
        else
        {
            $passage_ligne = "\n";
        }

        //=====Déclaration des messages au format texte et au format HTML.
        $message_txt=$this->getContent();
        //Laissé pour test
        //$message_txt = "Salut à tous, voici un e-mail envoyé par un script PHP.";
        $message_html= "<html><head></head><body>".$message_txt."</body></html>";

        //=====Création de la boundary
        $boundary = "-----=".md5(rand());

        //=====Définition du sujet.
        $sujet = "Gestion des véhicules : ";

        $sujet.= $this->getSubject();

        //=====Création du header de l'e-mail.
        $header = "From: \"ROOT\"<root@scuti.mavril.fr>".$passage_ligne;
        $header.= "Reply-to: \"ROOT\" <root@scuti.mavril.fr>".$passage_ligne;
        $header.= "MIME-Version: 1.0".$passage_ligne;
        $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

        //=====Création du message.
        $message = $passage_ligne."--".$boundary.$passage_ligne;

        //=====Ajout du message au format texte.
        $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
        $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
        $message.= $passage_ligne.$message_txt.$passage_ligne;

        $message.= $passage_ligne."--".$boundary.$passage_ligne;

        //=====Ajout du message au format HTML
        $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
        $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
        $message.= $passage_ligne.$message_html.$passage_ligne;

        $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
        $message.= $passage_ligne."--".$boundary."--".$passage_ligne;

        //=====Envoi de l'e-mail.
        mail($mail,$sujet,$message,$header);

    }



}