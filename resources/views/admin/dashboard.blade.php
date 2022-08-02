<x-admin-layout>
    <div class="flex flex-col md:flex-row">
        <div class="today-sales w-full">
            <div class="table-head text-center bg-green-700 text-white font-bold">
                {{ __("Today's Sales") }}
            </div>
            <div class="flex bg-brandPrimary text-white font-bold">
                <div class="w-full text-center border-2 border-black">{{ __('Name') }}</div>
                <div class="w-full text-center border-2 border-black">{{ 'Cash' }}</div>
                <div class="w-full text-center border-2 border-black">{{ __('MB') }}</div>
                <div class="w-full text-center border-2 border-black">{{ __('Total') }}</div>
                <div class="w-full text-center border-2 border-black">{{ __('Profit') }}</div>
                <div class="w-full text-center border-2 border-black">{{ __('Expense') }}</div>
                <div class="w-full text-center border-2 border-black">{{ __('Customers') }}</div>
            </div>
            @forelse ($sales as $sale)
            <div class="flex bg-brandPrimary text-white font-bold">
                <div class="w-full text-center border-2 border-black">{{ $sale->user->name }}</div>
                <div class="w-full text-center border-2 border-black">{{ $sale->cash }}</div>
                <div class="w-full text-center border-2 border-black">{{ $sale->mb }}</div>
                <div class="w-full text-center border-2 border-black">{{ $sale->total }}</div>
                <div class="w-full text-center border-2 border-black">{{ $sale->profit }}</div>
                <div class="w-full text-center border-2 border-black">{{ $sale->expense }}</div>
                <div class="w-full text-center border-2 border-black">{{ $sale->orders }}</div>
            </div>
            @empty
            <div class="flex bg-brandSecondary text-white font-bold">
                <div class="w-full text-center border-2 border-black">{{ __('No New Sale') }}</div>
            </div>
            @endforelse
            <div class="row flex mt-4 bg-blue-900 text-white font-bold">
                <div class="w-full text-center border-2 border-black">
                    {{ __('Total') }}
                </div>
                <div class="w-full text-center border-2 border-black">
                    <span>&euro; </span><span> {{ $report['cash'] }}</span>
                </div>
                <div class="w-full text-center border-2 border-black">
                    <span>&euro; </span><span> {{ $report['mb'] }}</span>
                </div>
                <div class="w-full text-center border-2 border-black">
                    <span>&euro; </span><span> {{ $report['total'] }}</span>
                </div>
                <div class="w-full text-center border-2 border-black">
                    <span>&euro; </span><span> {{ $report['profit'] }}</span>
                </div>
                <div class="w-full text-center border-2 border-black">
                    <span>&euro; </span><span> {{ $report['expense'] }}</span>
                </div>
            </div>
        </div>

        <!-- <div class="chart-area w-full md:w-1/2 md:max-w-md rounded-md bg-white shadow">
            <div class="text-center font-bold text-lg mb-3 py-3">
                <span class="mr-3">{{ __('Total Cash') }} </span><span>&euro; {{ $totalTodaySale }}</span>
            </div>
            <div id="chart"></div>
        </div> -->
    </div>
    <div class="flex flex-col flex-wrap justify-around md:flex-row my-3" id="monthlyChart">
        @forelse ($users as $user)
        <div class="userChart sm:min-w-[400px] block rounded-md bg-[#1643CB] text-white shadow m-3">
            <div class="chartHeader font-bold text-xl text-center text-yellow-400">
                @can('sales.index')
                <a class="bg-brandYellow text-black float-left py-1 px-2 text-xs rounded-lg m-1" href="{{ route('sales.index', $user) }}">{{ __('Summary') }}</a>
                @endcan

                <span class="my-3">{{ $user->name }} Shop</span>
                <span class="bg-blue-500 float-right py-1 px-2 rounded-md">&euro; {{ $user->total }}</span>
            </div>
            <div class="chartBody flex justify-around w-full py-3" style="height: calc(var(--total) * 1.3);--total: 200px;">
                <div class="chartBar flex flex-col justify-end h-full">
                    <div class="w-6 mx-auto rounded-md bg-brandYellow" style="height: calc(var(--total) * <?php echo $user->total; ?>);"></div>
                    <div class="font-bold text-center">{{ __('Sale') }}</div>
                    <div class="font-bold text-center">&euro; {{ $user->total }}</div>
                </div>
                <?php
                $user->total = ($user->total) ?: '1';
                ?>
                <div class="chartBar flex flex-col justify-end h-full">
                    <div class="w-6 mx-auto rounded-md bg-cyan-400" style="height: calc(var(--total) * <?php echo $user->cash / $user->total; ?>);"></div>
                    <div class="font-bold text-center">{{ 'Cash' }}</div>
                    <div class="font-bold text-center">&euro; {{ $user->cash }}</div>
                </div>
                <div class="chartBar flex flex-col justify-end h-full">
                    <div class="w-6 mx-auto rounded-md bg-[#22215B]" style="height: calc(var(--total) * <?php echo $user->mb / $user->total; ?>);"></div>
                    <div class="font-bold text-center">{{ "MB" }}</div>
                    <div class="font-bold text-center">&euro; {{ $user->mb }}</div>
                </div>
                <div class="chartBar flex flex-col justify-end h-full">
                    <div class="w-6 mx-auto rounded-md bg-[#00FF19]" style="height: calc(var(--total) * <?php echo $user->profit / $user->total; ?>);"></div>
                    <div class="font-bold text-center">{{ __('Profit') }}</div>
                    <div class="font-bold text-center">&euro; {{ $user->profit }}</div>
                </div>
                <div class="chartBar flex flex-col justify-end h-full">
                    <div class="w-6 mx-auto rounded-md bg-red-700" style="height: calc(var(--total) * <?php echo $user->expense / $user->total; ?>);"></div>
                    <div class="font-bold text-center">{{ __('Expense') }}</div>
                    <div class="font-bold text-center">&euro; {{ $user->expense }}</div>
                </div>
            </div>
        </div>
        @empty

        @endforelse
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->
    <!-- <script>
        var options = {
            series: [],
            labels: [],
            chart: {
                width: 380,
                type: 'donut',
            },
            colors: ["#ff3412", "#00ff34"],
            legend: {
                fontSize: '16px',
                fontFamily: 'Roboto',
                fontWeight: 900,
                horizontalAlign: 'right',
                formatter: function(seriesName, opts) {
                    return [seriesName, " <br> &euro; ", opts.w.globals.series[opts.seriesIndex]]
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 300
                    },

                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script> -->


</x-admin-layout>