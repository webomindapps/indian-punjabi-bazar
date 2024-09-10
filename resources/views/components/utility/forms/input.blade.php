<div class="{{ $attributes->get('size') }}">
    <div class="form-group">
        <label class="form-label" for="{{ $attributes->get('id') }}">{{ $label }}@if ($attributes->get('required'))
                <span style="color: red">*</span>
            @endif
        </label>
        <input value="{!! $attributes->get('value') !!}" class="form-control {{ $attributes->get('class') }}"
            type="{{ $attributes->get('type') }}" step=".0001" id="{{ $attributes->get('id') }}" name="{{ $attributes->get('name') }}"
            placeholder="{{ $attributes->get('placeholder') }}" @if ($attributes->get('required')) required @endif
            @if ($attributes->get('readonly')) readonly @endif @if ($attributes->get('hidden')) hidden @endif
            @if ($attributes->get('multiple')) multiple @endif>

        @error($attributes->get('name'))
            <small id="{{ $attributes->get('id') }}" class="form-text text-danger">{{ $message }}</small>
        @enderror

        @if (isset($image))
            @if ($attributes->get('multiple'))
                <div id="image-section">
                </div>
            @else
                <img id="preview-image-{{ $attributes->get('id') }}"
                    @if (isset($imageValue)) src="{{ $imageValue }}" @endif height="100px" />
            @endif

        @endif

        {{-- @if (isset($image))
            <img id="preview-image" @if (isset($imageValue)) src="{{ $imageValue }}" @endif
                height="100px" />
        @endif --}}

    </div>
</div>
