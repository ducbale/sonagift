@php $flagPro = Func::status($rowDetail['status'],'stock'); @endphp
<div x-data class="hidden" id="quickview_popup">
    <div class="wrap-main my-[20px] mx-auto max-w-[1200px] w-[calc(100%_-_20px)]">
        <div class="grid-pro-detail">
            <div class="left-pro-detail">
                <div class="album-product ">
                    <div class="slick in-page" data-dots="0" data-infinite="1" data-arrows="0" data-autoplay='0'
                        data-slidesDefault="4:1" data-lg-items='4:1' data-md-items='4:1' data-sm-items='4:1'
                        data-xs-items="4:1" data-vertical="1">
                        <a class="thumb-pro-detail border-[1px] rounded-[8px]  mb-1" data-zoom-id="Zoom-1"
                            href="{{ assets_photo('product', '', $rowDetail['photo']) }}"
                            title="{{ $rowDetail['name' . $lang] }}"
                            data-image="{{ assets_photo('product', config('type.product.' . $rowDetail['type'] . '.images.photo.thumb_detail'), $rowDetail['photo'], 'watermarks') }}"><img
                                class=" !mb-0 !pb-0 !border-0"
                                onerror="this.src='{{ thumbs('thumbs/' . config('type.product.' . $rowDetail['type'] . '.images.photo.thumb_detail') . '/assets/images/noimage.png') }}';"
                                src="{{ assets_photo('product', config('type.product.' . $rowDetail['type'] . '.images.photo.thumb_detail'), $rowDetail['photo'], 'watermarks') }}"
                                alt="{{ $rowDetail['name' . $lang] }}"></a>
                        @foreach ($rowDetailPhoto as $v)
                            <a class="thumb-pro-detail border-[1px] rounded-[8px]  mb-1" data-zoom-id="Zoom-1"
                                href="{{ assets_photo('product', '', $v['photo']) }}"
                                title="{{ $rowDetail['name' . $lang] }}"
                                data-image="{{ assets_photo('product', config('type.product.' . $rowDetail['type'] . '.images.photo.thumb_detail'), $v['photo'], 'watermarks') }}"><img
                                    class=" !mb-0 !pb-0 !border-0"
                                    onerror="this.src='{{ thumbs('thumbs/' . config('type.product.' . $rowDetail['type'] . '.images.photo.thumb_detail') . '/assets/images/noimage.png') }}';"
                                    src="{{ assets_photo('product', config('type.product.' . $rowDetail['type'] . '.images.photo.thumb_detail'), $v['photo'], 'watermarks') }}"
                                    alt="{{ $rowDetail['name' . $lang] }}"></a>
                        @endforeach
                    </div>
                </div>
                <div class="slick_photo1  overflow-hidden">
                    <a id="Zoom-1" class="MagicZoom"
                        data-options="zoomMode: true; hint: false; zoomPosition: inner; rightClick: false; selectorTrigger: click; expandCaption: true; history: false;"
                        href="{{ assets_photo('product', '', $rowDetail['photo']) }}"
                        title="{{ $rowDetail['name' . $lang] }}">
                        <img class=""
                            onerror="this.src='{{ thumbs('thumbs/' . config('type.product.' . $rowDetail['type'] . '.images.photo.thumb_detail') . '/assets/images/noimage.png') }}';"
                            src="{{ assets_photo('product', config('type.product.' . $rowDetail['type'] . '.images.photo.thumb_detail'), $rowDetail['photo'], 'watermarks') }}"
                            alt="{{ $rowDetail['name' . $lang] }}">
                    </a>
                    @if($flagPro==true)  
                            <span class="soldout">sold out</span>
                        @endif
                </div>
            </div>

            <div class="right-pro-detail">
                <div class="title-detail mt-0">
                    <h1 class="text-start">{{ $rowDetail['name' . $lang] }}</h1>
                </div>
                <ul class="attr-pro-detail">
                    <div class="d-flex justify-content-start">
                        <li class="flex mb-3 items-baseline">
                            <div><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                            
                        </li>
                        <li class="flex mb-3 items-baseline">
                            <div class="stock-pro-detail">
                              
                                <label class="attr-label-pro-detail font-medium mr-[5px]">Tình trạng:</label>
                                @if($flagPro==true)  
                                    <span class="text-red-500">Hết hàng</span>
                                @else
                                    <span class="text-green-500">Còn hàng</span>
                                @endif
                            </div>
                        </li>
                    </div>
                    <li class="flex mb-3 items-baseline">
                        <label class="attr-label-pro-detail font-medium mr-[5px]">{{ __('web.luotxem') }}:</label>
                        <div class="attr-content-pro-detail"><span>{{ $rowDetail['view'] }}</span>
                        </div>
                    </li>
                    @if (!empty($rowDetail['code']))
                        <li class="flex mb-3 items-baseline">
                            <label class="attr-label-pro-detail font-medium mr-[5px]">{{ __('web.code') }}:</label>
                            <div class="attr-content-pro-detail"><span>{{ $rowDetail['code'] }}</span>
                            </div>
                        </li>
                    @endif
                    @if (!empty($rowDetail['desc' . $lang]))
                        <div>{!! Func::decodeHtmlChars($rowDetail['desc' . $lang]) !!}</div>
                    @endif
                    <li class="flex mb-3 items-baseline">
                        <label class="attr-label-pro-detail font-medium mr-[5px]">{{ __('web.gia') }}:</label>
                        <div class="attr-content-pro-detail">
                            @if ($rowDetail['sale_price'])
                                <span
                                    class="price-new-pro-detail">{{ Func::formatMoney($rowDetail['sale_price']) }}</span>
                                <span
                                    class="price-old-pro-detail">{{ Func::formatMoney($rowDetail['regular_price']) }}</span>
                            @else
                                <span
                                    class="price-new-pro-detail">{{ $rowDetail['regular_price'] ? Func::formatMoney($rowDetail['regular_price']) : __('web.lienhe') }}</span>
                            @endif
                        </div>
                    </li>
                </ul>
                @if (config('type.order') && $flagPro==false && !empty($rowDetail->regular_price))
                <div class="cart-pro-detail">
                    <div class="attr-content-pro-detail d-block">
                        <div class="quantity-pro-detail">
                            <span class="quantity-minus-pro-detail">-</span>
                            <input type="text" class="qty-pro !outline-none !shadow-none !ring-0" min="1"
                                value="1" readonly="">
                            <span class="quantity-plus-pro-detail">+</span>
                        </div>
                    </div>
                    <a class="transition addcart text-decoration-none addnow" data-id="{{ $rowDetail['id'] }}"
                        data-action="addnow">{{ __('web.themvaogiohang') }}</a>
                </div>
                <div class="cart-pro-detail">
                    <a class="transition flex-1 addcart text-decoration-none buynow" data-id="{{ $rowDetail['id'] }}"
                        data-action="buynow">
                        <span>{{ __('web.muangay') }}</span>
                    </a>
                </div>
                @endif
               
            </div>
        </div>
    </div>
</div>
