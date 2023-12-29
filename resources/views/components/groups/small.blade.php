@php
    use Illuminate\Support\Str;
@endphp

<div class="row row-cols-5 g-5">
    @foreach ($modules as $module)
        @if (hasPermission($module['id']))
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-white text-black avatar">
                                    @svg('tabler-' . $module['icon'], 'w-5 h-5')
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    <a href="{{ route($module['href']) }}" class="text-black">
                                        {{ \Illuminate\Support\Str::contains($module['name'], '::') ? __($module['name']) : $module['name'] }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
