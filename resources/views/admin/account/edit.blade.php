@extends('admin.layouts.master')
@section('title','Chỉnh sửa trang')
@section('content')
  <section class="content">
    
    <div class="clearfix"></div>
    <form method="POST" action="{{route('system_admin.account.update',['id'=>$account->id])}}">
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
                  <label for="title" class="control-label required">Account Name</label>
                  <input class="form-control" placeholder="Nhập tên trang" data-counter="120" name="accout_name" type="text" id="title" value="{{ $account->account_name }}" readonly>
                  @if ($errors->first('title')) 
                    <div class="error">{{ $errors->first('title') }}</div>
                  @endif
                </div>            
                <div class="form-group">
                  <label for="title" class="control-label required">Password</label>
                  <input class="form-control" placeholder="Nhập password" data-counter="120" name="password" type="text" id="title" value="{{ $account->password }}">
                  @if ($errors->first('content')) 
                    <div class="error">{{ $errors->first('content') }}</div>
                  @endif
                </div>

                <div class="form-group">
                  <label for="" class="control-label">Social</label>
                  <select name="social" id="" class="form-control">
                    <option value="1" {{$account->social == 1 ? 'selected' : ''}}>Facebook</option>
                    <option value="2" {{$account->social == 2 ? 'selected' : ''}}>Twiter</option>
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
                  <option value="1" {{$account->status == 1 ? 'selected' : ''}}>Đã kích hoạt</option>
                  <option value="0" {{$account->status == 0 ? 'selected' : ''}}>Đã vô hiệu</option>
                </select>
                @if ($errors->first('status')) 
                  <div class="error">{{ $errors->first('status') }}</div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </section>
@stop
@section('addjs')
  <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
  <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
  <script type="text/javascript">
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })

    @if(session('status_update'))
      swal(
        'Thành công!',
        'Chỉnh sửa trang thành công!',
        'success'
      )
    @endif
  </script>
@stop
