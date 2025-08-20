@extends('layout')
@section('content')
    <div class="max-width py-3">
        <div class="title-detail">
            <h1>{{ $titleMain }}</h1>
            <h2 class="hidden">{{ $titleMain }}</h2>
            <div class="filter"><i class="fa-solid fa-filter"></i>&nbsp; {{ __('web.loc') }} </div>
        </div>
        @if($com=='tim-kiem')
            <div class="div_kq_search mb-4">{{ $titleMain }} ({{count($product)}}): <span>"{{$keyword}}"</span></div>
        @endif
        <div class="sort-select" x-data="{ open: false }">
            <p class="click-sort" @click="open = ! open">{{ __('web.sapxep') }}: <span
                    class="sort-show">{{ __('web.moinhat') }}</span></p>
            <div class="sort-select-main sort" x-show="open">
                <p><a data-sort="1"
                        class="{{ Request()->sort == 1 || empty(Request()->sort) ? 'check' : '' }}"><i></i>{{ __('web.moinhat') }}</a>
                </p>
                <p><a data-sort="2" class="{{ Request()->sort == 2 ? 'check' : '' }}"><i></i>{{ __('web.cunhat') }}</a></p>
                <p><a data-sort="3"
                        class="{{ Request()->sort == 3 ? 'check' : '' }}"><i></i>{{ __('web.giacaodenthap') }}</a></p>
                <p><a data-sort="4"
                        class="{{ Request()->sort == 4 ? 'check' : '' }}"><i></i>{{ __('web.giathapdencao') }}</a></p>
                <input type="hidden" name="url" class="url-search" value="{{ Request()->url() }}" />
            </div>
        </div>
        <div class="flex-product-main">
            @if (!empty($listProductDm) && $listProductDm->isNotEmpty())
                <div class="left-product">
                    <p class="text-split transition title-product">Danh mục sản phẩm</p>
                    <ul class="p-0"> 
                        @foreach ($listProductDm as $list)
                        <li class="item-dmpro">  
                            <a href="{{ url('slugweb', ['slug' => $list['slug']]) }}" class="text-split transition {{ ($list['id'] ?? '') == ($idList ?? '') ? 'active' : '' }}">{{ $list['name'.$lang] }} ({{$list->get_items_n_b_count}})</a>
                            @if ($list->getCategoryCats()->get()->isNotEmpty())
                                <ul x-show="open" x-transition>
                                    @foreach ($list->getCategoryCats()->get() ?? [] as $vcat)
                                        <li>
                                            <a class="transition "
                                                href="{{ url('slugweb', ['slug' => $vcat['slugvi']]) }}"
                                                title="{{ $vcat['name' . $lang] }}">{{ $vcat['name' . $lang] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>    
                        @endforeach
                    </ul> 
                </div>
            @endif
            <div class="right-product {{ !empty($listProductDm) ? '' : 'w-100' }}">
                @if (!empty($product))
                    <div class="row row-0">
                        @foreach ($product as $v)
                            <div class="col-4  col-0">
                                @component('component.itemProduct', ['product' => $v])
                                @endcomponent
                            </div>
                        @endforeach
                    </div>
                @endif
                {!! $product->appends(request()->query())->links() !!}
            </div>
        </div>
    </div>
@endsection
