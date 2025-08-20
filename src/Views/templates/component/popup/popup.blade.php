@if (!empty($val) && empty(session()->get('popup')))
    <div class="modal fade show" id="popup" tabindex="-1" aria-labelledby="popupLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupLabel">{{ $val['namevi'] }} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="d-flex justify-content-between align-items-center">
                        @if (!empty($val['contentvi']))
                            <div class="mb-3 w-50 pe-3">
                                {!! $val['contentvi'] !!}
                            </div>
                        @endif
                        <a href="{{ $val['link'] }}" class="w-50 d-block">
                            <img data-src="{{ upload('photo', $val['photo']) }}" alt="{{ $val['namevi'] }}"
                                class="lazy loaded w-100" src="{{ upload('photo', $val['photo']) }}"
                                data-was-processed="true">
                        </a>
                    </div>
                </div>
         
            </div>
        </div>
    </div>
@endif
@if (!empty(strpos($val['status'], 'repeat')))
    @php session()->unset('popup'); @endphp
@else
    @php session()->set('popup', true); @endphp
@endif
