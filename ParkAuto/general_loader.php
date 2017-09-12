<?php
/**
 * Created by PhpStorm.
 * User: berne
 * Date: 05/06/2017
 * Time: 15:23
 */

session_start();
include_once 'pkg_mysql/bdd.php';
include_once  'pkg_html/html_loader.php';
include_once  'pkg_utilisateur/utilisateur_loader.php';
include_once  'pkg_news/news_loader.php';
include_once  'pkg_menu/menu_loader.php';
include_once  'pkg_role/role_loader.php';
include_once  'pkg_service/service_loader.php';
include_once  'pkg_niveau_carburant/niveau_carburant_loader.php';
include_once  'pkg_etat_vehicule/etat_vehicule_loader.php';
include_once  'pkg_vehicule/vehicule_loader.php';
include_once  'pkg_document/document_loader.php';
include_once  'pkg_status_reservation/status_reservation_loader.php';
include_once  'pkg_reservation/reservation_loader.php';
include_once  'pkg_type_carburant/type_carburant_loader.php';
include_once  'pkg_mail/mail_loader.php';