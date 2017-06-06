<?php

/**
 * Created by PhpStorm.
 * User: Yael
 * Date: 06/06/2017
 * Time: 10:26
 */
class role_controller
{
    //attribut privé de la classe
    //controller et model de la classe
    private $obj_role_model;
    private $obj_role_viewer;
    public function __construct($str_action = "", $roleId)
    {
        $this->obj_role_model = new role_model();
        $this->obj_role_viewer = new role_viewer();
        if ($str_action == 'roleOf') {
            $obj_role = $this->obj_role_model->roleOf($roleId);
            return $obj_role;
        }
    }
}