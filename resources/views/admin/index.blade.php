@extends('admin.layouts.master')
@section('title','Laravel Dashboard')
@section('content')
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3></h3>
            <p>Tài khoản</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <h3></h3>
            <p>Danh sách bài viết</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>     
  </section>
@stop