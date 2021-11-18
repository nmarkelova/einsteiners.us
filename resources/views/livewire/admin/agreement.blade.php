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
                window.history.pushState('1', 'Title', '/events');
            });
        </script>
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

    @if(count($agreements) == 0)
        <div class="uk-screen-clean uk-flex uk-flex-middle uk-flex-center">
            <div class="uk-text-center">
                <div>
                    <span class="uk-icon" data-uk-icon="icon: album; ratio: 2"></span>
                </div>
                <h2>{{ __('lanEventClean') }}</h2>
                <p>{{ __('lanEventCleanDesk') }}</p>
                <div class="uk-button-card uk-button">
                    <a href="{{ route('personal-events') }}?create=1">{{ __('LanCreateEvent') }}</a>
                </div>
            </div>
        </div>
    @endif

    <div class="uk-grid uk-grid-small uk-child-width-1-1@m" data-uk-grid>
        @foreach ($agreements as $agreement)
            <div id="element-{{ $agreement->id }}">
                <div class="uk-panel">
                    <div class="uk-loading" wire:loading.flex wire:target="delete({{ $agreement->id }})">
                        <span data-uk-spinner></span>
                    </div>
                    @if($agreement['cover_path'])
                        <div class="uk-image" data-src="{{ route('storage') }}/{{ $agreement->cover_path }}" data-uk-img></div>
                    @endif
                    <div class="uk-content">
                        <div class="uk-grid uk-flex uk-flex-middle" data-uk-grid>
                            <div class="uk-width-expand@m">
                                <div class="uk-grid uk-grid-small uk-child-width-1-2@m uk-flex uk-flex-middle"" data-uk-grid>
                                    <div>
                                        <div class="uk-grid uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
                                            <div>
                                                <h2>{{ $agreement->name }}</h2>  
                                            </div>
                                            <div>
                                                <button class="uk-button uk-button-symbol" wire:click="edit({{ $agreement->id }})" data-uk-tooltip="title: {{ __('LanEdit') }}; pos: bottom">
                                                    <span class="uk-icon uk-update" data-uk-icon="icon: pencil" wire:ignore></span>
                                                </button>
                                            </div>
                                            <div>
                                                <button class="uk-button uk-button-symbol" wire:click="deleteConfirm({{ $agreement->id }})" data-uk-tooltip="title: {{ __('LanDelete') }}; pos: bottom">
                                                    <span class="uk-icon uk-update" data-uk-icon="icon: trash" wire:ignore></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>