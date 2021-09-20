<div>
    @if ($confirmGift)
        <div id="giftevent" class="uk-modal uk-modal-event uk-open uk-flex-top" style="display: flex" data-uk-modal>
            <div class="uk-modal-dialog uk-margin-auto-vertical uk-modal-body uk-animation-slide-top">
                <button class="uk-modal-close-default" type="button" data-uk-close wire:ignore></button>
                <h2>{{ __('LangDeleteGift') }}</h2>
                <div class="uk-grid uk-grid-small uk-flex uk-flex-center uk-flex-middle" data-uk-grid>
                    <div>
                        <button class="uk-button uk-modal-close" type="button">{{ __('LanNo') }}</button>
                    </div>
                    <div>
                        <button class="uk-button" wire:click.prevent="delete({{ $confirmGift }})">{{ __('LanYes') }}</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="uk-panel-gift">
        <div class="uk-grid uk-grid-small" data-uk-grid>
            <div class="uk-width-1-1@m">
                @if (session()->has('message-gift'))
                    <div class="uk-alert-success" data-uk-alert>
                        <a class="uk-alert-close" data-uk-close></a>
                        {{ session('message-gift') }}
                    </div>
                @endif
                <div>
                    <div class="uk-slider" data-uk-slider="finite: true">
                        <ul class="uk-slider-items uk-grid uk-grid-small" data-uk-grid data-uk-height-match="target: > li > .uk-card">
                            @if (!$addMode)
                            <li>
                                <div class="uk-card uk-flex uk-flex-middle uk-flex-center" wire:click="add({{ $event_id }})" wire:ignore>
                                    <span data-uk-icon="icon: plus; ratio: 2.5" wire:ignore></span>
                                </div>
                            </li>
                            @endif
                            @foreach ($gifts as $gift)
                                <li>
                                    <div class="uk-card uk-gift">
                                        <div class="uk-loading" wire:loading.flex wire:target="delete({{ $gift->id }})">
                                            <span data-uk-spinner></span>
                                        </div>
                                        @if($gift->cover_path)
                                            <div class="uk-gift-image">
                                                <div data-src="{{ route('storage') }}/{{ $gift->cover_path }}" data-uk-img></div>
                                            </div>
                                        @endif
                                        <p>{{ $gift->name }}</p>
                                        <div class="uk-grid uk-grid-small uk-flex uk-flex-middle uk-flex-center" data-uk-grid>
                                            @if($gift->link_market)
                                                <div>
                                                    <a class="uk-button" href="{{ $gift->link_market }}" target="_blank" data-uk-tooltip="title: {{ __('LanLinkMarket') }}; pos: bottom">
                                                        <span class="uk-icon" data-uk-icon="link" wire:ignore></span>
                                                    </a>
                                                </div>
                                            @endif
                                            @if($gift->description)
                                                <div>
                                                    <button class="uk-button" data-description="<h2>{{ $gift->name }}</h2><br /> {{ $gift->description }}" onclick="DescriptionGift.call(this)" data-uk-tooltip="title: {{ __('LanGiftDes') }}; pos: bottom">
                                                        <span class="uk-icon" data-uk-icon="question" wire:ignore></span>
                                                    </button>
                                                </div>
                                            @endif
                                            <div>
                                                <button class="uk-button uk-button-symbol" wire:click="edit({{ $gift->id }})" data-uk-tooltip="title: {{ __('LanEdit') }}; pos: bottom">
                                                    <span class="uk-icon" data-uk-icon="icon: pencil" wire:ignore></span>
                                                </button>
                                            </div>
                                            <div>
                                                <button class="uk-button uk-button-symbol" wire:click="deleteConfirm({{ $gift->id }})" data-uk-tooltip="title: {{ __('LanDelete') }}; pos: bottom">
                                                    <span class="uk-icon" data-uk-icon="icon: trash" wire:ignore></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <ul class="uk-slider-nav uk-dotnav uk-grid uk-grid-collapse uk-child-width-expand"></ul>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1@m">
                @if ($addMode)
                    <div class="uk-card-sand uk-card-sand-gift">
                        @if ($updateMode)
                            <div>
                                <form wire:submit.prevent="update" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="uk-grid uk-grid-small uk-child-width-1-1@m" data-uk-grid>
                                        <div>
                                            <div class="uk-line-input">
                                                <label><i>*</i> {{ __('LanGiftName') }}</label>
                                                @error('name')
                                                    <div class="uk-alert-danger" data-uk-alert>
                                                        <a class="uk-alert-close" data-uk-close></a>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <input class="uk-input" wire:model.defer="name" type="text"/>
                                            </div>
                                        </div>
                                        <div>

                                            @if ($previewMode)
                                                <div class="uk-previe">
                                                    <img class="uk-cover" data-uk-cover src="{{ route('storage') }}/{{ $previewMode }}">
                                                </div>
                                            @else
                                                <div class="uk-previe">
                                                    <img class="uk-cover" data-uk-cover src="{{ route('storage') }}/{{ $cover_path }}">
                                                </div>
                                            @endif
                                            <div class="uk-placeholder uk-placeholder-upload uk-text-center">
                                                <span class="uk-icon" data-uk-icon="icon: cloud-upload" wire:ignore></span>
                                                <span class="uk-text-middle">{{ __('LanUploadImage') }}</span>
                                                <div class="uk-form-custom" data-uk-form-custom>
                                                    <input type="file" wire:model.defer="cover_path">
                                                    <span class="uk-link">{{ __('LanUploadTo') }}</span>
                                                </div>
                                            </div>
                                            @error('cover_path')
                                                <div class="uk-alert-danger" data-uk-alert>
                                                    <a class="uk-alert-close" data-uk-close></a>
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>
                                        <div>
                                            <div class="uk-line-input">
                                                <label><i>*</i> {{ __('lanDescription') }}</label>
                                                @error('description')
                                                    <div class="uk-alert-danger" data-uk-alert>
                                                        <a class="uk-alert-close" data-uk-close></a>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <textarea class="uk-textarea" wire:model.defer="description" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="uk-line-input">
                                                <label><i>*</i> {{ __('LanLinkMarket') }}</label>
                                                @error('link_market')
                                                    <div class="uk-alert-danger" data-uk-alert>
                                                        <a class="uk-alert-close" data-uk-close></a>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <input class="uk-input" wire:model.defer="link_market" type="text"/>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="uk-text-center">
                                                <div class="uk-button uk-button-submit">
                                                    <input type="submit" value="{{ __('LanSaveUpdate') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div>
                                <form wire:submit.prevent="store" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="uk-grid uk-grid-small uk-child-width-1-1@m" data-uk-grid>
                                        <div>
                                            <div class="uk-line-input">
                                                <label><i>*</i> {{ __('LanGiftName') }}</label>
                                                @error('name')
                                                    <div class="uk-alert-danger" data-uk-alert>
                                                        <a class="uk-alert-close" data-uk-close></a>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <input class="uk-input" wire:model.defer="name" type="text"/>
                                            </div>
                                        </div>
                                        <div>
                                            
                                            @if ($previewAddMode)
                                                <div class="uk-previe">
                                                    <img class="uk-cover" data-uk-cover src="{{ route('storage') }}/{{ $previewAddMode }}">
                                                </div>
                                            @endif
                                            <div class="uk-placeholder uk-placeholder-upload uk-text-center">
                                                <span class="uk-icon" data-uk-icon="icon: cloud-upload" wire:ignore></span>
                                                <span class="uk-text-middle">{{ __('LanUploadImage') }}</span>
                                                <div class="uk-form-custom" data-uk-form-custom>
                                                    <input type="file" wire:model.defer="cover_add">
                                                    <span class="uk-link">{{ __('LanUploadTo') }}</span>
                                                </div>
                                            </div>
                                            @error('cover_add')
                                                <div class="uk-alert-danger" data-uk-alert>
                                                    <a class="uk-alert-close" data-uk-close></a>
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>
                                        <div>
                                            <div class="uk-line-input">
                                                <label><i>*</i> {{ __('lanDescription') }}</label>
                                                @error('description')
                                                    <div class="uk-alert-danger" data-uk-alert>
                                                        <a class="uk-alert-close" data-uk-close></a>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <textarea class="uk-textarea" wire:model.defer="description" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="uk-line-input">
                                                <label><i>*</i> {{ __('LanLinkMarket') }}</label>
                                                @error('link_market')
                                                    <div class="uk-alert-danger" data-uk-alert>
                                                        <a class="uk-alert-close" data-uk-close></a>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <input class="uk-input" wire:model.defer="link_market" type="text"/>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="uk-text-center">
                                                <div class="uk-button uk-button-submit">
                                                    <input type="submit" value="{{ __('LanCreateGift') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


