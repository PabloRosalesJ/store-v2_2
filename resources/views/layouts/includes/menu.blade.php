    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar menu-light " id="navbar_app">
        <div class="navbar-wrapper  ">
            <div class="navbar-content scroll-div ">

                <!-- Auuth user information -->
                <div class="">
                    <div class="main-menu-header">
                        <img class="img-radius" src="{{ asset('img/admin_avatar.svg') }}" alt="User-Profile-Image">
                        <div class="user-details">
                            {{-- <div id="more-details">{{ Auth::user()->username }} <i class="fa fa-caret-down"></i></div> --}}
                        </div>
                    </div>
                    <div class="collapse" id="nav-user-link">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="user-profile.html" data-toggle="tooltip" title="View Profile"><i class="feather icon-user"></i></a></li>
                            <li class="list-inline-item"><a href="email_inbox.html"><i class="feather icon-mail" data-toggle="tooltip" title="Messages"></i><small class="badge badge-pill badge-primary">5</small></a></li>
                            <li class="list-inline-item">
                                <a href="/logout" data-toggle="tooltip" title="Logout" class="text-danger"
                                {{-- <a href="{{ route('logout') }}" data-toggle="tooltip" title="Logout" class="text-danger" --}}
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    <i class="feather icon-power"></i>
                                </a>

                                <form id="logout-form" action="/logout" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--Auuth user information End -->

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
                        <a class="nav-link "><span class="pcoded-micon">
                                <i class="feather icon-shopping-cart"></i>
                            </span><span class="pcoded-mtext">Ventas</a>
                        <ul class="pcoded-submenu">
                            <li class="pcoded-hasmenu">
                                <a href="#!">Ventas</a>
                                <ul class="pcoded-submenu">
                                    <li>
                                        <router-link :to="{name:'allSales'}">Todas las ventas</router-link>
                                    </li>
                                    <li><router-link :to="{name:'makeSale'}">Realizar venta</router-link></li>
                                </ul>
                            </li>

                            <li class="pcoded-hasmenu">
                                <a href="#!">Créditos</a>
                                <ul class="pcoded-submenu">
                                    <li>
                                        <router-link :to="{name:'allCredits'}">Todos los créditos</router-link>
                                    </li>
                                    <li>
                                        <router-link :to="{name:'makeCredit'}">Realizar venta a crédito</router-link>
                                    </li>
                                    <li>
                                        <router-link :to="{name:'allPayments'}">Pagos recibidos</router-link>
                                    </li>
                                </ul>
                            </li>



                        </ul>
                    </li>
                    <!-- Ventas End-->

                    <!-- Almacén -->
                    <li class="nav-item pcoded-hasmenu">
                        <a class="nav-link "><span class="pcoded-micon">
                                <i class="feather icon-package"></i>
                            </span><span class="pcoded-mtext">Almacén</span></a>
                        <ul class="pcoded-submenu">
                            <li>
                                <router-link :to="{name:'allCategories'}">Categorias</router-link>
                            </li>
                            <li>
                                <router-link :to="{name:'allProducts'}">Productos</router-link>
                            </li>
                            <li>
                                <router-link :to="{name:'allIncomes'}">Ingresos</router-link>
                            </li>
                        </ul>
                    </li>
                    <!-- Almacén End-->


                </ul>

            </div>
        </div>
    </nav><!-- [ navigation menu ] end -->
