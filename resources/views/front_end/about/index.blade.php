@extends('front_end.layout.master')
@section('title','Về chúng tôi')
@section('content')
    <div class="_intrdce">
        <div class="container">
            <div class="intrdce-ct">
                <div class="_tith1">
                    <h1><a href="#">giới thiệu</a></h1>
                </div>
                <div class="_lstgt">
                    <div class="lstev">
                        <div class="introdce">
                            <p>Công ty Cổ phần Truyền thông Đa phương tiện Phi Long (Phi Long Multimedia., JSC) tiền
                                thân là một ekip sáng tạo nội dung và tổ chức sự kiện từng kết hợp với nhiều đơn vị uy
                                tín tại Việt Nam.
                            </p>
                            <p>Phi Long hoạt động với nhiều lĩnh vực gồm cung cấp dịch vụ: quảng cáo, marketing, posm,... cho
                                nhãn hàng và hoạt động trong các lĩnh vực: <span>Truyền thông - Quảng cáo - Tổ chức sự kiện - Sản xuất
                                    film</span> có quan hệ đối tác trực tiếp với các đơn vị Truyền hình, Phát thanh, Quảng cáo ngoài
                                trời, Báo in, Báo mạng, Mạng viễn thông,... và các đơn vị, cá nhân, tổ chức hàng đầu Việt Nam trong lĩnh
                                vực sản xuất, tổ chức các chương trình, sản phẩm truyền thông, giải trí.
                            </p>
                            <p>Phi Long Multimedia cung cấp giải pháp truyền thông hiệu quả, giúp doanh nghiệp tối ưu hóa danh sách truyền thông
                                của đơn vị. Đồng thời đơn vị có khả năng đào tạo, sản xuất trong lĩnh vực liên quan đến hoạt động nghệ thuật, giải trí.
                            </p>
                        </div>
                        <div class="hgtcl">
                            <div class="_gtcl">
                                <h3>hệ giá trị cốt lõi</h3>
                                <ul>
                                    <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>chủ động:</span><p>Luôn chủ động trong mọi vấn đề, tình huống.</p></li>
                                    <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>trách nhiệm:</span><p>Thể hiện tinh thần trách nhiệm mọi lúc, mọi nơi.</p></li>
                                    <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>sáng tạo:</span><p>Không ngại sáng tạo, bứt phá thành công.</p></li>
                                    <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>tôn trọng:</span><p>Tinh thần tôn trọng đối tác, khách hàng.</p></li>
                                    <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>đạo đức:</span><p>Đạo đức luôn là nền tảng của sự phát triển.</p></li>
                                </ul>
                                <p>Hệ giá trị cốt lõi được hình thành dựa trên sự đúc kết của toàn bộ tập thể ekip Phi Long Multimedia,. JSC qua nhiều năm thực hiện các chương trình
                                    với nhiều đối tác trong nước & quốc tế
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="_prsnnl">
        <div class="container">
            <div class="_ctprsnnl">
                <div class="_tith1">
                    <h1>đội ngũ nhân sự</h1>
                </div>
                <div data-wow-delay="0.5s" class="_vbss wow fadeInDown">
                    <div class="_vbssimg">
                        <img src="{{asset('images/avansbs.jpg')}}" alt="">
                    </div>
                    <div class="_vbssct">
                        <h3>nguyễn thanh tuấn</h3>
                        <p>Giám đốc điều hành - Người sáng lập</p>
                        <span>Với hơn 10 năm hoạt động trong lĩnh vực báo chí, truyền thông tại các cơ quan truyền
                            thông, báo chí hàng đầu Việt Nam như: VTV, TH Viettel, QPVN, Diamond Media... với các vai
                            trò: Đạo diễn, Tổ chức sản xuất, Biên tập viên, Người dẫn chương trình, hiện anh đang đảm nhận
                            vai trò giám đốc và là người sáng lập của PL MULTIMEDIA. Anh là người đưa ra các ý tưởng kịch bản,
                            sáng tạo concept, thiết kế chương trình và trực tiếp tham gia trong hoạt động sản xuất chính của các
                            dự án, sản phẩm, sự kiện.
                        </span>
                    </div>
                </div>
                <div class="aitprsnnl">
                    <div data-wow-delay="0.5s" class="_itpsnl wow fadeInLeft">
                        <div class="_imgprsnnl">
                            <img src="{{asset('images/avans-1.jpg')}}" alt="">
                        </div>
                        <div class="_ctiprsnnl">
                            <h3>Bùi Quang Thái</h3>
                            <p>Trưởng phòng Media - Cameraman</p>
                        </div>
                    </div>
                    <div data-wow-delay="0.5s" class="_itpsnl wow fadeInRight">
                        <div class="_imgprsnnl">
                            <img src="{{asset('images/avans-2.jpg')}}" alt="">
                        </div>
                        <div class="_ctiprsnnl">
                            <h3>Nguyễn Vũ Dũng</h3>
                            <p>Trưởng phòng PR - Nội dung</p>
                        </div>
                    </div>
                    <div data-wow-delay="0.5s" class="_itpsnl wow fadeInLeft">
                        <div class="_imgprsnnl">
                            <img src="{{asset('images/avans-3.jpg')}}" alt="">
                        </div>
                        <div class="_ctiprsnnl">
                            <h3>Trịnh Trung Nghĩa</h3>
                            <p>Trưởng phòng Thiết kế - Họa sỹ</p>
                        </div>
                    </div>
                    <div data-wow-delay="0.5s" class="_itpsnl wow fadeInRight">
                        <div class="_imgprsnnl">
                            <img src="{{asset('images/avans-4.jpg')}}" alt="">
                        </div>
                        <div class="_ctiprsnnl">
                            <h3>Nguyễn Ngọc Ánh</h3>
                            <p>Trưởng phòng Kỹ thuật - Sản xuất</p>
                        </div>
                    </div>
                    <div data-wow-delay="0.5s" class="_itpsnl wow fadeInLeft">
                        <div class="_imgprsnnl">
                            <img src="{{asset('images/avans-1.jpg')}}" alt="">
                        </div>
                        <div class="_ctiprsnnl">
                            <h3>Phạm Hoàng Hồng Lĩnh</h3>
                            <p>Chuyên viên</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection