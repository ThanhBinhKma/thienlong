jQuery(document).ready(function(){
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    window.addEventListener("dragover",function(e){
      e = e || event;
      e.preventDefault();
    },false);
    window.addEventListener("drop",function(e){
      e = e || event;
      e.preventDefault();
    },false);
    today = yyyy + '/' + mm + '/' + dd;
     $('#date_writer').datepicker({
      format: "dd/mm/yyyy",
      endDate: 'today'
    })
  // Slide Toggle Filters
	$('.btn-show-table-options').click(function(t) {
		t.preventDefault(),
		$(this).closest(".dataTables_wrapper").find(".table-configuration-wrap").slideToggle(500)
	});
  //iCheck for checkbox and radio inputs
	$('.category-checkbox').iCheck({checkboxClass: 'icheckbox_minimal-blue',radioClass: 'iradio_flat-blue'}).on('ifChanged', function () {
    if (this.checked) {
        $(this).closest('tr').css('background-color', '#ffffd5');
    } else {
        $(this).closest('tr').css('background-color', '');
    }
	});
	$('.checkbox-toggle').iCheck({checkboxClass: 'icheckbox_flat-blue',radioClass: 'iradio_flat-blue'});
	$('.checkbox-toggle').on('ifChanged', function(event) {
	    if (this.checked) {
	        $('.grid-row-checkbox').iCheck('check');
	    } else {
	        $('.grid-row-checkbox').iCheck('uncheck');
	    }
	});
	$('.grid-row-checkbox').iCheck({checkboxClass: 'icheckbox_flat-blue',radioClass: 'iradio_flat-blue'}).on('ifChanged', function () {
    if (this.checked) {
        $(this).closest('tr').css('background-color', '#ffffd5');
    } else {
        $(this).closest('tr').css('background-color', '');
    }
	});
  $('#lfm').click(function(t) {
    t.preventDefault();
    $(this).parents('.image-box').find('.btn_remove_image').closest(".image-box").find(".preview-image-wrapper").show();
    // $('.btn_remove_image').closest(".image-box").find(".preview-image-wrapper").show();
  });
  $('.lfm').click(function(t) {
    t.preventDefault();
    $(this).parents('.image-box').find('.btn_remove_image').closest(".image-box").find(".preview-image-wrapper").show();
  });
	$(document).on("click", ".btn_remove_image", function(e) {
		e.preventDefault();
		$(this).parents(".image-box").find(".preview-image-wrapper").hide();
		$(this).parents(".image-box").find(".image-data").val("")
	});
});

function destroy(id , url , url_callback , text = '' ) {
  swal({
    title: 'Bạn có chắc không?',
    text: text,
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: "Xác nhận",
    cancelButtonText: "Hủy bỏ",
    preConfirm: function() {
      return new Promise(function(resolve) {
        setTimeout(function () {
          jQuery.ajax({
            headers: {
              'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: url,
            data: { id : id , _method:'delete' },
            dataType: 'json',
            success: function (data){
              resolve(data);
            }
          });
        }, 2000);
      });
    }
  }).then(function(result) {
    var data = result.value;
    if (typeof data === 'object') {
      if (data.status) {
        swal( 'Thành công!',data.msg,'success' );
        window.location = url_callback;
      } else {
        swal( 'Error!',data.msg,'error' );
      }
    }
  });
}
var selectedRows = function () {
  var selected = [];
  $('.grid-row-checkbox:checked').each(function(){
    selected.push($(this).data('id'));
  });
  return selected;
}

function destroyAll( url , url_callback , text = ''  ){
  var id = selectedRows().join();
  if (id) {
    swal({
      title: "Bạn có chắc không?",
      text: text,
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      closeOnConfirm: false,
      confirmButtonText: "Xác nhận",
      showLoaderOnConfirm: false,
      cancelButtonText: "Hủy bỏ",
      preConfirm: function() {
        return new Promise(function(resolve) {
          setTimeout(function () {
            $.ajax({
              method: 'post',
              url: url,
              data: {
                _method:'delete',
                id: id,
                _token: $('meta[name="csrf-token"]').attr('content')
              },
              dataType: 'json',
              success: function (data) {
                resolve(data);
              }
            });
          }, 2000);
        });
      }
    }).then(function(result) {
      var data = result.value;
      if (typeof data === 'object') {
        if (data.status) {
          swal( 'Thành công!',data.msg,'success' );
          window.location = url_callback;
        } else {
          swal( 'Error!',data.msg,'error' );
        }
      }
    });
  } else {
    swal({
      type: 'error',
      title: 'Không xác định',
      text: 'Vui lòng chọn bản ghi cần xóa!',
    });
  }
}

function restore( url , url_callback , text = '' ) {
  var id = selectedRows().join();
  if (id) {
    swal({
      title: "Bạn có chắc không?",
      text: text,
      type: "question",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      closeOnConfirm: false,
      confirmButtonText: "Xác nhận",
      showLoaderOnConfirm: false,
      cancelButtonText: "Hủy bỏ",
      preConfirm: function() {
        return new Promise(function(resolve) {
          setTimeout(function () {
            $.ajax({
              method: 'post',
              url: url,
              data: {
                id: id,
                _token: $('meta[name="csrf-token"]').attr('content')
              },
              dataType: 'json',
              success: function (data) {
                resolve(data);
              }
            });
          }, 2000);
        });
      }
    }).then(function(result) {
      var data = result.value;
      if (typeof data === 'object') {
        if (data.status) {
          swal( 'Thành công!',data.msg,'success' );
          window.location = url_callback;
        } else {
          swal( 'Error!',data.msg,'error' );
        }
      }
    });
  } else {
    swal({
      type: 'error',
      title: 'Không xác định',
      text: 'Vui lòng chọn bản ghi phục hồi!',
    });
  }
}
