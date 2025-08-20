<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

if (!function_exists('transfer')) {
    function transfer($showtext = '', $numb = '', $page_transfer = '') {
        return view('component.transfer', ['showtext' => $showtext, 'numb' => $numb, 'page_transfer' => $page_transfer]);
    }
}
if (!function_exists('linkReferer')) {
    function linkReferer(): array|string|null {
        return request()->server('HTTP_REFERER');
    }
}
if (!function_exists('alert')) {
    function alert($notify = ''): void
    {
        echo '<script language="javascript">alert("' . $notify . '")</script>';
    }
}
if (! function_exists('minify_html')) {
    function minify_html($html): array|string|null {
        $search = array(
            '/\>[^\S ]+/s',
            '/[^\S ]+\</s',
            '/(\s)+/s'
        );
        $replace = array(
            '>',
            '<',
            '\\1'
        );
        return preg_replace($search, $replace, $html);
    }
}
if (! function_exists('convertToModelClass')) {
    function convertToModelClass($input) {
        $camelCase = str_replace(' ', '', ucwords(str_replace('-', ' ', $input)));
        $modelClass = $camelCase.'Model';
        $namespace = '\\NINA\\Models\\' . $modelClass;
        return $namespace;
    }
}