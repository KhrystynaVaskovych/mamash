<div class="header" id="header">
    <div class="header-top bg-gray">
{{--        <span class="menu-box hidden" ><span class="icon icon-menu" id="hammenu"></span></span>--}}
        <div class="main-container-wrapper flex justify-between sm:justify-end py-3">
            <span class="menu-box visible sm:invisible"><span class="icon icon-menu" id="hammenu"></span></span>
            <div class="left-content mx-8 mt-1 leading-none relative">
            <a href="#" class="invisible sm:visible inline-block align-top text-white text-sm hover:text-yellow cursor-pointer">{{ __('shop::app.header.help') }}</a>
        </div>

        <?php
            $query = parse_url(\Illuminate\Support\Facades\Request::path(), PHP_URL_QUERY);
            $searchTerm = explode("?", $query);

            foreach($searchTerm as $term){
                if (strpos($term, 'term') !== false) {
                    $serachQuery = $term;
                }
            }
        ?>

        <div class="right-content flex">
{{--            <div class="mt-1 {{ count(core()->getCurrentChannel()->locales) == 1 ? 'hidden' : '' }}">--}}
            <div class="ml-8 mt-1">
                <ul class="flex uppercase text-sm leading-none relative">
                    @foreach (core()->getCurrentChannel()->locales as $locale)
                        <li class="px-1 {{($loop->index > 0) ? 'border-l-2 border-solid border-gray-light' : 'border-0'}}">
                            @if( $locale->code == app()->getLocale())
                                <span class="inline-block align-top text-yellow">{{$locale->code}}</span>
                            @else
                                @if(isset($serachQuery))
                                    <a href="?{{ $serachQuery }}?locale={{ $locale->code }}" class="inline-block align-top text-white hover:underline">{{$locale->code}}</a>
                                @else
                                    <a href="?locale={{ $locale->code }}" class="inline-block align-top text-white hover:underline">{{$locale->code}}</a>
                                @endif
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

            <ul class="right-content-menu">

                {!! view_render_event('bagisto.shop.layout.header.currency-item.before') !!}

                @if (core()->getCurrentChannel()->currencies->count() > 1)
                    <li class="currency-switcher">
                        <span class="dropdown-toggle">
                            {{ core()->getCurrentCurrencyCode() }}

                            <i class="icon arrow-down-icon"></i>
                        </span>

                        <ul class="dropdown-list currency">
                            @foreach (core()->getCurrentChannel()->currencies as $currency)
                                <li>
                                    @if(isset($serachQuery))
                                        <a href="?{{ $serachQuery }}?currency={{ $currency->code }}">{{ $currency->code }}</a>
                                    @else
                                        <a href="?currency={{ $currency->code }}">{{ $currency->code }}</a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif

                {!! view_render_event('bagisto.shop.layout.header.currency-item.after') !!}

            </ul>
        </div>
    </div>
    </div>

    <div class="bg-gray-dark">
        <div class="main-container-wrapper flex items-center flex-col sm:flex-row h-24">
            <div class="header-bottom w-full block flex-grow lg:flex lg:items-center lg:w-full" id="header-bottom">
                @include('shop::layouts.header.nav-menu.navmenu')
            </div>
            <div class="w-auto absolute inset-0 mt-2 ml-20 sm:relative">
                <ul class="logo-container h-full w-32 sm:w-56 sm:mx-8">
                    <li>
                        <a href="{{ route('shop.home.index') }}">
                            @if ($logo = core()->getCurrentChannel()->logo_url)
                                <img class="logo" src="{{ $logo }}" />
                            @else
                                <img class="logo" src="{{ bagisto_asset('images/logo.svg') }}" />
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
            <div class="w-full w-5/12 flex justify-end items-center">
                <div class="w-full right-content flex justify-between items-center">
                    <div class="search-container mr-10 items-center w-full flex justify-end relative">
                        <form role="search" action="{{ route('shop.search.index') }}" method="GET" >
                            <input type="text" class="bg-transparent font-serif font-light text-white text-sm h-8 w-20 border-b border-gray-light relative focus:w-48 focus:border-yellow"
                                   placeholder="{{ __('shop::app.header.search-text') }}" required>
                                    <div class="search-icon-wrapper flex items-center absolute right-0 inset-y-0">
                                        <button class="pl-2 -mr-5 pb-1">
                                            <svg class="fill-current text-white hover:text-yellow inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
                                        </button>
                                </div>
                        </form>
                    </div>

                    <div class="mx-1 px-10"><span class="border-gray-light border-l py-4 opacity-50"></span></div>

{{--                <span class="search-box hidden sm:visible"><span class="icon icon-search" id="search"></span></span>--}}

                    <ul class="w-1/2 right-content-menu flex justify-between items-center">

                        {!! view_render_event('bagisto.shop.layout.header.account-item.before') !!}

                        <li>
                        @guest
                            <a href="{{ route('customer.session.index') }}"><div class="cursor-pointer user-icon mr-1"></div></a>
                        @endguest
                        @auth('customer')
                            <a href="{{ route('customer.session.index') }}"><div class="cursor-pointer user-icon active"></div></a>
                        @endauth

