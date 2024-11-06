<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler"> </div>
            </li>
            <li class="sidebar-search-wrapper">
            </li>

            <li class="nav-item start @php echo "active",(request()->path() != 'home')?:"";@endphp">
                <a href="{{ url('/home') }}" class="nav-link nav-toggle">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="title">Tablero </span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item  start @if( request()->path() == 'fund' ) active open @endif
            @if( request()->path() == 'deposit/store' ) active open @endif
            @if( request()->path() == 'add/confirm' ) active open @endif">
                <a href="{{route('add.fund.index')}}" class="nav-link">
                    <i class="far fa-credit-card"></i>
                    <span class="title">Recarga de Fondos</span>
                    <span class="selected"></span>
                </a>
            </li>


            <li class="nav-item start @if( request()->path() == 'membership' ) active open @endif
            @if( request()->path() == 'membership' ) active open @endif">
                <a href="{{route('membership.index')}}" class="nav-link ">
                    <i class="fas fa-sitemap"></i>
                    <span class="title">Planes</span>
                </a>
            </li>

            <li class="nav-item start @if( request()->path() == 'withdraw' ) active open @endif
            @if( request()->path() == 'withdraw/preview' ) active open @endif">
                <a href="{{route('request.users_management.index')}}" class="nav-link ">
                    <i class="fas fa-spinner"></i>
                    <span class="title">Solicitar Retiro</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item start @if( request()->path() == 'transfer/fund' ) active open @endif">
                <a href="{{route('fund.transfer.index')}}" class="nav-link ">
                    <i class="fas fa-exchange-alt"></i>
                    <span class="title">Transferencia de fondos </span>
                    <span class="selected"></span>
                </a>
            </li>


            <li class="nav-item start @php echo "active",(request()->path() != 'transaction')?:"";@endphp">
                <a href="{{route('transaction.history')}}" class="nav-link">
                    <i class="far fa-clone"></i>
                    <span class="title">Historial de transacciones </span>
                    <span class="selected"></span>
                </a>
            </li>


            <li class="nav-item start <?php echo request()->path() == 'referral/commission' ? 'active' : ''; ?>
            <?php echo request()->path() == 'consumption/commission' ? 'active' : ''; ?>
            <?php echo request()->path() == 'unilevel/commission' ? 'active' : ''; ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="far fa-money-bill-alt"></i>
                    <span class="title"> Mis Ingresos</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  @if( request()->path() == 'referral/commission' ) active open @endif">
                        <a href="{{route('ref.commision.index')}}" class="nav-link ">
                            <i class="fas fa-users"></i>
                            <span class="title">Inicio Rápido</span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'unilevel/commission' ) active open @endif">
                        <a href="{{route('unilevel.commision.index')}}" class="nav-link ">
                            <i class="fas fa-sitemap"></i>
                            <span class="title">Unilevel</span>
                        </a>
                    </li>


                    <li class="nav-item  @if( request()->path() == 'solidario/commission' ) active open @endif">
                        <a href="{{route('solidario.commision.index')}}" class="nav-link ">
                            <i class="fas fa-dollar-sign"></i>
                            <span class="title">Solidario</span>
                        </a>
                    </li>
                    
                    <li class="nav-item  @if( request()->path() == 'consumption/commission' ) active open @endif">
                        <a href="{{route('consumption.commision.index')}}" class="nav-link ">
                            <i class="fas fa-dollar-sign"></i>
                            <span class="title">Consumo <b>(Próximamente)</b></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item start <?php echo request()->path() == 'unilevel/summery' ? 'active' : ''; ?>
            <?php echo request()->path() == 'tree' ? 'active' : ''; ?>
            <?php echo request()->path() == 'referral' ? 'active' : ''; ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fas fa-info-circle"></i>
                    <span class="title">Red</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  @if( request()->path() == 'tree' ) active open @endif">
                        <a href="{{route('tree.index')}}" class="nav-link ">
                            <i class="fas fa-sitemap"></i>
                            <span class="title">Mi red</span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'tree' ) active open @endif">
                        <a href="{{route('tree.binary')}}" class="nav-link ">
                            <i class="fas fa-sitemap"></i>
                            <span class="title">Binary</span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'referral' ) active open @endif">
                        <a href="{{route('referral.index')}}" class="nav-link ">
                            <i class="fas fa-registered"></i>
                            <span class="title">Mis socios</span>
                        </a>
                    </li>
                </ul>
            </li>



            <li class="nav-item start @php echo "active",(request()->path() != 'profile')?:"";@endphp
            @php echo "active",(request()->path() != 'security')?:"";@endphp
            @php echo "active",(request()->path() != 'security/two/step')?:"";@endphp">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fas fa-cogs"></i>
                    <span class="title">Ajustes</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  @if( request()->path() == 'profile' ) active open @endif">
                        <a href="{{ route('profile.index') }}" class="nav-link ">
                            <i class="fas fa-user-circle"></i>
                            <span class="title">Mi perfil</span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'security' ) active open @endif">
                        <a href="{{ route('security.index') }}" class="nav-link ">
                            <i class="fas fa-key"></i>
                            <span class="title">Cambiar Clave</span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'security/two/step' ) active open @endif">
                        <a href="{{route('two.factor.index')}}" class="nav-link ">
                            <i class="fas fa-lock"></i>
                            <span class="title">Seguridad</span>
                        </a>
                    </li>
                </ul>
            </li>
            
          

            <li class="nav-item start @if( request()->path() == 'support/new' ) active open @endif
            @if( request()->path() == 'support' ) active open @endif">
                <a href="{{route('support.index.customer')}}" class="nav-link ">
                    <i class="fas fa-ticket-alt"></i>
                    <span class="title">Soporte</span>
                </a>
            </li>

            {{--<li class="heading">--}}
                {{--<h3 class="uppercase">Investment Management</h3>--}}
            {{--</li>--}}

            {{--<li class="nav-item start @php echo "active",(request()->path() != 'lend/packages')?:"";@endphp--}}
            {{--@php echo "active",(request()->path() != 'lend/preview')?:"";@endphp">--}}
                {{--<a href="{{route('lend.index')}}" class="nav-link nav-toggle">--}}
                    {{--<i class="fas fa-bookmark"></i>--}}
                    {{--<span class="title">Invest System </span>--}}
                    {{--<span class="selected"></span>--}}
                {{--</a>--}}
            {{--</li>--}}

            {{--<li class="nav-item start @php echo "active",(request()->path() != 'lending/history')?:"";@endphp">--}}
                {{--<a href="{{route('lend.history')}}" class="nav-link nav-toggle">--}}
                    {{--<i class="fas fa-book"></i>--}}
                    {{--<span class="title">Invest History</span>--}}
                    {{--<span class="selected"></span>--}}
                {{--</a>--}}
            {{--</li>--}}


        </ul>
    </div>
</div>