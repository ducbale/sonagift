<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\Controllers\Web;

use Illuminate\Http\Request;
use NINA\Cart\Model\CartModel;
use NINA\Controllers\Controller;
use NINA\Core\Support\Facades\Auth;
use NINA\Core\Support\Facades\Func;
use NINA\Facade\Cart;
use NINA\Core\Support\Facades\View;
use NINA\Core\Support\Facades\Email;
use NINA\Models\NewsModel;
use NINA\Models\Place\CityModel;
use NINA\Models\Place\DistrictModel;
use NINA\Models\Place\WardModel;
use NINA\Models\ProductModel;
use NINA\Models\ProductPropertiesModel;

class CartController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        \Seo::set('title', __('web.giohang'));
        \Seo::set('meta', 'noindex,nofollow');
    }
    public function handle($action, Request $request): void
    {
        match ($action) {
            'add-to-cart' => $this->addCart($request),
            'update-to-number' => $this->updateCart($request),
            'delete-to-cart' => $this->deleteCart($request),
            'delete-all-cart' => $this->deleteAllCart(),
            'get-district' => $this->getDistrict($request),
            'get-ward' => $this->getWard($request),
            'send-to-cart' => $this->saveCart($request),
            'show-price' => $this->showPrice($request),
            'show-photo' => $this->showPhoto($request),
            default => 'unknown',
        };
    }
    protected function deleteAllCart()
    {
        Cart::destroy();
        transfer(__('web.giohangxoathanhcong'), 1, url('home'));
    }
    protected function showPrice($request): void
    {
        $id_product = $request->id_product;
        $id_properties = $request->id_properties;
        $row = ProductPropertiesModel::select(['regular_price', 'sale_price','descvi'])->where('id_parent', $id_product)->where('id_properties', $id_properties)->first();
        response()->json(['priceNew' => Func::formatMoney($row['sale_price']), 'priceOld' => Func::formatMoney($row['regular_price']), 'desc' => $row['descvi']]);
    }
    protected function showPhoto(Request $request)
    {   
        $id_product = $request->id_product;
        $id_properties = $request->id_properties;
        // $properties =  $id_properties ? explode(',', $id_properties):array();
    
        $rowDetail = ProductModel::select('type', 'id', 'id_list', 'properties', 'name'.$this->lang, 'photo')
        ->where('id', $id_product)
        ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])->first();


        $query = $rowDetail->getPhotos('product');
        // foreach (array_values($properties) as $v) $query->whereRaw("FIND_IN_SET(?, id_properties)", [$v]);
        $rowDetailPhoto = $query->whereRaw("FIND_IN_SET(?, id_properties)", [$id_properties])->get();

        return view('ajax.photoProduct', ['rowDetail' => $rowDetail, 'rowDetailPhoto' => $rowDetailPhoto]);  

    }
    protected function getDistrict($request): void
    {
        $districts = DistrictModel::select(['id', 'namevi'])->where('id_city', $request->id)->get()->toArray();
        response()->json(['districts' => $districts]);
    }
    protected function getWard($request): void
    {
        $wards = WardModel::select(['id', 'namevi'])->where('id_district', $request->id)->get()->toArray();
        response()->json(['wards' => $wards]);
    }
    public function showcart(Request $request)
    {
        $httt = NewsModel::where('type', 'hinh-thuc-thanh-toan')->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])->orderBy('id', 'desc')->get();
        $city = CityModel::all();
        return View::share('com', 'gio-hang')->view('giohang.index', compact('httt', 'city'));
    }
    public function saveCart(Request $request)
    {
        $isMemberCheck = 0;
        if ($isMemberCheck) $idMember = Auth::guard('web')->user()->id;
        if (empty($request->get('dataOrder'))) return url('home');
        $dataOrder = $request->get('dataOrder');
        $info_user['fullname'] = $dataOrder['fullname'];
        $info_user['phone'] = $dataOrder['phone'];
        $info_user['email'] = $dataOrder['email'];
        $info_user['city'] = $dataOrder['city'];
        $info_user['district'] = $dataOrder['district'];
        $info_user['ward'] = $dataOrder['ward'];
        $info_user['address'] = $dataOrder['address'];
        $name_city = CityModel::where('id',$info_user['city'])->first();
        $name_district = DistrictModel::where('id',$info_user['district'])->first();
        $name_ward = WardModel::where('id',$info_user['ward'])->first();
        $info_user['address1'] = $name_ward['namevi'] . ', ' . $name_district['namevi'] . ', ' . $name_city['namevi'];
        $dataOrderSave['info_user'] = $info_user;
        $dataOrderSave['id_user'] = $idMember ?? 0;
        $dataOrderSave['order_payment'] = $dataOrder['payments'];
        $dataOrderSave['requirements'] = $dataOrder['requirements'];
        $dataOrderSave['numb'] = 1;
        $dataOrderSave['order_status'] = 1;
        $dataOrderSave['ship_price'] = 30000;
        $dataOrderSave['temp_price'] = Cart::subtotalFloat();
        $dataOrderSave['total_price'] = Cart::priceTotalFloat();
        $dataOrderSave['code'] =  strtoupper(Func::stringRandom(10));
        $dataOrderSave['order_detail'] = Cart::content();
        $cartSave = CartModel::create($dataOrderSave);
       

        if (!empty($cartSave)) {
            Cart::destroy();
            $optCompany = json_decode(Func::setting('options'), true);
            $company = Func::setting();
            $arrayEmail = null;
            $subject = $subject = "Thông tin đơn hàng từ " . $company['namevi'];
            $message = Email::markdown('giohang.send', $cartSave);
         
            if (Email::send("admin", $arrayEmail, $subject, $message, '', $optCompany, $company)) {
                $arrayEmail = array(
                    "dataEmail" => array(
                        "name" => $info_user['fullname'],
                        "email" => $info_user['email']
                    )
                );

                Email::send("customer", $arrayEmail, $subject, $message, '', $optCompany, $company);
                return transfer(__('web.thongtindonhangguithanhcong'), true, url('home'));
            } else {
                return transfer(__('web.thongtindonhangguithatbai'), false, url('home'));
            }
        }else{
            transfer(__('web.thongtindonhangguithatbai'), false, url('home'));
        }
        
    }
    protected function updateCart($request): void
    {
        $rowId = $request->rowId;
        $quantity = $request->quantity;
        $item = Cart::get($rowId);
        Cart::update($rowId, $quantity);
        $regular_price = Func::formatMoney($item->options->itemProduct->regular_price * $item->qty);
        $sale_price = Func::formatMoney($item->options->itemProduct->sale_price * $item->qty);

        $temp = Cart::subtotalFloat();
        $tempText = Func::formatMoney($temp);
        $total = Cart::priceTotalFloat();
        if (!empty($ship)) $total += $ship;
        $totalText = Func::formatMoney($total);
        response()->json(['max' => Cart::count(), 'regularPrice' => $regular_price, 'salePrice' => $sale_price, 'tempText' => $tempText, 'totalText' => $totalText]);
    }
    protected function deleteCart($request): void
    {
        $rowId = $request->input('rowId');
        Cart::remove($rowId);
        $tempText = Func::formatMoney(Cart::subtotalFloat());
        $total = Cart::priceTotalFloat();
        if (!empty($ship)) $total += $ship;
        $totalText = Func::formatMoney($total);
        response()->json(['max' => Cart::count(), 'tempText' => $tempText, 'totalText' => $totalText]);
    }
    protected function addCart($request): void
    {

        $idProduct = $request->id;
        $photo = $request->photo;
        $qty = (!empty($request->quantity)) ? (int)$request->quantity : 1;
        $properties = json_decode($request->properties, true) ?? [];
        $itemProduct = ProductModel::find($idProduct);

        $code = md5(vsprintf('%s.%s.%s', [$idProduct, $itemProduct->namevi, json_encode($properties)]));
        if (!empty($properties)) {
            $getProperties = \NINA\Models\PropertiesModel::whereIn('id', $properties)->with('getListProperties')->get();
            $query = \NINA\Models\ProductPropertiesModel::select('regular_price', 'sale_price');
            foreach (array_values($properties) as $v) $query->whereRaw("FIND_IN_SET(?, id_properties)", [$v]);
            $getPrice = $query->where('id_parent',$idProduct)->first();
            if (!empty($getPrice)) {
                $itemProduct->regular_price = $getPrice->regular_price;
                $itemProduct->sale_price = $getPrice->sale_price;
            }
        }
        $data = [
            'id' => $itemProduct->id,
            'name' => $itemProduct->namevi,
            'price' => (!empty($itemProduct->sale_price)) ? $itemProduct->sale_price : $itemProduct->regular_price,
            'qty' => $qty,
            'weight' => 0,
            'options' => [
                'properties' => $getProperties ?? collect(),
                'code' => $code,
                'itemProduct' => $itemProduct,
                'photo' => $photo
            ]
        ];
        if ($this->findProductInCart($code)->isNotEmpty()) {
            $rowId = $this->findProductInCart($code)->first()->rowId;
            $qtyOld = $this->findProductInCart($code)->first()->qty;
            Cart::update($rowId, ($qtyOld + $qty));
        } else {
            Cart::add($data);
        }

        response()->json(['max' => Cart::count()]);
    }
    protected function findProductInCart($id): \Illuminate\Support\Collection
    {
        return Cart::search(function ($cartItem) use ($id) {
            return $cartItem->options->code === (string)$id;
        });
    }
}
