<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left">
            <!-- <img src="{{ asset('assets/img/logo.jpg') }}" class="img img-thumbnails"  alt="User Image" style="width: 100%;height: 150px;"> -->
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="{{Request::is('admin/dashboard')?'active':''}} treeview"><a
                        href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>
           
            <li class="{{Request::is('admin/navigation-list/Main')?'active':''}} treeview"><a
                        href="{{url('/admin/navigation-list/Main')}}"><i class="fa fa-list"></i>
                    <span>Main Navigation</span></a></li>
            <li class="{{Request::is('admin/navigation-list/Home')?'active':''}} treeview"><a
                        href="{{url('/admin/navigation-list/Home')}}"><i class="fa fa-list"></i>
                    <span>Home Navigation</span></a></li>
                    {{-- <li class="{{Request::is('admin/navigation-list/SNS')?'active':''}}  treeview"><a href="{{url('/admin/navigation-list/SNS')}}"><i class="fa fa-list"></i> <span>SNS Navigation</span></a> </li> --}}
                    {{-- <li class="{{Request::is('admin/subscribers-list')?'active':''}} treeview"><a
                        href="{{url('/admin/subscribers-list')}}"><i class="fa fa-list"></i>
                    <span>Subscribers List</span></a></li> --}}
          
            <!--------customized by MD------------>
             {{-- <li class="{{Request::is('admin/job-list')?'active':''}}  treeview"><a
                        href="{{url('/admin/job-list')}}"><i class="fa fa-cog"></i> <span>JOBS</span></a>
            </li> --}}
            <!----------end------------>
               <!--------customized by MD------------>
             
              <li class="{{Request::is('admin/global-setting')?'active':''}}  treeview"><a
                        href="{{url('/admin/global-setting')}}"><i class="fa fa-cog"></i> <span>Global Setup</span></a>
            </li>
            <li class="{{Request::is('admin/applied-job-list')?'active':''}}  treeview"><a
                        href="{{url('/admin/applied-job-list')}}"><i class="fa fa-cog"></i> <span>Message</span></a>
            </li>
            <!----------end------------>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

  