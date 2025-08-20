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
use NINA\Traits\FullTextSearch;

class ProductModel extends Model
{
    use HasFactory,TraitAttr, FullTextSearch;
    protected $guarded = [];
    protected $table = 'product';
    protected $searchable = [
        'namevi'
    ];
    public function getBrand(): \NINA\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(ProductBrandModel::class,'id_brand','id');
    }
    public function getNews(): \NINA\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(NewsModel::class,'id','id_parent');
    }
    public function getCategoryList(): \NINA\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(ProductListModel::class,'id_list','id');
    }
    public function getCategoryCat(): \NINA\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(ProductCatModel::class,'id_cat','id');
    }
    public function getCategoryItem(): \NINA\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(ProductItemModel::class,'id_item','id');
    }
    public function getCategorySub(): \NINA\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(ProductSubModel::class,'id_sub','id');
    }
    public function tags(): \NINA\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(TagsModel::class, 'product_tags', 'id_parent', 'id_tags');
    }
    
    public function getComment(): \NINA\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(CommentModel::class, 'id_variant', 'id')->where("id_parent", 0)->whereRaw("FIND_IN_SET(?,status)", ['hienthi']);
    }
   

}