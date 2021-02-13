@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

             

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/admin') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('quickadmin.qa_dashboard')</span>
                </a>
            </li>

            
{{--            @can('user_management_access')--}}
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('quickadmin.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
           {{--     @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('quickadmin.roles.title')
                            </span>
                        </a>
                    </li>
                @endcan--}}
{{--                @can('user_access')--}}
                <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('quickadmin.users.title')
                            </span>
                        </a>
                    </li>
{{--                @endcan--}}
                </ul>
            </li>
{{--            @endcan--}}

            @can('category_create')
                <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.categories.index') }}">
                            <i class="fa fa-suitcase"></i>
                            <span class="title">
                                @lang('quickadmin.categories.title')
                            </span>
                        </a>
                    </li>
                @endcan

            @can('product_access')
            <li class="{{ $request->segment(2) == 'produit' ? 'active' : '' }}">
                <a href="{{ route('admin.produits.index') }}">
                    <i class="fa fa-product-hunt"></i>
                    <span class="title">@lang('quickadmin.produits.title')</span>
                </a>
            </li>
            @endcan
            
            @can('image_access')
            <li class="{{ $request->segment(2) == 'images' ? 'active' : '' }}">
                <a href="{{ route('admin.images.index') }}">
                    <i class="fa fa-image"></i>
                    <span class="title">@lang('quickadmin.images.title')</span>
                </a>
            </li>
            @endcan


           {{-- <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('password.request') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('quickadmin.qa_change_password')</span>
                </a>
            </li>--}}

            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                  document.getElementById('logout-form1').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
                <form id="logout-form1" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </section>
</aside>

