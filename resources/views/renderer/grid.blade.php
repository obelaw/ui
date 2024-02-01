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
                        @if ($bottoms || $actions)
                            <div class="dropdown">
                                <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Open bottoms and
                                    actions</a>
                                <div class="dropdown-menu">
                                @empty(!$bottoms)
                                    @foreach ($bottoms as $bottom)
                                        @if (isset($bottom['permission']) && hasPermission($bottom['permission']))
                                            <a href="{{ route($bottom['route']) }}" class="dropdown-item">
                                                <img src="{{ asset($bottom['icon']) }}" alt=""
                                                    class="w-auto me-2" style="height: 22px;">
                                                {{ \Illuminate\Support\Str::contains($bottom['label'], '::grids') ? __($bottom['label']) : $bottom['label'] }}
                                            </a>
                                        @endif
                                    @endforeach
                                @endempty
                                <button wire:click="export" class="dropdown-item">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-file-type-xls me-2" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                                        <path d="M4 15l4 6" />
                                        <path d="M4 21l4 -6" />
                                        <path
                                            d="M17 20.25c0 .414 .336 .75 .75 .75h1.25a1 1 0 0 0 1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 1 1 -1h1.25a.75 .75 0 0 1 .75 .75" />
                                        <path d="M11 15v6h3" />
                                    </svg>
                                    Export Excel
                                </button>
                            @empty(!$actions)
                                <div class="hr-text">actions</div>
                                <div class="p-2">
                                    @foreach ($actions as $action)
                                        @livewire($action)
                                    @endforeach
                                </div>
                            @endempty

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
<!-- Page body -->
<div class="page-body">
<div class="container-xl">
    <div class="row row-cards">
        <div class="col-12">
            <div class="card mb-3">

                @if ($table->getRows()->isEmpty())
                    <div class="empty">
                        <div class="empty-icon">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-mood-empty" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                <path d="M9 10l.01 0"></path>
                                <path d="M15 10l.01 0"></path>
                                <path d="M9 15l6 0"></path>
                            </svg>
                        </div>
                        <p class="empty-title">No results found</p>
                        <p class="empty-subtitle text-secondary">
                            Try adjusting your search or filter or creating a new record to find a records.
                        </p>
                    </div>
                @endif

                @if (!$table->getRows()->isEmpty())
                    <div class="table-responsive">

                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    @foreach ($table->getLabels() as $label)
                                        <th>{{ $label }}</th>
                                    @endforeach
                                    <th width="21%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($table->getRows() as $row)
                                    <tr>
                                        @foreach ($row['columns'] as $column)
                                            <td>{!! $column !!}</td>
                                        @endforeach
                                        <td align="right">
                                            @foreach ($row['calls'] as $call => $action)
                                                @if (isset($action['permission']) && hasPermission($action['permission']))
                                                    @if ($action['type'] == 'route')
                                                        <a class="btn btn-sm btn-{{ $action['color'] }}"
                                                            href="{{ route($action['route'], [$row['primary']]) }}">
                                                            {{ \Illuminate\Support\Str::contains($call, '::grids') ? __($call) : $call }}
                                                        </a>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @if ($canRemoveRow)
                                                <button class="btn btn-sm btn-danger"
                                                    wire:click="removeRow({{ $row['primary'] }})"
                                                    onclick="return confirm('Are you sure you want to remove?') || event.stopImmediatePropagation();">{{ __('obelaw::builder.grids.remove') }}</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                @endif
            </div>

            {{ $table->getLinks() }}
        </div>
    </div>
</div>
</div>
<x-obelaw-loading />
</div>
