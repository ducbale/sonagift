<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\Cart\Contracts;

interface Buyable
{
    public function getBuyableIdentifier($options = null);
    public function getBuyableDescription($options = null);
    public function getBuyablePrice($options = null);
    public function getBuyableWeight($options = null);
}