{{--                    <span class="dropdown-toggle">--}}
{{--                        <i class="icon account-icon"></i>--}}


{{--                        <span class="name">{{ __('shop::app.header.account') }}</span>--}}

{{--                        <i class="icon arrow-down-icon"></i>--}}
{{--                    </span>--}}

{{--                            @guest('customer')--}}
{{--                                <ul class="dropdown-list account guest">--}}
{{--                                    <li>--}}
{{--                                        <div>--}}
{{--                                            <label style="color: #9e9e9e; font-weight: 700; text-transform: uppercase; font-size: 15px;">--}}
{{--                                                {{ __('shop::app.header.title') }}--}}
{{--                                            </label>--}}
{{--                                        </div>--}}

{{--                                        <div style="margin-top: 5px;">--}}
{{--                                            <span style="font-size: 12px;">{{ __('shop::app.header.dropdown-text') }}</span>--}}
{{--                                        </div>--}}

{{--                                        <div style="margin-top: 15px;">--}}
{{--                                            <a class="btn btn-primary btn-md" href="{{ route('customer.session.index') }}" style="color: #ffffff">--}}
{{--                                                {{ __('shop::app.header.sign-in') }}--}}
{{--                                            </a>--}}

{{--                                            <a class="btn btn-primary btn-md" href="{{ route('customer.register.index') }}" style="float: right; color: #ffffff">--}}
{{--                                                {{ __('shop::app.header.sign-up') }}--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            @endguest--}}

{{--                            @auth('customer')--}}
{{--                                <ul class="dropdown-list account customer">--}}
{{--                                    <li>--}}
{{--                                        <div>--}}
{{--                                            <label style="color: #9e9e9e; font-weight: 700; text-transform: uppercase; font-size: 15px;">--}}
{{--                                                {{ auth()->guard('customer')->user()->first_name }}--}}
{{--                                            </label>--}}
{{--                                        </div>--}}

{{--                                        <ul>--}}
{{--                                            <li>--}}
{{--                                                <a href="{{ route('customer.profile.index') }}">{{ __('shop::app.header.profile') }}</a>--}}
{{--                                            </li>--}}

{{--                                            <li>--}}
{{--                                                <a href="{{ route('customer.wishlist.index') }}">{{ __('shop::app.header.wishlist') }}</a>--}}
{{--                                            </li>--}}

{{--                                            <li>--}}
{{--                                                <a href="{{ route('shop.checkout.cart.index') }}">{{ __('shop::app.header.cart') }}</a>--}}
{{--                                            </li>--}}

{{--                                            <li>--}}
{{--                                                <a href="{{ route('customer.session.destroy') }}">{{ __('shop::app.header.logout') }}</a>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            @endauth--}}
                        </li>

                        {!! view_render_event('bagisto.shop.layout.header.account-item.after') !!}


                        {!! view_render_event('bagisto.shop.layout.header.cart-item.before') !!}

                        <li class="cart-dropdown-container">

                            @include('shop::checkout.cart.mini-cart')

                        </li>

                        {!! view_render_event('bagisto.shop.layout.header.cart-item.after') !!}

                    </ul>
                </div>
{{--                    <span class="menu-box hidden sm:visible" ><span class="icon icon-menu" id="hammenu"></span></span>--}}

            </div>
        </div>
    </div>

</div>




@push('scripts')
    <script>
        $(document).ready(function() {

            $('body').delegate('#search, .icon-menu-close, .icon.icon-menu', 'click', function(e) {
                toggleDropdown(e);
            });

            function toggleDropdown(e) {
                var currentElement = $(e.currentTarget);

                if (currentElement.hasClass('icon-search')) {
                    currentElement.removeClass('icon-search');
                    currentElement.addClass('icon-menu-close');
                    $('#hammenu').removeClass('icon-menu-close');
                    $('#hammenu').addClass('icon-menu');
                    $("#search-responsive").css("display", "block");
                    $("#header-bottom").css("display", "none");
                } else if (currentElement.hasClass('icon-menu')) {
                    currentElement.removeClass('icon-menu');
                    currentElement.addClass('icon-menu-close');
                    $('#search').removeClass('icon-menu-close');
                    $('#search').addClass('icon-search');
                    $("#search-responsive").css("display", "none");
                    $("#header-bottom").css("display", "block");
                } else {
                    currentElement.removeClass('icon-menu-close');
                    $("#search-responsive").css("display", "none");
                    $("#header-bottom").css("display", "none");
                    if (currentElement.attr("id") == 'search') {
                        currentElement.addClass('icon-search');
                    } else {
                        currentElement.addClass('icon-menu');
                    }
                }
            }
        });
    </script>
@endpush
