<?php
$url = $_SERVER['REQUEST_URI'];
$url = str_replace(['/','.php'], '', $url);
?>


<div class="main-header">
    <div class="logo">
        <img src="./assets/images/er_profile.png" alt="">
    </div>

    <div class="menu-toggle">
        <div></div>
        <div></div>
        <div></div>
    </div>

    <div style="margin: auto"></div>

    <div class="header-part-right">
        <!-- Full screen toggle -->
        <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>
        <!-- Grid menu Dropdown -->
        <div class="dropdown">
            <i class="i-Safe-Box text-muted header-icon" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <div class="menu-icon-grid">
                    <a href="#"><i class="i-Shop-4"></i> Home</a>
                    <a href="#"><i class="i-Library"></i> UI Kits</a>
                    <a href="#"><i class="i-Drop"></i> Apps</a>
                    <a href="#"><i class="i-File-Clipboard-File--Text"></i> Forms</a>
                    <a href="#"><i class="i-Checked-User"></i> Sessions</a>
                    <a href="#"><i class="i-Ambulance"></i> Support</a>
                </div>
            </div>
        </div>
        <!-- Notificaiton -->
        <div class="dropdown">
            <div class="badge-top-container" role="button" id="dropdownNotification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="badge badge-primary">3</span>
                <i class="i-Bell text-muted header-icon"></i>
            </div>
            <!-- Notification dropdown -->
            <div class="dropdown-menu dropdown-menu-right rtl-ps-none notification-dropdown" aria-labelledby="dropdownNotification" data-perfect-scrollbar data-suppress-scroll-x="true">
                <div class="dropdown-item d-flex">
                    <div class="notification-icon">
                        <i class="i-Speach-Bubble-6 text-primary mr-1"></i>
                    </div>
                    <div class="notification-details flex-grow-1">
                        <p class="m-0 d-flex align-items-center">
                            <span>New message</span>
                            <span class="badge badge-pill badge-primary ml-1 mr-1">new</span>
                            <span class="flex-grow-1"></span>
                            <span class="text-small text-muted ml-auto">10 sec ago</span>
                        </p>
                        <p class="text-small text-muted m-0">James: Hey! are you busy?</p>
                    </div>
                </div>
                <div class="dropdown-item d-flex">
                    <div class="notification-icon">
                        <i class="i-Receipt-3 text-success mr-1"></i>
                    </div>
                    <div class="notification-details flex-grow-1">
                        <p class="m-0 d-flex align-items-center">
                            <span>New order received</span>
                            <span class="badge badge-pill badge-success ml-1 mr-1">new</span>
                            <span class="flex-grow-1"></span>
                            <span class="text-small text-muted ml-auto">2 hours ago</span>
                        </p>
                        <p class="text-small text-muted m-0">1 Headphone, 3 iPhone x</p>
                    </div>
                </div>
                <div class="dropdown-item d-flex">
                    <div class="notification-icon">
                        <i class="i-Empty-Box text-danger mr-1"></i>
                    </div>
                    <div class="notification-details flex-grow-1">
                        <p class="m-0 d-flex align-items-center">
                            <span>Product out of stock</span>
                            <span class="badge badge-pill badge-danger ml-1 mr-1">3</span>
                            <span class="flex-grow-1"></span>
                            <span class="text-small text-muted ml-auto">10 hours ago</span>
                        </p>
                        <p class="text-small text-muted m-0">Headphone E67, R98, XL90, Q77</p>
                    </div>
                </div>
                <div class="dropdown-item d-flex">
                    <div class="notification-icon">
                        <i class="i-Data-Power text-success mr-1"></i>
                    </div>
                    <div class="notification-details flex-grow-1">
                        <p class="m-0 d-flex align-items-center">
                            <span>Server Up!</span>
                            <span class="badge badge-pill badge-success ml-1 mr-1">3</span>
                            <span class="flex-grow-1"></span>
                            <span class="text-small text-muted ml-auto">14 hours ago</span>
                        </p>
                        <p class="text-small text-muted m-0">Server rebooted successfully</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Notificaiton End -->

        <!-- User avatar dropdown -->
        <div class="dropdown">
            <div class="user colalign-self-end">
                <img src="./assets/images/faces/1.jpg" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <div class="dropdown-header">
                        <i class="i-Lock-User mr-1"></i> Ricardo A.
                    </div>
                    <a class="dropdown-item">Account settings</a>
                    <a class="dropdown-item">Billing history</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();">Log out</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            <?php  if (str_contains($url, 'index') || empty($url) || str_contains($url, 'administrativo')) { ?>
        <li class="nav-item active">
        <?php } else { ?>
            <li class="nav-item">
                <?php } ?>
                <a class="nav-item-hold" href="sistema-administrativo">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">DASHBOARD</span>
                </a>
                <div class="triangle"></div>
            </li>
            <?php  if (str_contains($url, 'gestao')) { ?>
        <li class="nav-item active">
        <?php } else { ?>
            <li class="nav-item">
                <?php } ?>
                <a class="nav-item-hold" href="gestao">
                    <i class="nav-icon i-Conference"></i>
                    <span class="nav-text">GESTÃO OS</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" >
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Over-Time-2"></i>
                    <span class="nav-text">PREVENTIVA</span>
                </a>
                <div class="triangle"></div>
            </li>
            <?php  if (str_contains($url, 'relatorios')) { ?>
        <li class="nav-item active">
        <?php } else { ?>
            <li class="nav-item">
                <?php } ?>
                <a class="nav-item-hold" href="relatorios">
                    <i class="nav-icon i-Folder-With-Document"></i>
                    <span class="nav-text">RELATÓRIOS</span>
                </a>
                <div class="triangle"></div>
            </li>
            <?php  if (str_contains($url, 'ativos')) { ?>
        <li class="nav-item active">
        <?php } else { ?>
            <li class="nav-item">
                <?php } ?>
                <a class="nav-item-hold" href="ativos">
                    <i class="nav-icon i-Financial"></i>
                    <span class="nav-text">ATIVOS</span>
                </a>
                <div class="triangle"></div>
            </li>
            <?php  if (str_contains($url, 'equipe')) { ?>
        <li class="nav-item active">
        <?php } else { ?>
            <li class="nav-item">
                <?php } ?>
                <a class="nav-item-hold" href="equipe">
                    <i class="nav-icon i-Business-Mens"></i>
                    <span class="nav-text">EQUIPE</span>
                </a>
                <div class="triangle"></div>
            </li>

            <?php  if (str_contains($url, 'compras')) { ?>
            <li class="nav-item active">
                <?php } else { ?>
            <li class="nav-item">
                <?php } ?>
                <a class="nav-item-hold" href="compras">
                    <i class="nav-icon i-Add-Cart"></i>
                    <span class="nav-text">COMPRAS</span>
                </a>
                <div class="triangle"></div>
            </li>
        </ul>
    </div>

</div>
