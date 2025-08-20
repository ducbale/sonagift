<div class="header z-100">
    <div class="wrap-content">
        <div class="flex items-center justify-between ">
            <div class="phone-header">
                Hotline: {{ Func::formatPhone($optSetting['hotline']) }}
            </div>
            <div class="slogan-header mb-0 ">
                <?= $slogan['name' . $lang] ?>
            </div>
            <div class="lienket-header d-flex justify-content-end align-items-center">
                @foreach($lienket as $k => $v)
                    <a class="text-decoration-none text-black ms-4 " href="{{$v['link']}}" title="{{$v['name'.$lang]}}">{{$v['name'.$lang]}}</a>
                @endforeach    
            </div>
        </div>
    </div>
</div>
