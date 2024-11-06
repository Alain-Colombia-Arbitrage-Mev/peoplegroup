<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler"> </div>
            </li>
            <li class="sidebar-search-wrapper">
            </li>

            <li class="nav-item start @php echo "active",(request()->path() != 'admin/home')?:"";@endphp">
                <a href="{{url('admin/home')}}" class="nav-link nav-toggle">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="title">Tablero</span>
                    <span class="selected"></span>
                </a>
            </li>
            @php
                $url = Find_fist_int(request()->path());
            @endphp

            <li class="nav-item start @php echo "active",(request()->path() != 'admin/general')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/charge/commission')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/logo/icon')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/background/images')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/template')?:"";@endphp">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fas fa-desktop"></i>
                    <span class="title">Configuración</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">

                    <li class="nav-item start @if( request()->path() == 'admin/charge/commission' ) active open @endif">
                        <a href="{{route('charge.commission')}}" class="nav-link ">
                            <i class="fas fa-money-bill-alt"></i>
                            <span class="title">Bonos y Cargos</span>
                        </a>
                    </li>
                    <li class="nav-item  @if( request()->path() == 'admin/general' ) active open @endif">
                        <a href="{{route('general.index')}}" class="nav-link ">
                            <i class="fas fa-cog"></i>
                            <span class="title">General</span>
                        </a>
                    </li>

                    

                    <li class="nav-item  @if( request()->path() == 'admin/template' ) active open @endif">
                        <a href="{{route('email.index.admin')}}" class="nav-link ">
                            <i class="fas fa-envelope-open"></i>
                            <span class="title">Plantilla de Email</span>
                        </a>
                    </li>

                    <!-- <li class="nav-item  @if( request()->path() == 'admin/sms-api' ) active open @endif">
                        <a href="{{route('sms.index.admin')}}" class="nav-link ">
                            <i class="far fa-comments"></i>
                            <span class="title">SMS Api</span>
                        </a>
                    </li> -->

                    <li class="nav-item  @if( request()->path() == 'admin/logo/icon' ) active open @endif">
                        <a href="{{route('logo.icon')}}" class="nav-link ">
                            <i class="fas fa-file-image"></i>
                            <span class="title">Logo</span>
                        </a>
                    </li>

                    <li class="nav-item start @php echo "active",(request()->path() != 'admin/background/images')?:"";@endphp">
                        <a href="{{route('background.image.index')}}" class="nav-link nav-toggle">
                            <i class="far fa-file-image"></i>
                            <span class="title">Imágenes de Fondo</span>
                        </a>
                    </li>

                </ul>
            </li>

            @php $req = \App\WithdrawTrasection::where('status', 0)->count() @endphp

            <li class="nav-item start @php echo "active",(request()->path() != 'admin/withdraw/method')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/withdraw/requests')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/withdraw/log')?:"";@endphp">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="far fa-money-bill-alt"></i>
                    <span class="title">Retiro de fondos @if($req == 0)  @else<span class="badge badge-danger">{{$req}} @endif</span></span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  @if( request()->path() == 'admin/withdraw/method' ) active open @endif">
                        <a href="{{route('add.withdraw.method')}}" class="nav-link ">
                            <i class="fab fa-paypal"></i>
                            <span class="title">Métodos de Retiro</span>
                        </a>
                    </li>
                    <li class="nav-item  @if( request()->path() == 'admin/withdraw/requests' ) active open @endif">
                        <a href="{{route('withdraw.request.index')}}" class="nav-link ">
                            <i class="fas fa-spinner"></i>
                            <span class="title">Solicitudes @if($req == 0)  @else<span class="badge badge-danger">{{$req}} @endif</span></span>
                        </a>
                    </li>
                    <li class="nav-item  @if( request()->path() == 'admin/withdraw/log' ) active open @endif">
                        <a href="{{route('withdraw.viewlog.admin')}}" class="nav-link ">
                            <i class="fas fa-eye"></i>
                            <span class="title">Registros</span>
                        </a>
                    </li>
                </ul>
            </li>

            @php $req = \App\Deposit::where('status', 0)->count() @endphp

            <li class="nav-item start @php echo "active",(request()->path() != 'admin/gateway')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/deposit/requests')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/add/fund/user')?:"";@endphp">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="far fa-money-bill-alt"></i>
                    <span class="title">Depósitos @if($req == 0)  @else<span class="badge badge-danger">{{$req}} @endif</span></span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  @if( request()->path() == 'admin/gateway' ) active open @endif">
                        <a href="{{route('gateway.index')}}" class="nav-link ">
                            <i class="far fa-credit-card"></i>
                            <span class="title">Métodos de pago</span>
                        </a>
                    </li>
                    <li class="nav-item  @if( request()->path() == 'admin/deposit/requests' ) active open @endif">
                        <a href="{{route('deposit.request.index')}}" class="nav-link ">
                            <i class="fas fa-spinner"></i>
                            <span class="title">Por verificar @if($req == 0)  @else<span class="badge badge-danger">{{$req}} @endif</span></span>
                        </a>
                    </li>
                    <li class="nav-item  @if( request()->path() == 'admin/add/fund/user' ) active open @endif">
                        <a href="{{route('index.deposit.user')}}" class="nav-link ">
                            <i class="fas fa-eye"></i>
                            <span class="title">Registro de depósitos</span>
                        </a>
                    </li>
                </ul>
            </li>
           
            <li class="nav-item start @php echo "active",(request()->path() != 'admin/users')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/paid/user')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/leader/user')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/deactive/user')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/free/user')?:"";@endphp">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fas fa-users"></i>
                    <span class="title">Usuarios</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">

                    <li class="nav-item  @if( request()->path() == 'admin/users' ) active open @endif">
                        <a href="{{route('user.manage')}}" class="nav-link ">
                            <i class="far fa-user-circle"></i>
                            <span class="title">Todos</span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'admin/leader/user' ) active open @endif">
                        <a href="{{route('leader.user.index')}}" class="nav-link ">
                            <i class="fa fa-sitemap"></i>
                            <span class="title">Líderes</span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'admin/paid/user' ) active open @endif">
                        <a href="{{route('paid.user.index')}}" class="nav-link ">
                            <i class="far fa-user"></i>
                            <span class="title">Con membresia</span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'admin/free/user' ) active open @endif">
                        <a href="{{route('free.user.index')}}" class="nav-link ">
                            <i class="fas fa-user-times"></i>
                            <span class="title">Sin pago</span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'admin/deactive/user' ) active open @endif">
                        <a href="{{route('index.deactive.user')}}" class="nav-link ">
                            <i class="fas fa-ban"></i>
                            <span class="title">Bloqueados</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item start @php echo "active",(request()->path() != 'admin/membership')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/membership/history')?:"";@endphp">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-sitemap"></i>
                    <span class="title">Membresías</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">

                    <li class="nav-item  @if( request()->path() == 'admin/membership/history' ) active open @endif">
                        <a href="{{route('membership.history.index')}}" class="nav-link ">
                            <i class="far fa-user-circle"></i>
                            <span class="title">Historico</span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'admin/membership' ) active open @endif">
                        <a href="{{route('membership.admin.index')}}" class="nav-link ">
                            <i class="fas fa-cog"></i>
                            <span class="title">Configurar</span>
                        </a>
                    </li>

                </ul>
            </li>
            
            <li class="nav-item start @php echo "active",(request()->path() != 'admin/transfer/balance')?:"";@endphp">
                <a href="{{route('user.total.trans', 2)}}" class="nav-link nav-toggle">
                    <i class="fas fa-download"></i>
                    <span class="title">Transacciones Admin</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item start @php echo "active",(request()->path() != 'admin/transfer/balance')?:"";@endphp">
                <a href="{{route('user.total.trans', 1)}}" class="nav-link nav-toggle">
                    <i class="fas fa-retweet"></i>
                    <span class="title">Transacciones Wallet de reserva</span>
                    <span class="selected"></span>
                </a>
            </li>

            @php $check_count = \App\Ticket::where('status', 1)->get() @endphp
            <li class="nav-item start @if( request()->path() == 'admin/supports' || request()->path() == 'admin/supports' ) active open @endif
            @if( request()->path() == '' || request()->path() == '' ) active open @endif">
                <a href="{{route('support.admin.index')}}" class="nav-link nav-toggle">
                    <i class="fas fa-ticket-alt"></i>
                    <span class="title">Soporte @if(count($check_count) == 0)  @else <span class="badge badge-danger"> {{count($check_count)}} @endif </span></span>
                    <span class="selected"></span>
                </a>
            </li>

        </ul>
    </div>
</div>