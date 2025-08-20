<div id="mmenu">
    <a id="hamburger" href="#menu" title="Menu"><span></span></a>
    <div class="search-res">
        <p class="icon-search transition"><i class="fa-solid fa-magnifying-glass"></i></p>
        <div class="search-grid w-clear">
            <input type="text" name="keyword-res" id="keyword-res" placeholder="{{ __('web.timkiem') }}" onkeypress="doEnter(event,'keyword-res');" value="<?= (!empty($_GET['keyword'])) ? $_GET['keyword'] : "" ?>" />
            <p onclick="onSearch('keyword-res');"><i class="fa-solid fa-magnifying-glass"></i></p>
        </div>
    </div>
</div>

<nav id="menu">
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
                                    title="{{ $vcat['namevi'] }}">{{ $vcat['namevi'] }} <span>Xem tất cả
                                        &#8250;</span></a>
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
</nav>
