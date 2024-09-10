<div class="{{ $attributes->get('size') }}">
    <div class="form-group">
        <label class="mb-2" for="{{ $attributes->get('id') }}">{{ $label }}@if ($attributes->get('required'))
                <span style="color: red">*</span>
            @endif
        </label>
        <select class="form-control" id="{{ $attributes->get('id') }}" name="{{ $attributes->get('name') }}"
            @if ($attributes->get('required')) required @endif>
            <option value="">Select</option>
            @foreach ($options as $option)
                <option value="{{ $option['value'] }}" @if ($attributes->get('value') == $option['value']) selected @endif>
                    {{ $option['label'] }}</option>
            @endforeach
        </select>
        @error($attributes->get('name'))
            <small id="{{ $attributes->get('id') }}" class="form-text text-danger">{{ $message }}</small>
        @enderror

    </div>
</div>
