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

/**
 * @method static create(array $data)
 */
class Role extends Model
{
    protected $fillable = [
        'name',
        'numb',
        'status'
    ];
    public function users(): \NINA\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(UserModel::class,'user_has_roles');
    }

    public function permissions(): \NINA\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Permission::class,'role_has_permissions');
    }
}