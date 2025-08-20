
<div class="slideshow">
    <div class="owl-page owl-carousel owl-theme" data-items="screen:0|items:1" data-rewind="1" data-autoplay="1"
        data-loop="0" data-lazyload="0" data-mousedrag="0" data-touchdrag="0" data-smartspeed="800" data-autoplayspeed="800"
        data-autoplaytimeout="5000" data-dots="1"
        data-animations=""
        data-nav="0" data-navcontainer=".control-slideshow">
        @foreach ($slider as $v)
            <div class="slideshow-item block" owl-item-animation>
                <a class="slideshow-image " href="{{ $v['link'] }}" target="_blank" title="{{ $v['name'] }}">
                    <picture>
                        <source media="(max-width: 500px)" srcset="{{ assets_photo('photo','',$v['photo'],'') }}">
                        <img class="w-100" onerror="this.src='{{ thumbs('thumbs/'.config('type.photo.'.$v['type'].'.thumb').'/assets/images/noimage.png') }}';"
                            src="{{ assets_photo('photo','',$v['photo'],'') }}" alt="{{ $v['name'.$lang] }}"
                            title="{{ $v['name'.$lang] }}" />
                    </picture>
                </a>
            </div>
        @endforeach
    </div>
    <div class="control-slideshow control-owl transition"></div>
</div>
