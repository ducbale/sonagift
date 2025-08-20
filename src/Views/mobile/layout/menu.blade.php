
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
                                <a class="transition {{ ($com ?? '') == 'san-pham' ? 'active' : '' }} " href="{{ url('san-pham') }}"
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
                                <a class="transition {{ ($com ?? '') == 'dich-vu' ? 'active' : '' }} " href="{{ url('dich-vu') }}"
                                    title="{{ __('web.dichvu') }}">{{ __('web.dichvu') }}
                                </a>
                            </li>
                            <li class="group">
                                <a class="transition {{ ($com ?? '') == 'bai-viet' ? 'active' : '' }} " href="{{ url('bai-viet') }}"
                                    title="{{ __('web.baiviet') }}">{{ __('web.baiviet') }}
                                </a>
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
        @include('layout.mmenu')
    </div>
