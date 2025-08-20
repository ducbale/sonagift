<div class="product" >
    @php
        $flagPro = Func::status($product['status'],'hot');
        $flagPro1 = Func::status($product['status'],'sale');
        $flagPro2 = Func::status($product['status'],'stock');
    @endphp
    @if($flagPro==true)                        
        <span class="check-hot">Hot</span>
    @endif
    @if($flagPro1==true)                        
        <span class="check-sale">Sale</span>
    @endif
    @if($flagPro2==true)  
        <span class="soldout">sold out</span>
    @endif
    <div class="pic-product">
        <a class="img block" href="{{ url('slugweb', ['slug' => $product['slug']]) }}"
            title="{{ $product['name'.$lang] }}">
            <div class=" @if($product['photo2']) pic1 @endif"> 
                <img class="lazy" onerror="this.src='{{ thumbs('thumbs/'.config('type.product.'.$product['type'].'.images.photo.thumb').'/assets/images/noimage.png') }}';"
                data-src="{{ assets_photo('product', config('type.product.'.$product['type'].'.images.photo.thumb'), $product['photo'], 'watermarks') }}" alt="{{ $product['name'.$lang] }}">
            </div>
            
            @if($product['photo2'])
                <div class="pic2">
                    <img class="lazy" onerror="this.src='{{ thumbs('thumbs/'.config('type.product.'.$product['type'].'.images.photo.thumb').'/assets/images/noimage.png') }}';"
                    data-src="{{ assets_photo('product', config('type.product.'.$product['type'].'.images.photo.thumb'), $product['photo2'], 'watermarks') }}" alt="{{ $product['name'.$lang] }}">
                </div>
            @endif
        </a>
        @if ($flagPro2==false && !empty($product->regular_price))
            <a class="transition addcart text-decoration-none addnow"  data-id="{{ $product['id'] }}"
                                                    data-action="addnow">{{ __('web.themvaogiohang') }}
            </a>
        @else
            <a class="transition addcart text-decoration-none " href="{{ url('slugweb', ['slug' => $product['slug']]) }}" title="{{ $product['name' . $lang] }}">{{ __('web.xemchitiet') }}
            </a>
        @endif
        <input class="hidden qty-pro" value="1">
        <div class="button-in quickshop">
            <div class="quickshop-1" data-fancybox="quick-view" data-type="ajax" data-src="{{url('load-quickview') .'?id='.$product['id'] }}"  data-id="{{$product['id']}}" data-url="{{ url('load-quickview') }}">
                <span class="ts-tooltip button-tooltip">Quick view</span>
                <i class="fas fa-search"></i>
            </div>
        </div>
        <div class="show-quickview"></div>
    </div>
    <div class="info-product">
        <h3 class="name-product">
            <a class="text-split text-decoration-none" href="{{ url('slugweb', ['slug' => $product['slug']]) }}"
                title="{{ $product['name'.$lang] }}">{{ $product['name'.$lang] }}</a>
        </h3>
        <div class="price-product">
            @if (empty($product->sale_price))
                @if (empty($product->regular_price))
                    <span class="price-new">{{ __('web.lienhe') }}</span>
                @else
                    <span class="price-new">{{ Func::formatMoney($product->regular_price) }}</span>
                @endif
            @else
                <span class="price-new">{{ Func::formatMoney($product->sale_price) }}</span>
                <span class="price-old">{{ Func::formatMoney($product->regular_price) }}</span>
                
            @endif
        </div>
    </div>
</div>
