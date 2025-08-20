<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\Models;
use NINA\Database\Eloquent\Factories\HasFactory;
use NINA\Database\Eloquent\Authenticate;
use NINAPermission\Traits\HasPermission;

class UserModel extends Authenticate
{
    use HasFactory,HasPermission;
    public $timestamps = false;
    protected $guard = "admin";
    protected $table = 'user';
    protected $guarded = [];
    protected $hidden = [
        'password'
    ];
    protected $casts = [
        'password' => 'hashed'
    ];
    protected string $username = 'email';
    protected string $password = 'password';
}