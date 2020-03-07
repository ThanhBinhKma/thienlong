@extends('admin.layouts.master')
@section('title','Quản lí thành viên')
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
                        <form action="" method="GET">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="text" name="keyword" class="form-control" id="keyword"
                                               placeholder="Nhập từ khóa tìm kiếm : Tên tài khoản..."
                                               @if($request->has('keyword')) value="{{ $request->keyword}}" @endif>
                                    </div>
                                </div>


                                <div class="col-md-5">
                                    <div class="form-group">
                                        <select name="status" class="form-control" id="status">
                                            <option value="">-Chọn trạng thái-</option>
                                            <option value="1"
                                                    @if(isset($request->status) && $request->status == 1) selected @endif>
                                                Đã kích hoạt
                                            </option>
                                            <option value="0"
                                                    @if( isset($request->status) && $request->status == 0) selected @endif>
                                                Đã vô hiệu
                                            </option>
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
                                <a class="btn btn-sm btn-twitter" title="Export"><i class="fa fa-download"></i><span
                                            class="hidden-xs"> Export</span></a>
                                <button type="button" class="btn btn-sm btn-twitter dropdown-toggle"
                                        data-toggle="dropdown">
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
                                <a href="{{route('system_admin.submedia.create')}}" class="btn btn-sm btn-success"
                                   title="New">
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
                                    <input type="checkbox" class="checkbox-toggle"/>
                                </th>
                                <th>
                                    ID<a class="fa fa-fw fa-sort" href="#"></a>
                                </th>
                                <th style="width: 150px;">Tiêu Đề</th>
                                <th>Truyền thông</th>
                                <th>Đường dẫn</th>
                                <th>Ngày tạo</th>
                                <th>Trạng thái</th>
                                <th>Tác vụ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($submedias) >0)
                                @foreach($submedias as $submedia)
                                    <tr>
                                        <td><input type="checkbox" class="grid-row-checkbox"
                                                   data-id="{{ $submedia->id }}"/></td>
                                        <td>
                                            {{ $submedia->id }}
                                        </td>
                                        <td>
                                            <a class="text-left" href=""
                                               title="{{ $submedia->title }}">{{ $submedia->title }}</a>

                                        </td>
                                        <td style="width: 100px;">
                                           {{$submedia->media->title}}
                                        </td>
                                        <td>
                                            {{$submedia->link}}
                                        </td>

                                        <td> {{ \Carbon\Carbon::parse($submedia->created_at)->format('d/m/Y H:i:s')}}</td>
                                        <td> {!! \App\Helpers\Common::checkStatus($submedia->status) !!} </td>
                                        <td>
                                            <a href="{{route('system_admin.submedia.edit',['id'=>$submedia->id])}}"
                                               class="btn btn-icon btn-sm btn-warning tip">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            <a href="http://darianculbert.com/blog/32/le-hoi-nguoi-cham"
                                               class="btn btn-icon btn-sm btn-primary tip">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="javascript:void(0);" data-id="{{$submedia->id}}"
                                               class="btn btn-icon btn-sm btn-danger deleteDialog tip">
                                                <i class="fa fa-trash"></i>
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
                            Hiển thị trang <b>{{ $submedias->currentPage() }}</b> / <b>{{ $submedias->lastPage() }}</b>
                        </div>
                        <div class="col-md-7">
                            {{
                              $submedias->appends([
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

@section('addjs')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.deleteDialog').on('click', function () {
                var post_id = $(this).attr('data-id');
                destroy(post_id, '{{ route('system_admin.submedia.destroy') }}', '{{ route('system_admin.submedia.index') }}', "Bạn muốn xóa bài đăng này!");
            });
        });
        $('.grid-batch-0').on('click', function () {
            destroyAll('{{ route('system_admin.submedia.destroyAll') }}', '{{ route('system_admin.submedia.index') }}', "Bạn muốn xóa các bài đăng đã chọn?");
        });
        $('.grid-batch-1').on('click', function () {
            restore('{{ route('system_admin.submedia.restore') }}', '{{ route('system_admin.submedia.index') }}', "Bạn muốn phục hồi các bài đăng đã chọn?");
        });
        $('.grid-refresh').click(function () {
            location.reload(true);
        });


    </script>
@stop