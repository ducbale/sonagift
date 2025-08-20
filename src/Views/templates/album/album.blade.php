@extends('layout')
@section('content')
    <div>
        <div class="max-width py-3">
            <div class="title-detail">
                <h1>{{$titleMain}}</h1>
            </div>
            @if (!empty($product))
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
            @endif
            {!! $product->links() !!}
        </div>
    </div>
@endsection
