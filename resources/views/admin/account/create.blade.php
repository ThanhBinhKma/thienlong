@extends('admin.layouts.master')
@section('title','Thêm trang mới')
@section('content')
  <section class="content">
    
    <div class="clearfix"></div>
    <form method="POST" action="{{route('system_admin.account.store')}}">
      {{ csrf_field() }}
      

      @if(session('error_account'))
        <div class="note note-success"><p>Tên tài khoản hoặc mật khẩu sai</p></div>
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
                  <label for="title" class="control-label required">Account Name</label>
                  <input class="form-control" placeholder="Nhập tên đăng nhập" data-counter="120" name="account_name" type="text" id="title" value="{{ old('title') }}">
                  @if ($errors->first('account_name')) 
                    <div class="error">{{ $errors->first('account_name') }}</div>
                  @endif
                </div>            
                <div class="form-group">
                  <label for="description" class="control-label">Password</label>
                  <input class="form-control" placeholder="Nhập mật khẩu" data-counter="120" name="password" type="password" id="title" value="{{ old('title') }}">
                  @if ($errors->first('password')) 
                    <div class="error">{{ $errors->first('password') }}</div>
                  @endif
                </div>

                <div class="form-group">
                  <label for="" class="control-label">Social</label>
                  <select name="social" id="" class="form-control">
                    <option value="1">Facebook</option>
                    <option value="2">Twiter</option>
                  </select>
                  @if ($errors->first('social')) 
                    <div class="error">{{ $errors->first('social') }}</div>
                  @endif
                </div>
              </div>
            </div><!-- end.tab-content -->
          </div>
        </div>
        <div class="col-md-3 right-sidebar">
          <div class="widget meta-boxes form-actions form-actions-default action-horizontal">
            <div class="widget-title">
              <h4><span>Tạo trang</span></h4>
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
                  <option value="1" selected="selected">Đã kích hoạt</option>
                  <option value="0">Đã vô hiệu</option>
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

