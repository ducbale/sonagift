@extends('layout')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y container-fluid">
    <h4>
        <span>Quản lý</span>/<span class="text-muted fw-light"></span>{{ $configMan->title_main }}
    </h4>
    <div class="card pd-15 bg-main mb-3">
        <div class="col-md-3">
            @component('component.inputSearch', ['title' => 'Tìm kiếm mã đơn hàng'])
            @endcomponent
        </div>
    </div>
    @if (!empty($configMan->search))
    <div class="card card-primary card-outline text-sm mb-3">
        <div class="card-header">
            <h3 class="card-title">Tìm kiếm đơn hàng</h3>
        </div>
        <div class="card-body row form-group-category">
            <div class="form-group col-md-3 col-sm-3">
                <label for="flatpickr-range" class="form-label">Ngày đặt</label>
                <input type="text" class="form-control" placeholder="DD/MM/YYYY to DD/MM/YYYY" name="order_date" id="flatpickr-range" />
            </div>
            <div class="form-group col-md-3 col-sm-3">
                <label>Tình trạng:</label>
                {!! Func::orderStatus() !!}
            </div>
            <div class="form-group col-md-3 col-sm-3">
                <label>Hình thức thanh toán:</label>
                {!! Func::orderPayments() !!}
            </div>
            <div class="form-group col-md-3 col-sm-3">
                <label>Tỉnh thành:</label>
                {!! Func::getAjaxPlace('city') !!}
            </div>
            <div class="form-group col-md-3 col-sm-3">
                <label>Quận huyện:</label>
                {!! Func::getAjaxPlace('district') !!}
            </div>
            <div class="form-group col-md-3 col-sm-3">
                <label>Phường xã:</label>
                {!! Func::getAjaxPlace('ward') !!}
            </div>

            <div class="form-group col-md-6 col-sm-6">
                <label>Khoảng giá:</label>
                <div class="noUi-primary mt-4 mb-5" id="slider-primary"></div>
                <input type="hidden" name="price_from" class="price_from" id="input-with-keypress-0">
                <input type="hidden" name="price_to" class="price_to" id="input-with-keypress-1">
            </div>
            <div class="form-group text-center mt-2 mb-0 col-12">
                <a class="btn btn-primary text-white waves-effect waves-light" onclick="actionOrder('{{ url('admin',['com'=>$com,'act'=>'man','type'=>$type]) }}')" title="Tìm kiếm"><i class="fas fa-search mr-1"></i>Tìm kiếm</a>
                <a class="ml-1 btn btn-secondary text-white waves-effect waves-light" href="{{ $linkMan }}" title="Hủy lọc"><i class="fas fa-times mr-1"></i>Hủy lọc</a>
            </div>
        </div>
    </div>
    @endif

    <div class="card mb-3">
        <div class="card-datatable table-responsive">
            <table class="datatables-category-list table border-top text-sm">
                <thead>
                    <tr>
                        <th class="align-middle w-[60px]">
                            <div class="custom-control custom-checkbox my-checkbox">
                                <input type="checkbox" {{ !isPermissions(str_replace('-','.',$com).'.'.$type.'.delete')?'disabled':'' }} class="form-check-input" id="selectall-checkbox">
                            </div>
                        </th>
                        <th class="text-center w-[70px] !pl-0">STT</th>
                        <th class="text-left">Mã</th>
                        <th class="text-left">Họ tên</th>
                        <th class="text-left">Ngày đặt</th>
                        <th class="text-left">HT thanh toán</th>
                        <th class="text-center">Tổng giá</th>
                        <th class="text-left">Tình trạng</th>
                        <th class="text-lg-center text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($items as $k => $v)
                    <tr>
                        <td class="align-middle">
                            <div class="custom-control custom-checkbox my-checkbox">
                                <input type="checkbox" {{ !isPermissions(str_replace('-','.',$com).'.'.$type.'.delete')?'disabled':'' }} class="form-check-input" id="select-checkbox1" value="{{ $v['id'] }}">
                            </div>
                        </td>
                        <td class="align-left w-[70px] !pl-0">
                            @component('component.inputNumb',['numb'=>$v['numb'],'idtbl'=>$v['id'],'table'=>'orders'])@endcomponent
                        </td>
                        <td class="align-left">
                            <a class="text-dark text-break">{{ $v['code'] }}</a>
                        </td>
                        <td class="align-left">
                            <a class="text-dark text-break">{{ $v['fullname'] }}</a>
                        </td>
                        <td class="align-left">
                            <a class="text-dark text-break">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$v['created_at'])->format('d/m/Y H:i:s') }}</a>
                        </td>
                        <td class="align-left">
                            <a class="text-dark text-break">{{ Func::showName('news', $v['order_payment'], 'namevi') }}</a>
                        </td>
                        <td class="align-middle text-center">
                            <a class="text-dark text-break">{{ Func::formatMoney($v['total_price']) }}</a>
                        </td>
                        <td class="align-right">
                            <a class="text-{{ Func::showName('order_status', $v['order_status'], 'class_order') }} py-1 px-2 fs-6 rounded-1 bg-{{ Func::showName('order_status', $v['order_status'], 'class_order') }}-bg-subtle">{{ Func::showName('order_status', $v['order_status'], 'namevi') }}</a>
                        </td>
                        <td class="align-middle text-center">
                            @component('component.buttonList',['params'=>['id'=>$v['id']]])
                                @if (!empty($configMan->excel))
                                    <a class="text-success mr-2 {{ !isPermissions(str_replace('-','.',$com.'-excel').'.'.$type.'.man')?'disabled':'' }}" href="{{url('admin',['com'=>'order-excel','act'=>'man','type'=>$type],['id'=>$v['id']])}}" ><i class="ti ti-file-spreadsheet" data-bs-toggle="tooltip" data-bs-trigger="hover"  data-bs-placement="bottom"  title="Xuất file excel"></i></a>
                                @endif
                            @endcomponent
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100" class="text-center">Không có dữ liệu</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {!! $items->appends(request()->query())->links() !!}
    @component('component.buttonMan')
    @endcomponent
