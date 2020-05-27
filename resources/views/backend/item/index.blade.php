@extends('backend.layouts.app')

@section('title', app_name() . ' | Product List' )

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Inline</h5>
                    <div>
                        <form class="form-inline">
                            <div class="position-relative form-group">
                                <label for="exampleEmail33" class="sr-only">Email</label>
                                <input name="email" id="exampleEmail33" placeholder="Email" type="email" class="mr-2 form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label for="examplePassword44" class="sr-only">Password</label>
                                <input name="password" id="examplePassword44" placeholder="Password" type="password" class="mr-2 form-control">
                            </div>
                            <button class="btn btn-primary">Search</button>
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
                            <th>IMAGE</th>
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
                            <th><img src="{{ asset($item->image_url) }}" class="rounded" width="50px" alt="{{ $item->name }}"></th>
                            <th>{{ $item->code }}</th>
                            <th>{{ $item->name }}</th>
                            <th>{{ $item->category->name }}</th>
                            <th class="text-center">{{ $item->qty_left }}</th>
                            <th class="text-center">{{ $item->qty_alert }}</th>
                            <th class="text-center">{!! ($item->qty_alert_disabled == 0)? "<span class='badge badge-pill badge-success'>YES</span>" : "<span class='badge badge-pill badge-danger'>NO</span>" !!}</th>
                            <th class="text-center">
                                <a href="{{ route('admin.item.view', $item->id) }}" class="btn btn-info btn-sm">View</a>
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

