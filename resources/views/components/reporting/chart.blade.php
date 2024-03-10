<div class="position-relative">
    <div class="position-absolute top-0 left-0 px-3 mt-1 w-75">
        {{ $slot }}
    </div>
    <div id="{{ $id }}"></div>
</div>

@script
    <script>
        $wire.on('event-chart', (event) => {
            console.log(event);
            new ApexCharts(document.getElementById('{{ $id }}'), {
                chart: {
                    type: "area",
                    fontFamily: 'inherit',
                    height: 300,
                    sparkline: {
                        enabled: true
                    },
                    animations: {
                        enabled: false
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                fill: {
                    opacity: .16,
                    type: 'solid'
                },
                stroke: {
                    width: 2,
                    lineCap: "round",
                    curve: "smooth",
                },
                series: event.series,
                tooltip: {
                    theme: 'dark'
                },
                grid: {
                    strokeDashArray: 4,
                },
                xaxis: {
                    labels: {
                        padding: 0,
                    },
                    tooltip: {
                        enabled: false
                    },
                    axisBorder: {
                        show: false,
                    },
                    type: 'string',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: event.labels,
                colors: event.series_color,
                legend: {
                    show: false,
                },
                point: {
                    show: false
                },
            }).render();
        });
    </script>
@endscript
