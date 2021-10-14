<div>
    <div class="uk-search">
        <form method="POST" wire:submit.prevent="search">
            @csrf
            <div class="uk-grid uk-grid-small">
                <div class="uk-width-4-5@xs">
                    <div class="uk-search-input">
                        <div class="uk-inline">
                            <span class="uk-form-icon" data-uk-icon="icon: search" wire:ignore></span>
                            <input type="text" wire:model="searchEvents" class="uk-input" placeholder="{{ __('LanEventOrAutor') }}">
                        </div>
                    </div>
                </div>
                {{--
                <div class="uk-width-2-5@xs">
                    @if(!$selectedCountry)
                    <div class="uk-search-input">
                        <div class="uk-inline">
                            <span class="uk-form-icon uk-icon" data-uk-icon="icon: location" wire:ignore></span>
                            <select wire:model.defer="countrie_id" wire:change="selectedCountry" class="uk-select">
                                <option value="">{{ __('LanSelectCountry') }}</option>
                                @foreach ($countries as $countrie)
                                    <option value="{{ $countrie->id }}"><span>{{ __($countrie->name) }}</span></option>
                                @endforeach
                            </select>
                        </div>
                        @error('countrie_id')
                            <div class="uk-alert-danger" data-uk-alert>
                                <a class="uk-alert-close" data-uk-close></a>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    @endif
                    @if($selectedCountry || $countrie_id)
                        <div class="uk-search-input">
                            <div class="uk-inline">
                                <span class="uk-form-icon uk-icon" data-uk-icon="icon: location" wire:ignore></span>
                                <select wire:model.defer="citie_id" class="uk-select">
                                    <option value="">{{ __('LanSelectCity') }}</option>
                                    @foreach ($cities as $citie)
                                        <option value="{{ $citie->id }}">{{ __($citie->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('citie_id')
                                <div class="uk-alert-danger" data-uk-alert>
                                    <a class="uk-alert-close" data-uk-close></a>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endif
                    {{--
                    <div class="uk-search-input">
                        <div class="uk-inline">
                            <span class="uk-form-icon" data-uk-icon="icon: location"></span>
                            <input type="text" wire:model="searchCity" class="uk-input" placeholder="{{ __('LanCity') }}">
                        </div>
                    </div>
                    -}}
                </div>
                --}}
                <div class="uk-width-1-5@xs">
                    <input class="uk-button-search" type="submit" value="{{ __('LanSerach') }}">
                </div>
            </div>
        </form>


        @if($searchResult)
            <div class="uk-dropdown uk-result">
                <span class="uk-icon uk-clean" data-uk-icon="icon: close" wire:click.prevent="clean" wire:ignore></span>
                <h2>{{ __('LanSearchResult') }}</h2>

                @if(count($events) == 0)
                    <h4>{{ __('LanSearchPersonal') }}:</h4> <small>{{ __('LanSearchNoResult') }}</small>
                @else
                    <h4>{{ __('LanSearchPersonal') }}:</h4>
                    <div class="uk-list-search uk-grid uk-child-width-1-1@m uk-grid-small uk-grid-stack" data-uk-grid data-uk-height-match="target: > div > .uk-card">
                        @foreach ($events as $event)
                            @php
                                $date = new DateTime($event['date_event']);
                            @endphp
                            <div>
                                <div class="uk-card uk-flex uk-flex-middle uk-grid-small" data-uk-grid>
                                    <div>
                                        <a href="@php echo url('/') @endphp/event/view/{{ $event->link }}" title="{{ $event->name }}">
                                            {{ $event->name }}
                                        </a>
                                    </div>
                                    <div class="uk-date">{{ date_format($date,"d.m") }}</span> {{ date_format($date,"Y") }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <hr />
                @if(count($activities) == 0)
                    <h4>{{ __('LanSearchVendor') }}:</h4> <small>{{ __('LanSearchNoResult') }}</small>
                @else
                    <h4>{{ __('LanSearchVendor') }}:</h4>
                    <div class="uk-list-search uk-grid uk-child-width-1-1@m uk-grid-small uk-grid-stack" data-uk-grid data-uk-height-match="target: > div > .uk-card">
                        @foreach ($activities as $activitie)
                            @php
                                $date = new DateTime($activitie['date_event']);
                            @endphp
                            <div>
                                <div class="uk-card uk-flex uk-flex-middle uk-grid-small" data-uk-grid>
                                    <div>
                                        <a href="@php echo url('/') @endphp/activities/{{ $activitie->id }}">
                                            {{ $activitie->name }}
                                        </a>
                                    </div>
                                    <div class="uk-date">{{ date_format($date,"d.m") }}</span> {{ date_format($date,"Y") }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        @endif
    </div>
</div>