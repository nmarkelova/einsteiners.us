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
                window.history.pushState('1', 'Title', '/agreement');
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
                                    <label><i>*</i> {{ __('lanAgreementName') }}</label>
                                    @error('name')
                                        <div class="uk-alert-danger" data-uk-alert>
                                            <a class="uk-alert-close" data-uk-close></a>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input type="text" wire:model.defer="name" class="uk-input">
                                </div>
                            </div>
                            {{-- Test --}}
                            @if ($previewMode)
                                <div class="uk-grid-margin uk-first-column">
                                    <div class="uk-document-load">
                                        <iframe src="{{ route('storage') }}/{{ $previewMode }}" width="100%" height="300"></iframe>
                                    </div>
                                </div>
                            @else
                                <div class="uk-grid-margin uk-first-column">
                                    <div class="uk-document-load">
                                        <iframe src="{{ route('storage') }}/{{ $cover_path }}" width="100%" height="300"></iframe>
                                    </div>
                                </div>
                            @endif
                            {{-- Test --}}
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-placeholder uk-placeholder-upload uk-text-center">
                                    <span class="uk-icon" data-uk-icon="icon: cloud-upload" wire:ignore></span>
                                    <span class="uk-text-middle">{{ __('LanUploadAgreement') }}</span>
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
                    {{ __('LanCreateAgreement') }}
                </h2>
                <form wire:submit.prevent="store" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="uk-modal-body">
                        <div class="uk-grid uk-child-width-1-1 uk-grid-stack" data-uk-grid>
                            <div class="uk-first-column">
                                <div class="uk-line-input">
                                    <label><i>*</i> {{ __('lanAgreementName') }}</label>
                                    @error('name')
                                        <div class="uk-alert-danger" data-uk-alert>
                                            <a class="uk-alert-close" data-uk-close></a>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input type="text" wire:model.defer="name" class="uk-input">
                                </div>
                            </div>
                            {{-- Test --}}
                            @if ($previewAddMode)
                                <div class="uk-grid-margin uk-first-column">
                                    <div class="uk-document-load" wire:loading.class="bg-gray">
                                        <iframe src="{{ route('storage') }}/{{ $previewAddMode }}" width="100%" height="300"></iframe>
                                    </div>
                                </div>
                            @endif
                            {{-- Test --}}
                                <div class="uk-grid-margin uk-first-column">
                                    <div class="uk-placeholder uk-placeholder-upload uk-text-center">
                                        <span class="uk-icon" data-uk-icon="icon: cloud-upload" wire:ignore></span>
                                        <span class="uk-text-middle">{{ __('LanUploadAgreement') }}</span>
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
                            <input type="submit" value="{{ __('LanCreateAgreement') }}">
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
                <h2>{{ __('lanAgreementClean') }}</h2>
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
                        <div class="uk-image uk-document-name">
                            <iframe src="{{ route('storage') }}/{{ $agreement->cover_path }}" width="100%" height="300"></iframe>
                        </div>
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

    <div class="uk-text-center uk-margin-top">
        <div class="uk-button-card uk-button">
            <a href="{{ route('agreement') }}?create=1">{{ __('LanCreateAgreement') }}</a>
        </div>
    </div>

</div>