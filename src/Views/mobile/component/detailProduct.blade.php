<div class="modal-detail" x-data="{ open: false }" @showts.window="open=true;console.log($event.detail)" x-cloak
    x-show="open" x-transition>
    <div class="content-modal-detail">
        <div x-data="{ tab: 'tab1' }" @showts.window="tab = $event.detail.type">
            <ul class="tabs">
                @if ($rowDetailPhoto->isNotEmpty())
                    <li :class="{ 'active': tab === 'tab1' }" @click="tab = 'tab1'">Điểm nổi bật</li>
                @endif
                @if ($rowDetailPhoto1->isNotEmpty())
                    <li :class="{ 'active': tab === 'tab2' }" @click="tab = 'tab2'">Đen</li>
                @endif
                <li :class="{ 'active': tab === 'tab3' }" @click="tab = 'tab3'">Thông số kỹ thuật</li>
                <li :class="{ 'active': tab === 'tab4' }" @click="tab = 'tab4'">Thông tin sản phẩm</li>
            </ul>
            @if ($rowDetailPhoto->isNotEmpty())
                <div x-cloak x-show="tab === 'tab1'" class="tab-content active">
                    <div class="slick_photo1  overflow-hidden">
                        <a id="Zoom-1" class="MagicZoom"
                            data-options="zoomMode: false; hint: off; rightClick: true; selectorTrigger: click; expandCaption: false; history: false;"
                            href="{{ assets_photo('product', '', $rowDetail['photo']) }}"
                            title="{{ $rowDetail['namevi'] }}">
                            <img class=""
                                onerror="this.src='{{ thumbs('thumbs/950x600x1/assets/images/noimage.png') }}';"
                                src="{{ assets_photo('product', '950x600x1', $rowDetail['photo'], 'thumbs') }}"
                                alt="{{ $rowDetail['namevi'] }}">
                        </a>
                    </div>
                    <div class="album-product my-2 mt-3">
                        <div class="p-relative">
                            <div class="owl-page owl-carousel owl-theme"
                                data-items="screen:0|items:4|margin:10,screen:425|items:4|margin:10,screen:575|items:4|margin:10,screen:767|items:5|margin:10,screen:991|items:6|margin:10,screen:1199|items:7|margin:10"
                                data-rewind="1" data-autoplay="1" data-loop="0" data-lazyload="0" data-mousedrag="0"
                                data-touchdrag="0" data-smartspeed="800" data-autoplayspeed="800"
                                data-autoplaytimeout="5000" data-dots="0"
                                data-animations="animate__fadeInDown, animate__backInUp, animate__rollIn, animate__backInRight, animate__zoomInUp, animate__backInLeft, animate__rotateInDownLeft, animate__backInDown, animate__zoomInDown, animate__fadeInUp, animate__zoomIn"
                                data-nav="1" data-navcontainer=".control-detail-album">
                                <a class="thumb-pro-detail border-[1px] rounded-[8px]" data-zoom-id="Zoom-1"
                                    href="{{ assets_photo('product', '', $rowDetail['photo']) }}"
                                    title="{{ $rowDetail['namevi'] }}"
                                    data-image="{{ assets_photo('product', '950x600x1', $rowDetail['photo'], 'thumbs') }}"><img
                                        class=" !mb-0 !pb-0 !border-0"
                                        onerror="this.src='{{ thumbs('thumbs/950x600x1/assets/images/noimage.png') }}';"
                                        src="{{ assets_photo('product', '950x600x1', $rowDetail['photo'], 'thumbs') }}"
                                        alt="{{ $rowDetail['namevi'] }}"></a>
                                @foreach ($rowDetailPhoto as $v)
                                    <a class="thumb-pro-detail border-[1px] rounded-[8px]" data-zoom-id="Zoom-1"
                                        href="{{ assets_photo('product', '', $v['photo']) }}"
                                        title="{{ $rowDetail['namevi'] }}"
                                        data-image="{{ assets_photo('product', '950x600x1', $v['photo'], 'thumbs') }}"><img
                                            class=" !mb-0 !pb-0 !border-0"
                                            onerror="this.src='{{ thumbs('thumbs/950x600x1/assets/images/noimage.png') }}';"
                                            src="{{ assets_photo('product', '950x600x1', $v['photo'], 'thumbs') }}"
                                            alt="{{ $rowDetail['namevi'] }}"></a>
                                @endforeach
                            </div>
                            <div class="control-detail-album control-owl transition"></div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($rowDetailPhoto1->isNotEmpty())
                <div x-cloak x-show="tab === 'tab2'" class="tab-content">
                    <div class="slick_photo1  overflow-hidden">
                        <a id="Zoom-1" class="MagicZoom"
                            data-options="zoomMode: false; hint: off; rightClick: true; selectorTrigger: click; expandCaption: false; history: false;"
                            href="{{ assets_photo('product', '', $rowDetailPhoto1[0]['photo']) }}"
                            title="{{ $rowDetailPhoto1[0]['namevi'] }}">
                            <img class=""
                                onerror="this.src='{{ thumbs('thumbs/950x600x1/assets/images/noimage.png') }}';"
                                src="{{ assets_photo('product', '950x600x1', $rowDetailPhoto1[0]['photo'], 'thumbs') }}"
                                alt="{{ $rowDetailPhoto1[0]['namevi'] }}">
                        </a>
                    </div>
                    <div class="album-product my-2 mt-3">
                        <div class="p-relative">
                            <div class="owl-page owl-carousel owl-theme"
                                data-items="screen:0|items:4|margin:10,screen:425|items:4|margin:10,screen:575|items:4|margin:10,screen:767|items:5|margin:10,screen:991|items:6|margin:10,screen:1199|items:7|margin:10"
                                data-rewind="1" data-autoplay="1" data-loop="0" data-lazyload="0" data-mousedrag="0"
                                data-touchdrag="0" data-smartspeed="800" data-autoplayspeed="800"
                                data-autoplaytimeout="5000" data-dots="0"
                                data-animations="animate__fadeInDown, animate__backInUp, animate__rollIn, animate__backInRight, animate__zoomInUp, animate__backInLeft, animate__rotateInDownLeft, animate__backInDown, animate__zoomInDown, animate__fadeInUp, animate__zoomIn"
                                data-nav="1" data-navcontainer=".control-detail-album">
                                @foreach ($rowDetailPhoto1 as $v)
                                    <a class="thumb-pro-detail border-[1px] rounded-[8px]" data-zoom-id="Zoom-1"
                                        href="{{ assets_photo('product', '', $v['photo']) }}"
                                        title="{{ $rowDetail['namevi'] }}"
                                        data-image="{{ assets_photo('product', '950x600x1', $v['photo'], 'thumbs') }}"><img
                                            class=" !mb-0 !pb-0 !border-0"
                                            onerror="this.src='{{ thumbs('thumbs/950x600x1/assets/images/noimage.png') }}';"
                                            src="{{ assets_photo('product', '950x600x1', $v['photo'], 'thumbs') }}"
                                            alt="{{ $rowDetail['namevi'] }}"></a>
                                @endforeach
                            </div>
                            <div class="control-detail-album control-owl transition"></div>
                        </div>
                    </div>
                </div>
            @endif
            <div x-cloak x-show="tab === 'tab3'" class="tab-content">
                {!! Func::decodeHtmlChars($rowDetail['parametervi']) !!}
            </div>
            <div x-cloak x-show="tab === 'tab4'" class="tab-content">
                {!! Func::decodeHtmlChars($rowDetail['contentvi']) !!}
            </div>
        </div>
    </div>
    <div class="btn-closemenu close-tab" x-on:click="open = ! open">Đóng</div>
</div>
