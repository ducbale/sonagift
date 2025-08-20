<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\Controllers;

use NINA\Core\Support\Facades\File;
use NINA\Core\Support\Facades\Image;
use NINA\Models\PhotoModel;

class InterventionController extends Controller
{
    public function thumb($thumbsize,$path,$folder,$imageUrl){
        list($width, $height, $zoom_crop) = array_pad(explode('x', $thumbsize), 3, null);
        $thumb_path = thumb_path().'/'.$thumbsize.'/'.$path.'/'.$folder;
        if(!File::exists($thumb_path.'/'.$imageUrl)){
            $image = $this->getRead($thumb_path, $folder, $imageUrl, $width, $height,$zoom_crop,$path);
            return $image->toWebp(100)->response();
        }else{
            $image = Image::read($thumb_path.'/'.$imageUrl);
        }
        return $image->toWebp(100)->response();
    }
    public function watermark($thumbsize,$path,$folder,$imageUrl){
        list($width, $height, $zoom_crop) = array_pad(explode('x', $thumbsize), 3, null);
        $thumb_path = watermark_path().'/'.$thumbsize.'/'.$path.'/'.$folder;
        if(!File::exists($thumb_path.'/'.$imageUrl)){
            $image = $this->getRead($thumb_path, $folder, $imageUrl, $width, $height,$zoom_crop);
            $watermark = PhotoModel::where('type','watermark_product')->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])->first();
            if(!empty($watermark)){
                $options = (!empty($watermark['options']))?json_decode($watermark['options'],true):['position'=>'top-left','offset_x'=>0,'offset_y'=>0,'opacity'=>100];
                $wte =Image::read(upload_path('photo').'/'.$watermark->photo);
                $wte->contain(config('type.photo.watermark_product.width'),config('type.photo.watermark_product.height'),background: 'ffffff00', position: 'center');
                $image->place(
                    $wte,
                    $options['position'],
                    $options['offset_x'],
                    $options['offset_y'],
                    $options['opacity'],
                );
            }
            $image->save($thumb_path.'/'.$imageUrl);
            return $image->toWebp(100)->response();
        }else{
            $image = Image::read($thumb_path.'/'.$imageUrl);
        }
        return $image->toWebp(100)->response();
    }
    /**
     * @param string $thumb_path
     * @param $folder
     * @param $imageUrl
     * @param $ext
     * @param mixed $width
     * @param mixed $height
     * @return mixed
     */
    public function getRead(string $thumb_path, $folder, $imageUrl, mixed $width, mixed $height, mixed $zoom_crop,$path=''): mixed
    {
        if (!file_exists($thumb_path)) mkdir($thumb_path, 0777, true);
        $folder = ($path == 'assets') ? base_path('assets/'.$folder) : upload_path($folder);
        $image = Image::read($folder . '/' . $imageUrl);
        if ($zoom_crop == 3) $image->scale($width, $height);
        if ($zoom_crop == 2) $image->contain($width, $height,background: 'ffffff00', position: 'center');
        if ($zoom_crop == 1) $image->cover($width, $height,position:'center');
        $image->save($thumb_path . '/' . $imageUrl);
        return $image;
    }
}