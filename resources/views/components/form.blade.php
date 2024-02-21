<form class="card" wire:submit="submit">
    @csrf
    <div class="card-header">
        <h3 class="card-title">Form</h3>
    </div>
    <div class="card-body">

        @foreach ($fields as $field)
            @if ($field['type'] == 'text')
                <x-obelaw-text-field label="{{ $field['label'] }}" model="{{ 'inputs.' . $field['model'] }}"
                    :hint="$field['hint']" :required="str_contains($field['rules'], 'required')" />
            @endif

            @if ($field['type'] == 'select')
                <x-obelaw-select-field label="{{ $field['label'] }}" model="{{ 'inputs.' . $field['model'] }}"
                    :options="$field['options']" :hint="$field['hint']" :required="str_contains($field['rules'], 'required')" :multiple="$field['multiple']" :selected="$field['selected'] ?? false" />
            @endif

            @if ($field['type'] == 'textarea')
                <x-obelaw-textarea-field label="{{ $field['label'] }}" model="{{ 'inputs.' . $field['model'] }}"
                    :hint="$field['hint']" :required="str_contains($field['rules'], 'required')" />
            @endif

            @if ($field['type'] == 'date')
                <x-obelaw-date-field label="{{ $field['label'] }}" model="{{ 'inputs.' . $field['model'] }}"
                    :hint="$field['hint']" :required="str_contains($field['rules'], 'required')" />
            @endif

            @if ($field['type'] == 'checkbox')
                <x-obelaw-checkbox-field label="{{ $field['label'] }}" model="{{ 'inputs.' . $field['model'] }}"
                    :options="$field['options'] ?? null" :hint="$field['hint']" :required="str_contains($field['rules'], 'required')" />
            @endif
        @endforeach

        <div class="hr-text">TABS</div>
        <div class="accordion" id="accordion-example">

            @foreach ($tabs as $id => $tab)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $id }}" aria-expanded="false">
                            {{ $tab['label'] }}
                        </button>
                    </h2>
                    <div id="collapse-{{ $id }}" class="accordion-collapse collapse"
                        data-bs-parent="#accordion-example" style="">
                        <div class="accordion-body pt-0">
                            @foreach ($tab['fields'] as $field)
                                @if ($field['type'] == 'text')
                                    <x-obelaw-text-field label="{{ $field['label'] }}"
                                        model="{{ 'inputs.' . $field['model'] }}" :hint="$field['hint']"
                                        :required="str_contains($field['rules'], 'required')" />
                                @endif

                                @if ($field['type'] == 'select')
                                    <x-obelaw-select-field label="{{ $field['label'] }}"
                                        model="{{ 'inputs.' . $field['model'] }}" :options="$field['options']" :hint="$field['hint']"
                                        :required="str_contains($field['rules'], 'required')" :multiple="$field['multiple']" :selected="$field['selected'] ?? false" />
                                @endif

                                @if ($field['type'] == 'textarea')
                                    <x-obelaw-textarea-field label="{{ $field['label'] }}"
                                        model="{{ 'inputs.' . $field['model'] }}" :hint="$field['hint']"
                                        :required="str_contains($field['rules'], 'required')" />
                                @endif

                                @if ($field['type'] == 'date')
                                    <x-obelaw-date-field label="{{ $field['label'] }}"
                                        model="{{ 'inputs.' . $field['model'] }}" :hint="$field['hint']"
                                        :required="str_contains($field['rules'], 'required')" />
                                @endif

                                @if ($field['type'] == 'checkbox')
                                    <x-obelaw-checkbox-field label="{{ $field['label'] }}"
                                        model="{{ 'inputs.' . $field['model'] }}" :options="$field['options'] ?? null" :hint="$field['hint']"
                                        :required="str_contains($field['rules'], 'required')" />
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
    <div class="card-footer text-end">
        <button type="submit" class="btn btn-primary">{{ __('obelaw::builder.form.submit') }}</button>
    </div>
</form>
