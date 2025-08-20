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

class PropertiesModel extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'properties';
    public function getListProperties(): \NINA\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\NINA\Models\PropertiesListModel::class,'id_list','id');
    }
}