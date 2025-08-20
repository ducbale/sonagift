<script type="text/javascript">
    var NN_FRAMEWORK = NN_FRAMEWORK || {};
    var ASSET = '{{ assets('assets/') }}';
    var BASE = '{{ assets() }}';
    var CSRF_TOKEN = '{{ url('token') }}';
    var WEBSITE_NAME = '{{ !empty($setting['name' . $lang]) ? addslashes($setting['name' . $lang]) : '' }}';
    var RECAPTCHA_ACTIVE = {{ !empty(config('app.recaptcha.active')) ? 'true' : 'false' }};
    var RECAPTCHA_SITEKEY = '{{ config('app.recaptcha.sitekey') }}';
    var GOTOP = ASSET + 'images/top.png';
    var CART_URL = {
        'ADD_CART': '{{ url('cart', ['action' => 'add-to-cart']) }}',
        'UPDATE_CART': '{{ url('cart', ['action' => 'update-cart']) }}',
        'DELETE_CART': '{{ url('cart', ['action' => 'delete-cart']) }}',
        'DELETE_ALL_CART': '{{ url('cart', ['action' => 'delete-all-cart']) }}',
        'PAGE_CART': '{{ url('giohang') }}',
    };
</script>
@php
    jsminify()->set('js/jquery.min.js');
    jsminify()->set('bootstrap/bootstrap.js');
    jsminify()->set('js/lazyload.min.js');
    jsminify()->set('owlcarousel2/owl.carousel.js');
    jsminify()->set('holdon/HoldOn.js');
    jsminify()->set('confirm/confirm.js');
    jsminify()->set('simplenotify/simple-notify.js');
    jsminify()->set('fancybox5/fancybox.umd.js');
    jsminify()->set('fotorama/fotorama.js');
    jsminify()->set('admin/toastify/toastify.js');
    jsminify()->set('mmenu/mmenu.js');
    jsminify()->set('slick/slick.js');
    jsminify()->set('magiczoomplus/magiczoomplus.js');
    jsminify()->set('js/functions.js');
    jsminify()->set('js/cart.js');
    jsminify()->set('aos/aos.js');
    jsminify()->set('js/apps.js');
    echo jsminify()->get();
@endphp
@stack('scripts')

<script src="@asset('assets/js/alpinejs.js')" defer></script>
{{-- <script >
        var message="Đây là bản quyền thuộc về {!!$setting['name' . $lang]!!}";
        function clickIE() {
        if (document.all) {(message);return false;}
        }
        function clickNS(e) {
        if (document.layers||(document.getElementById&&!document.all)) {
            if (e.which==2||e.which==3) {alert(message);return false;}}}
            if (document.layers) {document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;document.onselectstart=clickIE}document.oncontextmenu=new Function("return false")
      </script>
      <script type="text/javascript">
        function disableselect(e){
            return false
        }
        function reEnable(){
            return true
        }
        document.onselectstart=new Function ("return false")
        if (window.sidebar){
            document.onmousedown=disableselect
            document.onclick=reEnable
        }
</script> --}}
@if(!Func::isGoogleSpeed())
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.async = true;
            js.src = "https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    @if (!empty(config('app.recaptcha.active')))
        <script type="text/javascript">
            $(document).ready(function() {
                $('form input.reset-token').change(function() {
                    $.getScript(
                        'https://www.google.com/recaptcha/api.js?render={{ config('app.recaptcha.sitekey') }}',
                        function() {
                            grecaptcha.ready(function() {
                                generateCaptcha('Newsletter', 'recaptchaResponseNewsletter');
                                generateCaptcha('contact', 'recaptchaResponseContact');
                            });
                        });
                });
            });
        </script>
    @endif
    
@endif

{!! Func::decodeHtmlChars($setting['bodyjs']) !!}
