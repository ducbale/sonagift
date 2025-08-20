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
use NINA\Models\OrdersModel;
use NINA\Models\OrderHistoryModel;
use NINA\Core\Support\Facades\Func;
use NINA\Core\Support\Facades\Flash;
use NINA\Core\Support\Facades\Validator;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Helper\Sample;

class OrderController
{

    public function man($com, $act, $type, Request $request)
    {

        $order_status = (isset($request->order_status)) ? htmlspecialchars($request->order_status) : 0;
        $order_payment = (isset($request->order_payment)) ? htmlspecialchars($request->order_payment) : 0;
        $order_date = (isset($request->order_date)) ? htmlspecialchars($request->order_date) : 0;
        $price_from = (isset($request->price_from)) ? htmlspecialchars($request->price_from) : 0;
        $price_to = (isset($request->price_to)) ? htmlspecialchars($request->price_to) : 0;
        $city = (isset($request->id_city)) ? htmlspecialchars($request->id_city) : 0;
        $district = (isset($request->id_district)) ? htmlspecialchars($request->id_district) : 0;
        $ward = (isset($request->id_ward)) ? htmlspecialchars($request->id_ward) : 0;
        $keyword = (isset($request->keyword)) ? htmlspecialchars($request->keyword) : '';

        $query = OrdersModel::selectRaw('id,numb,code,created_at,order_payment,total_price,order_status')
            ->selectRaw('JSON_UNQUOTE(JSON_EXTRACT(info_user, "$.fullname")) AS fullname')
            ->selectRaw('JSON_UNQUOTE(JSON_EXTRACT(info_user, "$.email")) AS email')
            ->selectRaw('JSON_UNQUOTE(JSON_EXTRACT(info_user, "$.phone")) AS phone')
            ->where('id', '<>', 0);

        if (!empty($order_status)) $query->where('order_status', $order_status);
        if (!empty($order_payment)) $query->where('order_payment', $order_payment);

        if (!empty($order_date)) {
            $order_date = explode(" to ", $order_date);
            $date_from = Carbon::createFromFormat('d/m/Y H:i:s', $order_date[0] . ' 00:00:00')->toDateTimeString();
            $date_to = Carbon::createFromFormat('d/m/Y H:i:s', $order_date[1] . ' 23:59:59')->toDateTimeString();
            $query->where('created_at', '<=', $date_to);
            $query->where('created_at', '>=', $date_from);
        }

        if (!empty($price_from) && !empty($price_to)) {
            $query->where('total_price', '<=', $price_to);
            $query->where('total_price', '>=', $price_from);
        }


        if (!empty($city)) $query->whereRaw('JSON_UNQUOTE(JSON_EXTRACT(info_user, "$.city")) = ?', array($city));
        if (!empty($district)) $query->whereRaw('JSON_UNQUOTE(JSON_EXTRACT(info_user, "$.district")) = ?', array($district));
        if (!empty($ward)) $query->whereRaw('JSON_UNQUOTE(JSON_EXTRACT(info_user, "$.ward")) = ?', array($ward));


        if (!empty($keyword)) $query->where(function ($query) use ($keyword) {
            $query->where('code', $keyword)
                ->orWhereRaw('JSON_UNQUOTE(JSON_EXTRACT(info_user, "$.email")) LIKE ?', ['%' . $keyword . '%'])
                ->orWhereRaw('JSON_UNQUOTE(JSON_EXTRACT(info_user, "$.fullname")) LIKE ?', ['%' . $keyword . '%'])
                ->orWhereRaw('JSON_UNQUOTE(JSON_EXTRACT(info_user, "$.phone")) LIKE ?', ['%' . $keyword . '%']);
        });

        $items = $query->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('order.man.man', ['items' => $items]);
    }

    public function edit($com, $act, $type, Request $request)
    {
        $id = (isset($request->id)) ? htmlspecialchars($request->id) : 0;

        $item = OrdersModel::select('*')
            ->where('id', $id)
            ->first();

        $history = OrderHistoryModel::select('*')
            ->where('id_order', $id)
            ->orderBy('id', 'desc')
            ->get();

        $infoUser = json_decode($item['info_user'], true);
        $infoOrder = json_decode($item['order_detail'], true);
        //dd($infoOrder);

        return view('order.man.add', ['item' => $item, 'infoUser' => $infoUser, 'infoOrder' => $infoOrder, 'history' => $history]);
    }

    public function save($com, $act, $type, Request $request)
    {
        if (!empty($request->csrf_token)) {
            $message = '';
            $response = array();
            $id = (!empty($request->id)) ? htmlspecialchars($request->id) : 0;
            $data = (!empty($request->data)) ? $request->data : null;
            if ($data) {
                foreach ($data as $column => $value) {
                    if (strpos($column, 'content') !== false || strpos($column, 'desc') !== false) {
                        $data[$column] = htmlspecialchars(Func::sanitize($value, 'iframe'));
                    } else {
                        $data[$column] = htmlspecialchars(Func::sanitize($value));
                    }
                }
            }
            if (!empty($response)) {
                if (!empty($data)) {
                    foreach ($data as $k => $v) {
                        if (!empty($v)) {
                            Flash::set($k, $v);
                        }
                    }
                }
                $response['status'] = 'danger';
                $message = base64_encode(json_encode($response));
                Flash::set('message', $message);
                response()->redirect(linkReferer());
            }
            if (!empty($id)) {
                if (OrdersModel::where('id', $id)->update($data)) {
                    $history['id_order'] = $id;
                    $history['order_status'] = $data['order_status'];
                    $history['notes'] = $data['notes'];
                    OrderHistoryModel::create($history);
                    return transfer('Cập nhật dữ liệu thành công.', true, url('admin', ['com' => $com, 'act' => 'man', 'type' => $type],['page'=>$request->page]));
                } else {
                    response()->redirect(url('admin', ['com' => $com, 'act' => 'man', 'type' => $type],['page'=>$request->page]));
                }
            } else {
                $itemSave = OrdersModel::create($data);
                if (!empty($itemSave)) {
                    response()->redirect(url('admin', ['com' => $com, 'act' => 'man', 'type' => $type],['page'=>$request->page]));
                } else {
                    return transfer('Thêm dữ liệu thất bại.', false, linkReferer());
                }
            }
        }
    }

