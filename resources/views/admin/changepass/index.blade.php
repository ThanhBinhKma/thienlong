@extends('admin.layouts.master')
@section('title','Đổi mật khẩu')
@section('content')
  @php
    $request = request();
  @endphp
  <section class="content dataTables_wrapper">
    {{ Breadcrumbs::render('changepass') }}
    <div class="clearfix"></div>
    @if (session('status_store'))
      <div class="note note-success"><p>{{ session('status_store') }}</p></div>
    @endif
    <div class="row">
      <div class="col-md-12">
        <form action="{{route('system_admin.handle_changepass')}}" method="POST">
          @csrf
          <div class="form-group">
            <label for="pn" class="control-label required"> Mật khẩu mới :</label>
            <input type="password" id="pn" name="password" class="form-control">
            @if ($errors->first('password'))
                    <div class="error">{{ $errors->first('password') }}</div>
                  @endif
          </div>

          <div class="form-group">
            <label for="po" class="control-label required"> Xác nhận mật khẩu mới :</label>
            <input type="password" id="po" name="passconf" class="form-control">
            @if ($errors->first('passconf'))
                    <div class="error">{{ $errors->first('passconf') }}</div>
                  @endif
          </div>

          <button type="submit" class="btn btn-primary">Thay Đổi</button>
        </form>
      </div>
    </div>
  </section>
@stop

@section('addjs')
<script type="text/javascript">
 @if(session('done'))
swal(
            'Thành công!',
            'Thay đổi mật khẩu thành công!',
            'success'
        )
        @endif
</script>
@endsection
