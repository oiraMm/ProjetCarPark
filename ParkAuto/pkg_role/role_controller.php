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
    public function __construct($str_action = "", $roleId = null)
    {
        $this->obj_role_model = new role_model();
        $this->obj_role_viewer = new role_viewer();
        if ($str_action == 'roleOf') {
            $obj_role = $this->obj_role_model->roleOf($roleId);
            return $obj_role;
        }
    }

    /**
     * @return role_model
     */
    public function getObjRoleModel()
    {
        return $this->obj_role_model;
    }

    /**
     * @param role_model $obj_role_model
     */
    public function setObjRoleModel(role_model $obj_role_model)
    {
        $this->obj_role_model = $obj_role_model;
    }

    /**
     * @return role_viewer
     */
    public function getObjRoleViewer()
    {
        return $this->obj_role_viewer;
    }

    /**
     * @param role_viewer $obj_role_viewer
     */
    public function setObjRoleViewer(role_viewer $obj_role_viewer)
    {
        $this->obj_role_viewer = $obj_role_viewer;
    }

}