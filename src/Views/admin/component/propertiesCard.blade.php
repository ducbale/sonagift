<div class="flex-propertiescard">
    <div class="form-group">
        <div class="input-group">
            <input type="text" class="form-control" name="propertiescard[name_properties][{{$key}}]" placeholder="Tên"
                value="{{ $value['namevi'] }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <input type="text" class="form-control format-price price-origin-attr"
                id="regular_price_{{ $code }}" name="propertiescard[regular_price][{{$key}}]" placeholder="Giá bán"
                value="{{ $value['regular_price'] }}">
            <div class="input-group-text"><strong>VNĐ</strong></div>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <input type="text" class="form-control format-price price-origin-attr" id="sale_price_{{ $code }}"
                name="propertiescard[sale_price][{{$key}}]" placeholder="Giá khuyến mãi" value="{{ $value['sale_price'] }}">
            <div class="input-group-text"><strong>VNĐ</strong></div>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group ">
            <textarea type="text" class="form-control" name="propertiescard[desc_properties][{{$key}}]" placeholder="Mô tả"
                value="{{ $value['descvi'] }}" >
                {{ $value['descvi'] }}
            </textarea>
        </div>
    </div>
    <input type="hidden" class="form-control" name="propertiescard[id_properties][{{$key}}]"
        value='{{ $value['id_properties'] }}'>
</div>
