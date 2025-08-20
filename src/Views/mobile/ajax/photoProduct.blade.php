@if(count($rowDetailPhoto) > 0)
    @php $flagPro = Func::status($rowDetail['status'],'stock'); @endphp
    <div class="slick_photo1  overflow-hidden ">
        <a id="Zoom-2" class="MagicZoom kq_photo1"
            data-options="zoomMode: true; hint: off; rightClick: true; selectorTrigger: click; expandCaption: false; history: false;"
            href="{{ assets_photo('product', '', $rowDetailPhoto[0]['photo']) }}"   rel="{{ assets_photo('product', '', $rowDetailPhoto[0]['photo']) }}"
            title="{{ $rowDetail['name' . $lang] }}">
            <img class=""
                onerror="this.src='{{ thumbs('thumbs/' . config('type.product.' . $rowDetail['type'] . '.images.photo.thumb_detail') . '/assets/images/noimage.png') }}';"
                src="{{ assets_photo('product', config('type.product.' . $rowDetail['type'] . '.images.photo.thumb_detail'), $rowDetailPhoto[0]['photo'], 'watermarks') }}"
                alt="{{ $rowDetail['name' . $lang] }}">
        </a>
        @if($flagPro==true)  
            <span class="soldout">sold out</span>
        @endif
    </div>
    <div class="album-product ">
        <div class="slick in-page" data-dots="0" data-infinite="1" data-arrows="0" data-autoplay='0'
            data-slidesDefault="4:5" data-lg-items='4:5' data-md-items='4:5' data-sm-items='4:5'
            data-xs-items="4:5" data-vertical="0">
            @foreach ($rowDetailPhoto as $v)
                <a class="thumb-pro-detail border-[1px] rounded-[8px]" data-zoom-id="Zoom-2"
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
@endif