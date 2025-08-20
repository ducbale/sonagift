<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINAPermission\Repositories;
use NINAPermission\Models\Permission;

class PermissionRepository extends Repository
{
    /**
     * @var Permission
     */
    protected $model;
    public function __construct()
    {
        $this->model = new Permission();
    }
    public function assignRole($role)
    {
        $this->fetchSet();
        $this->getModel()->roles()->attach($role);
        return $this->getModel();
    }

    public function allowTo($user)
    {
        $this->fetchSet();
        $this->getModel()->users()->attach($user);
        return $this->getModel();
    }

    public function terminateToUser($user)
    {
        $this->fetchSet();
        $this->getModel()->users()->detach($user);
        return $this->getModel();
    }

    public function terminateToRole($role)
    {
        $this->fetchSet();
        $this->getModel()->roles()->detach($role);
        return $this->getModel();
    }

    public function getAllUsers()
    {
        $this->fetchSet();
        return $this->getModel()->users;
    }
}