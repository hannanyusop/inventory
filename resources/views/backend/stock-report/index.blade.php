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
                    <div class="page-title-subheading">Examples of just how powerful ArchitectUI really is!</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div>
                        {{ html()->form()->method('get')->class('form-inline')->open() }}
                        <div class="position-relative form-group">
                            <label for="name" class="sr-only">Name</label>
                            {{ html()->select('year', $years)->class('form-control mr-2')->value($year) }}
                        </div>
                        <button class="btn btn-primary mr-2">Search</button>
                        {{ html()->form()->close()  }}
                    </div>
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
        var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var color = Chart.helpers.color;
        var barChartData = {
            labels: MONTHS,
            datasets: [{
                label: 'Stock Receive(RM)',
                borderColor: 'rgb(0,141,14)',
                borderWidth: 1,
                data: @json($data_receive)
            }, {
                label: 'Stock Transfer(RM)',
                borderColor: 'rgb(5,31,151)',
                borderWidth: 1,
                data: @json($data_transfer)
            }]

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
                        text: 'Stock Report Year {{ $year }}'
                    }
                }
            });

        };

    </script>
@endpush

