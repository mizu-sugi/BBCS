@extends('layouts.users')

@section('content')
<div class="w-full">
        <form method="GET" action="{{ route('members.health-records.index') }}" class="mb-4">
            <div class="flex items-center">
                <div class="mr-4">
                    <label for="start_date" class="block text-gray-700 font-bold mb-2">開始日</label>
                    <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mr-4">
                    <label for="end_date" class="block text-gray-700 font-bold mb-2">終了日</label>
                    <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mr-4 mt-6">
                    <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">フィルタ</button>
                </div>
            </div>
        </form>
        
        <canvas id="temperature-chart" class="w-full h-96"></canvas>
    </div>

    <div class="grid grid-cols-3 gap-4 mt-8">
        <div class="chart-item">
            <canvas id="nausea-chart" width="150" height="150"></canvas>
        </div>
        <div class="chart-item">
            <canvas id="fatigue-chart" width="150" height="150"></canvas>
        </div>
        <div class="chart-item">
            <canvas id="pain-chart" width="150" height="150"></canvas>
        </div>
        <div class="chart-item">
            <canvas id="appetite-chart" width="150" height="150"></canvas>
        </div>
        <div class="chart-item">
            <canvas id="numbness-chart" width="150" height="150"></canvas>
        </div>
        <div class="chart-item">
            <canvas id="anxiety-chart" width="150" height="150"></canvas>
        </div>
    </div>

    <div id="chart-data"
         data-labels="{{ json_encode($labels) }}"
         data-temperatures="{{ json_encode($temperatures) }}"
         data-nausea-levels="{{ json_encode($nauseaLevels) }}"
         data-fatigue-levels="{{ json_encode($fatigueLevels) }}"
         data-pain-levels="{{ json_encode($painLevels) }}"
         data-appetite-levels="{{ json_encode($appetiteLevels) }}"
         data-numbness-levels="{{ json_encode($numbnessLevels) }}"
         data-anxiety-levels="{{ json_encode($anxietyLevels) }}">
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chartData = document.getElementById('chart-data');

            const labels = JSON.parse(chartData.getAttribute('data-labels'));
            const temperatures = JSON.parse(chartData.getAttribute('data-temperatures'));
            const nauseaLevels = JSON.parse(chartData.getAttribute('data-nausea-levels'));
            const fatigueLevels = JSON.parse(chartData.getAttribute('data-fatigue-levels'));
            const painLevels = JSON.parse(chartData.getAttribute('data-pain-levels'));
            const appetiteLevels = JSON.parse(chartData.getAttribute('data-appetite-levels'));
            const numbnessLevels = JSON.parse(chartData.getAttribute('data-numbness-levels'));
            const anxietyLevels = JSON.parse(chartData.getAttribute('data-anxiety-levels'));

            // 折れ線グラフ（体温）
            const temperatureCtx = document.getElementById('temperature-chart').getContext('2d');
            const temperatureChart = new Chart(temperatureCtx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: '体温',
                        data: temperatures,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        y: {
                            min: 35,
                            max: 40,
                            stepSize: 0.5
                        }
                    }
                }
            });

            // 各項目の円グラフ
            const charts = ['nausea', 'fatigue', 'pain', 'appetite', 'numbness', 'anxiety'];
            charts.forEach(chartName => {
                const ctx = document.getElementById(`${chartName}-chart`).getContext('2d');
                const levels = [0, 0, 0, 0, 0]; // レベルごとの集計データ

                switch (chartName) {
                    case 'nausea':
                        nauseaLevels.forEach(level => levels[level - 1]++);
                        break;
                    case 'fatigue':
                        fatigueLevels.forEach(level => levels[level - 1]++);
                        break;
                    case 'pain':
                        painLevels.forEach(level => levels[level - 1]++);
                        break;
                    case 'appetite':
                        appetiteLevels.forEach(level => levels[level - 1]++);
                        break;
                    case 'numbness':
                        numbnessLevels.forEach(level => levels[level - 1]++);
                        break;
                    case 'anxiety':
                        anxietyLevels.forEach(level => levels[level - 1]++);
                        break;
                }

                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Level 1', 'Level 2', 'Level 3', 'Level 4', 'Level 5'],
                        datasets: [{
                            label: `${chartName} levels`,
                            data: levels,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(75, 192, 192, 0.6)',
                                'rgba(153, 102, 255, 0.6)',
                                'rgba(255, 159, 64, 0.6)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: `${chartName.charAt(0).toUpperCase() + chartName.slice(1)} Levels`, // タイトルの設定
                                padding: 20
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2);
                                    }
                                }
                            }
                        }
                    }
                });
            });
        });
    </script>

    <div class="mt-8">
        <h2 class="text-xl font-bold mb-4">健康記録の一覧</h2>
        <ul>
            @foreach($records as $record)
                <li class="mb-2">
                    <a href="{{ route('members.health-records.show', $record->id) }}" class="text-blue-500 hover:underline">
                        {{ $record->created_at->format('Y-m-d H:i:s') }} - 体温: {{ $record->temperature }}℃
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
