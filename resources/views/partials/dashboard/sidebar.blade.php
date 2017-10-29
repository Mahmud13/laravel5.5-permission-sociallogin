
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" class="img-circle" alt="User Image"/>
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{{ Request::is('dashboard')? 'active' : ''}}}">
          <a href="{{ url('/dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        @canany('user-list|user-create|user-edit|user-delete|role-list|role-create|role-edit|role-delete|permission-list|permission-create|permission-edit|permission-delete')
        <li class="treeview {{{ str_contains(Request::url(), ['user', 'role', 'permission']) ? 'active' : ''}}}">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>User Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
            <ul class="treeview-menu">
                @canany('permission-list|permission-create|permission-edit|permission-delete')
                <li class="{{{ Request::is('permissions')? 'active' : ''}}}">
                  <a href="{{ url('permissions') }}">
                    <i class="fa fa-shield"></i>
                    <span>Permissions</span>
                  </a>
                </li>
                @endcanany
                @canany('role-edit|role-create|role-delete')
                <li class="{{{ Request::is('roles/role-permission-table')? 'active' : ''}}}">
                  <a href="{{ url('roles/role-permission-table') }}">
                    <i class="fa fa-key"></i>
                    <span>Role Permission Table</span>
                  </a>
                </li>
                @endcanany
                @canany('user-list|user-create|user-edit|user-delete')
                <li class="{{{ Request::is('users/user-role-table')? 'active' : ''}}}">
                  <a href="{{ url('users/user-role-table') }}">
                    <i class="fa fa-table"></i>
                    <span>User Role Table</span>
                  </a>
                </li>
                @endcanany
            </ul>
        </li>
        @endcanany
    </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
