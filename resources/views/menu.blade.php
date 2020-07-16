
    <nav class="navigation nav-c" id="navigation" data-menu-type="1200">
        <div class="nav-inner">
            <a href="#" class="bars-close" id="bars-close">Close</a>
            <div class="tb">
                <div class="tb-cell">
                    <ul class="menu-list text-uppercase">


                        <li class="{{ $menu == 'home' ? 'current-menu-parent' : '' }}">
                            <a href="{{ route('main') }}" title="">@lang('menu.home')</a>
                        </li>


                        <li class="{{ $menu == 'hunting' ? 'current-menu-parent' : '' }}">
                            <a title="">@lang('menu.catalog')</a>
                            <ul class="sub-menu">
                                
                                @forelse($species as $specie)
                                <li class="{{ $menu == $specie->slug ? 'current-menu-parent' : '' }}">
                                    <a href="{{ route('tours.index', ['cat_tour' => $specie->slug]) }}" title="">{{ $specie->name }}</a>
                                </li>
                                @empty

                                @endforelse
                                
                            </ul>
                        </li>


                        <li class="{{ $menu == 'contacts' ? 'current-menu-parent' : '' }}">
                            <a href="{{ route('contacts.index') }}" title="">@lang('menu.contact')</a>
                        </li>

                        <li>
                            <a href="{{ route('login') }}" title="">@lang('menu.login')</a>
                        </li>

                        <li>
                            <a href="{{ route('register') }}" title="">@lang('menu.register')</a>
                        </li>

                        
                    </ul>
                </div>
            </div>
        </div>
    </nav>
