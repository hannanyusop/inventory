@extends('backend.layouts.app')

@section('title', app_name() . ' | Receive Stock List' )

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-briefcase icon-gradient bg-ripe-malin"></i>
                </div>
                <div>Receive Stock List
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
                        <form class="form-inline">
                            <div class="position-relative form-group">
                                <label for="supplier_id" class="sr-only">Supplier</label>
                                {{ html()->select('supplier_id', $suppliers)->class('mr-2 multiselect-dropdown form-control')->value((request()->has('supplier_id'))? request('supplier_id') : '') }}
                            </div>
                            <button class="ml-2 btn btn-primary">Search</button>
                            <a href="{{ route('admin.stock-receive.index') }}" class="ml-2 btn btn-warning">Clear</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Receive Stock List</h5>
                    <div class="float-right mb-3">
                        <a href="{{ route('admin.stock-receive.add') }}" class="btn btn-success">Add New Receive Stock List</a>
                    </div>
                    <table class="mb-0 table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>INVOICE NO</th>
                            <th>SUPPLIER NAME</th>
                            <th>DATE</th>
                            <th>TOTAL</th>
                            <th>STATUS</th>
                            <th>OPTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($si as $key => $item)
                        <tr>
                            <th>{{ $key+1 }}</th>
                            <td>{{ $item->invoice_no }}</td>
                            <th>{{ $item->supplier->name }}</th>
                            <th>{{ $item->date }}</th>
                            <th>{{ $item->price_net }}</th>
                            <th>{{ $item->status }}</th>
                            <th>
                                <a href="{{ route('admin.stock-receive.view', $item->id) }}" class="btn btn-info btn-sm">View</a>
                            </th>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

