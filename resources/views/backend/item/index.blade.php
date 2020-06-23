@extends('backend.layouts.app')

@section('title', app_name() . ' | Product List' )

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-ticket icon-gradient bg-ripe-malin"></i>
                </div>
                <div>Product
                    <div class="page-title-subheading">Product List</div>
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
                                <label for="exampleEmail33" class="sr-only">Category</label>
                                {{ html()->select('category_id', $categories)->class('mr-2 multiselect-dropdown form-control')->value((request()->has('category_id'))? request('category_id') : '')  }}
                            </div>
                            <div class="position-relative form-group">
                                <label for="examplePassword44" class="sr-only">Name</label>
                                {{ html()->input('text', 'name')->class('form-control mr-2 ml-2')->value((request()->has('name'))? request('name') : '') }}
                            </div>
                            <button type="submit" class="btn btn-primary btn-icon mr-2"><i class="fa fa-search btn-icon-wrapper"></i> Search</button>
                            <a href="{{ route('admin.stock-report.index') }}" class="btn btn-warning btn-icon mr-2"><i class="fa fa-redo btn-icon-wrapper"></i> Clear</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Product List</h5>
                    <div class="float-right mb-3">
                        <a href="{{ route('admin.item.add') }}" class="btn btn-success">Add Product</a>
                    </div>
                    <table class="mb-0 table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>CODE</th>
                            <th>NAME</th>
                            <th >CATEGORY</th>
                            <th class="text-center">QTY LEFT</th>
                            <th class="text-center">QTY ALERT</th>
                            <th class="text-center">ALERT ENABLED</th>
                            <th class="text-center">OPTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $key => $item)
                        <tr>
                            <th>{{ $key }}</th>
                            <th>{{ $item->code }}</th>
                            <th>{{ $item->name }}</th>
                            <th>{{ $item->category->name }}</th>
                            <th class="text-center">{{ $item->qty_left }}</th>
                            <th class="text-center">{{ $item->qty_alert }}</th>
                            <th class="text-center">{!! ($item->qty_alert_disabled == 0)? "<span class='badge badge-pill badge-success'>YES</span>" : "<span class='badge badge-pill badge-danger'>NO</span>" !!}</th>
                            <th class="text-center">
                                <a href="{{ route('admin.item.view', $item->id) }}" class="btn btn-info btn-sm mr-2">View</a>
                                <a href="{{ route('admin.item.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
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

