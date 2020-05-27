@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    Quantity Alert
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th class="text-center">Qty Left</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($qty_alert as $item)
                            <tr>
                                <td class="text-muted">{{ $item->code }}</td>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">{{ $item->qty_left }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.item.view', $item->id) }}" id="PopoverCustomT-1" class="btn btn-primary btn-sm">Details</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-block text-center card-footer">
                    <a href="{{ route('admin.item.index') }}" class="btn-wide btn btn-success">View All Products</a>
                </div>
            </div>
        </div>
    </div>
@endsection
