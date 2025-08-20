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

use Carbon\Carbon;
use Illuminate\Http\Request;
use NINA\Core\Support\Facades\File;
use NINA\Models\UserLogModel;
use NINA\Core\Support\Facades\Func;
use NINA\Core\Support\Facades\Flash;
use NINA\Core\Support\Facades\Validator;

class LogController
{

    public function man($com, $act, $type, Request $request)
    {
        $log_date = (isset($request->log_date)) ? htmlspecialchars($request->log_date) : 0;
        $keyword = (isset($request->keyword)) ? htmlspecialchars($request->keyword) : '';
        $query = UserLogModel::select('*')
            ->where('id', '<>', 0);

        if (!empty($log_date)) {
            $log_date = explode(" to ", $log_date);
            if (!empty($log_date[0])) {
                $date_from = Carbon::createFromFormat('d/m/Y H:i:s', $log_date[0] . ' 00:00:00')->toDateTimeString();
                $query->where('created_at', '>=', $date_from);
            }

            if (!empty($log_date[1])) {
                $date_to = Carbon::createFromFormat('d/m/Y H:i:s', $log_date[1] . ' 23:59:59')->toDateTimeString();
                $query->where('created_at', '<=', $date_to);
            }
        }

        if (!empty($keyword)) $query->where('ip', $keyword);

        $items = $query->orderBy('id', 'desc')
            ->paginate(10);

        return view('log.man.man', ['items' => $items]);
    }

    // {
    //     if (!empty($request->id)) {
    //         $id = $request->id;
    //         $row = ContactModel::select('id', 'file_attach')
    //             ->where('id', $id)
    //             ->first();

    //         if (!empty($row)) {
    //             if (File::exists(upload('file', $row['file_attach']))) {
    //                 File::delete(upload('file', $row['file_attach']));
    //             }
    //             ContactModel::where('id', $id)->delete();
    //         }

    //     } elseif (!empty($request->listid)) {
    //         $listid = explode(",", $request->listid);

    //         for ($i = 0; $i < count($listid); $i++) {
    //             $id = htmlspecialchars($listid[$i]);
    //             $row = ContactModel::select('id', 'file_attach')
    //                 ->where('id', $id)
    //                 ->first();

    //             if (!empty($row)) {
    //                 if (File::exists(upload('file', $row['file_attach']))) {
    //                     File::delete(upload('file', $row['file_attach']));
    //                 }
    //                 ContactModel::where('id', $id)->delete();
    //             }
    //         }
    //     }
    //     response()->redirect(url('admin', ['com' => $com, 'act' => 'man', 'type' => $type]));
    // }

}
