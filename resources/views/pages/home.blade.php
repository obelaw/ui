<div>
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Overview
                    </div>
                    <h2 class="page-title">
                        Dashboard
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            @foreach ($modules as $gruob => $_modules)
                <div class="hr-text hr-text-left">{{ \Illuminate\Support\Str::of($gruob)->replace('_', ' ') }}</div>
                @if (config('obelaw.ui.group_style.' . $gruob, 'large') == 'large')
                    <x-obelaw-large-group :modules="$_modules" />
                @endif

                @if (config('obelaw.ui.group_style.' . $gruob, 'large') == 'small')
                    <x-obelaw-small-group :modules="$_modules" />
                @endif
            @endforeach
        </div>
    </div>
</div>
