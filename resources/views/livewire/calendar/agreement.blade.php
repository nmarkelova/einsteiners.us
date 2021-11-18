<div id="agreement-list">
    @foreach ($agreements as $agreement)
        <label id="element-{{ $agreement->id }}">
            <input name="agreement-{{ $agreement->id }}" class="uk-checkbox" type="checkbox" required="">
            <span>{{ $agreement->name }}<a href="{{ route('storage') }}/{{ $agreement->cover_path }}" target="_blank"><span data-uk-icon="file-pdf" wire:ignore="" class="uk-icon"></span></a></span>
        </label>
        <br />
    @endforeach
</div>