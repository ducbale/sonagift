@extends('layout')
@section('content')
    <div>
        @if ($news->isNotEmpty())
            <div class="max-width py-3">
                <div class="title-detail">
                    <h1>{{ $titleMain }}</h1>
                </div>
                <div class="row">
                    @foreach ($news as $k => $v)
                        <div class="col-4  mb-3">
                            <div class="item_tt">
                                @component('component.itemNews', ['news' => $v])
                                    <span>{{ __('web.ngaydang') }}: {{ \Carbon\Carbon::parse($v->created_at)->format('d/m/Y') }}</span>
                                    @if(!empty($v['desc'.$lang]))
                                    <div class="desc-news line-clamp-3 mt-1">{{ $v['desc'.$lang] }}</div>
                                    @endif
                                @endcomponent
                            </div>
                        </div>
                    @endforeach
                </div>
                {!! $news->links() !!}
            </div>
        @endif
    </div>
@endsection
