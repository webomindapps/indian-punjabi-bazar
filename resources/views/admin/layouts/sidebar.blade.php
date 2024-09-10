<div class="sidebar active">
    <div class="logo_content">
        <div class="logo_img">
            <a href="">
                <img src="{{ asset('frontend/assets/images/logo.png') }}" class="img-fluid"
                    style="width:150px; height:90px;">
            </a>
        </div>
        <i class='bx bx-menu-alt-right' id="btn" style="font-size: 25px; cursor: pointer;"></i>
    </div>
    <ul class="nav_list">
        @php
            $menusConfig = config('menu.menu');
        @endphp
        @if (is_array($menusConfig))
            @foreach ($menusConfig as $menus)
                @if (isset($menus['menu']) && is_array($menus['menu']))
                    @foreach ($menus['menu'] as $menu)
                        @if (isset($menu['is_submenu']) && $menu['is_submenu'])
                            <li class="dropdown nav-item ">
                                <a href="javascript:void()" class="nav-link">
                                    <span class="shape1"></span>
                                    <span class="shape2"></span>
                                    <i class="{{ $menu['icon'] }}"></i>
                                    <span class="link_names">{{ $menu['name'] }}</span>
                                    <span class="right-arr">
                                        <i class='bx bx-chevron-down'></i>
                                    </span>
                                </a>
                                @if (isset($menu['sub_menus']) && is_array($menu['sub_menus']))
                                    <ul class="dropdown_menu">
                                        @foreach ($menu['sub_menus'] as $submenu)
                                            <li>
                                                <a
                                                    @if (isset($submenu['params'])) href="{{ route($submenu['route'], $submenu['params']) }}"
                                            @else href="{{ route($submenu['route']) }}" @endif>
                                                    <i class='bx bx-chevron-right'></i>
                                                    {{ $submenu['name'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @else
                            <li
                                class="dropdown nav-item {{ $menu['route'] == Route::currentRouteName() ? 'active' : '' }}">
                                <a @if (isset($menu['params'])) href="{{ route($menu['route'], $menu['params']) }}"
                            @else href="{{ route($menu['route']) }}" @endif
                                    class="nav-link">
                                    <span class="shape1"></span>
                                    <span class="shape2"></span>
                                    <i class="{{ $menu['icon'] }}"></i>
                                    <span class="link_names">{{ $menu['name'] }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        @endif
    </ul>

</div>
