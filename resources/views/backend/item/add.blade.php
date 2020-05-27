@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Add Product</h5>
                    {{ html()->form('post', route('admin.item.insert'))->attribute('enctype', 'multipart/form-data')->open() }}

                    <div class="row">

                    </div>
                    <div class="position-relative form-group">
                        <label for="code" class="">CODE</label>
                        {{ html()->input('text', 'code')->placeholder('PRODUCT CODE')->class('form-control') }}
                    </div>

                    <div class="position-relative form-group">
                        <label for="code" class="">NAME</label>
                        {{ html()->input('text', 'name')->placeholder('PRODUCT NAME')->class('form-control') }}
                    </div>

                    <div class="position-relative form-group">
                        <label for="category_id" class="">CATEGORY</label>
                        {{ html()->select('category_id', $categories)->class('multiselect-dropdown form-control') }}
                    </div>

                    <div class="position-relative form-group">
                        <label for="price_supplier" class="">SUPPLIER PRICE</label>
                        {{ html()->input('text', 'price_supplier')->placeholder('SUPPLIER PRICE')->class('form-control') }}
                    </div>

                    <div class="position-relative form-group">
                        <label for="price_supplier" class="">CUSTOMER PRICE</label>
                        {{ html()->input('text', 'price_customer')->placeholder('CUSTOMER PRICE')->class('form-control') }}
                    </div>

                    <div class="position-relative form-group">
                        <label for="code" class="">QUANTITY LEFT </label>
                        {{ html()->input('text','qty_left')->value('0')->class('form-control')->readonly() }}
                        <small class="form-text text-muted"></small>
                    </div>

                    <div class="position-relative form-group">
                        <label for="code" class="">QUANTITY ALERT </label>
                        {{ html()->input('text','qty_alert')->value('0')->class('form-control') }}
                        <small class="form-text text-muted"></small>
                    </div>

                    <div class="position-relative form-group ml-3">
                        {{ html()->checkbox('qty_alert_disabled')->class('form-check-input') }}
                        Disabled quantity alert
                        <small class="form-text text-muted"></small>
                    </div>


                        <div class="position-relative form-group">
                            <label for="exampleText" class="">DESCRIPTION</label>
                            {{ html()->textarea('description')->class('form-control')->attribute('row', 5) }}
                            <small class="form-text text-muted">This is some placeholder block-level help
                                text for the above input. It's a bit lighter and easily wraps to a new
                                line.
                            </small>
                        </div>
                        <div class="position-relative form-group">
                            <label for="image" class="">IMAGE</label>
                            {{ html()->file('image_url')->class('form-control-file') }}
                            <small class="form-text text-muted">MAX:5MB</small>
                        </div>
                        <button type="submit" class="mt-1 btn btn-primary">Add New Product</button>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
