<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\Models\Place;
use NINA\Database\Eloquent\Factories\HasFactory;
use NINA\Database\Eloquent\Model;

class DistrictModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'district';
    public function getWard(): \NINA\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('NINA\Models\Place\WardModel','id_district');
    }
    public function getCity(): \NINA\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('NINA\Models\Place\CityModel', 'id_city');
    }
}