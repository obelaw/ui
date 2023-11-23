<div {{ $attributes->merge(['class' => 'mb-3 row']) }}>
    <label class="col-3 col-form-label @if ($required) required @endif">{{ $label }}</label>
    <div class="col">
        <select class="form-select @error($model) is-invalid @enderror" wire:model.defer="{{ $model }}"
            {{ $attributes }} @if ($multiple) multiple @endif
            @if ($selected) wire:change="{{ $selected }}()" @endif id="select_{{ $model }}">
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

@push('scripts')
    <script>
        Livewire.on('setOptions', event => {
            if (event.toModel == '{{ $model }}') {

                var htmlOptions = '<option value="null">{{ __('obelaw::builder.form.select') }}...</option>';

                event.options.forEach(option => {
                    htmlOptions += '<option value="' + option.value + '">' + option.label + '</option>';
                });

                document.getElementById('select_{{ $model }}').innerHTML = htmlOptions;
            }
        });
    </script>
@endpush