    public function delete($com, $act, $type, Request $request)
    {
        if (!empty($request->id)) {
            $id = $request->id;
            OrdersModel::where('id', $id)->delete();
            OrderHistoryModel::where('id_order', $id)->delete();
        } elseif (!empty($request->listid)) {
            $listid = explode(",", $request->listid);

            for ($i = 0; $i < count($listid); $i++) {
                $id = htmlspecialchars($listid[$i]);
                OrdersModel::where('id', $id)->delete();
                OrderHistoryModel::where('id_order', $id)->delete();
            }
        }
        response()->redirect(url('admin', ['com' => $com, 'act' => 'man', 'type' => $type],['page'=>$request->page]));
    }


    public function manExcel($com, $act, $type, Request $request)
    {
        $id = $request->id;
        $rows = OrdersModel::select('*')
            ->where('id', $id)
            ->orderBy('numb', 'asc')
            ->first();
        if (!empty($rows)) {
            $infoOrder = json_decode($rows['order_detail'], true);
            $infoUser = json_decode($rows['info_user'], true);
            $array_columns = array(
                'numb' => 'STT',
                'name' => "Tên sản phẩm",
                'price' => "Giá",
                'qty' => "Số lượng",
                'sum' => "Tổng tiền"
            );
            $array_width = [5, 50, 20, 10, 20];
            // Tạo một đối tượng spreadsheet mới
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Thêm đoạn văn bản vào 3 dòng đầu tiên
            $sheet->setCellValue('A1', "THÔNG TIN ĐƠN HÀNG");
            $sheet->setCellValue('A2', $infoUser['fullname']);
            $sheet->setCellValue('A3', $infoUser['email']);
            $sheet->setCellValue('A4', $infoUser['phone']);
            $sheet->setCellValue('A5', $infoUser['address']);
            $sheet->setCellValue('A6', 'Mã đơn hàng: ' . $rows['code']);

            // Gộp các ô cho đoạn văn bản
            $sheet->mergeCells('A1:E1');
            $sheet->mergeCells('A2:E2');
            $sheet->mergeCells('A3:E3');
            $sheet->mergeCells('A4:E4');
            $sheet->mergeCells('A5:E5');
            $sheet->mergeCells('A6:E6');

            // Áp dụng kiểu dáng cho đoạn văn bản
            $textStyle = [
                'font' => [
                    'bold' => true,
                    'size' => 16,
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ];

            $textStyle1 = [
                'font' => [
                    'size' => 13,
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ];
            $sheet->getStyle('A1:E1')->applyFromArray($textStyle);
            $sheet->getStyle('A2:E2')->applyFromArray($textStyle1);
            $sheet->getStyle('A3:E3')->applyFromArray($textStyle1);
            $sheet->getStyle('A4:E4')->applyFromArray($textStyle1);
            $sheet->getStyle('A5:E5')->applyFromArray($textStyle1);
            $sheet->getStyle('A6:E6')->applyFromArray($textStyle1);

            // Tiêu đề
            $rowIndex = 8;
            $colIndex = 'A';
            foreach ($array_columns as  $cellValue) {
                $sheet->setCellValue($colIndex . $rowIndex, $cellValue);
                $colIndex++;
            }

            // Điền dữ liệu vào sheet bắt đầu từ dòng thứ tư
            $rowIndex = 9;
            foreach ($infoOrder as $key => $v) {
                $colIndex = 'A';
                $num = 1;
                foreach ($array_columns as $k => $cellValue) {
                    if ($k == 'numb') {
                        $sheet->setCellValue($colIndex . $rowIndex, $num);
                    } else if ($k == 'sum') {
                        $sheet->setCellValue($colIndex . $rowIndex, $v['price'] * $v['qty']);
                    } else {
                        $sheet->setCellValue($colIndex . $rowIndex, $v[$k]);
                    }
                    $colIndex++;
                    $num++;
                }
                $rowIndex++;
            }

            // Áp dụng kiểu dáng cho tiêu đề
            $headerStyle = [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => 'FFFFFFFF'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF4CAF50'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ];
            $sheet->getStyle('A8:E8')->applyFromArray($headerStyle);

            // Áp dụng kiểu dáng cho dữ liệu
            $dataStyle = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrap' => true
                ],
            ];

            $sheet->getStyle('A8:E' . ($rowIndex - 1))->applyFromArray($dataStyle)->getAlignment()->setWrapText(true);

            // Thiết lập độ rộng cột

            foreach (range('A', 'E') as $k => $columnID) {
                $sheet->getColumnDimension($columnID)->setWidth($array_width[$k]);
            }

            // Thiết lập header để tải xuống file Excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Chi_tiet_don_hang.xlsx"');
            header('Cache-Control: max-age=0');

            // Tạo đối tượng writer để ghi file Excel
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            exit;
        } else {
            return transfer('Đơn hàng không tồn tại.', false, linkReferer());
        }
    }

   
}