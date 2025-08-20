<div class="fileUpload-zone">
    <div class="fileUpload-detail mb-2" id="fileUpload-preview">
        @if (!empty($fileDetail['file']))
            {{ $fileDetail['file'] }}    
        @endif 
    </div>
    <label class="fileUpload-file" id="photo-zone1" for="file-zone1">
        <input type="file" name="file1" id="file-zone1">
        <i class="ti ti-cloud-upload"></i>
        <p class="fileUpload-drop">Kéo và thả file vào đây</p>
        <p class="fileUpload-or">Hoặc</p>
        <p class="fileUpload-choose btn btn-sm">Chọn file</p>
    </label>
    <div class="fileUpload-dimension">{{ $fileDetail['dimension'] }}</div>
</div>

@pushonce('styles')
<link rel="stylesheet" href="@asset('assets/admin/fancybox5/fancybox.css')">
@endpushonce
@pushonce('scripts')
<script src="@asset('assets/admin/fancybox5/fancybox.umd.js')"></script>
<script src="@asset('assets/admin/fancybox5/fancybox.umd.js')"></script>
<script type="text/javascript">
    Fancybox.bind('[data-fancybox]', {});
    /* PhotoZone */
    if ($('#photo-zone1').length) {
        photoZone('#photo-zone1', '#file-zone1', '#fileUpload-preview span');
    }
    /* Reader image */
    function readImage(inputFile, elementPhoto) {
        const regex = new RegExp(`.(${TYPE_FILE})$`, 'i');
        const fileName = inputFile[0].file1[0].name;
        if (inputFile[0].file1[0]) {
            if (fileName.match(regex)) {
                var size = parseInt(inputFile[0].file1[0].size) / 1024;

                if (size <= 4096) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $(elementPhoto).attr('span', e.target.result);
                    };
                    reader.readAsDataURL(inputFile[0].file1[0]);
                } else {
                    notifyDialog('Dung lượng file cho phép < 4MB');
                    return false;
                }
            } else {
                $(elementPhoto).attr('span', '');
                notifyDialog('Định dạng file không hợp lệ');
                return false;
            }
        } else {
            $(elementPhoto).attr('span', '');
            return false;
        }
    }
    /* Photo zone */
    function photoZone(eDrag, iDrag, eLoad) {
        if ($(eDrag).length) {
            /* Drag over */
            $(eDrag).on('dragover', function () {
                $(this).addClass('drag-over');
                return false;
            });

            /* Drag leave */
            $(eDrag).on('dragleave', function () {
                $(this).removeClass('drag-over');
                return false;
            });

            /* Drop */
            $(eDrag).on('drop', function (e) {
                e.preventDefault();
                $(this).removeClass('drag-over');

                var lengthZone = e.originalEvent.dataTransfer.file1.length;

                if (lengthZone == 1) {
                    $(iDrag).prop('file1', e.originalEvent.dataTransfer.file1);
                    readImage($(iDrag), eLoad);
                } else if (lengthZone > 1) {
                    notifyDialog('Bạn chỉ được chọn 1 file để upload');
                    return false;
                } else {
                    notifyDialog('Dữ liệu không hợp lệ');
                    return false;
                }
            });

            /* File zone */
            $(iDrag).change(function () {
                readImage($(this), eLoad);
            });
        }
    }
</script>
@endpushonce