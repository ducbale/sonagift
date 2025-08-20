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
use NINA\Database\Eloquent\Relations\HasMany;

class PropertiesListModel extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'properties_list';

    public function getProperties(): HasMany
    {
        return $this->hasMany(PropertiesModel::class,'id_list','id');
    }

}