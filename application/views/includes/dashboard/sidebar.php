<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?php echo base_url ( '/' ) ?>">
                <img alt="image" src="<?php echo base_url ( '/assets/img/logo.png' ) ?>" class="header-logo"/>
                <span class="logo-name"><?php echo APP_SLUG ?></span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown <?php echo ( $parent_uri == 'dashboard' ) ? 'active' : '' ?>">
                <a href="<?php echo base_url ( '/dashboard' ) ?>" class="nav-link">
                    <i data-feather="monitor"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="dropdown <?php echo ( $parent_uri == 'attendance' ) ? 'active' : '' ?>">
                <a href="javascript:void(0)" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="calendar"></i>
                    <span>Attendance</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="<?php echo ( $parent_uri == 'attendance' and $child_uri == 'index' ) ? 'active' : '' ?>">
                        <a class="nav-link" href="<?php echo base_url ( '/attendance/index' ) ?>">All Attendances</a>
                    </li>
                    
                    <li class="<?php echo ( $parent_uri == 'attendance' and $child_uri == 'mark' ) ? 'active' : '' ?>">
                        <a class="nav-link" href="<?php echo base_url ( '/attendance/mark' ) ?>">Mark Attendance</a>
                    </li>
                </ul>
            </li>
            
            <li class="dropdown <?php echo ( $parent_uri == 'companies' ) ? 'active' : '' ?>">
                <a href="javascript:void(0)" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="trello"></i>
                    <span>Companies</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="<?php echo ( $parent_uri == 'companies' and $child_uri == 'search' ) ? 'active' : '' ?>">
                        <a class="nav-link" href="<?php echo base_url ( '/companies/index' ) ?>">All Companies</a>
                    </li>
                    
                    <li class="<?php echo ( $parent_uri == 'companies' and $child_uri == 'search' ) ? 'active' : '' ?>">
                        <a class="nav-link" href="<?php echo base_url ( '/companies/add' ) ?>">Add Company</a>
                    </li>
                </ul>
            </li>
            
            <li class="dropdown <?php echo ( $parent_uri == 'employees' ) ? 'active' : '' ?>">
                <a href="javascript:void(0)" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="users"></i>
                    <span>Employees</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="<?php echo ( $parent_uri == 'employees' and $child_uri == 'search' ) ? 'active' : '' ?>">
                        <a class="nav-link" href="<?php echo base_url ( '/employees/index' ) ?>">All Employees</a>
                    </li>
                    
                    <li class="<?php echo ( $parent_uri == 'employees' and $child_uri == 'search' ) ? 'active' : '' ?>">
                        <a class="nav-link" href="<?php echo base_url ( '/employees/add' ) ?>">Add Employee</a>
                    </li>
                </ul>
            </li>
            
            <li class="dropdown <?php echo ( $parent_uri == 'shifts' ) ? 'active' : '' ?>">
                <a href="javascript:void(0)" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="clock"></i>
                    <span>Shifts</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="<?php echo ( $parent_uri == 'shifts' and $child_uri == 'index' ) ? 'active' : '' ?>">
                        <a class="nav-link" href="<?php echo base_url ( '/shifts/index' ) ?>">All Shifts</a>
                    </li>
                    
                    <li class="<?php echo ( $parent_uri == 'shifts' and $child_uri == 'add' ) ? 'active' : '' ?>">
                        <a class="nav-link" href="<?php echo base_url ( '/shifts/add' ) ?>">Add Shift</a>
                    </li>
                </ul>
            </li>
            
            <li class="dropdown <?php echo ( $parent_uri == 'leaves' ) ? 'active' : '' ?>">
                <a href="javascript:void(0)" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="send"></i>
                    <span>Leaves</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="<?php echo ( $parent_uri == 'leaves' and $child_uri == 'assigned' ) ? 'active' : '' ?>">
                        <a class="nav-link" href="<?php echo base_url ( '/leaves/assigned' ) ?>">All Assigned Leaves</a>
                    </li>
                    
                    <li class="<?php echo ( $parent_uri == 'leaves' and $child_uri == 'assign' ) ? 'active' : '' ?>">
                        <a class="nav-link" href="<?php echo base_url ( '/leaves/assign' ) ?>">Assign Leave</a>
                    </li>
                    <hr style="margin: 0">
                    
                    <li class="<?php echo ( $parent_uri == 'leaves' and $child_uri == 'index' ) ? 'active' : '' ?>">
                        <a class="nav-link" href="<?php echo base_url ( '/leaves/index' ) ?>">All Leaves</a>
                    </li>
                    
                    <li class="<?php echo ( $parent_uri == 'leaves' and $child_uri == 'add' ) ? 'active' : '' ?>">
                        <a class="nav-link" href="<?php echo base_url ( '/leaves/add' ) ?>">Add Leave</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
<!-- Main Content -->
<div class="main-content">
    <section class="section">