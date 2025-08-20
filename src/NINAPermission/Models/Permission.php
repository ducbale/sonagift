<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINAPermission\Models;
use NINA\Database\Eloquent\Model;
use NINA\Models\UserModel;

class Permission extends Model
{
    protected $fillable = [
        'name',
    ];
    public function users()
    {
        return $this->belongsToMany(UserModel::class,'user_has_permissions');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_has_permissions');
    }

    public function scopeAssignRole($role)
    {
        return $this->roles()->attach($role);
    }
}