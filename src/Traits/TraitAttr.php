<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\Traits;
trait TraitAttr
{
    public function getSeo($com = 'product', $act = 'man')
    {
        $currentModelClass = get_class($this);
        $currentTableName = (new $currentModelClass)->getTable();
        return $this->belongsTo('\NINA\Models\SeoModel', 'id', 'id_parent')
            ->join($currentTableName, $currentTableName . '.id', '=', 'seo.id_parent')
            ->select('seo.*', $currentTableName . '.photo', $currentTableName . '.options as base_options')
            ->where('seo.type', $this->type)
            ->where('seo.act', $act)
            ->where('seo.com', $com);
    }
    public function getPhotos(){
        return $this->hasMany('\NINA\Models\GalleryModel','id_parent','id')
            ->where('type_parent', $this->type);
    }
    /**
     * Scope cho trường hợp date_publish null hoặc nhỏ hơn thời gian hiện tại.
     *
     * @param \NINA\Database\Eloquent\Builder $query
     * @return \NINA\Database\Eloquent\Builder
     */
    public function scopedatePublish($query): \NINA\Database\Eloquent\Builder
    {
        return $query->where(function ($query) {
            $query->whereNull('date_publish')->orWhere('date_publish', '<', \Carbon\Carbon::now());
        });
    }
}