<div class="photoUpload-zone">
    <div class="crop-view-popup d-block">
        <div class="setting-crop">
            <input type="hidden" name="additionalData" id="additionalData" value="someAdditionalData">
            <ul class="mb-3 hide-crop">
                <li>
                    <button id="cropButton-{{ $key }}" type="button"
                        class="cropButton btn-primary btn-crop-img"><i class="ti ti-crop"></i> Cắt ảnh</button>
                </li>
            </ul>
            <div class="actions mb-3 mt-2" id="actions-{{ $key }}">
                <div class="docs-buttons">
                    <!-- <h3>Toolbar:</h3> -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45"
                            title="Rotate Left">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotate(-45)">
                                <i class="ti ti-rotate-2"></i>
                            </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="rotate" data-option="45"
                            title="Rotate Right">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotate(45)">
                                <i class="ti ti-rotate-clockwise-2"></i>
                            </span>
                        </button>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1"
                            title="Zoom In">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoom(0.1)">
                                <i class="ti ti-zoom-in"></i>
                            </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1"
                            title="Zoom Out">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoom(-0.1)">
                                <i class="ti ti-zoom-out"></i>
                            </span>
                        </button>
                    </div>

                    <div class="docs-data px-2">
                        <div class="input-group  my-2">
                            <input type="number" class="form-control cropWidth" id="cropWidth-{{ $key }}"
                                placeholder="width">
                            <span class="input-group-append">
                                <span class="input-group-text">px</span>
                            </span>
                        </div>
                        <div class="input-group  my-2">
                            <input type="number" class="form-control cropHeight" id="cropHeight-{{ $key }}"
                                placeholder="height">
                            <span class="input-group-append">
                                <span class="input-group-text">px</span>
                            </span>
                        </div>
                    </div>

                    <div class="btn-group px-2 w-100">
                        <button type="button" class="btn btn-primary crop-reset" id="crop-reset-{{ $key }}"
                            data-method="reset" title="Reset">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.reset()">
                                <i class="ti ti-refresh"></i> Làm lại
                            </span>
                        </button>
                    </div>

                    <!-- Show the cropped image in modal -->
                </div><!-- /.docs-buttons -->
            </div>
            <ul>
                <li>
                    <button id="saveButton-{{ $key }}" type="button"
                        class="saveButton  btn-primary btn-crop-img"><i class="ti ti-circle-plus"></i> Áp dụng</button>
                </li>
            </ul>
            <div class="view-size">{{ $photoDetail['dimension'] }}</div>
        </div>

        <div class="view-cropper">
            <div class="photoUpload-detail" id="photoUpload-preview-{{ $key }}">
                @if (!empty($photoDetail['image']))
                    <a class="img-container">
                        <img class="rounded" onerror="this.src='../assets/images/noimage.png';"
                            data-src="{{ upload($photoDetail['upload'], $photoDetail['image']) }}"
                            src="{{ upload($photoDetail['upload'], $photoDetail['image']) }}" alt="Alt photo"
                            title="Alt photo" />
                    </a>
                @else
                    <img class="rounded" onerror="this.src='../assets/images/noimage.png';"
                        src="{{ upload($photoDetail['upload'], $photoDetail['image']) }}" alt="Alt photo"
                        title="Alt photo" />
                @endif

                <button type="button" class="crop-popup btn-primary btn-crop-img mt-3"
                    id="crop-popup-{{ $key }}">Chỉnh sửa ảnh</button>
            </div>
        </div>
    </div>
    <div class="file-photo">
        <label class="photoUpload-file" id="photo-zone-{{ $key }}" for="file-zone-{{ $key }}">
            <input type="file" class="file-zone-{{ $key }}" name="file-{{ $key }}"
                id="file-zone-{{ $key }}">
            <input type="hidden" class="cropFile" name="cropFile-{{ $key }}"
                id="cropFile-{{ $key }}">
            <i class="ti ti-cloud-upload"></i>
            <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
            <p class="photoUpload-or">Hoặc</p>
            <p class="photoUpload-choose btn btn-sm">Chọn hình</p>
        </label>
        <div class="photoUpload-dimension">{{ $photoDetail['dimension'] }}</div>
    </div>
</div>
