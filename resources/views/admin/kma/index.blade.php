
@extends('admin.layouts.master')
@section('title','Quản lý Danh Mục Bài Viết')
@section('content')
  @php
    $request = request(); 
  @endphp
  <section class="content dataTables_wrapper">
    <div class="row">
      <form action="{{route('system_admin.kma.testKma')}}" method="POST">
      	@csrf
         <div class="form-group">
         	<label class="label-group">Tên đăng nhập</label>
         	<input type="text" name="user_name" class="form-control">
         </div>
         <div class="form-group">
         	<label class="label-group">Mật khẩu</label>
         	<input type="text" name="password" class="form-control">
         </div>
     	<div class="form-group" style="text-align: center;">
     		<button class="btn btn-primary">Đăng kí</button>
     	</div>
     	</form>
    </div>
  </section>
@stop
