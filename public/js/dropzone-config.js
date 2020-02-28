Dropzone.autoDiscover = false;
          var cruise_gallery = [];
          var room_gallery_1 = [];
          var room_gallery_2 = [];
          var room_gallery_3 = [];
          var room_gallery_4 = [];
          var room_gallery_5 = [];
  jQuery(document).ready(function() {

    $("div#my-awesome-dropzone").dropzone({
      url: "images-save",
      acceptedFiles: "image/*",
      addRemoveLinks: true,
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(file, response){
        cruise_gallery.push(response);
        $('#cruise_gallery').val(JSON.stringify(cruise_gallery));
    },
        removedfile: function(file) 
        {
            var name = file.upload.filename;
            $.ajax({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: 'images-delete',
                data: {filename: name},
                success: function (data){
                  cruise_gallery = [];
                  $('#my-awesome-dropzone .dz-image img').each(function(){
                    cruise_gallery.push($(this).attr('alt'));
                  });
                  $('#cruise_gallery').val(JSON.stringify(cruise_gallery));
                },
                error: function(e) {
                }});
                var fileRef;
                return (fileRef = file.previewElement) != null ? 
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
    });

    $("div#my-awesome-dropzone-1").dropzone({
      url: "images-save",
      acceptedFiles: "image/*",
      addRemoveLinks: true,
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(file, response){
        room_gallery_1.push(response);
        $('#room_gallery_1').val(JSON.stringify(room_gallery_1));
    },
        removedfile: function(file) 
        {
            var name = file.upload.filename;
            $.ajax({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: 'images-delete',
                data: {filename: name},
                success: function (data){
                  room_gallery_1 = [];
                  $('#my-awesome-dropzone-1 .dz-image img').each(function(){
                    room_gallery_1.push($(this).attr('alt'));
                  });
                  $('#room_gallery_1').val(JSON.stringify(room_gallery_1));
                },
                error: function(e) {
                }});
                var fileRef;
                return (fileRef = file.previewElement) != null ? 
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
    });


    $("div#my-awesome-dropzone-2").dropzone({
      url: "images-save",
      acceptedFiles: "image/*",
      addRemoveLinks: true,
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(file, response){
        room_gallery_2.push(response);
        $('#room_gallery_2').val(JSON.stringify(room_gallery_2));
    },
        removedfile: function(file) 
        {
            var name = file.upload.filename;
            $.ajax({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: 'images-delete',
                data: {filename: name},
                success: function (data){
                  room_gallery_2 = [];
                  $('#my-awesome-dropzone-2 .dz-image img').each(function(){
                    room_gallery_2.push($(this).attr('alt'));
                  });
                  $('#room_gallery_2').val(JSON.stringify(room_gallery_2));
                },
                error: function(e) {
                }});
                var fileRef;
                return (fileRef = file.previewElement) != null ? 
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
    });

    $("div#my-awesome-dropzone-3").dropzone({
      url: "images-save",
      acceptedFiles: "image/*",
      addRemoveLinks: true,
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(file, response){
        room_gallery_3.push(response);
        $('#room_gallery_3').val(JSON.stringify(room_gallery_3));
    },
        removedfile: function(file) 
        {
            var name = file.upload.filename;
            $.ajax({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: 'images-delete',
                data: {filename: name},
                success: function (data){
                  room_gallery_3 = [];
                  $('#my-awesome-dropzone-3 .dz-image img').each(function(){
                    room_gallery_3.push($(this).attr('alt'));
                  });
                  $('#room_gallery_3').val(JSON.stringify(room_gallery_3));
                },
                error: function(e) {
                }});
                var fileRef;
                return (fileRef = file.previewElement) != null ? 
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
    });

    $("div#my-awesome-dropzone-4").dropzone({
      url: "images-save",
      acceptedFiles: "image/*",
      addRemoveLinks: true,
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(file, response){
        room_gallery_4.push(response);
        $('#room_gallery_4').val(JSON.stringify(room_gallery_4));
    },
        removedfile: function(file) 
        {
            var name = file.upload.filename;
            $.ajax({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: 'images-delete',
                data: {filename: name},
                success: function (data){
                  room_gallery_4 = [];
                  $('#my-awesome-dropzone-4 .dz-image img').each(function(){
                    room_gallery_4.push($(this).attr('alt'));
                  });
                  $('#room_gallery_4').val(JSON.stringify(room_gallery_4));
                },
                error: function(e) {
                }});
                var fileRef;
                return (fileRef = file.previewElement) != null ? 
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
    });

    $("div#my-awesome-dropzone-5").dropzone({
      url: "images-save",
      acceptedFiles: "image/*",
      addRemoveLinks: true,
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(file, response){
        room_gallery_5.push(response);
        $('#room_gallery_5').val(JSON.stringify(room_gallery_5));
    },
        removedfile: function(file) 
        {
            var name = file.upload.filename;
            $.ajax({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: 'images-delete',
                data: {filename: name},
                success: function (data){
                  room_gallery_5 = [];
                  $('#my-awesome-dropzone-5 .dz-image img').each(function(){
                    room_gallery_5.push($(this).attr('alt'));
                  });
                  $('#room_gallery_5').val(JSON.stringify(room_gallery_5));
                },
                error: function(e) {
                }});
                var fileRef;
                return (fileRef = file.previewElement) != null ? 
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
    });
  });