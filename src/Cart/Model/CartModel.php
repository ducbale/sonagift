<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\Cart\Model;
use NINA\Database\Eloquent\Factories\HasFactory;
use NINA\Database\Eloquent\Model;

/**
 * @method static create(array $dataOrder)
 */
class CartModel extends Model
{
    use HasFactory;
    public $table = 'orders';
    protected $casts = [
        'info_user' => 'json',
        'order_detail' => 'json',
    ];
    protected $fillable = [
        'info_user',
        'id_user',
        'order_payment',
        'temp_price',
        'total_price',
        'code',
        'ship_price',
        'requirements',
        'notes',
        'numb',
        'order_detail',
    ];

}