<form class="card" wire:submit.prevent="submit">
    @csrf
    <div class="card-header">
        <h3 class="card-title">Form</h3>
    </div>
    <div class="card-body">

        @foreach ($fields as $field)
            @if ($field['type'] == 'text')
                <x-obelaw-text-field label="{{ $field['label'] }}" model="{{ $field['model'] }}" :hint="$field['hint']"
                    :required="str_contains($field['rules'], 'required')" />
            @endif

            @if ($field['type'] == 'select')
                <x-obelaw-select-field label="{{ $field['label'] }}" model="{{ $field['model'] }}" :options="$field['options']"
                    :hint="$field['hint']" :required="str_contains($field['rules'], 'required')" :multiple="$field['multiple']" :selected="$field['selected'] ?? false" />
            @endif

            @if ($field['type'] == 'textarea')
                <x-obelaw-textarea-field label="{{ $field['label'] }}" model="{{ $field['model'] }}" :hint="$field['hint']"
                    :required="str_contains($field['rules'], 'required')" />
            @endif

            @if ($field['type'] == 'date')
                <x-obelaw-date-field label="{{ $field['label'] }}" model="{{ $field['model'] }}" :hint="$field['hint']"
                    :required="str_contains($field['rules'], 'required')" />
            @endif

            @if ($field['type'] == 'checkbox')
                <x-obelaw-checkbox-field label="{{ $field['label'] }}" model="{{ $field['model'] }}" :options="$field['options'] ?? null"
                    :hint="$field['hint']" :required="str_contains($field['rules'], 'required')" />
            @endif
        @endforeach

    </div>
    <div class="card-footer text-end">
        <button type="submit" class="btn btn-primary">{{ __('obelaw::builder.form.submit') }}</button>
    </div>
</form>
