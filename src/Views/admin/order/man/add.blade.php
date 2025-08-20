@extends('layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y container-fluid">
    <div class="app-ecommerce">
        <form class="validation-form" novalidate method="post"
            action="{{ url('admin', ['com' => $com, 'act' => 'save', 'type' => $type], ['id' => $item['id'] ?? 0,'page'=>$page]) }}"
            enctype="multipart/form-data">
            @component('component.buttonAdd')
            @endcomponent
            {!! Flash::getMessages('admin') !!}
            <div class="row-card">
                <div class="row">

                    <div class="col-12 col-lg-8">
                        <div class="card card-primary card-outline text-sm mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Chi tiết đơn hàng</h3>
                            </div>

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="align-middle text-center" width="10%">STT</th>
                                        <th class="align-middle">Hình ảnh</th>
                                        <th class="align-middle" style="width:30%">Tên sản phẩm</th>
                                        <th class="align-middle text-center">Đơn giá</th>
                                        <th class="align-middle text-right">Số lượng</th>
                                        <th class="align-middle text-right">Tạm tính</th>
                                    </tr>
                                </thead>

                                @if (empty($infoOrder))
                                <tbody>
                                    <tr>
                                        <td colspan="100" class="text-center">Không có dữ liệu</td>
                                    </tr>
                                </tbody>
                                @else
                                <tbody>
                                    @php $num = 0 ; @endphp
                                    @foreach ($infoOrder as $k => $v)
                                    @php
                                    $num = $num + 1;
                                    $options = $v['options'];

                                    $itemProduct = $v['options']['itemProduct'];
                                    @endphp
                                    <tr>
                                        <td class="align-middle text-center">{{ $num }}</td>
                                        <td class="align-middle">
                                            <a title="{{ $v['name'] }}">
                                                <img class="img-preview"
                                                    onerror="this.src='../assets/images/noimage.png';"
                                                    src="{{ $v['options']['photo'] }}"
                                                    alt="{{ $v['name'] }}" title="{{ $v['name'] }}" />
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <p class=" mb-1">{{ $v['name'] }}</p>

                                            @foreach ($options['properties'] as $kp => $vp)
                                            <p class="text-primary">{{ $vp['namevi'] }}</p> <br />
                                            @endforeach
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="price-cart-detail">
                                                @if ($itemProduct['sale_price'])
                                                <span
                                                    class="price-new-cart-detail">{{ Func::formatMoney($itemProduct['sale_price']) }}</span>
                                                @else
                                                <span
                                                    class="price-new-cart-detail">{{ Func::formatMoney($itemProduct['regular_price']) }}</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="align-middle text-right">{{ $v['qty'] }}</td>
                                        <td class="align-middle text-right">
                                            <div class="price-cart-detail">
                                                @if ($itemProduct['sale_price'])
                                                <span
                                                    class="price-new-cart-detail">{{ Func::formatMoney($itemProduct['sale_price'] * $v['qty']) }}</span>
                                                @else
                                                <span
                                                    class="price-new-cart-detail">{{ Func::formatMoney($itemProduct['regular_price'] * $v['qty']) }}</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @if (!empty($configMan->ship))
                                    <tr>
                                        <td colspan="5" class="title-money-cart-detail">Tạm tính:</td>
                                        <td colspan="1" class="cast-money-cart-detail">
                                            {{ Func::formatMoney($item['temp_price']) }}
                                        </td>
                                    </tr>
                                    @endif
                                    @if (!empty($configMan->ship))
                                    <tr>
                                        <td colspan="5" class="title-money-cart-detail">Phí vận chuyển:</td>
                                        <td colspan="1" class="cast-money-cart-detail">
                                            @if ($item['ship_price'])
                                            {{ Func::formatMoney($item['ship_price']) }}
                                            @else
                                            0đ
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td colspan="5" class="title-money-cart-detail text-right">Tổng giá trị
                                            đơn hàng:
                                        </td>
                                        <td colspan="1" class="cast-money-cart-detail text-right">
                                            <strong
                                                class="text-danger">{{ Func::formatMoney($item['total_price']) }}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                                @endif
                            </table>

                        </div>

                        <div class="card card-primary card-outline text-sm mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Lịch sử đơn hàng</h3>
                            </div>
                            <div class="card-body">
                                <div class="timeline-container_new">
                                    <div class="timeline-new__wrapper__content--body">
                                        @foreach ($history ?? [] as $value)
                                        <div class="timeline-container_new--position">
                                            <div class="timeline-event-contentnew__icon">
                                                <div class="icon icon-login"><i
                                                        class="fa-regular fa-calendar-days"></i>
                                                </div>
                                            </div>
                                            <div class="timeline-item-new--border--padding">
                                                <div class="timeline-new__infomation">
                                                    <div>
                                                        <span class="timeline-new__infomation__name"></span>
                                                        <span
                                                            class="timeline-new__infomation__time text-primary">{{ $value['updated_at'] }}</span>
                                                    </div>

                                                    <div class="timeline-new__infomation__message">
                                                        <div class="hs-usname">
                                                            + Cập nhật trạng thái thành <span
                                                                class="text-success">{{ Func::showName('order_status', $value['order_status'], 'namevi') }}</span>
                                                        </div>
                                                        @if (!empty($value['notes']))
                                                        <div class="hs-usname">
                                                            + Cập nhật ghi chú đơn hàng thành <span
                                                                class="text-success">{{ $value['notes'] }}</span>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <div class="timeline-container_new--position">
                                            <div class="timeline-event-contentnew__icon">
                                                <div class="icon icon-login"><i class="fa-regular fa-calendar-days"></i>
                                                </div>
                                            </div>
                                            <div class="timeline-item-new--border--padding">
                                                <div class="timeline-new__infomation">
                                                    <div>
                                                        <span class="timeline-new__infomation__name"></span>
                                                        <span
                                                            class="timeline-new__infomation__time text-primary">{{ $item['updated_at'] }}</span>
                                                    </div>
                                                    <div class="timeline-new__infomation__message">
                                                        <div class="hs-usname">
                                                            + Đơn hàng được tạo bởi <strong
                                                                class="text-danger">{{ @$infoUser['fullname'] }}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4">
                        <div class="card card-primary card-outline text-sm mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin đơn hàng</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <p class="form-label">Ngày đặt:
                                        <span>{{ @$item['created_at'] }}</span>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <p class="form-label">Mã đơn hàng: <span
                                            class="text-primary">{{ @$item['code'] }}</span></p>
                                </div>

                                <div class="form-group">
                                    <p class="form-label">Họ tên: <span
                                            class="text-uppercase text-success">{{ @$infoUser['fullname'] }}</span>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <p class="form-label">Điện thoại: <span>{{ @$infoUser['phone'] }}</span></p>
                                </div>
                                <div class="form-group">
                                    <p class="form-label">Email: <span>{{ @$infoUser['email'] }}</span></p>
                                </div>
                                <div class="form-group">
                                    <p class="form-label">Địa chỉ: <span>{{ @$infoUser['address'] }}, {{ @$infoUser['address1'] }} </span></p>
                                </div>
                                <div class="form-group">
                                    <p class="form-label">Nội dung: <span>{{ @$item['requirements'] }}</span></p>
                                </div>
                                @if (!empty($configMan->ship))
                                <div class="form-group">
                                    <p class="form-label">Phí vận chuyển:
                                        @if (!empty($item['ship_price']) && $item['ship_price'] > 0)
                                        {{ Func::formatMoney($item['ship_price']) }}
                                        @else
                                        0đ
                                        @endif
                                    </p>

                                </div>
                                @endif
                                <div class="form-group">
                                    <p class="form-label">Hình thức thanh toán: <span
                                            class="text-primary">{{ Func::showName('news', $item['order_payment'], 'namevi') }}</span>
                                    </p>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Ghi chú:</label>
                                    <textarea class="form-control text-sm" name="data[notes]" id="notes" rows="5" placeholder="Ghi chú"><?= @$item['notes'] ?></textarea>
                                </div>

                            </div>
                        </div>

                        <div class="card card-primary card-outline text-sm mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Tình trạng đơn hàng</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="order_status" class="mr-2">Tình trạng:</label>
                                    <?= Func::orderStatus(@$item['order_status']) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <input type="hidden" name="id"
                    value="{{ !empty($item['id']) && $item['id'] > 0 ? $item['id'] : '' }}">
                <input name="csrf_token" type="hidden" value="{{ csrf_token() }}">

                @component('component.buttonAdd')
                @endcomponent

            </div>
        </form>
    </div>
</div>
@endsection