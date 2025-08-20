@extends('layout')
@section('content')
<div class="max-width py-3">
    <div class="wrap-content padding-top-bottom">
        <form class="form-cart"  method="post" action="cart/send-to-cart" enctype="multipart/form-data">
            <div class="wrap-cart flex items-stretch justify-between">
                @if(Cart::count() > 0)
                    <div class="top-cart">
                        <p class="title-cart">{{__('web.giohangcuaban')}}:</p>
                        <div class="list-procart">
                            <div class="procart procart-label d-flex align-items-start justify-content-between">
                                <div class="pic-procart ">{{__('web.hinhanh')}}</div>
                                <div class="info-procart ">{{__('web.tensanpham')}}</div>
                                <div class="quantity-procart ">
                                    <p>{{__('web.soluong')}}</p>
                                    <p>{{__('web.thanhtien')}}</p>
                                </div>
                                <div class="price-procart ">{{__('web.tongtien')}}</div>
                            </div>
                            @foreach(Cart::content() as $k => $v)
                                @php
                                    $color = $v->options->color ?? '';
                                    $size = $v->options->size ?? '';
                                    $code = $v->options->code ?? '';
                                    $photo = $v->options->photo ?? '';
                                    $proInfo = $v->options->itemProduct;
                               
                                    $pro_price =$proInfo->regular_price;
                                    $pro_price_new =$proInfo->sale_price;
                                    $pro_price_qty = $pro_price * $v->qty;
                                    $pro_price_new_qty = $pro_price_new * $v->qty;
                                @endphp

                                <div class="procart flex items-start justify-between procart-{{ $v->rowId }}">
                                    <div class="pic-procart">
                                        <a class="text-decoration-none" href="{{ url('slugweb',['slug'=>$proInfo->slugvi]) }}" target="_blank" title="{{ $proInfo->namevi }}">
                                            <img src="{{ $photo}}" alt="{{ $proInfo->namevi }}" />
                                        </a>
                                        <a class="del-procart text-decoration-none" data-rowId="{{$v->rowId}}">
                                            <i class="fa fa-times-circle"></i>
                                            <span>{{__('web.xoa')}}</span>
                                        </a>
                                    </div>
                                    <div class="info-procart">
                                        <h3 class="name-procart"><a class="text-decoration-none" href="{{ url('slugweb',['slug'=>$proInfo->slugvi]) }}" target="_blank" title="{{ $proInfo->namevi }}">{{ $proInfo->namevi }}</a></h3>
                                        @if(!empty($v->options->properties->toArray()))
                                            <div class="properties-procart">
                                                <span>Mẫu bánh:</span>
                                                @foreach($v->options->properties as $kp => $vp)
                                                <p>{{$vp->namevi}}</p> <br/>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="quantity-procart">
                                        <div class="price-procart price-procart-rp">
                                            @if(!empty($proInfo->sale_price))
                                                <p class="price-new-cart load-price-new-{{ $v->rowId }}">{!! Func::formatMoney((float)$pro_price_new_qty) !!}</p>
                                                <p class="price-old-cart load-price-{{ $v->rowId }}">{!! Func::formatMoney((float)$pro_price_qty) !!}</p>
                                            @else
                                                <p class="price-new-cart load-price-{{ $v->rowId }}>">{!! Func::formatMoney((float)$pro_price_qty) !!}</p>
                                            @endif
                                        </div>
                                        <div class="quantity-counter-procart quantity-counter-procart-{{ $v->rowId }} flex items-stretch justify-between">
                                            <span class="counter-procart-minus counter-procart">-</span>
                                            <input type="text" readonly class="quantity-procat" min="1" value="{{ $v->qty }}"  data-pid="{{ $v->id }}" data-rowId="{{ $v->rowId }}" />
                                            <span  class="counter-procart-plus counter-procart">+</span>
                                        </div>
                                        
                                    </div>
                                    <div class="price-procart">
                                        @if(!empty($proInfo->sale_price))
                                            <p class="price-new-cart load-price-new-{{ $v->rowId }}">{!! Func::formatMoney((float)$pro_price_new_qty) !!}</p>
                                            <p class="price-old-cart load-price-{{ $v->rowId }}">{!! Func::formatMoney((float)$pro_price_qty) !!}</p>
                                        @else
                                            <p class="price-new-cart load-price-{{ $v->rowId }}">{!! Func::formatMoney((float)$pro_price_qty) !!}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="money-procart">
                            @if (!empty(config('type.order.don-hang.ship')))
                                <div class="total-procart flex items-center justify-between">
                                    <p>{{__('web.tamtinh')}}:</p>
                                    <p class="load-price-sub">{!! Func::formatMoney(Cart::subtotalFloat()) !!}</p>
                                </div>
                            @endif
                            @if (!empty(config('type.order.don-hang.ship')))
                                <div class="total-procart flex items-center justify-between">
                                    <p>{{__('web.phivanchuyen')}}:</p>
                                    <p class="load-price-ship">30.000đ</p>
                                </div>
                            @endif
                            <div class="total-procart flex items-center justify-between">
                                <p>{{__('web.tongtien')}}:</p>
                                <p class="total-price load-price-total">{!! Func::formatMoney(Cart::priceTotalFloat()) !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-cart">
                        <div class="section-cart">
                            <p class="title-cart">{{__('web.hinhthucthanhtoan')}}:</p>
                            <div class="information-cart">
                                @foreach($httt as $k => $v)
                                <div class="payments-cart form-check" >
                                    <input type="radio" class="form-check-input" id="payments-{{ $v->id }}" name="dataOrder[payments]" value="{{ $v->id }}" required>
                                    <label class="payments-label form-check-label"   for="payments-{{ $v->id }}" data-payments="{{ $v->id }}">{{ $v->namevi }}</label>
                                    <div class="payments-info payments-info-{{ $v->id }} transition">{!! nl2br($v->descvi) !!}</div>
                                </div>
                                @endforeach
                            </div>
                            <p class="title-cart">{{__('web.thongtingiohang')}}:</p>
                            <div class="information-cart !mb-[10px]">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-[10px]">
                                    <div class="input-cart">
                                        <div class="input-cart">
                                            <input type="text" class="form-control text-sm" id="fullname" name="dataOrder[fullname]" placeholder="{{__('web.hoten')}}" value="" required />
                                        </div>
                                        <div class="invalid-feedback">{{__('web.vuilongnhaphoten')}}</div>
                                    </div>
                                    <div class="input-cart">
                                        <div class="input-cart">
                                            <input type="number" class="form-control text-sm" id="phone" name="dataOrder[phone]" placeholder="Điện thoại" value="" required />
                                        </div>
                                        <div class="invalid-feedback">Vui lòng nhập số điện thoại</div>
                                    </div>
                                </div>
                                <div class="input-cart">
                                    <div class="input-cart">
                                        <input type="email" class="form-control text-sm" id="email" name="dataOrder[email]" placeholder="Email" value="" required />
                                    </div>
                                    <div class="invalid-feedback">Vui lòng nhập email</div>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-x-[10px]">
                                    <div class="input-cart">
                                        <select  class="select-city-cart form-select form-control text-sm" required id="city" name="dataOrder[city]">
                                            <option value="">Tỉnh thành</option>
                                            @foreach($city??[] as $k => $v)
                                                <option value="{{$v->id}}">{{ $v->namevi }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Vui lòng chọn tỉnh thành</div>
                                    </div>
                                    <div class="input-cart">
                                        <select  class="select-district-cart select-district form-select form-control text-sm" required id="district" name="dataOrder[district]">
                                            <option value="">Quận huyện</option>
                                          
                                        </select>
                                        <div class="invalid-feedback">Vui lòng chọn quận huyện</div>
                                    </div>
                                    <div class="input-cart">
                                        <select class="select-ward-cart select-ward form-select form-control text-sm" required id="ward" name="dataOrder[ward]">
                                            <option value="">Phường xã</option>
                                       
                                        </select>
                                        <div class="invalid-feedback">Vui lòng chọn phường xã</div>
                                    </div>
                                </div>
                                <div class="input-cart">
                                    <div class="input-cart">
                                        <input type="text" class="form-control text-sm" id="address" name="dataOrder[address]" placeholder="Địa chỉ" value="" required />
                                    </div>
                                    <div class="invalid-feedback">Vui lòng nhập địa chỉ</div>
                                </div>
                                <div class="input-cart">
                                    <div class="input-cart">
                                        <textarea class="form-control text-sm" id="requirements" name="dataOrder[requirements]" placeholder="Yêu cầu khác"></textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary btn-cart w-100" name="thanhtoan" value="Thanh toán"  />
                        </div>
                    </div>
                @else
                    <div>Bạn chưa có sản phẩm trong giỏ hàng !</div>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection