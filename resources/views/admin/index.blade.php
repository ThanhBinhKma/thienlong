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
            <h3>{{count($members)}}</h3>
            <p>Thành viên</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="{{route('system_admin.member.index')}}" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{count($events)}}</h3>
            <p>Sự kiện</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="{{route('system_admin.event.index')}}" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{count($partners)}}</h3>
            <p>Đối tác</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="{{route('system_admin.partner.index')}}" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
  </section>
@stop