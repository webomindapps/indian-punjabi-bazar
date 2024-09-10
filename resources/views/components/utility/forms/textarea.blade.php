<div class="{{ $attributes->get('size') }}">
    <div class="form-group">
        <label class="form-label" for="{{ $attributes->get('id') }}">{{ $label }}@if ($attributes->get('required'))
                <span style="color: red">*</span>
            @endif
        </label>
        <textarea rows="{{ $attributes->get('rows') }}" cols="{{ $attributes->get('cols') }}" class="form-control"
            id="{{ $attributes->get('id') }}" name="{{ $attributes->get('name') }}"
            placeholder="{{ $attributes->get('placeholder') }}" @if ($attributes->get('required')) required @endif
            @if ($attributes->get('readonly')) readonly @endif>
@if ($attributes->get('editor'))
{!! $attributes->get('value') !!}@else{!! $attributes->get('value') !!}
@endif
</textarea>
        @error($attributes->get('name'))
            <small id="{{ $attributes->get('id') }}" class="form-text text-danger">{{ $message }}</small>
        @enderror

    </div>
</div>
