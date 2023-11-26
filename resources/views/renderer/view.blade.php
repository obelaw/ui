<div>
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        {{ $pretitle }}
                    </div>
                    <h2 class="page-title">
                        {{ $title }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        @empty(!$buttons)
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wand"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M6 21l15 -15l-3 -3l-15 15l3 3"></path>
                                        <path d="M15 6l3 3"></path>
                                        <path d="M9 3a2 2 0 0 0 2 2a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2a2 2 0 0 0 2 -2"></path>
                                        <path d="M19 13a2 2 0 0 0 2 2a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2a2 2 0 0 0 2 -2"></path>
                                    </svg>
                                    <span class="d-none d-sm-inline-block">Magic buttons</span>
                                </button>
                                <div class="dropdown-menu">
                                    @foreach ($buttons as $button)
                                        @livewire($button, $parameters)
                                    @endforeach
                                </div>
                            </div>
                        @endempty
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card" x-data="{ tab: '{{ $tabs[0] }}' }">
                <div class="row g-0">
                    <div class="col-12 col-md-3 border-end">
                        <div class="card-body">
                            {{-- <h4 class="subheader">Tabs</h4> --}}
                            <div class="list-group list-group-transparent">
                                @foreach ($tabs as $tab)
                                    <a href="#" x-on:click="tab = '{{ $tab }}'"
                                        class="list-group-item list-group-item-action d-flex align-items-center"
                                        :class="{ 'active': tab === '{{ $tab }}' }">
                                        {{ $tab }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-9 d-flex flex-column">
                        @foreach ($components as $tab => $component)
                            <div class="card-body" x-show="tab == '{{ $tab }}'">
                                @livewire($component, $parameters)
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
