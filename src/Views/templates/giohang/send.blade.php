<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
    <tbody>
        @component('component.email.header')
        @endcomponent
        <tr>
            <td align="center"
                style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"
                valign="top">
                <table border="0" cellpadding="0" cellspacing="0" width="600">
                    <tbody>
                        <tr style="background:#fff">
                            <td align="left" height="auto" style="padding:15px" width="600">
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">
                                                    Cảm ơn quý khách đã đặt hàng tại {{$optSetting['website']}}</h1>
                                                <p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Chúng tôi rất vui thông báo đơn hàng #{{$params['code']}} của quý khách đã được tiếp nhận và đang trong quá trình xử lý. {{$setting['namevi']}} sẽ thông báo đến quý khách ngay khi hàng chuẩn bị được giao.</p>
                                                <h3 style="font-size:13px;font-weight:bold;color:{{$params['emailColor']}};text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">Thông tin đơn hàng #{{$params['code']}} <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">({{$params['created_at']}})</span></h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th align="left" style="padding:6px 9px 0px 0px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Thông tin thanh toán</th>
                                                            <th align="left" style="padding:6px 0px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Địa chỉ giao hàng</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:capitalize">{{$params['info_user']['fullname']}}</span><br>
                                                                <a href="mailto:{{$params['info_user']['email']}}" target="_blank">{{$params['info_user']['email']}}</a><br>
                                                                {{$params['info_user']['phone']}}
                                                            </td>
                                                            <td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:capitalize">{{$params['info_user']['fullname']}}</span><br>
                                                                <a href="mailto:{{$params['info_user']['email']}}" target="_blank">{{$params['info_user']['email']}}</a><br>
                                                                {{$params['info_user']['address']}}, {{$params['info_user']['address1']}} <br>
                                                                Tel: {{$params['info_user']['phone']}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding:7px 0px 0px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444" valign="top">
                                                                <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Hình thức thanh toán: </strong> {{ Func::showName('news', $params['order_payment'], 'namevi') }}
                                                                    @if (!empty($params['ship_price'])) 
                                                                        <br><strong>Phí vận chuyển: </strong> {!! Func::formatMoney($params['ship_price']) !!}
                                                                    @endif
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Yêu cầu khác:</strong> <i>{{$params['requirements']}}</i></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:{{$params['emailColor']}}">CHI TIẾT ĐƠN HÀNG</h2>
                                                <table border="1" cellpadding="0" cellspacing="0" style="background:#f5f5f5" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th align="center" bgcolor="{{$params['emailColor']}}" style="padding:6px 9px;color:#333;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Hình ảnh</th>
                                                            <th align="left" bgcolor="{{$params['emailColor']}}" style="padding:6px 9px;color:#333;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Sản phẩm</th>
                                                            <th align="left" bgcolor="{{$params['emailColor']}}" style="padding:6px 9px;color:#333;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Đơn giá</th>
                                                            <th align="center" bgcolor="{{$params['emailColor']}}" style="padding:6px 9px;color:#333;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px;min-width:55px;">Số lượng</th>
                                                            <th align="right" bgcolor="{{$params['emailColor']}}" style="padding:6px 9px;color:#333;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Tổng tạm</th>
                                                        </tr>
                                                    </thead>
                                                   <tbody bgcolor="#f7f7f7" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                              
                                    @foreach ($params['order_detail'] as $k => $v)
                                    @php
                                        $options = $v['options'];
                                        $itemProduct = $v['options']['itemProduct'];
                                    @endphp
                                    <tr>
                                      <td class="align-middle" align="center" style="padding:3px 9px" valign="top">
                                            <img class="img-preview" style="width:90px" onerror="this.src='../assets/images/noimage.png';"
                                                    src="{{ $v['options']['photo'] }}"
                                                    alt="{{ $v['name'] }}" title="{{ $v['name'] }}" />
                                        </td>
                                        <td class="align-middle" align="left" style="padding:3px 9px" valign="top">
                                            <h3 class=" mb-1">{{ $v['name'] }}</h3>
                                            @foreach ($options['properties'] as $kp => $vp)
                                            <p class="text-primary">Mẫu bánh: {{ $vp['namevi'] }}</p>
                                            @endforeach
                                        </td>
                                        <td class="align-middle text-center" align="left" style="padding:3px 9px" valign="top">
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
                                        <td class="align-middle text-right" align="left" style="padding:3px 9px" valign="top">{{ $v['qty'] }}</td>
                                        <td class="align-middle text-right" align="left" style="padding:3px 9px" valign="top">
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
                                            {{ Func::formatMoney($params['temp_price']) }}
                                        </td>
                                    </tr>
                                    @endif
                                    @if (!empty($configMan->ship))
                                    <tr>
                                        <td colspan="4" class="title-money-cart-detail">Phí vận chuyển:</td>
                                        <td colspan="1" class="cast-money-cart-detail">
                                            @if ($params['ship_price'])
                                            {{ Func::formatMoney($params['ship_price']) }}
                                            @else
                                            0đ
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td colspan="4" class="title-money-cart-detail text-right" style="padding:3px 9px">Tổng giá trị
                                            đơn hàng:
                                        </td>
                                        <td colspan="1" class="cast-money-cart-detail text-right" style="padding:3px 9px">
                                            <strong
                                                class="text-danger">{{ Func::formatMoney($params['total_price']) }}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                                                </table>
                                                <div style="margin:auto;text-align:center"><a style="display:inline-block;text-decoration:none;background-color:{{$params['emailColor']}}!important;text-align:center;border-radius:3px;color:#333;padding:5px 10px;font-size:12px;font-weight:bold;margin-top:5px" target="_blank">Chi tiết đơn hàng tại {{$optSetting['website']}}</a></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        @component('component.email.footer')
        @endcomponent
    </tbody>
</table>