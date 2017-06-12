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
    public function select ($str_champ, $str_table, $str_condition = '', $str_orderBy = '')
    {
        $db = $this->connexion();
        $str_query = 'SELECT '. $str_champ . ' FROM '. $str_table ;
        if ($str_condition != '')
        {
            $str_query.= ' WHERE '.$str_condition;
        }
        if ($str_orderBy != '')
        {
            $str_query.= ' ORDER BY '.$str_orderBy;
        }
        $select = $db->prepare($str_query);
        $select->execute();
        $result = $select->fetchAll();

        return $result;
    }

    //insert delete update ...
}