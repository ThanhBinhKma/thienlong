<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="{{asset('front_end/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('front_end/css/animation.css')}}">
    <link rel="stylesheet" href="{{asset('front_end/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('front_end/css/lightslider.min.css')}}">
    <link rel="stylesheet" href="{{asset('front_end/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('front_end/css/responsive.css')}}">
    <script src="{{asset('front_end/js/jquery.min.js')}}"></script>
    <link rel="shortcut icon" type="image/png" href="{{asset('front_endimages/logo-top.jpg/')}}">
</head>
<body>
<div class="_logo-rp">
    <img src="{{asset('front_end/images/logo-top.jpg')}}" alt="">
</div>
@include('front_end.layout.header')
<div class="overlay-sticker"></div>



<div id="touch-on"><span></span></div>
@yield('content')

<div class="_hotline">
    <div class="_hotlnct">
        <div class="hlph-cir"></div>
        <div class="hlphcirfill"></div>
        <div class="callcirfill">
            <a href="#">
                <i class="fa fa-phone" aria-hidden="true"></i>
            </a>
        </div>
        <div class="_nbphone">
            <a href="tel:0123456789">0376468955</a>
        </div>
    </div>
</div>
<div class="_contct">
    <div class="container">

        <div class="_titlh">
            <div class="_titlect">
                <h2>Liên hệ với chúng tôi</h2>
            </div>
            <div class="_acntct">
                <div class="_wrcnttct">
                    <div class="_mapct">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1861.5972652284647!2d105.82880855794264!3d21.06489129946406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135aa57ce65ca61%3A0x1263b1c159dd021!2zVOG7qSBMacOqbiwgVMOieSBI4buTLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1582734978227!5m2!1svi!2s"
                                width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                    </div>
                    <div class="_frmct">
                        <form action="">
                            <div class="inp-ct">
                                <input type="text" name="FullName" placeholder="Họ và tên">
                            </div>
                            <div class="inp-ct">
                                <input type="text" name="Phone" placeholder="Điện thoại">
                            </div>
                            <div class="inp-ct">
                                <input type="text" name="Email" placeholder="Email">
                            </div>
                            <div class="inp-ct">
                                <input type="text" name="Address" placeholder="Địa chỉ">
                            </div>
                            <div class="txtfull-ct">
                                <textarea name="Content" placeholder="Nội dung"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="_clct">
                        <button>Gửi liên hệ</button>
                    </div>

                </div>
                <div class="_ntcntct">
                    <div class="_addct">
                        <h3>công ty cổ phần truyền thông đa phương tiện phi long</h3>
                        <ul>
                            <li><i class="fa fa-map-marker" aria-hidden="true"></i>Địa chỉ: Số 8C ngõ 184 đường âu Cơ,
                                Phường Tứ Liên, Quận Tây Hồ, Hà Nội
                            </li>
                            <li><i class="fa fa-phone" aria-hidden="true"></i>Điện thoại: 0123654789 - 0125421452</li>
                            <li><i class="fa fa-envelope-o" aria-hidden="true"></i>Email: vietanhvietanh112@gmail.com
                            </li>
                            <li><a href="#"><i class="fa fa-globe" aria-hidden="true"></i>https://philongmedia.com</a>
                            </li>
                        </ul>

                    </div>
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
@include('front_end.layout.footer')
<script src="{{asset('front_end/js/bootstrap.min.js')}}"></script>
<script src="{{asset('front_end/js/lightslider.min.js')}}"></script>
<script src="{{asset('front_end/js/popper.min.js')}}"></script>
<script src="{{asset('front_end/js/wow.min.js')}}"></script>
<script src="{{asset('front_end/js/main.js')}}"></script>
</body>
</html>