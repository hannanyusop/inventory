@extends('backend.layouts.app')

@section('title', app_name() . ' | Add Category')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Add Category</h5>
                    {{ html()->form('post', route('admin.category.insert'))->attribute('enctype', 'multipart/form-data')->open() }}

                        <div class="position-relative form-group">
                            <label for="code" class="">NAME</label>
                            {{ html()->input('text', 'name')->placeholder('PRODUCT NAME')->class('form-control') }}
                        </div>
                        <div class="position-relative form-group">
                            <label for="exampleText" class="">REMARK</label>
                            {{ html()->textarea('remark')->class('form-control')->attribute('row', 5) }}
                        </div>
                        <button type="submit" class="mt-1 btn btn-primary">Add New Categoy</button>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
