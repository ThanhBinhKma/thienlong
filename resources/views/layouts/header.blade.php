<div class="over_wrap"></div>
<div class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-6 col-sm-6 col-md-6">
                <ul class="hotline-email">
                    <li>
                        <a href="tel:(＋84)904087192">
                            <i class="fa fa-phone" aria-hidden="true"></i> (＋84) 904 087 192
                        </a>
                    </li>
                    <li>
                        <a href="mailto:humanshare@gmail.com">
                            <i class="fa fa-envelope" aria-hidden="true"></i> humanshare@gmail.com</a>
                    </li>
                </ul>
            </div>

            {{-- <div class="col-6 col-sm-6 col-md-6">
                <select name="" class="change_langues" id="">
                    <option value="">vi</option>
                    <option value="">jp</option>
                </select>
            </div> --}}
        </div>
    </div>
</div>
<div class="header-fluid">
    <div class="container header-main">
        <button type="button" class="button_menu">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="desktop-menu">
            <div class="row">
                @if(session('userAuthenticated'))
                    <div class="col-2 col-md-2 col-sm-2 col-logo">
                        <a href="{{route('home')}}"><img src="{{asset('images/logo.png')}}" width="100%" height="100%"
                                                         alt="">
                        </a>
                    </div>
                @else
                    <div class="col-2 col-md-2 col-sm-2 col-logo login-logo">
                        <a href="{{route('home')}}"><img src="{{asset('images/logo.png')}}" width="100%" height="100%"
                                                         alt="">
                        </a>
                    </div>
                @endif
                <div class="col-6 col-md-5 col-sm-5 menu menu-site">
                    <ul id="navigation">
                        @if(session('current_company') || session('current_freelancer'))
                            <li class="nav-option">
                                <a href="javascript:void(0)">
                                    <img
                                        src="{{ \App\Helpers\Helpers::getAvatarUser(Auth::user()) }}"
                                        class="avatar" width="40px" height="40px">
                                    <span class="username">{{Auth::user()->name}}</span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                    @if(session('current_company'))
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="fa fa-cogs" aria-hidden="true"></i> {{ trans('frontend/base.records_management') }}
                                            </a>
                                            <ul class="sub-menu">
                                              <li>
                                                <a class="dropdown-item" href="{{route('system_user.company.profile.index')}}">
                                                  Thông tin công ty
                                                </a>
                                              </li>
                                              <li>
                                                <a class="dropdown-item" href="{{route('system_user.company.listBooking')}}">
                                                  {{trans('messages.list_booking')}}
                                                </a>
                                              </li>
                                              <li>
                                                <a class="dropdown-item" href="{{route('system_user.company.listPost')}}">
                                                  {{trans('messages.list_post')}}
                                                </a>
                                              </li>
                                            </ul>
                                        </li>
                                    @else
                                        <li>
                                            <a 
                                               href="javascript:void(0)">
                                                <i class="fa fa-cogs" aria-hidden="true"></i> {{ trans('frontend/base.records_management') }}

                                            </a>
                                            <ul class="sub-menu">
                                              <li>
                                                <a class="dropdown-item" href="{{route('infoperson')}}">Thông tin cá nhân
                                                </a>
                                              </li>
                                              <li>
                                                <a class="dropdown-item" href="{{route('infoperson.Cv')}}">
                                                  Thông tin CV
                                                </a>
                                              </li>
                                              <li>
                                                <a  class="dropdown-item" href="{{route('infoperson.social')}}">
                                                  Liên kết tài khoản
                                                </a>
                                              </li>
                                              <li>
                                                <a class="dropdown-item" href="{{route('infoperson.upgrade')}}">
                                                  Đăng ký cho doanh nghiệp
                                                </a>
                                              </li>
                                            </ul>
                                        </li>
                                    @endif
                                    @if(session('current_company'))
                                        <li>

                                            <a class="dropdown-item"
                                               href="{{route('system_user.company.passwordSecurity')}}">
                                                <i class="fa fa-key" aria-hidden="true"></i> {{trans('messages.password_security')}}

                                            </a>
                                        </li>
                                    @else
                                        <li>
                                            <a class="dropdown-item" href="{{route('infoperson.changepass')}}">
                                                <i class="fa fa-key" aria-hidden="true"></i> {{ trans('frontend/base.change_password') }}
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a class="dropdown-item" href="{{route('userLogout')}}">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i> {{ trans('frontend/base.log_out') }}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-option">
                                <a href="{{ route('userRegister') }}"
                                   title="{{ trans('frontend/base.sign_up') }}">
                                    <i class="fa fa-key"
                                       aria-hidden="true"></i> {{ trans('frontend/base.sign_up') }}
                                </a>
                            </li>
                            <li class="nav-option">
                                <a href="{{ route('userLogin') }}"
                                   title="{{ trans('frontend/base.sign_in') }}">
                                    <i class="fa fa-sign-in"
                                       aria-hidden="true"></i> {{ trans('frontend/base.sign_in') }}
                                </a>
                            </li>
                        @endif

                        <li><a href="{{route('search_post')}}">
                                <i class="fa fa-search" aria-hidden="true"></i> {{ trans('frontend/base.search') }}
                            </a>
                        </li>

                        <li><a href="javascript:void(0)">{{ trans('frontend/base.category') }}</a>
                            <ul class="sub-menu">
                                @foreach(\App\Helpers\Helpers::getCategories() as $category)
                                    <li>
                                        <a href="{{ route('searchPage',['id'=>$category->id]) }}">{{ $category->name }}</a>
                                        @if(isset($category->categories) && count($category->categories))
                                            <ul class="sub-menu child-menu">
                                                @foreach($category->categories as $item)
                                                    <li>
                                                        <a href="{{ route('searchPage',['id'=>$category->id, 'category' => $item->id]) }}">{{ $item->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        @if(session('current_company') || session('current_freelancer'))
                            <li><a href="{{route('uploadCv')}}">{{ trans('frontend/base.upload_CV') }}</a></li>
                        @endif
                        @if(session('current_company') || session('current_freelancer'))
                            <li class="nav-option">
                                <a href="{{ route('faq')}}" title="Câu hỏi thường gặp">
                                   {{ trans('frontend/base.faq') }}
                                </a>
                            </li>
                        @endif

                        <li class="nav-option">
                            @if(session('current_company'))
                                <a class="mb-notification" href="{{route('system_user.company.notification')}}" title="Thông báo">
                                    <img src="images/icon/ic_thongbao@2x.png" class="icon-header" alt="Icon">
                                    {{ trans('frontend/base.notification') }}
                                    @if(\App\Helpers\Helpers::getNumberNotification(Auth::user()) > 0)
                                        <span>{{ \App\Helpers\Helpers::getNumberNotification(Auth::user()) }}
                                              </span>
                                    @else
                                        <span></span>
                                    @endif
                                </a>
                            @endif
                            @if(session('current_freelancer'))
                                <a class="mb-notification" title="Thông báo"
                                   href="{{route('infoperson.notification')}}">
                                    <img src="images/icon/ic_thongbao@2x.png" alt="Icon" class="icon-header">
                                    {{ trans('frontend/base.notification') }}
                                    @if(\App\Helpers\Helpers::getNumberNotification(Auth::user()) > 0)
                                        <span>{{ \App\Helpers\Helpers::getNumberNotification(Auth::user()) }}
                                              </span>
                                    @else
                                        <span></span>
                                    @endif
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="col-4 col-md-5 col-sm-5">
                    <div class="row justify-content-between">
                        <div class="col-md-12 header-ul" style="line-height: initial">
                            <ul class="mob-res-385">
                                @if(session('current_company') || session('current_freelancer'))
                                    <li class="mb-hidden">
                                        <a class="dropdown-item notification" href="{{ route('faq')}}"
                                           title="Câu hỏi thường gặp">
                                            <img src="images/icon/ic_hoi@2x.png" class="icon-header" alt="">
                                        </a>
                                    </li>

                                    <li class="mb-hidden">
                                        @if(session('current_company'))
                                            <a class="dropdown-item notification user-notification"
                                               href="{{route('system_user.company.notification')}}" title="Thông báo">
                                                <img src="images/icon/ic_thongbao@2x.png" class="icon-header" alt="">
                                                @if(\App\Helpers\Helpers::getNumberNotification(Auth::user()) > 0)
                                                    <span>{{ \App\Helpers\Helpers::getNumberNotification(Auth::user()) }}
                                              </span>
                                                @else
                                                    <span></span>
                                                @endif
                                            </a>
                                        @else
                                            <a class="dropdown-item notification user-notification" title="Thông báo"
                                               href="{{route('infoperson.notification')}}">
                                                <img src="images/icon/ic_thongbao@2x.png" alt="" class="icon-header">
                                                @if(\App\Helpers\Helpers::getNumberNotification(Auth::user()) > 0)
                                                    <span>{{ \App\Helpers\Helpers::getNumberNotification(Auth::user()) }}
                                              </span>
                                                @else
                                                    <span></span>
                                                @endif
                                            </a>
                                        @endif
                                    </li>

                                    <li class="main">
                                        <div class="box-option">
                                            <a href="javascript:void(0)">
                                                <img
                                                    src="{{ \App\Helpers\Helpers::getAvatarUser(Auth::user()) }}"
                                                    class="avatar" width="40px" height="40px">
                                                <span class="username">{{Auth::user()->name}}</span>
                                            </a>
                                            <div class="dropdown-menu user-box-option">
                                                @if(session('current_company'))
                                                    <a class="dropdown-item"
                                                       href="{{route('system_user.company.profile.index')}}">
                                                        <i class="fa fa-cogs" aria-hidden="true"></i> {{ trans('frontend/base.records_management') }}
                                                    </a>
                                                @else
                                                    <a class="dropdown-item"
                                                       href="{{route('infoperson',['id'=>Auth::user()->id])}}">
                                                        <i class="fa fa-cogs" aria-hidden="true"></i> {{ trans('frontend/base.records_management') }}
                                                    </a>
                                                @endif
                                                @if(session('current_company'))
                                                    <a class="dropdown-item"
                                                       href="{{route('system_user.company.passwordSecurity')}}">
                                                        <i class="fa fa-key" aria-hidden="true"></i> {{ trans('frontend/base.change_password') }}
                                                    </a>
                                                @else
                                                    <a class="dropdown-item" href="{{route('infoperson.changepass')}}">
                                                        <i class="fa fa-key" aria-hidden="true"></i> {{ trans('frontend/base.change_password') }}
                                                    </a>
                                                @endif
                                                <a class="dropdown-item" href="{{route('userLogout')}}">
                                                    <i class="fa fa-sign-out" aria-hidden="true"></i> {{ trans('frontend/base.log_out') }}
                                                </a>
                                            </div>
                                        </div>
                                    </li>

                                @else
                                    <li class="mb-hidden" style="line-height: 65px">
                                        <a href="{{ route('userRegister') }}"
                                           title="{{ trans('frontend/base.sign_up') }}">
                                            <i class="fa fa-key"
                                               aria-hidden="true"></i> {{ trans('frontend/base.sign_up') }}
                                        </a>
                                    </li>
                                    <li class="mb-hidden" style="line-height: 65px">
                                        <a href="{{ route('userLogin') }}"
                                           title="{{ trans('frontend/base.sign_in') }}">
                                            <i class="fa fa-sign-in"
                                               aria-hidden="true"></i> {{ trans('frontend/base.sign_in') }}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
