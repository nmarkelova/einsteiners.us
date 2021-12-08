<div
    {{--
    @if($eventClickEnabled)
        wire:click.stop="onEventClick('{{ $event['id']  }}')"
    @endif
    --}}
    class="bg-white rounded-lg border py-2 px-3 shadow-md cursor-pointer">
    {{--
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
    --}}
    {{--
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
    @endif
    --}}

    @php
        $date = new DateTime($event['date_event']);
    @endphp
    <div id="cal-modal-{{ $event['id'] }}" class="uk-modal uk-modal-calendar uk-flex-top" data-uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
            <button class="uk-modal-close-default" type="button" uk-close></button>
    
            <div class="uk-image" data-src="{{ route('storage') }}/{{ $event['cover_path'] }}" data-uk-img></div>
            <div class="uk-content">
                <h2>{{ $event['name'] }}</h2>
                <div class="uk-date">
                    <div class="uk-flex uk-flex-middle">
                        <div class="uk-icon" data-uk-icon="icon: clock"></div>
                        &ensp;
                        <div>{{ __('LanBeginning') }} <span>{{--{{ date_format($date,"d.m") }}</span> {{ date_format($date,"Y") }}--}} {{ date_format($date,"H:s") }}</span></div>
                    </div>
                </div>
                <div class="uk-flex uk-flex-middle">
                    <div class="uk-icon" data-uk-icon="icon: location"></div>
                    &ensp;
                    <div>{{ $event['location'] ?? 'No description' }}</div>
                </div>
                <hr />
                <p>{{ $event['description'] ?? 'No description' }}</p>
            </div>
            <div class="uk-panel-callback">
                <p><strong>{{ __('LanSignFor') }} {{ $event['name'] }}</strong></p>


                <form id="callcal-{{ $event['id'] }}" wire:submit.prevent="sand({{ $event['id'] }})">
                    @csrf
                    <input type="hidden" data-value="{{ $event['name'] }} / {{ $event['date_event'] }}" wire:model="event_name" />
                    <div class="uk-line-elements">
                        <div class="uk-line uk-line-clean">
                            <input id="personal-{{ $event['id'] }}" wire:model="personal" type="text" class="uk-input" onkeydown="inputAction.call(this);inputLine.call(this);" required pattern="[А-Яа-яЁёA-z ]{2,}" />
                            <label for="personal-{{ $event['id'] }}"><span class="uk-icon" data-uk-icon="icon: user"></span> <i>*</i> {{ __('Name') }}</label>
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
                                <input id="phone-{{ $event['id'] }}" wire:model="phone" type="tel" class="uk-input uk-mask" onFocus="maskPhone.call(this);" onkeydown="inputAction.call(this);inputLine.call(this);" onClick="inputAction.call(this);inputLine.call(this);" placeholder="+7 (9__) ___-__-__" pattern="\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}" required="required">
                                <label for="phone-{{ $event['id'] }}"><span class="uk-icon" data-uk-icon="icon: receiver"></span> <i>*</i> {{ __('LanPhone') }}</label>
                                <span class="uk-border"></span>
                            </div>
                        @elseif (App::isLocale('en'))
                            <div class="uk-line uk-line-clean">
                                <input id="phone-{{ $event['id'] }}" wire:model="phone" type="tel" class="uk-input uk-mask" onFocus="maskPhone.call(this);" onkeydown="inputAction.call(this);inputLine.call(this);" onClick="inputAction.call(this);inputLine.call(this);" placeholder="+1 (___) ___-__-__" pattern="\+1\s?[\(]{0,1}[0-9][0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}" required="required">
                                <label for="phone-{{ $event['id'] }}"><span class="uk-icon" data-uk-icon="icon: receiver"></span> <i>*</i> {{ __('LanPhone') }}</label>
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
    </div>
    <p class="uk-title text-sm font-medium">
        {{ $event['name'] }}
    </p>
    <div class="uk-date">
        <div class="uk-flex uk-flex-middle">
            <div class="uk-icon" data-uk-icon="icon: clock"></div>
            &ensp;
            <div>{{--{{ date_format($date,"d.m") }}</span> {{ date_format($date,"Y") }}--}} {{ date_format($date,"H:s") }}</div>
        </div>
    </div>
    <div>
        <a href="#cal-modal-{{ $event['id'] }}" data-uk-toggle>{{ __('LanMore') }}</a>
    </div>

    @if($adminView)
        <div class="uk-flex uk-flex-middle">
            <div>
                <button class="uk-button uk-button-symbol" wire:click="edit({{ $event['id'] }})" data-uk-tooltip="title: {{ __('LanEdit') }}; pos: bottom">
                    <span class="uk-icon uk-update" data-uk-icon="icon: pencil" wire:ignore></span>
                </button>
            </div>
            <div>
                <button class="uk-button uk-button-symbol" wire:click="deleteConfirm({{ $event['id'] }})" data-uk-tooltip="title: {{ __('LanDelete') }}; pos: bottom">
                    <span class="uk-icon uk-update" data-uk-icon="icon: trash" wire:ignore></span>
                </button>
            </div>
        </div>
    @endif

</div>
