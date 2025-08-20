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
use NINA\Database\Eloquent\Model;

class OrdersModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'orders';

    public function getStatus(): \NINA\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo('NINA\Models\OrderStatusModel', 'order_status');
    }
    public function getPayment(): \NINA\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo('NINA\Models\NewsModel', 'order_payment');
    }
    public function getMember() {
        //return $this->belongsTo('\NINA\Models\Member', 'id_user');
    }
}