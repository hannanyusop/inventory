@extends('backend.layouts.app')

@section('title', app_name() . ' | Add Supplier')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card-hover-shadow card-border mb-3 card">
                <div class="dropdown-menu-header">
                    <div class="dropdown-menu-header-inner bg-warning">
                        <div class="menu-header-content">
                            <div>
                                <h5 class="menu-header-title">{{ $supplier->name }}</h5>
                                <h6 class="menu-header-subtitle">{{ $supplier->email }}</h6>
                            </div>
                            <div class="menu-header-btn-pane">
                                <a href="{{ route('admin.supplier.edit', $supplier->id) }}" class="mr-2 btn btn-dark btn-sm">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p>Phone : {{ $supplier->phone_number }}</p>
                    <p>Address : {{ $supplier->address }}</p>
                    </p>
                </div>
                <div class="d-block text-right card-footer">
                    <a href="{{ route('admin.supplier.index') }}" class="btn-shadow-primary btn btn-primary btn-lg">Back</a>
                </div>
            </div>
        </div>
        <div class="col-md-8">

            <div class="row">
                <div class="col-md-6 col-xl-6">
                    <div class="card mb-3 widget-chart widget-chart2 text-left card-btm-border card-shadow-success border-success">
                        <div class="widget-chat-wrapper-outer">
                            <div class="widget-chart-content pt-3 pl-3 pb-1">
                                <div class="widget-chart-flex">
                                    <div class="widget-numbers">
                                        <div class="widget-chart-flex">
                                            <div class="fsize-4">
                                                <small class="opacity-5">$</small>
                                                <span>RM {{ $box['year'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="widget-subheading mb-0 opacity-5">Total Supplied Item This Year</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-6">
                    <div class="card mb-3 widget-chart widget-chart2 text-left card-btm-border card-shadow-primary border-primary">
                        <div class="widget-chat-wrapper-outer">
                            <div class="widget-chart-content pt-3 pl-3 pb-1">
                                <div class="widget-chart-flex">
                                    <div class="widget-numbers">
                                        <div class="widget-chart-flex">
                                            <div class="fsize-4">
                                                <small class="opacity-5">$</small>
                                                <span>RM {{ $box['overall'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="widget-subheading mb-0 opacity-5">Total Supplied Item (Overall)</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Transfer List History</h5>

                    <form>
                        <select name="year" id="year" class="form-control">
                            @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                        <span class="text-muted">Select Year</span>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered mt-4">
                            <tr>
                                <th>Date</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            <tbody id="data"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){

            fetch_customer_data();

            function fetch_customer_data(query = '')
            {
                $.ajax({
                    url:"{{ route('admin.supplier.get-invoice', $supplier->id) }}",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                    success:function(data)
                    {
                        $('#data').html(data.table_data);
                        $('#total_records').text(data.total_data);
                    }
                })
            }

            $(document).on('change', '#year', function(){
                var query = $(this).val();
                fetch_customer_data(query);
            });
        });
    </script>
@endpush
