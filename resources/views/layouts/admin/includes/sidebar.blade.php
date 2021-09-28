<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('admin/doctors*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('doctors.index') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Doctors</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('appointment*') ? 'active' : '' }}">
        <a class="nav-link {{ Request::is('appointment*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse"
            data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-sitemap fa-folder"></i>
            <span>Appointments</span>
        </a>
        <div id="collapseTwo" class="collapse {{ Request::is('appointment*') ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('appointments/create') ? 'active' : '' }}"
                    href="{{ Route('appointments.create') }}">Create</a>
                <a class="collapse-item {{ Request::is('appointments') ? 'active' : '' }}"
                    href="{{ Route('appointments.index') }}">Check</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">



</ul>
