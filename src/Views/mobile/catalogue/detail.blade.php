@extends('layout')
@section('content')
    <div>
        <div class="max-width py-3 mt-4">
            @if (!empty($rowDetail))
                <div class="title-detail">
                    <h1><?= $rowDetail['name'.$lang] ?></h1>
                </div>
                <div class="meta-toc">
                    <div class="box-readmore">
                        <ul class="toc-list" data-toc="article" data-toc-headings="h1, h2, h3"></ul>
                    </div>
                </div>
                <div class="content-main baonoidung w-clear" id="toc-content"> {!! Func::decodeHtmlChars($rowDetail['content'.$lang]) !!}</div>
                <div class="share">
                    <b>{{ __('web.chiase') }}:</b>
                    <div class="social-plugin w-clear">
                        @component('component.share')
                        @endcomponent
                    </div>
                </div>
            @else
                <div class="alert alert-warning w-100" role="alert">
                    <strong>{{ __('web.dangcapnhatdulieu') }}</strong>
                </div>
            @endif
        </div>
    </div>
    @if ($news->isNotEmpty())
        <div>
            <div class="max-width py-3">
                <div class="title-main">
                    <span>{{ __('web.baivietkhac') }}</span>
                </div>
                <div class="row">
                    @foreach ($news as $v)
                    <div class="col-6 mb-3">
                        <div class="item_tt">
                        @component('component.itemNews', ['news' => $v])
                        @endcomponent
                    </div>
                </div>
                    @endforeach
                </div>

            </div>
        </div>
    @endif
@endsection
@pushOnce('scripts')
    <script src="@asset('assets/toc/toc.js')"></script>
    <script>
        if (isExist($('.toc-list'))) {
            $('.toc-list').toc({
                content: 'div#toc-content',
                headings: 'h2,h3,h4'
            });

            if (!$('.toc-list li').length) $('.meta-toc').hide();
            if (!$('.toc-list li').length) $('.meta-toc .mucluc-dropdown-list_button').hide();

            $('.toc-list')
                .find('a')
                .click(function() {
                    var x = $(this).attr('data-rel');
                    goToByScroll(x);
                });

            $('body').on('click', '.mucluc-dropdown-list_button', function() {
                $('.box-readmore').slideToggle(200);
            });

            $(document).scroll(function() {
                var y = $(this).scrollTop();
                if (y > 300) {
                    $('.meta-toc').addClass('fiedx');
                } else {
                    $('.meta-toc').removeClass('fiedx');
                }
            });
        }
    </script>
@endPushOnce
