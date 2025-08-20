{{-- Phan trang --}}
@if (!empty($NewsAjax))
    <div class="p-relative">
        <div class="row">
            @foreach ($NewsAjax as $v)
                <div class="col-6 col-lg-4 col-md-4 col-sm-6 mb-3">
                    <div class="item_tt">
                        @component('component.itemNews', ['news' => $v])
                            <span>{{ __('web.ngaydang') }}: {{ \Carbon\Carbon::parse($v->created_at)->format('d/m/Y') }}
                                - by Admin</span>
                            <div class="desc-news line-clamp-3 mt-1">{{ $v['desc'.$lang] }}</div>
                        @endcomponent
                    </div>
                </div>
            @endforeach
        </div>
        {!! $NewsAjax->appends(request()->query())->links('pagination.pagin-ajax') !!}
    </div>
@endif
