<div {{ $attributes->merge(['class' => 'mb-3 row']) }}>
    <label class="col-3 col-form-label @if ($required) required @endif">{{ $label }}</label>
    <div class="col">
        <select class="form-select @error($model) is-invalid @enderror" wire:model="{{ $model }}"
            {{ $attributes }} @if ($multiple) multiple @endif
            @if ($selected) wire:change="{{ $selected }}()" @endif>
            <option value="null">{{ __('obelaw::builder.form.select') }}...</option>
            @foreach ($options as $option)
                <option value="{{ $option['value'] }}">
                    {{ Str::contains($option['label'], '::forms') ? __($option['label']) : $option['label'] }}</option>
            @endforeach
        </select>
        @error($model)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @if (isset($hint))
            <small class="form-hint">{{ $hint }}</small>
        @endif
    </div>
</div>
