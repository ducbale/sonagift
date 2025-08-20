<footer>
    <div class="footer-article">
        <div class="wrap-content flex flex-wrap items-start justify-between">
            <div class="footer-news ">
                <a class="logo-ft" href="">
                    <img src="{{ assets_photo('news', config('type.static.' . $footer['type'] . '.images.photo.thumb'), $footer['photo'] ,'thumbs') }}" alt="{{ $footer['name' . $lang] }}">
                </a>
               <div class="name-ft">{{ $footer['name' . $lang] }}</div>
               <div class="hotline-ft">Hotline:  {{ Func::formatPhone($optSetting['hotline']) }}</div>
               <div class="info-footer">{!! Func::decodeHtmlChars($footer['content'.$lang]) !!}</div>
            </div>
            <div class="footer-news ">
                <div class="title-footer">Điều khoản dịch vụ</div>
                <ul class="footer-ul p-0 m-0 list-none">
                    @foreach ($policy as $v)
                        <li class="last:mb-0">
                            <a class="inline-block"
                                href="{{ url('slugweb', ['slug' => $v['slug']]) }}" data-aos="fade-up" data-aos-duration="1000">{{ $v['name'.$lang] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="footer-news">
                <ul class="social-footer flex flex-wrap justify-content-center p-0 m-0">
                    @foreach ($social1 as $v)
                        <li class="mx-1">
                            <a href="{{ $v->link }}" target="_blank" class="block group" >
                                <img class="transition-all group-hover:animate__bounceIn"
                                    src="{{ assets_photo('photo', '', $v->photo) }}" alt="{{ $v['name' . $lang] }}">  
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-powered">
        <div class="wrap-content">
            <div class="copyright">© Copyright <span>{{$copyright['name'.$lang]}}</span>. All rights reserved. Design by <a href="https://nina.vn" class=" text-decoration-none" title="Nina.vn">Nina.vn</a></div> 
        </div>
    </div>
</footer>
