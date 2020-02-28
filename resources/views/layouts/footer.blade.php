<div class="footer-main">
    <div class="container" style="width: initial">
        <div class="logo-footer">
            <a href="" title="HumanShare">
                <img src="{{asset('images/logo_f.png')}}" width="160px" alt="Logo">
            </a>
        </div>
        <div class="row justify-content-md-center">

            <div class="col-md-4 col-sm-12  policy">
                <ul>
                    <li>
                        <p class="w-100 mb-1">{{ trans('frontend/base.Company_limited_services') }} Beetech</p></li>
                    <li>
                        <p class="w-100 mb-1">{{ trans('frontend/base.address_company') }} </p></li>
                    <li>
                        <p class="w-100 mb-1">{{ trans('frontend/base.tel') }}: 0904 087 192</p></li>
                    <li><p class="w-100 mb-1">MST/ĐKKD/QĐTL:0107658088</p></li>
                </ul>
            </div>

            <div class="col-md-4 col-sm-12 policy">
                <h4>{{ trans('frontend/base.Human_infomation') }}</h4>
                <ul class="ul-li-none" style="display: block !important;">
                    <li style="display: block !important;"><p class="w-100 mb-1"><a href="{{ route('about')}}"> > {{ trans('frontend/base.about_us') }}</a></p></li>
                    <li style="display: block !important;"><p class="w-100 mb-1"><a href="{{ route('policy')}}"> > {{ trans('frontend/base.policy') }}</a></p></li>
                    <li style="display: block !important;"><p class="w-100 mb-1"><a href="{{route('contact')}}"> > {{ trans('frontend/base.feedback_review') }} </a></p></li>
                    <li style="display: block !important;"><p class="w-100 mb-1"><a href="{{route('terms')}}"> > {{ trans('frontend/base.term_of_use') }} </a></p></li>

                </ul>
            </div>

            <div class="col-md-4 col-sm-12 policy">
                <h4>{{ trans('frontend/base.HumanShare_guide') }}</h4>
                <ul class="ul-li-none" style="display: block !important;">
                    <li style="display: block !important;"><p class="w-100 mb-1"><a href="{{ route('faq')}}"> > {{ trans('frontend/base.faq') }} </a></p></li>
                    <li style="display: block !important;"><p class="w-100 mb-1"><a href="{{route('guidePayment')}}"> > {{ trans('frontend/base.payment_guide') }}</a></p></li>
                </ul>

                <div class="bct">
                    <a href="javascript:void(0)" title="Đăng kí Bộ Công Thương">
                        <img src="{{ asset('images/bct.png') }}" alt="" style="height: 70px !important;">
                    </a>
                </div>

            </div>
        </div>

        <div class="row follows mt-2">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="follow-footer">
                    <p>
                        {{ trans('frontend/base.follow_us') }}</p>
                    <ul>
                        <li>
                            <a href="" title="Google+">
                                <img src="{{ asset('images/icon/gg.png') }}" alt="Google+" class="icon-footer">
                            </a>
                        </li>

                        <li>
                            <a href="" title="Facebook">
                                <img src="{{ asset('images/icon/fa.png') }}" alt="Facebook" class="icon-footer">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="app-footer">
                    <p>{{ trans('frontend/base.mobile_app') }} </p>
                    <ul>
                        <li>
                            <a href=""><img src="{{ asset('images/icon/apple.png') }}" alt="" class="icon-footer"></a>
                        </li>
                        <li>
                            <a href=""><img src="{{ asset('images/icon/adroi.png') }}" alt="" class="icon-footer"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-12">

        </div>
    </div>
</div>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function () {
        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/5d775247eb1a6b0be60bda3f/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
<!--End of Tawk.to Script-->
