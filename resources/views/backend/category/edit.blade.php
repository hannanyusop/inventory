@extends('backend.layouts.app')
@section('title', app_name() . ' | Edit Category')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Edit Category #{{ $category->id }}</h5>

                    {{ html()->modelForm($category)->attribute('enctype', 'multipart/form-data')->open() }}

                    <div class="position-relative form-group">
                        <label for="code" class="">NAME</label>
                        {{ html()->input('text', 'name')->placeholder('PRODUCT NAME')->class('form-control') }}
                    </div>
                    <div class="position-relative form-group">
                        <label for="exampleText" class="">REMARK</label>
                        {{ html()->textarea('remark')->class('form-control')->attribute('row', 5) }}
                    </div>
                        <button type="submit" class="mt-1 btn btn-primary">Update Product</button>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
