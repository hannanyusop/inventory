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
                    <h5 class="card-title">Customer List</h5>
                    <div class="float-right mb-3">
                        <a href="{{ route('admin.customer.add') }}" class="btn btn-success">Add Customer</a>
                    </div>
                    <table class="mb-0 table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>PHONE NUMBER</th>
                            <th>OPTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $key => $customer)
                        <tr>
                            <th>{{ $key+1 }}</th>
                            <th>{{ $customer->name }}</th>
                            <th>{{ $customer->email }}</th>
                            <th>{{ $customer->phone_number }}</th>
                            <th>
                                <a href="{{ route('admin.customer.view', $customer->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('admin.customer.edit', $customer->id) }}" class="btn btn-warning btn-sm">Edit</a>
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

