@php
    use Illuminate\Support\Str;
@endphp

<div class="row row-cols-5 g-5">
    @foreach ($modules as $module)
        @if (hasPermission($module['id']))
            <div class="col">
                <a href="{{ route($module['href']) }}">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="py-3">
                                <p class="m-0">
                                    @svg('tabler-' . $module['icon'], 'w-7 h-7')
                                </p>
                                <p class="m-0 mt-3 h3">
                                    {{ Str::contains($module['name'], '::') ? __($module['name']) : $module['name'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endif
    @endforeach
</div>
