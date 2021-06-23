
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU NAVIGASI</li>
        <li class="{{ request()->is('home') ? 'active' : '' }}" >
          <a href="{{url('home')}}">
            <i class="fa fa-dashboard"></i> <span>Home</span>
          </a>
        </li>

        <!-- <li class="header">DATA MASTER</li> -->
        <!-- <li class="header">DATA TRANSAKSI</li> -->
        <li class="{{ request()->routeIs('laporan') ? 'active' : '' }}" >
          <a href="{{url('laporan')}}">
            <i class="fa fa-edit"></i>
            <span>Laporan</span>
          </a>
        </li>
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>