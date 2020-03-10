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
                  'system_admin.dashboard'
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
                                      'system_admin.partner.index',
                           'system_admin.partner.index',
                          'system_admin.partner.create',
                          'system_admin.partner.store',
                          'system_admin.partner.edit',
                          'system_admin.partner.update',
                          'system_admin.partner.destroy',
                          'system_admin.partner.destroyAll',
                                    );
                                @endphp
                                @if ( in_array($name, $arg_staff) )
                                    <li class="active">
                                @else
                                    <li>
                                        @endif
                                        <a href="{{route('system_admin.partner.index')}}">
                                            <i class="fa fa-database" aria-hidden="true"></i> <span>Đối tác</span>
                                        </a>
                                    </li>

                                    @php
                          $arg_staff =array('system_admin.changepass');
                       @endphp
                       @if(in_array($name, $arg_staff))
                          <li class="activer"></li>
                        @else
                          <li>
                                        @endif
                                        <a href="{{route('system_admin.changepass')}}">
                                            <i class="fa fa-database" aria-hidden="true"></i> <span>Đổi mật khẩu</span>
                                        </a>
                                    </li>
                   
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>