Dropzone.autoDiscover = false;
    var cruise_gallery = [];
    var room_gallery_1 = [];
    var room_gallery_2 = [];
    var room_gallery_3 = [];
    var room_gallery_4 = [];
    var room_gallery_5 = [];
    jQuery(document).ready(function() {

        $("div#my-awesome-dropzone").dropzone({
            url: "/system-admin/upload-image",
            acceptedFiles: "image/*",
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (file, response) {
                cruise_gallery.push(response);
                $('#cruise_gallery').val(JSON.stringify(cruise_gallery));
            },
            removedfile: function (file) {
                var name = JSON.parse(file.xhr.response);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: '/system-admin/delete-image',
                    data: {filename: name},
                    success: function (data) {
                        cruise_gallery = [];
                        $('#my-awesome-dropzone .dz-image img').each(function () {
                            cruise_gallery.push($(this).attr('alt'));
                        });
                        $('#cruise_gallery').val(JSON.stringify(cruise_gallery));
                    },
                    error: function (e) {
                    }
                });
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
        });
    });