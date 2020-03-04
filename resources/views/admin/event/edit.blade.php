@extends('admin.layouts.master')
@section('title','Chỉnh sửa trang')
@section('content')
    <section class="content">
        {{ Breadcrumbs::render('editevent') }}
        <div class="clearfix"></div>
        <form method="POST" action="{{route('system_admin.event.update',['id'=>$event->id])}}">
            @method('PUT')
            {{ csrf_field() }}
            @if ($errors->all())
                <div class="note note-danger"><p>Vui lòng điền đầy đủ thông tin</p></div>
            @else
                <div class="note note-success"><p>Bạn đang sửa sự kiện</p></div>
            @endif
            <div class="row">
                <div class="col-md-9">
                    <div class="tabbable-custom">
                        <ul class="nav nav-tabs ">
                            <li class="nav-item">
                                <a href="#tab_detail" class="nav-link active show" data-toggle="tab">Chi tiết trang</a>
                            </li>
                        </ul><!-- end.nav-tabs -->
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tab_detail">
                                <div class="form-group">
                                    <label for="title" class="control-label required">Tiêu đề</label>
                                    <input class="form-control" placeholder="Nhập tên trang" data-counter="120"
                                           name="title" type="text" id="title" value="{{ $event->title}}">
                                    @if ($errors->first('title'))
                                        <div class="error">{{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="title" class="control-label required">Ngày</label>
                                    <input class="form-control" placeholder="Nhập tên trang" data-counter="120"
                                           name="date" type="text" id="date" value="{{ $event->date }}"
                                           autocomplete="off">
                                    @if ($errors->first('title'))
                                        <div class="error">{{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="title" class="control-label required">Địa điểm</label>
                                    <input class="form-control" placeholder="Nhập tên trang" data-counter="120"
                                           name="place" type="text" id="title" value="{{ $event->date }}">
                                    @if ($errors->first('title'))
                                        <div class="error">{{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group box-body pad">
                                    <textarea class="high" rows="10" placeholder="Nội dung trang" data-counter="400"
                                              name="content" cols="50"
                                              id="content">{!! $event->description !!}</textarea>
                                    @if ($errors->first('content'))
                                        <div class="error">{{ $errors->first('content') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="description" class="control-label">Cruise Gallery</label>
                                    <div class="dropzone dropzone-previews" name="" id="my-awesome-dropzone"></div>
                                </div>
                                <input type="hidden" name="images" id="cruise_gallery">
                            </div>
                        </div>
                    </div><!-- end.tab-content -->
                </div>
                <div class="col-md-3 right-sidebar">
                    <div class="widget meta-boxes form-actions form-actions-default action-horizontal">
                        <div class="widget-title">
                            <h4><span>Cập nhật trang</span></h4>
                        </div>
                        <div class="widget-body">
                            <div class="btn-set">
                                <button type="submit" name="submit" value="save" class="btn btn-info">
                                    <i class="fa fa-save"></i> Lưu
                                </button>
                                <button type="submit" name="submit" value="apply" class="btn btn-success">
                                    <i class="fa fa-check-circle"></i> Lưu và Sửa
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="widget meta-boxes">
                        <div class="widget-title">
                            <h4><label for="status" class="control-label required">Trạng thái</label></h4>
                        </div>
                        <div class="widget-body">
                            <div class="ui-select-wrapper">
                                <select class="form-control ui-select ui-select" id="status" name="status">
                                    <option value="1" {{$event->status == 1 ? 'selected' : ''}}>Đã kích hoạt</option>
                                    <option value="0" {{$event->status == 0 ? 'selected' : ''}}>Đã vô hiệu</option>
                                </select>
                                @if ($errors->first('status'))
                                    <div class="error">{{ $errors->first('status') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="widget meta-boxes">
                            <div class="widget-title">
                                <h4><label for="image" class="control-label">Hình ảnh</label></h4>
                            </div>
                            <div class="widget-body">
                                <div class="image-box">
                                    @if ($event->avatar)
                                        <input id="thumbnail" type="hidden" name="thumbnail" value="{{$event->avatar }}"
                                               class="image-data">
                                        <div class="preview-image-wrapper ">
                                            <img id="holder" class="preview_image" src="{{ $event->avatar }}"
                                                 type="text" name="filepath" alt="preview image">
                                            <a class="btn_remove_image" title="Xoá ảnh">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    @else
                                        <input id="thumbnail" type="hidden" name="thumbnail" value=""
                                               class="image-data">
                                        <div class="preview-image-wrapper ">
                                            <img id="holder" class="preview_image"
                                                 src="{{ asset('images/placeholder.png') }}" type="text" name="filepath"
                                                 alt="preview image">
                                            <a class="btn_remove_image" title="Xoá ảnh">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    @endif
                                    <div class="image-box-actions">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder"
                                           class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Chọn hình ảnh
                                        </a>
                                    </div>
                                    @if ($errors->first('thumbnail'))
                                        <div class="error">{{ $errors->first('thumbnail') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@stop
@section('addjs')
    <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
    <script type="text/javascript">
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
        $('#lfm').filemanager('image');
        @if(session('status_update'))
swal(
            'Thành công!',
            'Chỉnh sửa trang thành công!',
            'success'
        )
        @endif
            Dropzone.autoDiscover = false;
        var cruise_gallery = [];
        jQuery(document).ready(function() {
            $("div#my-awesome-dropzone").dropzone({
                url: "/system-admin/upload-image",
                acceptedFiles: "image/*",
                addRemoveLinks: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                init: function () {
                            @if(count($images) > 0)
                            @foreach($images as $image)
                    var myDropzone = this;
                    var mockFile = {
                        name: '{{explode('/', $image->link)[3]}}',
                        size: 120
                    };
                    // Call the default addedfile event handler
                    myDropzone.options.addedfile.call(myDropzone, mockFile);
                    myDropzone.options.thumbnail.call(myDropzone, mockFile, '{{$image->link}}');
                    cruise_gallery.push('{{$image->link}}');
                    $('#cruise_gallery').val(JSON.stringify(cruise_gallery));
                    @endforeach
             @endif
                $('#cruise_gallery').val(JSON.stringify(cruise_gallery));
                },
                success: function (file, response) {
                    cruise_gallery.push(response);
                    $('#cruise_gallery').val(JSON.stringify(cruise_gallery));
                },
                removedfile: function (file) {

                    var name = file.name;
                    console.log(file);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        url: '/system-admin/delete-image',
                        data: {filename: name, cruise_id: $('[name="cruise_id"]').val()},
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
    </script>
@stop
