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
                    :options="!empty($field['options']) ? $field['options'] : $choices[$field['model']] ?? []" :hint="$field['hint']" :required="str_contains($field['rules'], 'required')" :multiple="$field['multiple']" :selected="$field['selected'] ?? false" />
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

        @if (!empty($tabs))
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
                                            model="{{ 'inputs.' . $field['model'] }}" :options="$field['options']"
                                            :hint="$field['hint']" :required="str_contains($field['rules'], 'required')" :multiple="$field['multiple']"
                                            :selected="$field['selected'] ?? false" />
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
                                            model="{{ 'inputs.' . $field['model'] }}" :options="$field['options'] ?? null"
                                            :hint="$field['hint']" :required="str_contains($field['rules'], 'required')" />
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        @endif

    </div>
    <div class="card-footer text-end">
        <div class="d-flex">
            @if (session()->has('obelaw-success'))
                <span class="text-green p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                        <path d="M9 12l2 2l4 -4" />
                    </svg>
                    {{ session('obelaw-success') }}
                </span>
            @elseif (session()->has('obelaw-error'))
                <span class="text-red p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-x" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                        <path d="M10 10l4 4m0 -4l-4 4" />
                    </svg>
                    {{ session('obelaw-error') }}
                </span>
            @endif

            <button type="submit" class="btn btn-primary ms-auto">{{ __('obelaw::builder.form.submit') }}</button>
        </div>
    </div>
</form>
