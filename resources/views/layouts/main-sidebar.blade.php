<aside class="main-sidebar sidebar-light-primary elevation-4">
    <a href="{{ url('/') }}" class="brand-link">
        <img class="logo-brand" src="{{ asset('viewly_assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link">
                        <img class="nav-icon" src="{{ asset('viewly_assets/dist/img/dashboard.png') }}"><img>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @if (Auth::user()->roles[0]->hasAnyPermission('user-list') || Auth::user()->roles[0]->hasAnyPermission('user-create'))
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <img class="nav-icon" src="{{ asset('viewly_assets/dist/img/user1.png') }}"><img>
                            <p>
                                Users
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('user-create')
                                <li class="nav-item">
                                    <a href="{{ route('users.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            @endcan
                            @can('user-list')
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->roles[0]->hasAnyPermission('role-list') || Auth::user()->roles[0]->hasAnyPermission('role-create'))
                    <li class="nav-item">
                        <a href="user-user-role.html" class="nav-link">
                            <img class="nav-icon" src="{{ asset('viewly_assets/dist/img/role-model.png') }}"><img>
                            <p>
                                Roles
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('role-create')
                                <li class="nav-item">
                                    <a href="{{ url('roles/create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            @endcan
                            @can('role-list')
                                <li class="nav-item">
                                    <a href="{{ url('roles') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="user-user-role.html" class="nav-link">
                        <img class="nav-icon" src="{{ asset('viewly_assets/dist/img/product.png') }}"><img>
                        <p>
                            Items
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('role-create')
                            <li class="nav-item">
                                <a href="{{ url('items/create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>
                        @endcan
                        @can('role-list')
                            <li class="nav-item">
                                <a href="{{ url('items') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>

                {{-- <li class="nav-item">
                    <a href="user-user-role.html" class="nav-link">
                        <img class="nav-icon" src="{{ asset('viewly_assets/dist/img/paper.png') }}"><img>
                        <p>
                            Types
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('role-create')
                            <li class="nav-item">
                                <a href="{{ url('types/create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>
                        @endcan
                        @can('role-list')
                            <li class="nav-item">
                                <a href="{{ url('types') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li> --}}

                <li class="nav-item">
                    <a href="user-user-role.html" class="nav-link">
                        <img class="nav-icon" src="{{ asset('viewly_assets/dist/img/documents.png') }}"><img>
                        <p>
                            Categories
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('role-create')
                            <li class="nav-item">
                                <a href="{{ url('categories/create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>
                        @endcan
                        @can('role-list')
                            <li class="nav-item">
                                <a href="{{ url('categories ') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="user-user-role.html" class="nav-link">
                        <img class="nav-icon" src="{{ asset('viewly_assets/dist/img/file-hosting.png') }}"><img>
                        <p>
                            Karat
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('role-create')
                            <li class="nav-item">
                                <a href="{{ url('karat/create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>
                        @endcan
                        @can('role-list')
                            <li class="nav-item">
                                <a href="{{ url('karat ') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="user-user-role.html" class="nav-link">
                        <img class="nav-icon" src="{{ asset('viewly_assets/dist/img/gold.png') }}"><img>
                        <p>
                            Gold Rates
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('role-create')
                            <li class="nav-item">
                                <a href="{{ url('sheet/test') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>
                        @endcan
                        @can('role-list')
                            <li class="nav-item">
                                <a href="{{ url('sheet ') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ url('view-profile') }}" class="nav-link">
                        <img class="nav-icon" src="{{ asset('viewly_assets/dist/img/control.png') }}"><img>
                        <p>
                            Settings
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
