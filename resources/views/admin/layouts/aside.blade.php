<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        @php
            $name = Route::currentRouteName();
            $user = \Auth::guard('admin')->user();

        @endphp
        <div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{$user->name}}</p>
                <i class="fa fa-circle text-success"></i> Online
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            @php
                $arg_dashboard = array(
                  'system_admin.get_dashboard'
                );
            @endphp
            @if ( in_array($name, $arg_dashboard) )
                <li class="active">
            @else
                <li>
                    @endif
                    <a href="{{ route('system_admin.dashboard') }}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>

                @php
                    $arg_staff = array(
                      'system_admin.member.index',
                      'system_admin.member.create',
                      'system_admin.member.store',
                      'system_admin.member.edit',
                      'system_admin.member.update',
                      'system_admin.member.destroy',
                      'system_admin.member.destroyAll',
                    );
                @endphp
                @if ( in_array($name, $arg_staff) )
                    <li class="active">
                @else
                    <li>
                        @endif
                        <a href="{{route('system_admin.member.index')}}">
                            <i class="fa fa-database" aria-hidden="true"></i> <span>Thành viên</span>
                        </a>
                    </li>

                    @php
                        $arg_staff = array(
                          'system_admin.event.index',
                           'system_admin.event.index',
                          'system_admin.event.create',
                          'system_admin.event.store',
                          'system_admin.event.edit',
                          'system_admin.event.update',
                          'system_admin.event.destroy',
                          'system_admin.event.destroyAll',
                        );
                    @endphp
                    @if ( in_array($name, $arg_staff) )
                        <li class="active">
                    @else
                        <li>
                            @endif
                            <a href="{{route('system_admin.event.index')}}">
                                <i class="fa fa-database" aria-hidden="true"></i> <span>Sự kiện</span>
                            </a>
                        </li>

                        @php
                            $arg_staff = array(
                              'system_admin.media.index',
                           'system_admin.media.index',
                          'system_admin.media.create',
                          'system_admin.media.store',
                          'system_admin.media.edit',
                          'system_admin.media.update',
                          'system_admin.media.destroy',
                          'system_admin.media.destroyAll',
                            );
                        @endphp
                        @if ( in_array($name, $arg_staff) )
                            <li class="active">
                        @else
                            <li>
                                @endif
                                <a href="{{route('system_admin.media.index')}}">
                                    <i class="fa fa-database" aria-hidden="true"></i> <span>Truyền thông</span>
                                </a>
                            </li>

                            @php
                                $arg_staff = array(
                                  'system_admin.submedia.index',
                           'system_admin.submedia.index',
                          'system_admin.submedia.create',
                          'system_admin.submedia.store',
                          'system_admin.submedia.edit',
                          'system_admin.submedia.update',
                          'system_admin.submedia.destroy',
                          'system_admin.submedia.destroyAll',
                                );
                            @endphp
                            @if ( in_array($name, $arg_staff) )
                                <li class="active">
                            @else
                                <li>
                                    @endif
                                    <a href="{{route('system_admin.submedia.index')}}">
                                        <i class="fa fa-database" aria-hidden="true"></i> <span>Bài viết của truyền thông</span>
                                    </a>
                                </li>

                                @php
                                    $arg_staff = array(
                                      'system_admin.produce.index',
                           'system_admin.produce.index',
                          'system_admin.produce.create',
                          'system_admin.produce.store',
                          'system_admin.produce.edit',
                          'system_admin.produce.update',
                          'system_admin.produce.destroy',
                          'system_admin.produce.destroyAll',
                                    );
                                @endphp
                                @if ( in_array($name, $arg_staff) )
                                    <li class="active">
                                @else
                                    <li>
                                        @endif
                                        <a href="{{route('system_admin.produce.index')}}">
                                            <i class="fa fa-database" aria-hidden="true"></i> <span>Sản phẩm</span>
                                        </a>
                                    </li>

                                    {{--@php--}}
                                        {{--$arg_staff = array(--}}
                                          {{--'system_admin.list_post.index',--}}
                                        {{--);--}}
                                    {{--@endphp--}}
                                    {{--@if ( in_array($name, $arg_staff) )--}}
                                        {{--<li class="active">--}}
                                    {{--@else--}}
                                        {{--<li>--}}
                                            {{--@endif--}}
                                            {{--<a href="{{route('system_admin.list_post.index')}}">--}}
                                                {{--<i class="fa fa-database" aria-hidden="true"></i> <span>Liên hệ</span>--}}
                                            {{--</a>--}}
                                        {{--</li>--}}



                                        {{--@php--}}
                                            {{--$arg_faq = array(--}}
                                              {{--'system_admin.faqs.index',--}}
                                              {{--'system_admin.faqs.create' ,--}}
                                              {{--'system_admin.faqs.edit',--}}
                                              {{--'system_admin.faqs_categories.index',--}}
                                              {{--'system_admin.faqs_categories.create' ,--}}
                                              {{--'system_admin.faqs_categories.edit'--}}
                                            {{--);--}}
                                        {{--@endphp--}}
                                        {{--@if ( in_array($name, $arg_faq) )--}}
                                            {{--<li class="treeview active">--}}
                                        {{--@else--}}
                                            {{--<li class="treeview">--}}
                                                {{--@endif--}}
                                                {{--<a href="#">--}}
                                                    {{--<i class="fa fa-envelope" aria-hidden="true"></i>--}}
                                                    {{--<span>Mailbox</span>--}}
                                                    {{--<span class="pull-right-container">--}}
            {{--<i class="fa fa-angle-left pull-right"></i>--}}
          {{--</span>--}}
                                                {{--</a>--}}
                                                {{--<ul class="treeview-menu">--}}
                                                    {{--<li>--}}
                                                        {{--<a href="--}}{{-- {{route('system_admin.email.index')}} --}}{{--">--}}
                                                            {{--<i class="fa fa-inbox"></i> Inbox--}}
                                                        {{--</a>--}}
                                                    {{--</li>--}}
                                                {{--</ul>--}}
                                            {{--</li>--}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>