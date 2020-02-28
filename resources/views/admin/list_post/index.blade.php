@extends('admin.layouts.master')
@section('title','Quản lý Trang')
@section('content')
  @php
    $request = request();
  @endphp
  <section class="content dataTables_wrapper">
    
    <div class="clearfix"></div>
    @if (session('status_store'))
      <div class="note note-success"><p>{{ session('status_store') }}</p></div>
    @endif
    <div class="row">
      <div class="col-xs-12">
        <div class="table-configuration-wrap">
          <span class="configuration-close-btn btn-show-table-options"><i class="fa fa-times"></i></span>
          <div class="wrapper-filter">
            <form action="{{route('system_admin.list_post.index')}}" method="GET">
              @csrf
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input type="text" name="keyword" class="form-control" id="keyword" placeholder="Nhập từ khóa tìm kiếm : Tên tài khoản..." @if($request->has('keyword')) value="{{ $request->keyword}}" @endif>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <select name="social" class="form-control" id="status">
                      <option value="">-Chọn mạng xã hội-</option>
                      <option value="1" @if($request->has('social') && $request->social == 1) selected @endif>Facebook</option>
                      <option value="2" @if($request->has('social') && $request->social == 2) selected @endif>Twitter</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <select name="sort" class="form-control" id="status">
                      <option value="">-Sắp xếp theo-</option>
                      <option value="1" @if($request->has('social') && $request->sort == 1) selected @endif>Lượt Like</option>
                      <option value="2" @if($request->has('social') && $request->sort == 2) selected @endif>Ngày Đăng Mới Nhất</option>
                      <option value="3" @if($request->has('social') && $request->sort == 3) selected @endif>Ngày Đăng Cũ Nhất</option>
                    </select>
                  </div>
                </div>


                <div class="col-md-2">
                  <div class="form-group">
                    <select name="status" class="form-control" id="status">
                      <option value="">-Chọn trạng thái-</option>
                      <option value="1" @if(isset($request->status) && $request->status == 1) selected @endif>Đã kích hoạt</option>
                      <option value="0" @if( isset($request->status) && $request->status == 0) selected @endif>Đã vô hiệu</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <button type="submit" class="btn btn-info">
                      <i class="fa fa-search"></i> Tìm kiếm
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <div class="pull-right">
              <div class="btn-group pull-right" style="margin-right: 10px">
                <a class="btn btn-sm btn-twitter" title="Export"><i class="fa fa-download"></i><span class="hidden-xs"> Export</span></a>
                <button type="button" class="btn btn-sm btn-twitter dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#" target="_blank">All</a></li>
                  <li><a href="#" target="_blank">Current page</a></li>
                  <li><a href="#" target="_blank" class="export-selected">Selected rows</a></li>
                </ul>
              </div>
              <div class="btn-group pull-right" style="margin-right: 10px">
                <a href="" class="btn btn-sm btn-success" title="New">
                  <i class="fa fa-save"></i><span class="hidden-xs">&nbsp;&nbsp;Thêm mới</span>
                </a>
              </div>
            </div>
            <span>
              <div class="portlet light bordered portlet-no-padding">
                <div class="portlet-title">
                  <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Tác Vụ
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                      <li><a href="javascript:void(0)" class="grid-batch-0">Xóa lựa chọn</a></li>
                      <li><a href="javascript:void(0)" class="grid-batch-1">Phục hồi</a></li>
                    </ul>
                  </div>
                  <a href="javascript:void(0)" class="btn btn-sm btn-primary grid-refresh" title="Refresh">
                    <i class="fa fa-refresh"></i><span class="hidden-xs"> Làm mới</span>
                  </a>
                  <button class="btn btn-primary btn-show-table-options">
                    <i class="fa fa-filter"></i> Tìm kiếm
                  </button>
                </div>
              </div>
            </span>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>
                    <input type="checkbox" class="checkbox-toggle" />
                  </th>                
                  <th>
                    ID<a class="fa fa-fw fa-sort" href="#"></a>
                  </th>
                  <th style="width: 150px;">Tài khoản</th>
                  <th>Ngày đăng</th>
                  <th>Reaction</th>
                  <th>Social</th>
                  <th>Link</th>
                  <th>Trạng thái</th>
                  <th>Tác vụ</th>
                </tr>
              </thead>
              <tbody>
                @if (count($post) >0)
                  @foreach($post as $posts) 
                    <tr>
                      <td><input type="checkbox" class="grid-row-checkbox" data-id="{{ $posts->id }}" /></td>
                      <td>
                        {{ $posts->id }}
                      </td>
                      <td>
                        <a class="text-left" href="{{route('system_admin.account.edit',['id'=>$posts->account_id])}}" title="{{ $posts->account_name }}" >{{ $posts->account_name }}</a>
                      </td>
                      <td> {{ \Carbon\Carbon::parse($posts->created_at)->format('d/m/Y H:i:s')}}</td>
                      <td>
                      
                        <span style="font-size: 19px;"> {{$posts->like}}</span> <i class="fa fa-thumbs-o-up" aria-hidden="true" style="font-size: 20px;margin-right: 10px;color: rgb(32, 120, 244);"></i>
                        <span style="font-size: 19px;">{{$posts->comment}} </span><i class="fa fa-comment-o" aria-hidden="true" style="font-size: 20px;margin-right: 10px;color: red;"></i>
                        @if($posts->social == 1)
                        <span style="font-size: 19px;">{{$posts->share}}</span> <i class="fa fa-share-alt" aria-hidden="true" style="font-size: 20px;margin-right: 10px;color: #e39400;"></i>
                        @elseif($posts->social == 2)
                        <span style="font-size: 19px;">{{$posts->retweet}}</span><i class="fa fa-retweet" aria-hidden="true" style="font-size: 20px;margin-right: 10px;color: #e39400;"></i>
                        @endif
                      </td>
                       <td> {!! \App\Helpers\Common::checkSocial($posts->social) !!}</td>
                       <td>
                         <a href="{{$posts->url}}" target="_blank"><i class="fa fa-hand-o-right" aria-hidden="true" style="font-size: 30px;margin-left: 20px;color: cornflowerblue" ></i></a>
                       </td>
                      <td> {!! \App\Helpers\Common::checkStatusPost($posts->status) !!} </td> 
                      <td>
                        <a href="{{route('system_admin.list_post.view',['id'=>$posts->id])}}" class="btn btn-icon btn-sm btn-primary tip">
                          <i class="fa fa-eye"></i>
                        </a>
                       
                      </td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
          <div class="box-footer clearfix">
            <div class="col-md-5">
              Hiển thị trang <b>{{ $post->currentPage() }}</b> / <b>{{ $post->lastPage() }}</b>
            </div>
            <div class="col-md-7"> 
              {{ 
                $post->appends([
                  'keyword' => $request->query('keyword'),
                  'status' => $request->query('status'),
                ])->links() 
              }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@stop