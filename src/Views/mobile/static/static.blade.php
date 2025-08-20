@extends('layout')
@section('content')
    <div>
        <div class="max-width py-3">
            @if (!empty($static))
                <div class="title-detail">
                    <h1>{{$static['name'.$lang]}}</h1>
                    <h2 class="hidden">{{$static['name'.$lang]}}</h2>
                </div>
                <div class="content-main w-clear"> {!! Func::decodeHtmlChars($static['content'.$lang]) !!}</div>
                <div class="share">
                    <b>{{ __('web.chiase') }}:</b>
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
@endsection