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
use NINA\Traits\TraitAttr;

class TagsModel extends Model
{
    use HasFactory;
    use TraitAttr;
    protected $guarded = [];
    protected $table = 'tags';
    public function products(): \NINA\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(ProductModel::class, 'product_tags', 'id_tags', 'id_parent');
    }
    public function news(): \NINA\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(NewsModel::class, 'news_tags', 'id_tags', 'id_parent');
    }
}