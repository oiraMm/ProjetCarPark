<?php
/**
 * Created by PhpStorm.
 * User: berne
 * Date: 26/05/2017
 * Time: 13:48
 */

include_once 'pkg_mysql/bdd.php';
session_start();

$obj_bdd = new bdd();
$str_select = 'SELECT utilisateur_id FROM utilisateur WHERE utilisateur_id = 1';
$arr_result = $obj_bdd->select($str_select);
echo '<pre>';
var_dump($arr_result);
echo '</pre>';