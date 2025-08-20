@extends('layout')
@section('content')
    <div>
        <div class="max-width py-3 mt-4">
            @if ($photo->isNotEmpty())
                <div class="title-main">
                    <h1>{{ $titleMain }}</h1>
                </div>
                <div class="album-product row">
                    @foreach ($photo as $v)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
                            <a class="img" data-fancybox="gallery" data-src="{{ assets_photo('photo', '', $v['photo']) }}"
                                title="{{ $titleMain }}"
                                data-image="{{ assets_photo('photo', config('type.photo.'.$v['type'].'.thumb'), $v['photo'], 'thumbs') }}">
                                <img class=""
                                    onerror="this.src='{{ thumbs('thumbs/'.config('type.photo.'.$v['type'].'.thumb').'/assets/images/noimage.png') }}';"
                                    src="{{ assets_photo('photo', config('type.photo.'.$v['type'].'.thumb'), $v['photo'], 'thumbs') }}"
                                    alt="{{ $titleMain }}">
                                </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
