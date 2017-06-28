<?php

/**
 * Created by PhpStorm.
 * User: berne
 * Date: 12/06/2017
 * Time: 17:08
 */
class vehicule_viewer
{

    public function templateCrudVehiculeDefault($arr_vehicule)
    {
        //echo'<pre>';var_dump($arr_user);echo'</pre>';
        //la trasmission d'info se fera via formulaire et champ caché (un formulaire pour le tableau, le click sur un bouton transmettra l'action et l'id de l'utilisateur concerné
        $obj_table = new STable();
        $obj_table->border = 1;
        $obj_table->thead()
            ->th("Marque")
            ->th("Modele")
            ->th("Immatriculation")
            ->th("Km")
            ->th("Carburant")
            ->th("Niveau d'essence")
            ->th("Etat")
            ->th("Action");
        foreach ($arr_vehicule as $vehicule)
        {
            $marque=($vehicule->getStrMarque()==null)?'-':$vehicule->getStrMarque();
            $modele=($vehicule->getStrModel()==null)?'-':$vehicule->getStrModel();
            $immatriculation=($vehicule->getStrImmatriculation()==null)?'-':$vehicule->getStrImmatriculation();
            $km=($vehicule->getIntKm()==null)?'-':$vehicule->getIntKm();
            $carburant=($vehicule->getObjTypeCarburant()==null)?'-':$vehicule->getObjTypeCarburant()->getStrLibelle();
            $niveauEssence=($vehicule->getObjNiveauCarburant()==null)?'-':$vehicule->getObjNiveauCarburant()->getStrLibelle();
            $etat=($vehicule->getObjEtat()==null)?'-':$vehicule->getObjEtat()->getStrLibelle();
            $formEdit = new htmlForm('index.php', 'POST');
            $formEdit->addHidden('idVehiculeEdit', $vehicule->getIntId());
            $formEdit->addHidden('mode', 'edit');
            $formEdit->addBtSubmit('Editer vehicule',"Submit","btn");
            $formDelete = new htmlForm('index.php', 'POST');
            $formDelete->addHidden('idVehiculeDelete', $vehicule->getIntId());
            $formDelete->addHidden('mode', 'delete');
            $formDelete->addBtSubmit('Supprimer vehicule',"Submit","btn", "deleteVehicule");
            $obj_table->tr()
                ->td($marque)
                ->td($modele)
                ->td($immatriculation)
                ->td($km)
                ->td($carburant)
                ->td($niveauEssence)
                ->td($etat)
                ->td($formEdit->render().$formDelete->render());
        }
        $formAdd = new htmlForm('index.php', 'POST');
        $formAdd->addHidden('mode', 'add');
        $formAdd->addBtSubmit('Ajouter vehicule',"Submit","btn");
        $str_test = '<h1>Liste des vehicules</h1>';
        return $str_test.$obj_table->getTable().$formAdd->render();

        //TODO détection de l'action delete pour afficher un message de confirmation si cette derniere à eu lieux
    }
}