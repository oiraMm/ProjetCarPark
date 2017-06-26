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
        //$db = new PDO('mysql:host=127.0.0.1;port=3306;dbname=beta', 'root', '');
        return $db;
    }

    /**
     * @param $str_champ : string (tout les champ à selectionner séparé par une virgule. exemple 'id, nom, prenom')
     * @param $str_table : string (toutes les table sur lesquels faire le select séparé par une virgule. exemple 'utilisateur, service')
     * @param $str_condition : string (chaine de caractère contenant les condition. exemple id=1 AND nom='toto')
     * @param $str_orderBy : string (chaine de caractère contenant les orderby. exemple 'saison DESC, numero DESC')
     * @return array
     */
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

    //TODO A tester insert update delete
    /**
     * @param $table : string (nom de la table dans laquelle faire l'insertion)
     * @param $arra_champ_value : array (tableau sous la forme $arra_champ_value['nomDuChamp']=valueAInserer, le nom du champ sera la clé la value la valeur du champ
     * @return bool
     */
    public function insert ($table, $arra_champ_value)
    {
        $db = $this->connexion();
        $str_query = 'INSERT INTO '. $table;
        $compteurChamp = 0;
        $str_champ = '(';
        $str_value = '(';
        foreach ($arra_champ_value as $champ => $value)
        {
            ($compteurChamp == 0)?$str_champ.=$champ:$str_champ.=', '.$champ;
            ($compteurChamp == 0)?$str_value.=$value:$str_value.=', '.$value;
            $compteurChamp++;
        }
        $str_value .= ')';
        $str_champ .= ')';
        $str_query.=$str_champ.' VALUES '. $str_value;

        $insert = $db->prepare($str_query);
        $result = $insert->execute();

        return $result;
    }

    /**
     * @param $table : string (nom de la table dans laquelle faire l'insertion)
     * @param $arra_champ_value : array (tableau sous la forme $arra_champ_value['nomDuChamp']=valueAInserer, le nom du champ sera la clé la value la valeur du champ
     * @param $condition : string (chaine de caractère contenant les condition. exemple id=1 AND nom='toto')
     * @return bool
     */
    public function update ($table, $arra_champ_value, $condition)
    {
        $db = $this->connexion();
        $str_query = 'UPDATE '. $table. ' SET ';
        $compteurChamp = 0;
        foreach ($arra_champ_value as $champ => $value)
        {
            ($compteurChamp == 0)?$str_query.=$champ.'='.$value:$str_query.=', '.$champ.'='.$value;
            $compteurChamp++;
        }
        $str_query.=' WHERE '. $condition;

        $update = $db->prepare($str_query);
        $result = $update->execute();

        return $result;
    }

    /**
     * @param $table : string (nom de la table dans laquelle faire la suppression)
     * @param $condition : string (chaine de caractère contenant les condition. exemple id=1 AND nom='toto')
     * @return bool
     */
    public function delete ($table, $condition)
    {

        $db = $this->connexion();
        $str_query = 'DELETE FROM '. $table. ' WHERE '. $condition;

        $delete = $db->prepare($str_query);
        $result = $delete->execute();

        return $result;
    }

    public function HashData ($data)
    {
        $algo = 'Whirlpool' ;
        $data = hash($algo, $data);
        return $data;
    }
}