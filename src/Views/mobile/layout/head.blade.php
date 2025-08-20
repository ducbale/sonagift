<base href="{{ config('app.asset') }}" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{!! Seo::get('title') !!}</title>
<meta name="keywords" content="{!! Seo::get('keywords') !!}" />
<meta name="description" content="{!! Seo::get('description') !!}" />
@if (config('app.site_path') != '/')
    <meta name="robots" content="noindex, nofollow">
@else
    <meta name="robots" content="{{ !\NINA\Core\Support\Str::isEmpty(Seo::get('meta')) ? Seo::get('meta') : 'index,follow,noodp' }}" />
@endif
<link href="{{ assets_photo('photo','48x48x1',$favicon['photo'],'thumbs') }}" rel="shortcut icon" type="image/x-icon" />
<link rel="icon" type="image/x-icon" href="{{ assets_photo('photo','48x48x1',$favicon['photo'],'thumbs') }}" />
{!! Func::decodeHtmlChars($setting['mastertool']) !!}
{!! Func::decodeHtmlChars($setting['analytics']) !!}
{!! Func::decodeHtmlChars($setting['headjs']) !!}
<meta name="geo.region" content="VN" />
<meta name="geo.placename" content="Hồ Chí Minh" />
<meta name="geo.position" content="10.823099;106.629664" />
<meta name="ICBM" content="10.823099, 106.629664" />
<meta name='revisit-after' content='1 days' />
<meta name="author" content="{!! $setting['namevi'] !!}" />
<meta name="copyright" content="{!! $setting['namevi'] . ' - [' . $optSetting['email'] . ']' !!}" />
<meta property="og:type" content="{{ Seo::get('type') }}" />
<meta property="og:site_name" content="{!! $setting['namevi'] !!}" />
<meta property="og:title" content="{!! Seo::get('title') !!}" />
<meta property="og:description" content="{!! Seo::get('description') !!}" />
<meta property="og:url" content="{{ Seo::get('url') }}" />
<meta property="og:image" content="{{ Seo::get('photo') }}" />
<meta property="og:image:alt" content="{!! Seo::get('title') !!}" />
<meta property="og:image:type" content="{{ Seo::get('photo:type') }}" />
<meta property="og:image:width" content="{{ Seo::get('photo:width') }}" />
<meta property="og:image:height" content="{{ Seo::get('photo:height') }}" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="{{ $optSetting['email'] }}" />
<meta name="twitter:creator" content="{!! $setting['namevi'] !!}" />
<meta property="og:url" content="{{Seo::get('url')}}" />
<meta property="og:title" content="{!! Seo::get('title') !!}" />
<meta property="og:description" content="{!! Seo::get('description') !!}" />
<meta property="og:image" content="{{ Seo::get('photo') }}" />
@canonical
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

