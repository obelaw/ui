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
            <div class="hr-text hr-text-left">Obelaw modules</div>
            <div class="row row-cols-5 g-5">
                @foreach ($modules as $id => $module)
                    @if (hasPermission($id))
                        <div class="col">
                            <a href="{{ route($module['href']) }}">
                                <div class="card text-center py-5">
                                    <p class="m-0">
                                        @svg('tabler-' . $module['icon'], 'w-7 h-7')
                                    </p>
                                    <p class="m-0 mt-3 h3">
                                        {{ \Illuminate\Support\Str::contains($module['name'], '::') ? __($module['name']) : $module['name'] }}
                                    </p>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="hr-text hr-text-left">Helper Modules</div>

            <div class="row row-cards">
                @foreach ($helperModules as $id => $module)
                    @if (hasPermission($id))
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
        </div>
    </div>
</div>
