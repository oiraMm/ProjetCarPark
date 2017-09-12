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
        //Génération du chemin d'upload
        $_SESSION['server_path'] = 'https://beta.mavril.fr';
        // Connexion à la base de données
        $db = new PDO('mysql:host=195.154.169.70;port=2206;dbname=beta', 'beta', 'PvlQ6TpblgkbPziP');
        //$db = new PDO('mysql:host=localhost;port=2206;dbname=beta', 'beta', 'PvlQ6TpblgkbPziP');
        return $db;
    }

    /**
     * @param $str_champ : string (tout les champ à selectionner séparé par une virgule. exemple 'id, nom, prenom')
     * @param $str_table : string (toutes les table sur lesquels faire le select séparé par une virgule. exemple 'utilisateur, service')
     * @param $str_condition : string (chaine de caractère contenant les condition. exemple id=1 AND nom='toto')
     * @param $str_orderBy : string (chaine de caractère contenant les orderby. exemple 'saison DESC, numero DESC')
     * @return array
     */
    public function select ($str_champ, $str_table, $str_condition = '', $str_orderBy = '', $bool_archivage = 1)
    {
        $db = $this->connexion();
        $str_query = 'SELECT '. $str_champ . ' FROM '. $str_table ;
        if ($str_condition != '')
        {
            $str_query.= ' WHERE '.$str_condition . " AND ".$str_table."_archivage = ". 1 . " ";
        }
        else
        {
            $str_query.= ' WHERE '.$str_table."_archivage = ". 1 . " ";
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
        $arra_champ_value[$table.'_createdBy'] = $_SESSION["current_user"];
        $arra_champ_value[$table.'_createdAt'] = '"'.date("Y-m-d H:m:s").'"';
        $arra_champ_value[$table.'_archivage'] = 1;
        //$arra_champ_value[$table.'_createdAt'] = ;
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
        $arra_champ_value[$table.'_updatedBy'] = $_SESSION["current_user"];
        $arra_champ_value[$table.'_updatedAt'] = '"'.date("Y-m-d H:m:s").'"';
        $arra_champ_value[$table.'_archivage'] = 1;
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
        //$str_query = 'DELETE FROM '. $table. ' WHERE '. $condition;
        $str_query = 'UPDATE '. $table. ' SET ' .$table. '_archivage = 0 WHERE '. $condition;
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