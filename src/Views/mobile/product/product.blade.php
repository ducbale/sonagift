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
         @foreach($Contentprd as $v)
            <div class="flex-product-main">
                <div class="left-content"></div>
                <div class="right-product">
                    @if(mb_strtolower($v['namevi'] ?? '') == mb_strtolower($titleMain ?? '') && $v['numb'] == 3)
                        <div class="baonoidung chitietsanpham mt-4" x-data="{ expanded: false }">
                            <div class="info_nd content_down he-first" 
                                x-bind:class="expanded ? 'heigt-auto' : ''"
                                x-collapse.min.100px>
                                {!! html_entity_decode($v['contentvi']) !!}
                            </div>
                            @if(!empty($v['contentvi']))
                                <button type="button" @click="expanded = ! expanded"
                                    class="mx-auto block active:!bg-[#5172fd] active:!border-[#5172fd] active:!text-white mt-4 mb-4 !border-[1px] border-solid border-gray-400 bg-white text-black !shadow-none !ring-0 !outline-none rounded-[50px] px-[15px] py-[7px]">
                                    <span x-text="(!expanded)?'{{ __('web.xemthem') }}':'{{ __('web.thugon') }}'" 
                                        class="font-medium"></span>
                                </button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        @endforeach    
        <div class="flex-product-main">
            @if (!empty($listProperties) && $listProperties->isNotEmpty())
                <div class="left-product">
                    @foreach ($listProperties as $list)
                        <div class="wr-search p-0">
                            <p class="text-split transition">{{ $list[0]['namevi'] }}</p>
                            <ul class="p-0">
                                @foreach ($list[1] as $key => $value)
                                    @php
                                        $listP = $list[0]['slugvi'];
                                        $arrayC = !empty(Request()->$listP) ? explode(',', Request()->$listP) : [];
                                    @endphp
                                    <li class="item-search mb-2">
                                        <input {{ in_array($value['id'], $arrayC) ? 'checked' : '' }}
                                            class="ip-search mx-2" id="{{ $list[0]['slugvi'] }}-{{ $list[0]['id'] }}"
                                            type="checkbox" data-list="{{ $list[0]['slugvi'] }}" name="ip-search"
                                            value="{{ $value['id'] }}">
                                        <label for="{{ $list[0]['id'] }}">{{ $value['namevi'] }}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach

                </div>
            @endif
            <div class="right-product {{ !empty($listProperties) ? '' : 'w-100' }}">
                @if (!empty($product))
                    <div class="row row-0">
                        @foreach ($product as $v)
                            <div class="col-6  mb-2 col-0">
                                @component('component.itemProduct', ['product' => $v])
                                @endcomponent
                            </div>
                        @endforeach
                    </div>
                @endif
                {!! $product->appends(request()->query())->links() !!}
            </div>
        </div>
        @foreach($Contentprd as $v)
            <div class="flex-product-main">
                <div class="left-content"></div>
                <div class="right-product">
                    @if(mb_strtolower($v['namevi'] ?? '') == mb_strtolower($titleMain ?? '') && $v['numb'] == 4)
                        <div class="baonoidung chitietsanpham mt-4" x-data="{ expanded: false }">
                            <div class="info_nd content_down he-first" 
                                x-bind:class="expanded ? 'heigt-auto' : ''"
                                x-collapse.min.100px>
                                {!! html_entity_decode($v['contentvi']) !!}
                            </div>
                            @if(!empty($v['contentvi']))
                                <button type="button" @click="expanded = ! expanded"
                                    class="mx-auto block active:!bg-[#5172fd] active:!border-[#5172fd] active:!text-white mt-4 mb-4 !border-[1px] border-solid border-gray-400 bg-white text-black !shadow-none !ring-0 !outline-none rounded-[50px] px-[15px] py-[7px]">
                                    <span x-text="(!expanded)?'{{ __('web.xemthem') }}':'{{ __('web.thugon') }}'" 
                                        class="font-medium"></span>
                                </button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        @endforeach  
    </div>
@endsection
