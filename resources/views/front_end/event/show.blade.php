@extends('front_end.layout.master')
@section('title','Dịch vụ')
@section('content')
    <div class="top-event">
        <div class="container">
            <div class="_lstev">
                <div class="_tith1">
                    <h1>Dịch vụ</h1>
                    <p>Phi Long hoạt động với nhiều lĩnh vực gồm cung cấp dịch vụ: quảng cáo, marketing, posm,... cho
                        nhãn hàng và hoạt động trong các lĩnh vực: <span>Truyền thông - Quảng cáo - Tổ chức sự kiện - Sản xuất
                            film</span> có quan hệ đối tác trực tiếp với các đơn vị Truyền hình, Phát thanh, Quảng cáo
                        ngoài
                        trời, Báo in, Báo mạng, Mạng viễn thông,... và các đơn vị, cá nhân, tổ chức hàng đầu Việt Nam
                        trong lĩnh
                        vực sản xuất, tổ chức các chương trình, sản phẩm truyền thông, giải trí.
                    </p>
                </div>
                <div class="lstev">
                    <div class="dsevt">
                        <div class="_listsk">
                            <ul>
                                @if(count($events) > 0 )
                                    @foreach($events as $event)
                                    <li>
                                        <div class="lstevimg">
                                            <img src="{{$event->avatar}}" alt="">
                                        </div>
                                        <div class="lstevct">
                                            <h3><a href="{{route('detail-event',['slug'=>$event->slug])}}">{{$event->title}}</a></h3>
                                            <p>{{$event->description}}</p>
                                        </div>
                                    </li>
                                    @endforeach
                                @endif

                            </ul>
                        </div>
                        <div class="clcknxt">
                            {{$events->links()}}
                        </div>
                    </div>
                    <div class="hgtcl">
                        <div class="_gtcl">
                            <h3>hệ giá trị cốt lõi</h3>
                            <ul>
                                <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>chủ động:</span>
                                    <p>Luôn chủ động trong mọi vấn đề, tình huống.</p></li>
                                <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>trách nhiệm:</span>
                                    <p>Thể hiện tinh thần trách nhiệm mọi lúc, mọi nơi.</p></li>
                                <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>sáng tạo:</span>
                                    <p>Không ngại sáng tạo, bứt phá thành công.</p></li>
                                <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>tôn trọng:</span>
                                    <p>Tinh thần tôn trọng đối tác, khách hàng.</p></li>
                                <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>đạo đức:</span>
                                    <p>Đạo đức luôn là nền tảng của sự phát triển.</p></li>
                            </ul>
                            <p>Hệ giá trị cốt lõi được hình thành dựa trên sự đúc kết của toàn bộ tập thể ekip Phi Long
                                Multimedia,. JSC qua nhiều năm thực hiện các chương trình
                                với nhiều đối tác trong nước & quốc tế
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection