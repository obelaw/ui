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
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="row row-cards" data-masonry='{"percentPosition": true }'>
                    @if (!$widgets)
                        <div class="empty mt-5">
                            <div class="empty-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pinned"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 4v6l-2 4v2h10v-2l-2 -4v-6" />
                                    <path d="M12 16l0 5" />
                                    <path d="M8 4l8 0" />
                                </svg>
                            </div>
                            <p class="empty-title">No widgets found</p>
                            <p class="empty-subtitle text-secondary">
                                There are no widgets under the <code>{{ $widget_id }}</code> key.
                            </p>
                        </div>
                    @endif

                    @if ($widgets)
                        @foreach ($widgets as $widget)
                            <div class="{{ $widget['cols'] }}">
                                @livewire($widget['component'])
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <!-- WIDGETS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.0/apexcharts.min.js" defer></script>
@endpush