</div>
@endsection
@pushonce('styles')
    <link rel="stylesheet" href="@asset('assets/admin/vendor/libs/nouislider/nouislider.css')" />
    <link rel="stylesheet" href="@asset('assets/admin/vendor/libs/flatpickr/flatpickr.css')" />
@endpushonce
@pushonce('scripts')
    <script src="@asset('assets/admin/vendor/libs/flatpickr/flatpickr.js')"></script>
    <script src="@asset('assets/admin/vendor/libs/nouislider/nouislider.js')"></script>
    <script>
        var input0 = document.getElementById('input-with-keypress-0');
        var input1 = document.getElementById('input-with-keypress-1');
        var inputs = [input0, input1];
        const flatpickrRange = document.querySelector('#flatpickr-range');
        const sliderPrimary = document.getElementById('slider-primary'),
            colorOptions = {
                start: [{{ request()->query('price_from')??\NINA\Models\OrdersModel::min('total_price')}}, {{request()->query('price_to')??\NINA\Models\OrdersModel::max('total_price')}}],
                connect: true,
                step:1000,
                behaviour: 'tap-drag',
                tooltips: {
                    to: function(numericValue) {
                        if (numericValue.toFixed(0) >= 1000000){ return `${numericValue.toFixed(0) / 1000000}M`; }
                        else {
                            if(numericValue.toFixed(0)==0) return '0';
                            else return (numericValue.toFixed(0)/1000) + 'k';
                        }
                    }
                },
                range: {
                    min: {{\NINA\Models\OrdersModel::min('total_price')}},
                    max: {{\NINA\Models\OrdersModel::max('total_price')}}
                },
                direction: isRtl ? 'rtl' : 'ltr'
            };
        if (sliderPrimary) {
            noUiSlider.create(sliderPrimary, colorOptions);
            sliderPrimary.noUiSlider.on('update', function (values, handle) {
                inputs[handle].value = parseFloat(values[handle]);
            });
        }
        if (typeof flatpickrRange != undefined) {
            flatpickrRange.flatpickr({
                dateFormat: 'd/m/Y',
                mode: 'range',
            });
        }
        function actionOrder(url) {
            var listid = '';
            var order_status = parseInt($('#order_status').val());
            var order_payment = parseInt($('#order_payment').val());
            var order_date = $('#flatpickr-range').val();
            var price_from = $('#input-with-keypress-0').val();
            var price_to = $('#input-with-keypress-1').val();
            var city = parseInt($('#id_city').val());
            var district = parseInt($('#id_district').val());
            var ward = parseInt($('#id_ward').val());
            var keyword = $('#keyword').val();
            $('input.select-checkbox').each(function () {
                if (this.checked) listid = listid + ',' + this.value;
            });
            listid = listid.substr(1);
            url += '?search=' + COM;
            if (listid) url += '&listid=' + listid;
            if (order_status) url += '&order_status=' + order_status;
            if (order_payment) url += '&order_payment=' + order_payment;
            if (order_date) url += '&order_date=' + order_date;
            if (price_from) url += '&price_from=' + price_from;
            if (price_to) url += '&price_to=' + price_to;
            if (city) url += '&id_city=' + city;
            if (district) url += '&id_district=' + district;
            if (ward) url += '&id_ward=' + ward;
            if (keyword) url += '&keyword=' + encodeURI(keyword);
            window.location = url;
        }
    </script>
@endpushonce