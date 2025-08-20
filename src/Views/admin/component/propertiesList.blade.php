<div class="row">
    @foreach ($propertieslist as $value)
        <div class="form-group col-6 col-lg-4">
            <label class="form-label d-block" for="id_list">{{ $value['namevi'] }}</label>
            {!! Func::getProperties(@$item['properties'], $value['id'], 'properties', 'san-pham', 'properties') !!}
        </div>
    @endforeach
</div>
