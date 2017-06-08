<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 26/05/2017
 * Time: 13:30
 */
class bdd
{
    private function connexion()
    {
        // Connexion à la base de données
        $db = new PDO('mysql:host=163.172.59.3;port=2206;dbname=beta', 'beta', 'PvlQ6TpblgkbPziP');
        return $db;
    }
    public function select ($str_requete)
    {
        $db = $this->connexion();
        $select = $db->prepare($str_requete);
        $select->execute();
        $result = $select->fetchAll();

        return $result;
    }

    //insert delete update ...
}