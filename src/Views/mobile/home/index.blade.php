@extends('layout')
@section('content')
    <h1 class="hidden">{!! Seo::get('title') !!}</h1>
    @if($listProductNB1->isNotEmpty())
        <div class="wrap-prolist1" data-aos="fade-up" data-aos-duration="1000">
            <div class="wrap-content">
                <div class="owl-prolist1 p-relative">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        @foreach ($listProductNB1 as $v)
                            <div class="item_prolist1">
                                <div class="pic_prolist1">
                                    <a class="" href="{{ url('slugweb', ['slug' => $v['slug']]) }}"
                                        title="{{ $v['name' . $lang] }}">
                                        <img onerror="this.src='{{ thumbs('thumbs/'.config('type.product.'.$v['type'].'.categories.list.images.icon.thumb').'/assets/images/noimage.png') }}';"
                                        src="{{ assets_photo('product', config('type.product.'.$v['type'].'.categories.list.images.icon.thumb'), $v['icon'], 'thumbs') }}" alt="{{ $v['name'.$lang] }}">
                                    </a>
                                </div>
                                <div class="info_prolist1">
                                    <h3 class="">
                                        <a class="text-split name_prolist1 text-decoration-none" href="{{ url('slugweb', ['slug' => $v['slug']]) }}"
                                            title="{{ $v['name'.$lang] }}">{{ $v['name'.$lang] }}</a>
                                    </h3>
                                    @if(empty($v['desc'.$lang]))
                                        <div class="desc_prolist1">{{$v->get_items_n_b_count}}  sản phẩm</div>
                                    @else
                                        <div class="desc_prolist1">{{$v['desc'.$lang]}}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if($proFlashsale->isNotEmpty())
        <div class="wrap_flashsale">
            <div class="wrap-content">
                <div class="title_flashsale" data-aos="fade-up" data-aos-duration="1000">
                    <h2>Flash sale</h2>
                    <a href="flash-sale" class="xemthem_newshome d-none">Xem tất cả</a>
                </div>
                <div class="owl_flashsale" data-aos="fade-up" data-aos-duration="1000">
                    <div class="owl-page owl-carousel owl-theme"
                    data-items="screen:0|items:2|margin:0"
                    data-rewind="1" data-autoplay="0" data-loop="0" data-lazyload="0" data-mousedrag="1"
                    data-touchdrag="1" data-smartspeed="800" data-autoplayspeed="800" data-autoplaytimeout="5000"
                    data-dots="0" data-animations="" data-nav="0" data-navcontainer="">
                        @foreach ($proFlashsale as $v)
                            @php
                                $flagPro2 = Func::status($v['status'],'stock');
                            @endphp
                            <div class="item_flashsale">
                                @if($flagPro2==true)  
                                    <span class="soldout">sold out</span>
                                @endif
                                <div class="pic_flashsale">
                                    <a class="scale-img" href="{{ url('slugweb', ['slug' => $v['slug']]) }}"
                                        title="{{ $v['name' . $lang] }}">
                                        <div class="@if($v['photo2']) pic1 @endif">
                                            <img class="lazy" onerror="this.src='{{ thumbs('thumbs/'.config('type.product.'.$v['type'].'.images.photo.thumb').'/assets/images/noimage.png') }}';"
                                            src="{{ assets_photo('product', config('type.product.'.$v['type'].'.images.photo.thumb'), $v['photo'], 'watermarks') }}" alt="{{ $v['name'.$lang] }}">
                                        </div>
                                        @if($v['photo2'])
                                        <div class="pic2">
                                            <img class="lazy" onerror="this.src='{{ thumbs('thumbs/'.config('type.product.'.$v['type'].'.images.photo.thumb').'/assets/images/noimage.png') }}';"
                                            data-src="{{ assets_photo('product', config('type.product.'.$v['type'].'.images.photo.thumb'), $v['photo2'], 'watermarks') }}" alt="{{ $v['name'.$lang] }}">
                                        </div>
                                    @endif
                                    </a>
                                    @if ($flagPro2==false && !empty($v->regular_price))
                                        <a class="transition addcart text-decoration-none addnow"  data-id="{{ $v['id'] }}"
                                                                                data-action="addnow">{{ __('web.themvaogiohang') }}
                                        </a>
                                    @else
                                        <a class="transition addcart text-decoration-none " href="{{ url('slugweb', ['slug' => $v['slug']]) }}" title="{{ $v['name' . $lang] }}">{{ __('web.xemchitiet') }}
                                        </a>
                                    @endif
                                    <input class="hidden qty-pro" value="1">
                                    <div class="button-in quickshop">
                                        <div class="quickshop-1" data-fancybox="quick-view" data-type="ajax" data-src="{{url('load-quickview') .'?id='.$v['id'] }}"  data-id="{{$v['id']}}" data-url="{{ url('load-quickview') }}">
                                            <span class="ts-tooltip button-tooltip">Quick view</span>
                                            <i class="fas fa-search"></i>
                                        </div>
                                    </div>
                                    <div class="show-quickview"></div>
                                </div>
                                <div class="info_flashsale">
                                    @if (!empty($v->discount))
                                        <div class="discount_flashsale">
                                            Hot Sale off {{ $v->discount }}%
                                        </div>
                                    @endif
                                    <h3 class="name_flashsale">
                                        <a class="text-split" href="{{ url('slugweb', ['slug' => $v['slug']]) }}" title="{{ $v['name' . $lang] }}">{{ $v['name' . $lang] }}</a>
                                    </h3>
                                    <div class="price_flashsale">
                                        @if (empty($v->sale_price))
                                            @if (empty($v->regular_price))
                                                <span class="flashsale_new">{{ __('web.lienhe') }}</span>
                                            @else
                                                <span class="flashsale_new">{{ Func::formatMoney($v->regular_price) }}</span>
                                            @endif
                                        @else
                                            <span class="flashsale_new">{{ Func::formatMoney($v->sale_price) }}</span>
                                            <span class="flashsale_old">{{ Func::formatMoney($v->regular_price) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if($newsHome1->isNotEmpty())
        <div class="wrap_newshome1">
            <div class="wrap-content">
                <div class="title_newshome1" data-aos="fade-up" data-aos-duration="1000">
                    <h2>chúng tôi chỉ phục vụ những gì tốt nhất cho bạn</h2>
                </div>
                <div data-aos="fade-up" data-aos-duration="1000">
                    <div class="slick-baiviet">
                        @foreach ($newsHome1 as $v)
                            <div class="item_newshome1">
                                <div class="pic_newshome1">
                                        <a class="" href="{{ url('slugweb', ['slug' => $v['slug']]) }}"
                                            title="{{ $v['name' . $lang] }}">
                                            <img onerror="this.src='{{ thumbs('thumbs/'.config('type.news.'.$v['type'].'.images.photo.thumb').'/assets/images/noimage.png') }}';"
                                            src="{{ assets_photo('news', config('type.news.'.$v['type'].'.images.photo.thumb'), $v['photo'], 'thumbs') }}" alt="{{ $v['name'.$lang] }}">
                                        </a>
                                </div>
                                <div class="info_newshome1">
                                    <h3 class="name_newshome1">
                                        <a class="text-split" href="{{ url('slugweb', ['slug' => $v['slug']]) }}" title="{{ $v['name' . $lang] }}">{{ $v['name' . $lang] }}</a>
                                    </h3>
                                    <div class="desc_newshome1 text-split">{!! Func::decodeHtmlChars($v['desc'.$lang])!!}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if($quangcao->isNotEmpty())
        <div class="wrap_quangcao">
            <div class="wrap-content">
                @foreach ($quangcao as $k => $v)
                    <div class="items_quangcao d-flex justify-content-between flex-wrap align-items-center @if($k%2 != 0) flex-row-reverse @endif" data-aos="fade-up" data-aos-duration="1000">
                        <div class="pic_quangcao">
                            <a class="" href="{{$v['link'] }}"
                                title="{{ $v['name' . $lang] }}" target="_blank">
                                <img onerror="this.src='{{ thumbs('thumbs/'.config('type.photo.'.$v['type'].'.thumb').'/assets/images/noimage.png') }}';"
                                src="{{ assets_photo('photo', config('type.photo.'.$v['type'].'.thumb'), $v['photo'], 'thumbs') }}" alt="{{ $v['name'.$lang] }}">
                            </a>
                        </div>
                        <div class="info_quangcao">
                            <h3 class="name_quangcao">{{ $v['name' . $lang] }}</h3>
                            <div class="desc_quangcao text-split">{{$v['desc' . $lang]}}</div>
                            <a class="btn_quangcao" href="{{$v['link'] }}" >Mua ngay</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @if(!empty($banner_qc))
        <div class="wrap_bannerqc" data-aos="zoom-in" data-aos-duration="1000">
            <div class="wrap-1366">
                <a class="block" href="{{$banner_qc['link']}}">
                    <img class="w-full"
                        onerror="this.src='{{ thumbs('thumbs/' . config('type.photo.' . $banner_qc['type'] . '.thumb') . '/assets/images/noimage.png') }}';"
                        src="{{ assets_photo('photo', config('type.photo.' . $banner_qc['type'] . '.thumb'), $banner_qc['photo'], 'thumbs') }}"
                        alt="{{ $about['name'] }}">
                </a>
            </div>
        </div>
    @endif
    @if($productNB->isNotEmpty())
        <div class="wrap_pronb load-product-home" data-url="{{ url('load-product') }}" data-type="san-pham" data-status="noibat1" data-paginate="4" data-other="1" data-template='List' data-slug="san-pham" data-eshow=".paging-product-home">
            <div class="wrap-content" >
                <div class="tỉtle_pronb" data-aos="fade-up" data-aos-duration="1000">
                    <h2>sản phẩm nổi bật của sona</h2>
                </div>
                <div class="paging-product-home"></div>
            </div>
        </div>
    @endif
    @if($listProductNB->isNotEmpty())
        @foreach ($listProductNB as $vlist)
            @if (!empty($vlist->getItemsNB->isNotEmpty()))
                <div id="other-product" class="wrap_listnb load-product-home">
                    <div class="wrap-content" data-aos="fade-up" data-aos-duration="1000">
                        <div class="title-list-main">
                            <div class="left-title">
                                <div class="title-pro hidden"><span class="">{{ $vlist['name' . $lang] }}</span></div>
                                <div class="list-c2">
                                    @if (!empty($vlist->getCategoryCatsHome))
                                        <div class="title-cat-main click-product">
                                            @foreach ($vlist->getCategoryCatsHome ?? [] as $k => $cat)
                                                <span class="" data-url="{{ url('load-product') }}" data-cat="{{ $cat['id'] }}"  data-list="{{ $vlist['id'] }}" data-status="noibat" data-paginate="4" data-other="1" data-eshow=".list-{{ $vlist['id'] }}"
                                                    data-slug="{{ $cat['slug' . $lang] }}" data-type="san-pham" 
                                                    data-template="List">
                                                    {{ $cat['name' . $lang] }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                           
                        </div>
                        <div class="paging-product list-{{ $vlist['id'] }}"></div>
                        <a href="{{$vlist->slug}}" class="xemthem_newshome">Xem tất cả</a>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
    @if($doitac->isNotEmpty())
        <div class="wrap_partner">
            <div class="wrap-content">
                <div class="title_partner" data-aos="fade-up" data-aos-duration="1000">
                    <h2>200+ doanh nghiệp đã sử dụng</h2>
                </div>
                <div class="slick_partner">
                    @foreach($doitac as $k => $v)
                        <div>
                            <a class="block items_partner" href="{{$v['link']}}" data-aos="fade-up" data-aos-duration="1000">
                                <img class=""
                                    onerror="this.src='{{ thumbs('thumbs/' . config('type.photo.' . $v['type'] . '.thumb') . '/assets/images/noimage.png') }}';"
                                    src="{{ assets_photo('photo', config('type.photo.' . $v['type'] . '.thumb'), $v['photo'], 'thumbs') }}"
                                    alt="{{ $about['name'] }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if($newsHome->isNotEmpty())
        <div class="wrap_newshome">
            <div class="wrap-content">
                <div class="title_newshome" data-aos="fade-up" data-aos-duration="1000">
                    <h2>Tin tức - sự kiện</h2>
                    <a href="bai-viet" class="xemthem_newshome d-none">Xem tất cả <img class="ms-2" src="assets/images/right.png"></a>
                </div>
                <div data-aos="fade-up" data-aos-duration="1000">
                    <div class="owl-page owl-carousel owl-theme"
                    data-items="screen:0|items:1|margin:10"
                    data-rewind="1" data-autoplay="1" data-loop="0" data-lazyload="0" data-mousedrag="1"
                    data-touchdrag="1" data-smartspeed="800" data-autoplayspeed="800" data-autoplaytimeout="5000"
                    data-dots="0" data-animations="" data-nav="0" data-navcontainer="">
                        @foreach ($newsHome as $v)
                            <div class="item_newshome">
                            <div class="pic_newshome">
                                    <a class="" href="{{ url('slugweb', ['slug' => $v['slug']]) }}"
                                        title="{{ $v['name' . $lang] }}">
                                        <img onerror="this.src='{{ thumbs('thumbs/'.config('type.news.'.$v['type'].'.images.photo.thumb').'/assets/images/noimage.png') }}';"
                                        src="{{ assets_photo('news', config('type.news.'.$v['type'].'.images.photo.thumb'), $v['photo'], 'thumbs') }}" alt="{{ $v['name'.$lang] }}">
                                    </a>
                            </div>
                            <div class="info_newshome">
                                    <h3 class="name_newshome">
                                        <a class="text-split" href="{{ url('slugweb', ['slug' => $v['slug']]) }}" title="{{ $v['name' . $lang] }}">{{ $v['name' . $lang] }}</a>
                                    </h3>
                                    <span>{{ __('web.ngaydang') }}: {{ \Carbon\Carbon::parse($v->created_at)->format('d/m/Y') }}</span>
                                    <div class="desc_newshome text-split">{{$v['desc'.$lang]}}</div>
                            </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if($feedback->isNotEmpty())
        <div class="wrap_feedback">
            <div class="wrap-content">
                <div class="title_feedback" data-aos="fade-up" data-aos-duration="1000">
                    <h2>đánh giá khách hàng</h2>
                </div>
                <div data-aos="fade-up" data-aos-duration="1000">
                    <div class="owl-page owl-carousel owl-theme"
                    data-items="screen:0|items:1|margin:0"
                    data-rewind="1" data-autoplay="1" data-loop="0" data-lazyload="0" data-mousedrag="1"
                    data-touchdrag="1" data-smartspeed="500" data-autoplayspeed="3500" data-dots="0"
                    data-nav="0" data-navcontainer="">
                        @foreach ($feedback as $v)
                            <div class="item_feedback">
                            <div class="pic_feedback scale-img">
                                    <img onerror="this.src='{{ thumbs('thumbs/' . config('type.news.' . $v['type'] . '.images.photo.thumb') . '/assets/images/noimage.png') }}';"
                                        src="{{ assets_photo('news', config('type.news.' . $v['type'] . '.images.photo.thumb'), $v['photo'], 'thumbs') }}"
                                        alt="{{ $v['name' . $lang] }}">
                                </div>
                                <div class="info_feedback">
                                    <div class="mb-2"><img src="assets/images/start.png"></div>
                                    <div class="desc_feedback text-split">{{$v['desc'.$lang]}}</div>
                                    <div class="name_feedback">{{$v['name'.$lang]}}</div>
                                    <div class="office_feedback">{{$v['office'.$lang]}}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(!empty($video_home))
        <div class="wrap_videohome">
            <div class="wrap-1366" data-aos="zoom-in" data-aos-duration="1000">
                <a class="block pic_videohome scale-img" data-fancybox="video-gallery" href="{{ Func::get_youtube_shorts($video_home['link']) }}" title="{{$video_home['name']}}">
                    <img onerror="this.src='{{ thumbs('thumbs/' . config('type.photo.' . $video_home['type'] . '.thumb') . '/assets/images/noimage.png') }}';" src="https://img.youtube.com/vi/{!! Func::getYoutube($video_home['link'])!!}/0.jpg" alt="{{ $video_home['name'] }}" />
                    
                </a>
            </div>
        </div>
    @endif
    <div class="wrap-nt">
        <div class="wrap-content">
            <div class="title-footer">Đăng ký nhận tin</div>
            <form class="form-newsletter validation-newsletter" novalidate="" method="POST" action="{{url('letter')}}" enctype="multipart/form-data">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="newsletter-input newsletter1-input" data-aos="fade-up" data-aos-duration="1000">
                        <input type="text" class="form-control reset-token" id="ten-newsletter" name="fullname" value="" placeholder="Nhập họ và tên" required="">
                    </div>
                    <div class="newsletter-input newsletter1-input" data-aos="fade-up" data-aos-duration="1000">
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Nhập điện thoại" required="">
                    </div>
                </div>
                <div class="newsletter-input" data-aos="fade-up" data-aos-duration="1000">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required="">
                </div>
                <div class="newsletter-input  newsletter2-input" data-aos="fade-up" data-aos-duration="1000">
                    <textarea class="form-control" id="content" name="content" placeholder="Nhập nội dung" required></textarea>
                </div>
                <div class="newsletter-button" data-aos="fade-up" data-aos-duration="1000">
                    <input type="submit" class="active:!bg-blue-500" name="submit-newsletter" value="đăng ký ngay">
                    <input type="hidden" name="csrf_token" value="{{csrf_token()}}">
                    <input type="hidden" name="recaptcha_response_newsletter" id="recaptchaResponseNewsletter" value="">
                </div>
            </form>
        </div>
    </div>
        

@endsection
