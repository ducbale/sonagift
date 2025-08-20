@extends('layout')
@section('content')
    <div>
        <div class="max-width py-3 mt-4">
            @if (!empty($rowDetail))
                <div class="title-detail">
                    <h1><?= $rowDetail['name' . $lang] ?></h1>
                </div>
                <div class="album-product row">
                    <div class="col-3">
                        <a class="img" data-fancybox="gallery"
                            data-src="{{ assets_photo('product', '', $rowDetail['photo']) }}"
                            title="{{ $rowDetail['name' . $lang] }}"
                            data-image="{{ assets_photo('product', config('type.product.' . $rowDetail['type'] . '.images.photo.thumb'), $rowDetail['photo'], 'thumbs') }}">
                            <img class="rounded-[7px] !mb-0 !pb-0 !border-0"
                                onerror="this.src='{{ thumbs('thumbs/' . config('type.product.' . $rowDetail['type'] . '.images.photo.thumb') . '/assets/images/noimage.png') }}';"
                                src="{{ assets_photo('product', config('type.product.' . $rowDetail['type'] . '.images.photo.thumb'), $rowDetail['photo'], 'thumbs') }}"
                                alt="{{ $rowDetail['name' . $lang] }}">
                        </a>
                    </div>
                    @foreach ($rowDetailPhoto as $v)
                        <div class="col-3">
                            <a class="img" data-fancybox="gallery"
                                data-src="{{ assets_photo('product', '', $v['photo']) }}"
                                title="{{ $rowDetail['name' . $lang] }}"
                                data-image="{{ assets_photo('product', config('type.product.' . $v['type'] . '.gallery.' . $v['type'] . '.photo_thumb'), $v['photo'], 'thumbs') }}">
                                <img class="rounded-[7px] !mb-0 !pb-0 !border-0"
                                    onerror="this.src='{{ thumbs('thumbs/' . config('type.product.' . $rowDetail['type'] . '.gallery.' . $v['type'] . '.photo_thumb') . '/assets/images/noimage.png') }}';"
                                    src="{{ assets_photo('product', config('type.product.' . $rowDetail['type'] . '.gallery.' . $v['type'] . '.photo_thumb'), $v['photo'], 'thumbs') }}"
                                    alt="{{ $rowDetail['name' . $lang] }}">
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="content-main baonoidung w-clear" id="toc-content"> {!! Func::decodeHtmlChars($rowDetail->contentvi) !!}</div>
                <div class="share">
                    <b>Chia sẻ:</b>
                    <div class="social-plugin w-clear">
                        @component('component.share')
                        @endcomponent
                    </div>
                </div>
            @else
                <div class="alert alert-warning w-100" role="alert">
                    <strong>{{ __('web.dangcapnhatdulieu') }}</strong>
                </div>
            @endif
        </div>
    </div>
    @if ($product->isNotEmpty())
        <div>
            <div class="max-width py-3">
                <div class="title-detail">
                    <h1>{{ __('web.albumkhac') }}</h1>
                </div>
                <div class="row">
                    @foreach ($product as $v)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                            <div class="album">
                                @component('component.itemAlbum', ['product' => $v])
                                @endcomponent
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection
