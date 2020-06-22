@extends('backend.layouts.app')

@section('title', app_name() . ' |  Stock Report' )

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-graph1 icon-gradient bg-ripe-malin"></i>
                </div>
                <div>Stock Report
                    <div class="page-title-subheading"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Vertical Bars</h5>
                    <canvas id="report"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-scripts')
    <script type="text/javascript">
        var MONTHS = @json($dataMonth);
        var color = Chart.helpers.color;
        var clr = ['#ff0000','#003366', '#20b2aa', '#660066', '#66cccc', '#008000', '#800000', '#800080'];

        var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        };

        var barChartData = {
            labels: MONTHS,
            datasets: [
                <? $key = 0; ?>
            @foreach($data as $i)
                {
                label: '{{ $names[$key] }}',
                borderWidth: 2,
                data: @json($formatted[$i->item_id])
                },
                <? $key++ ?>
            @endforeach

            ]

        };

        window.onload = function() {
            var ctx = document.getElementById('report').getContext('2d');
            window.myBar = new Chart(ctx, {
                type: 'line',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Most Sold Item Prediction For Next Month'
                    }
                }
            });

        };

    </script>
@endpush

