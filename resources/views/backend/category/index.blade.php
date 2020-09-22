@extends('backend.layouts.app')

@section('title', app_name() . ' | Category List' )

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Category List</h5>
                    <div class="float-right mb-3">
                        <a href="{{ route('admin.category.add') }}" class="btn btn-success">Add Category</a>
                    </div>
                    <table class="mb-0 table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>NAME</th>
                            <th>REMARK</th>
                            <th>CREATED AT</th>
                            <th>UPDATED_AT</th>
                            <th>OPTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $key => $item)
                        <tr>
                            <th>{{ $key }}</th>
                            <th>{{ $item->name }}</th>
                            <th>{{ $item->remark }}</th>
                            <th>{{ $item->created_at }}</th>
                            <th>{{ $item->updated_at }}</th>
                            <th>
                                <a href="{{ route('admin.category.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
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

