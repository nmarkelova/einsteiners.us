<div id="component">

    @if (session()->has('message'))
        <div class="uk-alert-success" data-uk-alert>
            <a class="uk-alert-close" data-uk-close></a>
            {{ session('message') }}
        </div>
    @endif
    @if (isset($_GET['create']))
        <script>
            document.addEventListener('livewire:load', function () {
                @this.create();
                window.history.pushState('1', 'Title', '/activities');
            });
        </script>
    @endif

    @if ($closeModal)
        <div>
            <script>
                UIkit.modal('#{{ $closeModal }}').hide();
            </script>
        </div>
    @endif

    @if ($confirmEvent)
        <div id="deleteevent" class="uk-modal uk-modal-event uk-open uk-flex-top" style="display: flex" data-uk-modal>
            <div class="uk-modal-dialog uk-margin-auto-vertical uk-modal-body uk-animation-slide-top">
                <button class="uk-modal-close-default" type="button" data-uk-close wire:ignore></button>
                <h2>{{ __('LanDeleteEvent') }}</h2>
                <div class="uk-grid uk-grid-small uk-flex uk-flex-center uk-flex-middle" data-uk-grid>
                    <div>
                        <button class="uk-button uk-modal-close" type="button">{{ __('LanNo') }}</button>
                    </div>
                    <div>
                        <button class="uk-button" wire:click.prevent="delete({{ $confirmEvent }})">{{ __('LanYes') }}</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($updateMode)
        <div id="editevent" class="uk-modal uk-modal-event uk-flex uk-flex-top uk-open" style="display: flex" data-uk-modal>
            <div class="uk-modal-dialog uk-margin-auto-vertical uk-modal-body uk-animation-slide-top">
                <button class="uk-modal-close-default" type="button" data-uk-close wire:ignore></button>
                <h2 class="uk-modal-title">
                    {{ __('LanEditEvent') }}
                </h2>
                <form wire:submit.prevent="update" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="uk-modal-body">
                        <div class="uk-grid uk-child-width-1-1 uk-grid-stack" data-uk-grid>
                            <div class="uk-first-column">
                                <div class="uk-line-input">
                                    <label><i>*</i> {{ __('lanEventName') }}</label>
                                    @error('name')
                                        <div class="uk-alert-danger" data-uk-alert>
                                            <a class="uk-alert-close" data-uk-close></a>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input type="text" wire:model.defer="name" class="uk-input">
                                </div>
                            </div>
                            @if ($previewMode)
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-previe">
                                    <img class="uk-cover" data-uk-cover src="{{ route('storage') }}/{{ $previewMode }}">
                                </div>
                            </div>
                            @else
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-previe">
                                    <img class="uk-cover" data-uk-cover src="{{ route('storage') }}/{{ $cover_path }}">
                                </div>
                            </div>
                            @endif
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-placeholder uk-placeholder-upload uk-text-center">
                                    <span class="uk-icon" data-uk-icon="icon: cloud-upload" wire:ignore></span>
                                    <span class="uk-text-middle">{{ __('LanUploadImage') }}</span>
                                    <div class="uk-form-custom" data-uk-form-custom>
                                        <input type="file" wire:model.defer="cover_path">
                                        <span class="uk-link">{{ __('LanUploadTo') }}</span>
                                    </div>
                                </div>
                            </div>
                            @error('cover_path')
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-alert-danger" data-uk-alert>
                                    <a class="uk-alert-close" data-uk-close></a>
                                    {{ $message }}
                                </div>
                            </div>
                            @enderror
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-line-input">
                                    <label><i>*</i> {{ __('LanAge') }}</label>
                                    @error('age')
                                        <div class="uk-alert-danger" data-uk-alert>
                                            <a class="uk-alert-close" data-uk-close></a>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <select wire:model="age" class="uk-select">
                                        <option value="{{ $age }}">{{ __($age) }}</option>
                                        <option value="0+">0+</option>
                                        <option value="6+">6+</option>
                                        <option value="10+">10+</option>
                                        <option value="12+">12+</option>
                                        <option value="16+">16+</option>
                                        <option value="18+">18+</option>
                                        @if (App::isLocale('en'))
                                            <option value="21+">21+</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            
                            <div class="uk-grid-margin uk-first-column">
                                <hr />
                                    <h4 class="uk-text-center">{{ __('LanDateLocation') }}</h4>
                                <hr />
                            </div>
                                <div class="uk-grid-margin uk-first-column">
                                    <div class="uk-line-input">
                                        <label><i>*</i> {{ __('lanEventDate') }}</label>
                                        @error('date_event')
                                            <div class="uk-alert-danger" data-uk-alert>
                                                <a class="uk-alert-close" data-uk-close></a>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        @php
                                            $datelocal = new DateTime($date_event);
                                        @endphp
                                        <input type="datetime-local" wire:model.defer="date_event" placeholder="@php echo date_format($datelocal,"d.m.Y H:i") @endphp" class="uk-input">
                                    </div>
                                </div>
                                
                                
                                <div class="uk-grid-margin uk-first-column">
                                    <div class="uk-line-input">
                                        <label><i>*</i> {{ __('lanEventLocation') }}</label>
                                        @error('location')
                                            <div class="uk-alert-danger" data-uk-alert>
                                                <a class="uk-alert-close" data-uk-close></a>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <input type="text" wire:model.defer="location" class="uk-input">
                                    </div>
                                </div>
                            <div class="uk-grid-margin uk-first-column">
                                <hr />
                            </div>

                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-line-input">
                                    <label><i>*</i> {{ __('lanDescription') }}</label>
                                    @error('description')
                                        <div class="uk-alert-danger" data-uk-alert>
                                            <a class="uk-alert-close" data-uk-close></a>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <textarea wire:model.defer="description" class="uk-textarea" rows="3"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="uk-modal-footer">
                        <div class="uk-button uk-button-submit">
                            <input type="submit" value="{{ __('LanSaveUpdate') }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{--
        @include('livewire.event.edit')
        --}}
    @else
        @if ($createMode)
        <div id="crevent" class="uk-modal uk-modal-event uk-flex-top uk-open" style="display: flex" data-uk-modal>
            <div class="uk-modal-dialog uk-margin-auto-vertical uk-modal-body uk-animation-slide-top">
                <button class="uk-modal-close-default" type="button" data-uk-close wire:ignore></button>
                <h2 class="uk-modal-title">
                    {{ __('LanCreateEvent') }}
                </h2>
                <form wire:submit.prevent="store" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="uk-modal-body">

                        <div class="uk-grid uk-child-width-1-1 uk-grid-stack" data-uk-grid>
                            <div class="uk-first-column">
                                <div class="uk-line-input">
                                    <label><i>*</i> {{ __('lanEventName') }}</label>
                                    @error('name')
                                        <div class="uk-alert-danger" data-uk-alert>
                                            <a class="uk-alert-close" data-uk-close></a>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input type="text" wire:model.defer="name" class="uk-input">
                                </div>
                            </div>
                            @if ($previewAddMode)
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-previe" wire:loading.class="bg-gray">
                                    <img class="uk-cover" data-uk-cover src="{{ route('storage') }}/{{ $previewAddMode }}">
                                </div>
                            </div>
                            @endif
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-placeholder uk-placeholder-upload uk-text-center">
                                    <span class="uk-icon" data-uk-icon="icon: cloud-upload" wire:ignore></span>
                                    <span class="uk-text-middle">{{ __('LanUploadImage') }}</span>
                                    <div class="uk-form-custom" data-uk-form-custom>
                                        <input type="file" wire:model.defer="cover_add">
                                        <span class="uk-link">{{ __('LanUploadTo') }}</span>
                                    </div>
                                </div>
                            </div>
                            @error('cover_add')
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-alert-danger" data-uk-alert>
                                    <a class="uk-alert-close" data-uk-close></a>
                                    {{ $message }}
                                </div>
                            </div>
                            @enderror
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-line-input">
                                    <label><i>*</i> {{ __('LanAge') }}</label>
                                    @error('age')
                                        <div class="uk-alert-danger" data-uk-alert>
                                            <a class="uk-alert-close" data-uk-close></a>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <select wire:model="age" class="uk-select">
                                        <option value="">{{ __('LanSelectAge') }}</option>
                                        <option value="0+">0+</option>
                                        <option value="6+">6+</option>
                                        <option value="10+">10+</option>
                                        <option value="12+">12+</option>
                                        <option value="16+">16+</option>
                                        <option value="18+">18+</option>
                                        @if (App::isLocale('en'))
                                            <option value="21+">21+</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="uk-grid-margin uk-first-column">
                                <hr />
                                    <h4 class="uk-text-center">{{ __('LanDateLocation') }}</h4>
                                <hr />
                            </div>
                                <div class="uk-grid-margin uk-first-column">
                                    <div class="uk-line-input">
                                        <label><i>*</i> {{ __('lanEventDate') }}</label>
                                        @error('date_event')
                                            <div class="uk-alert-danger" data-uk-alert>
                                                <a class="uk-alert-close" data-uk-close></a>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <input type="datetime-local" wire:model.defer="date_event" class="uk-input">
                                    </div>
                                </div>
                        
                                <div class="uk-grid-margin uk-first-column">
                                    <div class="uk-line-input">
                                        <label><i>*</i> {{ __('lanEventLocation') }}</label>
                                        @error('location')
                                            <div class="uk-alert-danger" data-uk-alert>
                                                <a class="uk-alert-close" data-uk-close></a>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <input type="text" wire:model.defer="location" class="uk-input">
                                    </div>
                                </div>
                            

                            <div class="uk-grid-margin uk-first-column">
                                <hr />
                            </div>
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-line-input">
                                    <label><i>*</i> {{ __('lanDescription') }}</label>
                                    @error('description')
                                        <div class="uk-alert-danger" data-uk-alert>
                                            <a class="uk-alert-close" data-uk-close></a>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <textarea wire:model.defer="description" class="uk-textarea" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-modal-footer">
                        <div class="uk-button uk-button-submit">
                            <input type="submit" value="{{ __('LanCreateEvent') }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endif
        {{--
        @include('livewire.event.create')
        --}}
    @endif

    @if($callbackModal)
        <div id="crevent" class="uk-modal uk-modal-callback uk-modal-event uk-flex-top uk-open" style="display: flex" data-uk-modal>
            <div class="uk-modal-dialog uk-margin-auto-vertical uk-modal-body uk-animation-slide-top">
                <button class="uk-modal-close-default" type="button" data-uk-close wire:ignore></button>
                <div class="uk-image" data-src="{{ route('storage') }}/{{ $select_calendars->cover_path }}" data-uk-img></div>
                <h2>{{ $select_calendars->name }}</h2>
                <p>{{ $select_calendars->description }}</p>

                <form wire:submit.prevent="sand({{ $select_calendars['id'] }})">
                    @csrf
                    <div class="uk-line-elements">
                        <div class="uk-line uk-line-clean">
                            <input id="personal-{{ $select_calendars['id'] }}" wire:model="personal" type="text" class="uk-input" onkeydown="inputAction.call(this);inputLine.call(this);" required pattern="[А-Яа-яЁёA-z ]{2,}" />
                            <label for="personal-{{ $select_calendars['id'] }}"><span class="uk-icon" data-uk-icon="icon: user"></span> <i>*</i> {{ __('Name') }}</label>
                            <span class="uk-border"></span>
                        </div>
                        @error('personal')
                            <div class="uk-alert-danger" data-uk-alert>
                                <a class="uk-alert-close" data-uk-close></a>
                                {{ $message }}
                            </div>
                        @enderror
                        @if (App::isLocale('ru'))
                            <div class="uk-line uk-line-clean">
                                <input id="phone-{{ $select_calendars['id'] }}" wire:model="phone" type="tel" class="uk-input uk-mask" onFocus="maskPhone.call(this);" onkeydown="inputAction.call(this);inputLine.call(this);" onClick="inputAction.call(this);inputLine.call(this);" placeholder="+7 (9__) ___-__-__" pattern="\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}" required="required">
                                <label for="phone-{{ $select_calendars['id'] }}"><span class="uk-icon" data-uk-icon="icon: receiver"></span> <i>*</i> {{ __('LanPhone') }}</label>
                                <span class="uk-border"></span>
                            </div>
                        @elseif (App::isLocale('en'))
                            <div class="uk-line uk-line-clean">
                                <input id="phone-{{ $select_calendars['id'] }}" wire:model="phone" type="tel" class="uk-input uk-mask" onFocus="maskPhone.call(this);" onkeydown="inputAction.call(this);inputLine.call(this);" onClick="inputAction.call(this);inputLine.call(this);" placeholder="+1 (___) ___-__-__" pattern="\+1\s?[\(]{0,1}[0-9][0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}" required="required">
                                <label for="phone-{{ $select_calendars['id'] }}"><span class="uk-icon" data-uk-icon="icon: receiver"></span> <i>*</i> {{ __('LanPhone') }}</label>
                                <span class="uk-border"></span>
                            </div>
                        @endif
                        @error('phone')
                            <div class="uk-alert-danger" data-uk-alert>
                                <a class="uk-alert-close" data-uk-close></a>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="uk-text-center">
                        <input class="uk-button-callback" type="submit" value="{{ __('LanSand') }}">
                    </div>
                    <div class="uk-block-notification uk-text-center">
                        {{ __('LanPoli1') }} <a class="uk-consent" href="#consent" data-uk-toggle onClick="showContent.call(this);event.preventDefault();" data-link="con-consent" data-load="consentloading" data-position="consentBody">{{ __('LanPoli2') }}</a>.
                    </div>
                </form>


            </div>
        </div>
    @endif

    @if($adminView)
        <div class="uk-text-center uk-margin">
            <div class="uk-button-card uk-button uk-button-mobile-large">
                <a href="/" wire:click.prevent="create()">{{ __('LanCreateEvent') }}</a>
            </div>
        </div>
    @endif
    
    <div class="uk-position-relative">
        <div class="uk-loading" wire:loading.flex>
            <span class="uk-spinner uk-icon" data-uk-spinner wire:ignore></span>
        </div>
        <div class="uk-list-event uk-grid uk-child-width-1-3@m uk-grid-small" data-uk-grid data-uk-height-match="target: > div > .uk-card">
            @foreach ($calendars as $calendar)
                @php
                    $date = new DateTime($calendar->date_event);
                @endphp
                <div>
                    <div class="uk-card">
                        <div class="uk-image" data-src="{{ route('storage') }}/{{ $calendar->cover_path }}" data-uk-img>
                            @if($calendar->age)
                                <span>{{ $calendar->age }}</span>
                            @endif
                        </div>
                        @if($calendar->date_event > date('Y-m-d H:i:s'))
                            <div class="uk-panel-time" wire:ignore>
                                <div class="uk-grid uk-grid-small uk-child-width-auto" data-uk-grid data-uk-countdown="date: @php echo date_format($date,"Y-m-d") . "T" . date_format($date,"h:m:s"); @endphp">
                                    <div>
                                        <div class="uk-countdown-number uk-countdown-days"></div>
                                        <div class="uk-countdown-label uk-margin-small uk-text-center">{{ __('LanDays') }}</div>
                                    </div>
                                    <div class="uk-countdown-separator">:</div>
                                    <div>
                                        <div class="uk-countdown-number uk-countdown-hours"></div>
                                        <div class="uk-countdown-label uk-margin-small uk-text-center">{{ __('LanHourse') }}</div>
                                    </div>
                                    <div class="uk-countdown-separator">:</div>
                                    <div>
                                        <div class="uk-countdown-number uk-countdown-minutes"></div>
                                        <div class="uk-countdown-label uk-margin-small uk-text-center">{{ __('LanMinutes') }}</div>
                                    </div>
                                    <div class="uk-countdown-separator">:</div>
                                    <div>
                                        <div class="uk-countdown-number uk-countdown-seconds"></div>
                                        <div class="uk-countdown-label uk-margin-small uk-text-center">{{ __('LanSecond') }}</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="uk-content">
                            <div class="uk-date">
                                <span>{{ date_format($date,"d.m") }}</span> {{ date_format($date,"Y") }}, {{ date_format($date,"H:s") }}
                            </div>
                            <h2>{{ $calendar->name }}</h2>
                            <ul class="uk-list" wire:ignore>
                                <li>{{ __('LanPlace') }}:
                                    <span>{{ $calendar->location }}</span>
                                </li>
                            </ul>
                            <div class="uk-grid uk-margin-top uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
                                <div class="uk-width-1-2@xs">
                                    <button class="uk-button uk-button-symbol" wire:click="callbackModal({{ $calendar->id }})">
                                        {{ __('LanSingup') }}
                                    </button>
                                </div>
                                @if ($adminView)
                                    <div class="uk-width-1-4@xs">
                                        <button class="uk-button uk-button-symbol" wire:click="edit({{ $calendar->id }})" data-uk-tooltip="title: {{ __('LanEdit') }}; pos: bottom">
                                            <span class="uk-icon uk-update" data-uk-icon="icon: pencil" wire:ignore></span>
                                        </button>
                                    </div>
                                    <div class="uk-width-1-4@xs">
                                        <button class="uk-button uk-button-symbol" wire:click="deleteConfirm({{ $calendar->id }})" data-uk-tooltip="title: {{ __('LanDelete') }}; pos: bottom">
                                            <span class="uk-icon uk-update" data-uk-icon="icon: trash" wire:ignore></span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{--
        {{ $calendars->links() }}
        --}}
    </div>
</div>