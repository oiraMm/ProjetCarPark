<?php
/**
 * Created by PhpStorm.
 * User: berne
 * Date: 05/06/2017
 * Time: 15:23
 */

session_start();
include_once '../../pkg_mysql/bdd.php';
include_once '../../pkg_html/htmlForm.php';
include_once '../../pkg_html/STable.php';
include_once '../../pkg_document/document_controller.php';
include_once '../../pkg_document/document_model.php';
include_once '../../pkg_document/document_viewer.php';
include_once '../../pkg_document/document_entity.php';
include_once '../../pkg_etat_vehicule/etat_vehicule_controller.php';
include_once '../../pkg_etat_vehicule/etat_vehicule_model.php';
include_once '../../pkg_etat_vehicule/etat_vehicule_viewer.php';
include_once '../../pkg_etat_vehicule/etat_vehicule_entity.php';
include_once '../../pkg_menu/menu_controller.php';
include_once '../../pkg_menu/menu_viewer.php';
include_once '../../pkg_news/news_controller.php';
include_once '../../pkg_news/news_model.php';
include_once '../../pkg_news/news_viewer.php';
include_once '../../pkg_news/news_entity.php';
include_once '../../pkg_niveau_carburant/niveau_carburant_controller.php';
include_once '../../pkg_niveau_carburant/niveau_carburant_model.php';
include_once '../../pkg_niveau_carburant/niveau_carburant_viewer.php';
include_once '../../pkg_niveau_carburant/niveau_carburant_entity.php';
include_once '../../pkg_reservation/reservation_controller.php';
include_once '../../pkg_reservation/reservation_model.php';
include_once '../../pkg_reservation/reservation_viewer.php';
include_once '../../pkg_reservation/reservation_entity.php';
include_once '../../pkg_role/role_controller.php';
include_once '../../pkg_role/role_model.php';
include_once '../../pkg_role/role_viewer.php';
include_once '../../pkg_role/role_entity.php';
include_once '../../pkg_service/service_controller.php';
include_once '../../pkg_service/service_model.php';
include_once '../../pkg_service/service_viewer.php';
include_once '../../pkg_service/service_entity.php';
include_once '../../pkg_status_reservation/status_reservation_controller.php';
include_once '../../pkg_status_reservation/status_reservation_model.php';
include_once '../../pkg_status_reservation/status_reservation_viewer.php';
include_once '../../pkg_status_reservation/status_reservation_entity.php';
include_once '../../pkg_type_carburant/type_carburant_controller.php';
include_once '../../pkg_type_carburant/type_carburant_model.php';
include_once '../../pkg_type_carburant/type_carburant_viewer.php';
include_once '../../pkg_type_carburant/type_carburant_entity.php';
include_once '../../pkg_vehicule/vehicule_controller.php';
include_once '../../pkg_vehicule/vehicule_model.php';
include_once '../../pkg_vehicule/vehicule_viewer.php';
include_once '../../pkg_vehicule/vehicule_entity.php';
