<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\Controllers\Admin;

use Illuminate\Http\Request;
use NINA\Models\CounterModel;


class HomeController
{
    public function index(Request $request)
    {

        if ((isset($request->month) && $request->month != '') && (isset($request->year) && $request->year != '')) {
            $time = $request->year . '-' . $request->month . '-1';
            $date = strtotime($time);
        } else {
            $date = strtotime(date('y-m-d'));
        }
        $day = date('d', $date);
        $month = date('m', $date);
        $year = date('Y', $date);
        $firstDay = mktime(0, 0, 0, $month, 1, $year);
        $dayOfWeek = date('D', $firstDay);
        $daysInMonth = cal_days_in_month(0, $month, $year);
        $timestamp = strtotime('next Sunday');
        $weekDays = array();
        /* Make data for js chart */
        $charts = array();
        $charts['month'] = $month;
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $k = $i + 1;
            $begin = strtotime($year . '-' . $month . '-' . $i);
            $end = strtotime($year . '-' . $month . '-' . $k);
            $todayrc = CounterModel::selectRaw('count(*) as todayrecord')
                ->where('tm', '>=', $begin)
                ->where('tm', '<', $end)
                ->first();
            $today_visitors = $todayrc['todayrecord'];
            $charts['series'][] = $today_visitors;
            $charts['labels'][] = 'D' . $i;
        }
        $browser = CounterModel::select('browser')->where('browser', '<>', '')->groupBy('browser')->get();
        $countBrowser = CounterModel::where('browser', '<>', '')->count();
        $topIP = CounterModel::select('ip', \DB::raw('count(*) as visits'))
        ->groupBy('ip')
        ->orderBy('visits', 'desc')
        ->limit(5)
        ->get();
        $countOs = CounterModel::where('os', '<>', '')->count();
        $device = CounterModel::select( 'device')->where('device', '<>', '')->where("device", '<>','robot')->groupBy('device')->get();
        $countDevice = CounterModel::where('device', '<>', '')->where("device", '<>','robot')->count();
        return view('index.index',compact(
            'charts',
            'day',
            'month',
            'year',
            'browser',
            'countBrowser',
            'countOs',
            'device',
            'countDevice',
            'topIP'
        ) );
    }
}
