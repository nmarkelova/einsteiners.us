<div>
    <ul class="uk-lang">
        <li @if (empty(Cookie::get('lang')) || Cookie::get('lang') == 'en') class="uk-active" @endif>
            <a href="{{ url('/lang/en') }}">EN</a>
        </li>
        <li @if (Cookie::get('lang') == 'ru') class="uk-active" @endif>
            <a href="{{ url('/lang/ru') }}">RU</a>
        </li>
    </ul>
    <ul class="uk-menu" uk-scrollspy="target: > li; cls:uk-animation-slide-left; delay: 100; repeat: true">
        <li class="{{ request()->is('list') ? 'uk-active' : null }}">
            <a class="uk-accordion-title" href="{{ route('list') }}">{{ __('lanEventsVendor') }}</a>
        </li>
        <li class="{{ request()->is('calendarlist') ? 'uk-active' : null }}">
            <a href="{{ route('calendarlist') }}">{{ __('LanCalendar') }}</a>
        </li>
        {{--
        <li class="{{ request()->is('service') ? 'uk-active' : null }}">
            <a href="{{ route('service') }}">{{ __('LanService') }}</a>
        </li>
        --}}
        {{--
        <li class="{{ request()->is('help') ? 'uk-active' : null }}">
            <a href="{{ route('help') }}">{{ __('LanHelp') }}</a>
        </li>
        --}}
        <li class="{{ request()->is('birtrhday') ? 'uk-active' : null }}">
            <a href="{{ route('birtrhday') }}">{{ __('LanBirtrhday') }}</a>
        </li>
        {{--
        <li class="{{ request()->is('conditions') ? 'uk-active' : null }}">
            <a href="{{ route('conditions') }}">{{ __('LanConditions') }}</a>
        </li>
        --}}
        <li class="{{ request()->is('contact') ? 'uk-active' : null }}">
            <a href="{{ route('contact') }}">{{ __('LanContact') }}</a>
        </li>
    </ul>
    <div>
        @auth
            <strong><small>{{ __('Manage Account') }}</small></strong>
            <hr />
            <ul class="uk-nav uk-dropdown-nav">
                @php
                    $endDate = date("Y-m-d H:i:s", strtotime('+30 days', strtotime(Auth::user()->past_paymant)));
                    $subDate = substr($endDate,0,10);
                    $daysDate = ceil((strtotime($subDate)-time())/86400);
                @endphp
                @if (Auth::user()->role_id == 1)
                    @if (Auth::user()->past_paymant !== null && strtotime($endDate) > date('Y-m-d H:i:s'))
                        <li>
                            <a href="{{ route('personal-activities') }}">
                                <span data-uk-icon="plus-circle"></span> {{ __('LanСreateMassEvent') }}
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="#" class="uk-link-muted" data-uk-tooltip="title: {{ __('lanPaymantStatus') }}; pos: bottom">
                                <span data-uk-icon="cart"></span> {{ __('LanСreatePayment') }}
                            </a>
                        </li>
                        <li>
                            <a href="#" class="uk-link-muted" data-uk-tooltip="title: {{ __('lanPaymantStatus') }}; pos: bottom">
                                <span data-uk-icon="plus-circle"></span> {{ __('LanСreateMassEvent') }}
                            </a>
                        </li>
                    @endif
                @endif
                <li>
                    <a href="{{ route('personal-events') }}">
                        <span data-uk-icon="plus-circle"></span> {{ __('LanCreateEvent') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('personal-events') }}">
                        <span data-uk-icon="album"></span> {{ __('LanMyEvents') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.show') }}">
                        <span data-uk-icon="user"></span> {{ __('Profile') }}
                    </a>
                </li>
                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <li>
                        <a href="{{ route('api-tokens.index') }}">
                            {{ __('API Tokens') }}
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role_id == 3)
                    <li>
                        <a href="{{ route('agreement') }}">
                            <span data-uk-icon="album"></span> {{ __('LanListAgreement') }}
                        </a>
                    </li>
                @endif
            </ul>
            <hr />
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();">
                    <span data-uk-icon="sign-out"></span> {{ __('Log Out') }}
                </x-jet-dropdown-link>
            </form>
            @else
            <br />
            <a class="uk-login-link" href="{{ route('login') }}" data-uk-toggle=""><span data-uk-icon="icon: sign-in"></span> {{ __('Login') }}</a>
            @if (Route::has('register'))
                <span>/</span>
                <a href="{{ route('register') }}" data-uk-toggle="">{{ __('Register') }}</a>
            @endif
        @endauth
    </div>
</div>