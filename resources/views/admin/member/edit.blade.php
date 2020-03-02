@extends('admin.layouts.master')
@section('title','Chỉnh sửa trang')
@section('content')
  <section class="content">
    
    <div class="clearfix"></div>
    <form method="POST" action="{{route('system_admin.member.update',['id'=>$member->id])}}">
       @method('PUT')
      {{ csrf_field() }}
    
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
                  <label for="title" class="control-label required">Tên thành viên</label>
                  <input class="form-control" placeholder="Nhập tên trang" data-counter="120" name="name_member" type="text" id="title" value="{{ $member->name }}" readonly>
                  @if ($errors->first('title')) 
                    <div class="error">{{ $errors->first('title') }}</div>
                  @endif
                </div>            
                <div class="form-group">
                  <label for="title" class="control-label required">Vị trí</label>
                  <input class="form-control" placeholder="Nhập password" data-counter="120" name="position" type="text" id="title" value="{{ $member->position }}">
                  @if ($errors->first('content')) 
                    <div class="error">{{ $errors->first('content') }}</div>
                  @endif
                </div>

                <div class="form-group">
                  <label for="title" class="control-label required">Lựa chọn vị trí</label>
                  <select name="position_id" id="" class="form-control">
                    <option value="1" {{$member->position_id == 1 ? 'selected' : ''}}>Giám đốc</option>
                    <option value="2" {{$member->position_id == 2 ? 'selected' : ''}}>Nhân viên</option>
                  </select>
                </div>
            
              </div>
            </div><!-- end.tab-content -->
          </div>
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
                  <option value="1" {{$member->status == 1 ? 'selected' : ''}}>Đã kích hoạt</option>
                  <option value="0" {{$member->status == 0 ? 'selected' : ''}}>Đã vô hiệu</option>
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
                @if ($member->avatar)
                  <input id="thumbnail" type="hidden" name="thumbnail" value="{{$member->avatar }}" class="image-data">
                  <div class="preview-image-wrapper ">
                    <img id="holder" class="preview_image" src="{{ $member->avatar }}" type="text" name="filepath" alt="preview image">
                    <a class="btn_remove_image" title="Xoá ảnh">
                      <i class="fa fa-times"></i>
                    </a>
                  </div>
                @else
                  <input id="thumbnail" type="hidden" name="thumbnail" value="" class="image-data">
                  <div class="preview-image-wrapper ">
                    <img id="holder" class="preview_image" src="{{ asset('images/placeholder.png') }}" type="text" name="filepath" alt="preview image">
                    <a class="btn_remove_image" title="Xoá ảnh">
                      <i class="fa fa-times"></i>
                    </a>
                  </div>
                @endif
                <div class="image-box-actions">
                   <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
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
      radioClass   : 'iradio_minimal-blue'
    })
    $('#lfm').filemanager('image');
    @if(session('status_update'))
      swal(
        'Thành công!',
        'Chỉnh sửa trang thành công!',
        'success'
      )
    @endif
  </script>
@stop
