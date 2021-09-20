{{--
<div>
    <div id="editevent" class="uk-modal uk-flex-top uk-open" style="display: block" data-uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-animation-slide-top">
            <button class="uk-modal-close-default" type="button" data-uk-close wire:ignore></button>
            <h2 class="uk-modal-title">
                Редактировать событие
            </h2>
            <form wire:submit.prevent="update" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="uk-modal-body">
                    <div class="uk-line-input">
                        <label><i>*</i> Название события</label>
                        @error('name')
                            <div class="uk-alert-danger" data-uk-alert>
                                <a class="uk-alert-close" data-uk-close></a>
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="text" wire:model="name" class="uk-input">
                    </div>

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
                        <span class="uk-text-middle">Загрузите изображение обложки</span>
                        <div class="uk-form-custom" data-uk-form-custom>
                            <input type="file" wire:model="cover_path">
                            <span class="uk-link">здесь</span>
                        </div>
                    </div>
                    @error('cover_path')
                        <div class="uk-alert-danger" data-uk-alert>
                            <a class="uk-alert-close" data-uk-close></a>
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="uk-line-input">
                        <label><i>*</i> Дата события</label>
                        @error('date_event')
                            <div class="uk-alert-danger" data-uk-alert>
                                <a class="uk-alert-close" data-uk-close></a>
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="datetime-local" wire:model="date_event" class="uk-input">
                    </div>
                    <div class="uk-line-input">
                        <label><i>*</i> Место проведения</label>
                        @error('location')
                            <div class="uk-alert-danger" data-uk-alert>
                                <a class="uk-alert-close" data-uk-close></a>
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="text" wire:model="location" class="uk-input">
                    </div>
                    <div class="uk-line-input">
                        <label><i>*</i> Место проведения</label>
                        @error('description')
                            <div class="uk-alert-danger" data-uk-alert>
                                <a class="uk-alert-close" data-uk-close></a>
                                {{ $message }}
                            </div>
                        @enderror
                        <textarea wire:model="description" class="uk-textarea" rows="3"></textarea>
                    </div>
                    <div class="uk-line-input">
                        <label><i>*</i> Поисковые теги</label>
                        @error('tags')
                            <div class="uk-alert-danger" data-uk-alert>
                                <a class="uk-alert-close" data-uk-close></a>
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="text" wire:model="tags" class="uk-input">
                    </div>
                </div>
                <div class="uk-modal-footer">
                    <div class="uk-button uk-button-submit">
                        <input type="submit" value="Сохранить изменения">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
--}}