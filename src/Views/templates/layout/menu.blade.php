{{-- <div class="menu-head-left" x-data="{ open: false }" x-on:mouseover="open = true" x-on:mouseleave="open = false">
    <span class="title-menu"><i class="fa-solid fa-bars me-2"></i> Tất cả danh mục <i
            class="fa-solid fa-caret-down ms-2"></i></span>
    <div class="menu-product-list" x-cloak x-show="open" x-transition>
        <ul>
            @foreach ($listProductMenu ?? [] as $vlist)
                <li x-data="{ open: false }" x-on:mouseover="open = true" x-on:mouseleave="open = false"><a
                        class="transition group-hover:text-[#fed402]"
                        href="{{ url('slugweb', ['slug' => $vlist['slugvi']]) }}"
                        title="{{ $vlist['namevi'] }}">{{ $vlist['namevi'] }}
                        {!! $vlist->getCategoryCats()->get()->isNotEmpty() ? '<span class="icon-down">&#8250;</span>' : '' !!}</a>
                    @if ($vlist->getCategoryCats()->get()->isNotEmpty())
                        <ul x-show="open" x-transition>
                            @foreach ($vlist->getCategoryCats()->get() ?? [] as $vcat)
                                <li>
                                    <a class="transition group-hover:text-[#fed402]"
                                        href="{{ url('slugweb', ['slug' => $vcat['slugvi']]) }}"
                                        title="{{ $vcat['namevi'] }}">{{ $vcat['namevi'] }} <span>Xem tất cả &#8250;</span></a>
                                    <ul>
                                        @foreach ($vcat->getCategoryItems()->get() ?? [] as $vitem)
                                            <li>
                                                <a class="transition group-hover:text-[#fed402]"
                                                    href="{{ url('slugweb', ['slug' => $vitem['slugvi']]) }}"
                                                    title="{{ $vitem['namevi'] }}">{{ $vitem['namevi'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div> 
 <a class="logo-header w-[15%]" >   
                <img src="{{ assets_photo('photo', config('type.photo.'.$logoPhoto['type'].'.thumb'), $logoPhoto->photo,'thumbs') }}" alt="{{ $setting->namevi }}">
            </a>
<a href="gio-hang" class="cart-head"><i class="fa-solid fa-cart-shopping mr-5"></i> <span
    class="text-cart">{{ __('web.giohang') }}</span> <span class="count-cart">{{ Cart::count() }}</span></a>--}}
    <div class="w-menu">
        <div class="menu">
            <div class="wrap-content">
                <div class="d-flex justify-content-between align-items-center ">
                    <div class="left-menu">
                        <a class="logo-header" href="">
                            <img src="{{ assets_photo('photo', config('type.photo.'.$logoPhoto['type'].'.thumb'), $logoPhoto->photo,'thumbs') }}" alt="{{ $setting->namevi }}">
                        </a>
                    </div>
                    <div class="center-menu">
                        <ul class="flex flex-wrap items-center justify-between ulmn">
                            <li class="group">
                                <a class="transition {{ ($com ?? ' ') == 'trang-chu' ? 'active' : '' }}" href=""
                                    title="{{ __('web.home') }}">{{ __('web.home') }}</a>
                            </li>
                            <li class="group">
                                <a class="transition {{ ($com ?? '') == 'gioi-thieu' ? 'active' : '' }} " href="{{ url('gioi-thieu') }}"
                                    title="{{ __('web.gioithieu') }}">{{ __('web.gioithieu') }}
                                </a>
                            </li>
                            <li class="group">
                                <a class="has-child transition {{ ($com ?? '') == 'san-pham' ? 'active' : '' }} " href="{{ url('san-pham') }}"
                                    title="{{ __('web.sanpham') }}">{{ __('web.sanpham') }}
                                </a>
                                @if ($listProductMenu->isNotEmpty())
                                    <ul>
                                        @foreach ($listProductMenu ?? [] as $vlist)
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
                                                                <ul>
                                                                    @foreach ($vcat->getCategoryItems()->get() ?? [] as $vitem)
                                                                        <li>
                                                                            <a class="transition "
                                                                                href="{{ url('slugweb', ['slug' => $vitem['slugvi']]) }}"
                                                                                title="{{ $vitem['name' . $lang] }}">{{ $vitem['name' . $lang] }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                            <li class="group">
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
                            <li class="group">
                                <a class="transition {{ ($com ?? '') == 'dich-vu' ? 'active' : '' }} " href="{{ url('dich-vu') }}"
                                    title="{{ __('web.dichvu') }}">{{ __('web.dichvu') }}
                                </a>
                            </li>
                            <li class="group">
                                <a class="has-child transition {{ ($com ?? '') == 'bai-viet' ? 'active' : '' }} " href="{{ url('bai-viet') }}"
                                    title="{{ __('web.baiviet') }}">{{ __('web.baiviet') }}
                                </a>
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
                            <li class="group">
                                <a class="transition {{ ($com ?? '') == 'lien-he' ? 'active' : '' }}" href="{{ url('lien-he') }}"
                                    title="{{ __('web.lienhe') }}">{{ __('web.lienhe') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="right-menu">
                        <div class="search-menu">
                            <p class="icon-search-menu transition"><img src="assets/images/search.png"></p>
                            <div class="search-grid w-clear">
                                <input type="text" name="keyword" id="keyword" placeholder="{{ __('web.timkiem') }}"
                                    onkeypress="doEnter(event,'keyword');"
                                    value="{{ !empty($_GET['keyword']) ? $_GET['keyword'] : '' }}" />
                            </div>
                        </div>
                        <a href="gio-hang" class="cart-head"><img src="assets/images/cart1.png"> <span class="count-cart">{{ Cart::count() }}</span></a>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
