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
                                href="{{ url('slugweb', ['slug' => $v['slug']]) }}">{{ $v['name'.$lang] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="footer-news">
                <div class="title-footer">Đăng ký nhận tin</div>
                <form class="form-newsletter validation-newsletter" novalidate="" method="POST" action="{{url('letter')}}" enctype="multipart/form-data">
                    <div class="d-flex justify-content-between flex-wrap">
                        <div class="newsletter-input newsletter1-input" data-aos="fade-up" data-aos-duration="1000">
                            <input type="text" class="form-control reset-token" id="ten-newsletter" name="fullname" value="" placeholder="Nhập họ và tên" required="">
                        </div>
                        <div class="newsletter-input newsletter1-input" data-aos="fade-up" data-aos-duration="1000">
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Nhập điện thoại" required="">
                        </div>
                    </div>
                    <div class="newsletter-input" data-aos="fade-up" data-aos-duration="1000">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required="">
                    </div>
                    <div class="newsletter-input  newsletter2-input" data-aos="fade-up" data-aos-duration="1000">
                        <textarea class="form-control" id="content" name="content" placeholder="Nhập nội dung" required></textarea>
                    </div>
                    <div class="newsletter-button" data-aos="fade-up" data-aos-duration="1000">
                        <input type="submit" class="active:!bg-blue-500" name="submit-newsletter" value="đăng ký ngay">
                        <input type="hidden" name="csrf_token" value="{{csrf_token()}}">
                        <input type="hidden" name="recaptcha_response_newsletter" id="recaptchaResponseNewsletter" value="">
                    </div>
                </form>
                <ul class="social-footer flex flex-wrap justify-content-center p-0 m-0">
                    @foreach ($social1 as $v)
                        <li class="mx-1">
                            <a href="{{ $v->link }}" target="_blank" class="block group">
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
