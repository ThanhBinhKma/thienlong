@extends('front_end.layout.master')
@section('title','Phi Long Media')
@section('content')
    <div class="top-event">
        <div class="container">
            <div class="_evtop">
                <div class="tit-h2">
                    <h2><a href="#">Sự kiện tiêu biểu</a></h2>
                </div>
                <div class="aitev-ct">
                    <div class="lst-itev">
                        <div class="ait-ev">
                            @if(count($events) > 0)
                                @foreach($events as $key => $event)
                                    <div class="it-ev">
                                        <div class="itev-img">
                                            <a href="{{route('detail-event',['slug'=>$event->slug])}}"><img src="{{$event->avatar}}" alt=""></a>
                                        </div>
                                        <div class="itev-txt">
                                            <h3>{{$event->title}}</h3>
                                            <p>{{$event->description}}</p>
                                            <a href="{{route('detail-event',['slug'=>$event->slug])}}">Xem thêm<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="bt-alev">
                            <a href="{{route('list-event')}}">Xem thêm</a>
                        </div>
                    </div>
                    <div class="_gtcl">
                        <h3>hệ giá trị cốt lõi</h3>
                        <ul>
                            <li><span>chủ động:</span>
                                <p>Luôn chủ động trong mọi vấn đề, tình huống.</p></li>
                            <li><span>trách nhiệm:</span>
                                <p>Thể hiện tinh thần trách nhiệm mọi lúc, mọi nơi.</p></li>
                            <li><span>sáng tạo:</span>
                                <p>Không ngại sáng tạo, bứt phá thành công.</p></li>
                            <li><span>tôn trọng:</span>
                                <p>Tinh thần tôn trọng đối tác, khách hàng.</p></li>
                            <li><span>đạo đức:</span>
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
    <div class="_prsnnl">
        <div class="container">
            <div class="_ctprsnnl">
                <div class="_titprsnnl">
                    <h2>Đội ngũ nhân sự</h2>
                </div>
                @foreach($members as $member)
                    @if($member->position_id == 1)
                        <div data-wow-delay="0.5s" class="_vbss wow fadeInDown">
                            <div class="_vbssimg">
                                <img src="{{ $member->avatar }}" alt="">
                            </div>
                            <div class="_vbssct">
                                <h3>{{ $member->name }}</h3>
                                <p>{{ $member->position }}</p>
                                <span>Với hơn 10 năm hoạt động trong lĩnh vực báo chí, truyền thông tại các cơ quan truyền
                            thông, báo chí hàng đầu Việt Nam như: VTV, TH Viettel, QPVN, Diamond Media... với các vai
                            trò: Đạo diễn, Tổ chức sản xuất, Biên tập viên, Người dẫn chương trình, hiện anh đang đảm nhận
                            vai trò giám đốc và là người sáng lập của PL MULTIMEDIA. Anh là người đưa ra các ý tưởng kịch bản,
                            sáng tạo concept, thiết kế chương trình và trực tiếp tham gia trong hoạt động sản xuất chính của các
                            dự án, sản phẩm, sự kiện.
                        </span>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="aitprsnnl">
                    @foreach($members as $key =>  $member)
                        @if($member->position_id == 2)
                            @if($key%2 == 1)
                                <div data-wow-delay="0.5s" class="_itpsnl wow fadeInLeft">
                                    <div class="_imgprsnnl">
                                        <img src="{{ $member->avatar }}" alt="">
                                    </div>
                                    <div class="_ctiprsnnl">
                                        <h3>{{ $member->name }}</h3>
                                        <p>{{ $member->position }}</p>
                                    </div>
                                </div>
                            @else
                                <div data-wow-delay="0.5s" class="_itpsnl wow fadeInRight">
                                    <div class="_imgprsnnl">
                                        <img src="{{ $member->avatar }}" alt="">
                                    </div>
                                    <div class="_ctiprsnnl">
                                        <h3>{{ $member->name }}</h3>
                                        <p>{{ $member->position }}</p>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="_prtner">
        <div class="container">
            <div class="ct-prtner">
                <div class="tit-h2">
                    <h2>Đối tác chiến lược</h2>
                </div>

                <div class="_aprtnr">
                    @if(count($partners) > 0)
                        @foreach($partners as $partner)
                            <div class="_itprtnr">
                                <a href="{{$partner->link}}"><img src="{{$partner->avatar}}" alt=""></a>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="_xtprtnr">
                    <a href="{{route('partner')}}">Xem thêm</a>
                </div>
            </div>
        </div>
    </div>
@endsection