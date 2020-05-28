@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-ticket icon-gradient bg-ripe-malin"></i>
                </div>
                <div>Product
                    <div class="page-title-subheading">Add Product</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    {{ html()->form('post', route('admin.item.insert'))->attribute('enctype', 'multipart/form-data')->open() }}

                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label for="code" class="">CODE</label>
                                {{ html()->input('text', 'code')->placeholder('PRODUCT CODE')->class('form-control') }}
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="position-relative form-group">
                                <label for="code" class="">NAME</label>
                                {{ html()->input('text', 'name')->placeholder('PRODUCT NAME')->class('form-control') }}
                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="category_id" class="">CATEGORY</label>
                                {{ html()->select('category_id', $categories)->class('multiselect-dropdown form-control') }}
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="price_supplier" class="">SUPPLIER PRICE</label>
                                {{ html()->input('text', 'price_supplier')->placeholder('SUPPLIER PRICE (RM)')->class('form-control') }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="price_supplier" class="">CUSTOMER PRICE</label>
                                {{ html()->input('text', 'price_customer')->placeholder('CUSTOMER PRICE (RM)')->class('form-control') }}
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="code" class="">QUANTITY LEFT </label>
                                {{ html()->input('text','qty_left')->value('0')->class('form-control')->readonly() }}
                                <small class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="code" class="">QUANTITY ALERT </label>
                                {{ html()->input('text','qty_alert')->value('0')->class('form-control') }}
                                <small class="form-text text-muted"></small>
                            </div>
                        </div>
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

                    <a href="{{ route('admin.item.index') }}" class="btn btn-icon btn-warning"><i class="btn-icon-wrapper fa fa-arrow-left"></i> Back To List</a>
                    <div class="float-right">
                        <button type="submit" class="mt-1 btn btn-success btn-icon"><i class="btn-icon-wrapper fa fa-plus"></i> Add New Product</button>
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
