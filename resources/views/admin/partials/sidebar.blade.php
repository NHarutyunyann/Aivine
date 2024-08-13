<aside class="main-sidebar-admin">
    <div class="sidebar-admin">
        <nav>
            <ul class="nav nav-pills nav-sidebar flex-column pt-4" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item menu">
                    <a href="{{ route('products.index') }}" class="nav-link"><i class="fas fa-dollar-sign"></i>
                        <span>Product</span></a>
                    <div class="subMenu">
                        <a href="{{ route('products.index')}}" class="nav-link"><span>All Products</span></a>
                        <a href="{{ route('products.create')}}" class="nav-link"><span>Add New</span></a>
                    </div>
                </li>

                <li class="nav-item menu">
                    <a href="{{ route('details.index') }}" class="nav-link"><i class="nav-icon fas fa-th"></i>
                        <span>Details</span></a>
                    <div class="subMenu">
                        <a href="{{ route('details.index')}}" class="nav-link"><span>All Details</span></a>
                        <a href="{{ route('details.create')}}" class="nav-link"><span>Add New</span></a>
                    </div>
                </li>
                
                <li class="nav-item menu">
                    <a href="{{ route('attachments.index') }}" class="nav-link">
                        <i class="fas fa-images"></i>
                        <span>Media</span>
                    </a>
                </li>

                <li class="nav-item menu">
                    <a href="{{ route('users.index') }}">
                        <i class="nav-icon fas fa-user"></i>
                        <span>Users</span>
                    </a>
                    <div class="subMenu">
                        <a href="{{ route('users.index') }}" class="nav-link">
                            <span>All Users</span>
                        </a>
                        <a href="{{ route('users.create') }}" class="nav-link">
                            <span>Add New</span>
                        </a>
                        <a href="{{ route('roles.index') }}" class="nav-link">
                            <span>Roles</span>
                        </a>
                    </div>
                </li>

                <li class="nav-item menu">
                    <a href="{{ route('settings.general') }}" class="nav-link"><i
                            class="nav-icon fas fa-sliders-h"></i><span>Settings</span></a>
                    <div class="subMenu">
                        <a href="{{ route('settings.general') }}" class="nav-link"><span>General</span></a>
                    </div>
                </li>

                <li class="nav-item menu">
                    <a href="{{ route('questions.index') }}" class="nav-link"><i class="far fa-comment"></i>
                        <span>Questions</span>
                    </a>
                    <div class="subMenu">
                        <a href="{{ route('questions.index') }}" class="nav-link"><span>All Questions</span></a>
                        <a href="{{ route('questions.create') }}" class="nav-link"><span>Add New</span></a>
                    </div>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
