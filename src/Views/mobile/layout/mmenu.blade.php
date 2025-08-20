<div class="menu-res">
    <div class="menu-bar-res d-flex align-items-center justify-content-between ">
        <div class="d-flex justify-content-between flex-menu-left align-items-center">
            <a id="hamburger" href="#menu" title="Menu"><span></span></a>
            <div class="search-res">
                <p class="icon-search transition"><img src="assets/images/search1.png" alt=""></p>
                <div class="search-grid w-clear">
                    <input type="text" name="keyword-res" id="keyword-res" placeholder="Bạn cần tìm sản phẩm gì" onkeypress="doEnter(event,'keyword-res');" ><p onclick="onSearch('keyword-res');"><img src="assets/images/search1.png" alt=""></p>
                </div>
            </div>
        </div>
        <a class="logo-mobile" href="">
            <img src="{{ assets_photo('photo', config('type.photo.'.$logoPhoto['type'].'.thumb'), $logoPhoto->photo,'thumbs') }}" alt="{{ $setting->namevi }}">
        </a>
        <a href="gio-hang" class="cart-head"><img src="assets/images/cart1.png"> <span class="count-cart">{{ Cart::count() }}</span></a>
      
    </div>
    <nav id="menu">
        <ul>
            <li><a class="@if(empty($com) || $com == "index" )  active @endif transition" href="" title="{{__('web.home')}}">{{__('web.home')}}</a></li>
            <li class="menu-line"></li>
            <li><a class="@if($com == "gioi-thieu" )  active @endif transition" href="gioi-thieu" title="{{ __('web.gioithieu') }}">{{ __('web.gioithieu') }}</a>
            </li>
            <li class="menu-line"></li>
            <li><a class="@if($com == "san-pham" )  active @endif transition" href="san-pham" title="{{ __('web.sanpham') }}">{{ __('web.sanpham') }}</a>
                <ul>
                    @foreach ($listProductMenu ?? [] as $vlist)
                        <li>
                            <a class="transition " href="{{ url('slugweb', ['slug' => $vlist['slugvi']]) }}"
                                title="{{ $vlist['namevi'] }}">{{ $vlist['name'.$lang] }}
                            </a>
                            @if ($vlist->getCategoryCats()->get()->isNotEmpty())
                                <ul x-show="open" x-transition>
                                    @foreach ($vlist->getCategoryCats()->get() ?? [] as $vcat)
                                        <li>
                                            <a class="transition " href="{{ url('slugweb', ['slug' => $vcat['slugvi']]) }}"
                                                title="{{ $vcat['name'.$lang] }}">{{ $vcat['name'.$lang] }}</a>
                                                @if ($vcat->getCategoryItems()->get()->isNotEmpty())
                                                    <ul x-show="open" x-transition>
                                                        @foreach ($vcat->getCategoryItems()->get() ?? [] as $vitems)
                                                            <li>
                                                                <a class="transition " href="{{ url('slugweb', ['slug' => $vitems['slugvi']]) }}"
                                                                    title="{{ $vitems['name'.$lang] }}">{{ $vitems['name'.$lang] }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </li>
            <li class="menu-line"></li>
            <li>
                <a class="has-child transition {{ ($com ?? '') == 'catalogue' ? 'active' : '' }} " href="{{ url('catalogue') }}"
                    title="{{ __('web.catalogue') }}">{{ __('web.catalogue') }}
                </a>
                @if ($listcatologue->isNotEmpty())
                    <ul>
                        @foreach ($listcatologue ?? [] as $vlist)
                            <li>
                                <a class="transition " href="{{ url('slugweb', ['slug' => $vlist['slug']]) }}"
                                    title="{{ $vlist['name'.$lang] }}">{{ $vlist['name'.$lang] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
            <li class="menu-line"></li>
            <li><a class="@if($com == "dich-vu" )  active @endif transition" href="dich-vu" title="{{ __('web.dichvu') }}">{{ __('web.dichvu') }}</a></li>
            <li class="menu-line"></li>

            <li><a class="@if($com == "bai-viet" )  active @endif transition" href="bai-viet" title="{{ __('web.baiviet') }}">{{ __('web.baiviet') }}</a>
                @if ($listBvMenu->isNotEmpty())
                    <ul>
                        @foreach ($listBvMenu ?? [] as $vlist)
                            <li>
                                <a class="transition " href="{{ url('slugweb', ['slug' => $vlist['slug']]) }}"
                                    title="{{ $vlist['name'.$lang] }}">{{ $vlist['name'.$lang] }}
                                </a>
                                @if ($vlist->getCategoryCats()->get()->isNotEmpty())
                                    <ul x-show="open" x-transition>
                                        @foreach ($vlist->getCategoryCats()->get() ?? [] as $vcat)
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
                @endif
            </li>
            <li class="menu-line"></li>
            <li><a class="@if($com == "lien-he" )  active @endif transition" href="lien-he" title="{{__('web.lienhe')}}">{{__('web.lienhe')}}</a></li>
            <div class="lienket-mobile d-flex justify-content-end align-items-center">
                @foreach($lienket as $k => $v)
                    <a class="text-decoration-none text-black ms-4 " href="{{$v['link']}}" title="{{$v['name'.$lang]}}">{{$v['name'.$lang]}}</a>
                @endforeach    
            </div> 
        </ul>
    </nav>
   
</div>