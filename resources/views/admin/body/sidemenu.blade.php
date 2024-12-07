<?php
$url = $_SERVER['REQUEST_URI'];
$url = str_replace(['/','.php'], '', $url);
?>

<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">

        @can('dashboard')
            <?php  if (str_contains($url, 'index') || empty($url) || str_contains($url, 'dashboard')) { ?>
        <li class="nav-item active" >
        <?php } else { ?>
            <li class="nav-item" >
                <?php } ?>
                <a class="nav-item-hold" href="{{ asset('dashboard') }}">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">DASHBOARD</span>
                </a>
                <div class="triangle"></div>
            </li>
        @endcan

        @can('management')
            <?php  if (str_contains($url, 'gestao')) { ?>
        <li class="nav-item active" data-item="gestao">
        <?php } else { ?>
            <li class="nav-item" data-item="gestao">
                <?php } ?>
                <a class="nav-item-hold" href="{{ route('gestao') }}">
                    <i class="nav-icon i-Conference"></i>
                    <span class="nav-text">GESTÃO OS</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endcan

            @can('preventive')
            <li class="nav-item" >
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Over-Time-2"></i>
                    <span class="nav-text">PREVENTIVA</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endcan

            @can('reports')
            <?php  if (str_contains($url, 'relatorios')) { ?>
        <li class="nav-item active" data-item="relatorios">
        <?php } else { ?>
            <li class="nav-item" data-item="relatorios">
                <?php } ?>
                <a class="nav-item-hold" href="{{ route('relatorios') }}">
                    <i class="nav-icon i-Folder-With-Document"></i>
                    <span class="nav-text">RELATÓRIOS</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endcan

            @can('assets')
            <?php  if (str_contains($url, 'ativos')) { ?>
        <li class="nav-item active" data-item="ativos">
        <?php } else { ?>
            <li class="nav-item" data-item="ativos">
                <?php } ?>
                <a class="nav-item-hold" href="{{ route('ativos') }}">
                    <i class="nav-icon i-Financial"></i>
                    <span class="nav-text">ATIVOS</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endcan

            @can('teams')
            <!-- if (str_contains($url, 'equipe')) { -->
            <?php  if(str_replace(['equipe','usuarios'], '', strtolower($url)) !== strtolower($url)) { ?>
        <li class="nav-item active" >
        <?php } else { ?>
            <li class="nav-item">
                <?php } ?>
                <a class="nav-item-hold" href="{{ route('usuarios') }}">
                    <i class="nav-icon i-Business-Mens"></i>
                    <span class="nav-text">EQUIPE</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endcan

            @can('transactions')
            <?php  if (str_contains($url, 'compras')) { ?>
            <li class="nav-item active"  data-item="suprimentos">
                <?php } else { ?>
            <li class="nav-item" data-item="suprimentos">
                <?php } ?>
                <a class="nav-item-hold" href="{{ route('compras') }}">
                    <i class="nav-icon i-Receipt"></i>
                    <span class="nav-text">SUPRIMENTOS</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endcan
        </ul>
    </div>

    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <!-- Submenu Dashboards -->
        <!-- ativos -->
        <ul class="childNav" data-parent="ativos">
            <li class="nav-item">
                <a href="{{ route('ativos') }}">
                    <i class="nav-icon i-Clock-3"></i>
                    <span class="item-name">Registrar Ativos</span>
                </a>
                <a href="{{ route('ativos-itens') }}">
                    <i class="nav-icon i-Clock-3"></i>
                    <span class="item-name">Cadastrar Itens/Ativos</span>
                </a>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a href="{{ route('link-ativos-itens') }}">--}}
{{--                    <i class="nav-icon i-Clock-4"></i>--}}
{{--                    <span class="item-name">Linkar Itens/Ativos</span>--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>
        <!-- relatorios -->
        <ul class="childNav" data-parent="gestao">
            <li class="nav-item">
                <a href="{{ route('chamado.index') }}">
                    <i class="nav-icon i-Hub"></i>
                    <span class="item-name">Chamados</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('gestao') }}">
                    <i class="nav-icon i-Pie-Chart-3"></i>
                    <span class="item-name">OS</span>
                </a>
            </li>
        </ul>
        <!-- relatorios -->
        <ul class="childNav" data-parent="relatorios">
            <li class="nav-item">
                <a href="{{ route('relatorios') }}">
                    <i class="nav-icon i-Receipt"></i>
                    <span class="item-name">Relatórios</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('relatorios') }}">
                    <i class="nav-icon i-Pie-Chart-3"></i>
                    <span class="item-name">Gráficos</span>
                </a>
            </li>
        </ul>
        <!-- Equipe -->
{{--        <ul class="childNav" data-parent="equipe">--}}
{{--            <li class="nav-item">--}}
{{--                <a href="{{ route('usuarios') }}">--}}
{{--                    <i class="nav-icon i-Add-User"></i>--}}
{{--                    <span class="item-name">Funcionarios</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a href="{{ route('equipe') }}">--}}
{{--                    <i class="nav-icon i-Address-Book-2"></i>--}}
{{--                    <span class="item-name">Cargos</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        </ul>--}}
        <!-- Suprimentos -->
        <ul class="childNav" data-parent="suprimentos">
            <li class="nav-item">
                <a href="{{ route('relatorios') }}">
                    <i class="nav-icon i-Scale"></i>
                    <span class="item-name">Almoxarifado</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('relatorios') }}">
                    <i class="nav-icon i-Car-Items"></i>
                    <span class="item-name">Compras</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('produto.index') }}">
                    <i class="nav-icon i-Bag-Items"></i>
                    <span class="item-name">Produtos</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="sidebar-overlay"></div>

</div>
<!--=============== Left side End ================-->
