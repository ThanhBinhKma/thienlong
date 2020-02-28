@extends('admin.layouts.master')
@section('title','Chỉnh sửa trang')
@section('content')
  <section class="content">
    
    <div class="clearfix"></div>
   
    
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
                  <input class="form-control" placeholder="Nhập tên trang" data-counter="120" name="accout_name" type="text" id="title" value="{{ $account[0]['account_name'] }}" readonly>
                  @if ($errors->first('title')) 
                    <div class="error">{{ $errors->first('title') }}</div>
                  @endif
                </div>            
                <div class="form-group">
                  <label for="title" class="control-label required">Nội dung</label>
                  <textarea class="form-control" rows="10" placeholder="Nội dung trang" data-counter="400" name="content" cols="50" id="content">{{$account[0]['content']}}</textarea>
                  @if ($errors->first('content')) 
                    <div class="error">{{ $errors->first('content') }}</div>
                  @endif
                </div>

                <div class="form-group">
                  <label for="title" class="control-label required">Link bài viết</label><br>
                  <a href="{{$account[0]['url']}}"><i class="fa fa-hand-o-right" aria-hidden="true" style="font-size: 45px;margin-left: 20px;color: cornflowerblue"></i></a>
                </div>

                <div class="form-group">
                  <label for="" class="control-label">Social</label>
                  @if($account[0]['social'] == 1)
                    <input class="form-control" placeholder="Nhập tên trang" data-counter="120" name="accout_name" type="text" id="title" value="Facebook">
                  @else
                    <input class="form-control" placeholder="Nhập tên trang" data-counter="120" name="accout_name" type="text" id="title" value="Twitter">
                  @endif
                </div>

                <div class="form-group">
                  <label class="control-label">Reaction</label>
                  <br>
                  <span style="font-size: 19px;"> {{$account[0]['like']}}</span> <i class="fa fa-thumbs-o-up" aria-hidden="true" style="font-size: 20px;margin-right: 10px;color: rgb(32, 120, 244);"></i>
                        <span style="font-size: 19px;">{{$account[0]['comment']}} </span><i class="fa fa-comment-o" aria-hidden="true" style="font-size: 20px;margin-right: 10px;color: red;"></i>
                        @if($account[0]['social'] == 1)
                        <span style="font-size: 19px;">{{$account[0]['share']}}</span> <i class="fa fa-share-alt" aria-hidden="true" style="font-size: 20px;margin-right: 10px;color: #e39400;"></i>
                        @elseif($account[0]['social'] == 2)
                        <span style="font-size: 19px;">{{$account[0]['retweet']}}</span><i class="fa fa-retweet" aria-hidden="true" style="font-size: 20px;margin-right: 10px;color: #e39400;"></i>
                        @endif
                </div>
              </div>
            </div><!-- end.tab-content -->
          </div>
        </div>
        <div class="col-md-3 right-sidebar">
          <div class="widget meta-boxes">
            <div class="widget-title">
              <h4><label for="status" class="control-label required">Trạng thái</label></h4>
            </div>
            <div class="widget-body">
              <div class="ui-select-wrapper">
                <select class="form-control ui-select ui-select" id="status" name="status">
                  <option value="1" {{$account[0]['status'] == 1 ? 'selected' : ''}}>Đã kích hoạt</option>
                  <option value="0" {{$account[0]['status'] == 0 ? 'selected' : ''}}>Đã vô hiệu</option>
                </select>
                @if ($errors->first('status')) 
                  <div class="error">{{ $errors->first('status') }}</div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
  
  </section>
@stop

