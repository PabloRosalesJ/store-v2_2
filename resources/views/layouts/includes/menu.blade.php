    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar menu-light ">
        <div class="navbar-wrapper  ">
            <div class="navbar-content scroll-div ">

                <!-- Auuth user information -->
                <div class="">
                    <div class="main-menu-header">
                        <img class="img-radius" src="{{ asset('images/avatar.jpg') }}" alt="User-Profile-Image">
                        <div class="user-details">
                            <div id="more-details">UX Designer <i class="fa fa-caret-down"></i></div>
                        </div>
                    </div>
                    <div class="collapse" id="nav-user-link">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="user-profile.html" data-toggle="tooltip"
                                    title="View Profile"><i class="feather icon-user"></i></a></li>
                            <li class="list-inline-item"><a href="email_inbox.html"><i class="feather icon-mail"
                                        data-toggle="tooltip" title="Messages"></i><small
                                        class="badge badge-pill badge-primary">5</small></a></li>
                            <li class="list-inline-item"><a href="auth-signin.html" data-toggle="tooltip" title="Logout"
                                    class="text-danger"><i class="feather icon-power"></i></a></li>
                        </ul>
                    </div>
                </div><!--Auuth user information End -->

                <ul class="nav pcoded-inner-navbar ">

                    <li class="nav-item pcoded-menu-caption">
                        <label>Secciones</label>
                    </li>

                    <!-- Usuarios -->
                    <li class="nav-item pcoded-hasmenu">
                        <a class="nav-link "><span class="pcoded-micon">
                            <i class="feather icon-users"></i>
                            </span><span class="pcoded-mtext">Usuarios</span></a>
                        <ul class="pcoded-submenu">
                            <li>
                                <router-link :to="{name:'clients'}">Clientes</router-link>
                            </li>
                            <li>
                                <router-link :to="{name:'providers'}">Proveedores</router-link>
                            </li>
                            <li>
                                <router-link :to="{name:'users'}">Usuarios</router-link>
                            </li>
                        </ul>
                    </li>
                    <!-- Usuarios End-->
                    
                    <!-- Ventas -->
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon">
                            <i class="feather icon-shopping-cart"></i>
                            </span><span class="pcoded-mtext">Ventas</a>
                        <ul class="pcoded-submenu">
                            <li><a href="widget-statistic.html">Categorias</a></li>
                            <li><a href="widget-data.html">Productos</a></li>
                            <li><a href="widget-chart.html">Ingresos</a></li>
                        </ul>
                    </li>
                    <!-- Ventas End--> 

                    <!-- Almacén -->
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon">
                            <i class="feather icon-package"></i>
                            </span><span class="pcoded-mtext">Almacén</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="index.html">Ventas</a></li>
                            <li><a href="dashboard-sale.html">Creéditos</a></li>
                        </ul>
                    </li>
                    <!-- Almacén End-->
                    

                </ul>

            </div>
        </div>
    </nav><!-- [ navigation menu ] end -->