@extends('front_end.layout.master')
@section('title','Đối tác')
@section('content')
    <div class="top-event">
        <div class="container">
            <div class="_lstev">
                <div class="_tith1">
                    <h1>đối tác chiến lược</h1>
                </div>
                <div class="lstev">
                    <div class="_prtnrcl">
                        @if(count($partners) > 0)
                            @foreach($partners as $partner)
                            <div class="_itprtnr">
                                <a href="{{$partner->link}}"><img src="{{$partner->avatar}}" alt=""></a>
                            </div>
                            @endforeach
                        @endif
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