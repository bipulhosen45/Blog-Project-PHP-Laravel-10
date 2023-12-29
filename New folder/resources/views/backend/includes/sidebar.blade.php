<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="" class="brand-link">
    <img src="{{asset('backend')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">{{Auth::user()->email}}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('backend')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{Auth::user()->name}}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

               <!-- Dashboard menu -->  
        <li class="nav-item menu-open">
          <a href="{{route('admin.dashboard')}}" class="nav-link {{Request::is('admin/dashboard*') ? 'active' : ''}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
        </li>

          <!-- category menu -->  
          @if (Auth::user()->role == \App\Models\User::ADMIN)
              
          <li class="nav-item">
            <a href="#" class="nav-link {{Request::is('admin/category*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-bars"></i>
              <p>
                 Manage Category
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('category.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('category.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Category</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Sub category menu -->  
          <li class="nav-item">
            <a href="#" class="nav-link {{Request::is('admin/sub-category*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-bars"></i>
              <p>
                 Manage Sub Category
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('sub-category.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Sub Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('sub-category.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Sub Category</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Tag menu -->  
          <li class="nav-item">
            <a href="#" class="nav-link {{Request::is('admin/tag*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-bars"></i>
              <p>
                 Manage Tag
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('tag.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Tag</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('tag.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Tag</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          <!-- Post section menu -->  
          <li class="nav-item">
            <a href="#" class="nav-link {{Request::is('admin/post*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-image"></i>
              <p>
                 Manage Post
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('post.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Post</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('post.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Post</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Profile Section --> 
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Profile
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('profile.index')}}" class="nav-link">
                <i class="fas fa-user nav-icon"></i>
              <p>Profile</p>
            </a>
            </li>
            <li class="nav-item">
              <a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav-link">
                <i class="fas fa-sign-out-alt nav-icon"></i>
              <p>Logout</p>
            </a>
            <form action="{{route('logout')}}" id="logout-form" method="POST" style="display: none">
            @csrf
            </form>
            </li>
          </ul>
        </li>
        <span class="mb-5"></span>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>