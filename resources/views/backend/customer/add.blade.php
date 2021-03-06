@extends('backend.layouts.app')

@section('title', app_name() . ' | Add Customer')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Add Customer</h5>
                    {{ html()->form('post', route('admin.customer.insert'))->attribute('enctype', 'multipart/form-data')->open() }}

                    <div class="position-relative form-group">
                        <label for="name" class="">NAME</label>
                        {{ html()->input('text', 'name')->placeholder('CUSTOMER NAME')->class('form-control') }}
                    </div>

                    <div class="position-relative form-group">
                        <label for="code" class="">EMAIL</label>
                        {{ html()->input('email', 'email')->placeholder('CUSTOMER EMAIL')->class('form-control') }}
                    </div>

                    <div class="position-relative form-group">
                        <label for="price_supplier" class="">PHONE NUMBER</label>
                        {{ html()->input('text', 'phone_number')->placeholder('CUSTOMER PHONE NUMBER')->class('form-control') }}
                    </div>

                    <div class="position-relative form-group">
                        <label for="address" class="">ADDRESS</label>
                        {{ html()->textarea('address')->class('form-control')->attribute('row', 5) }}
                        <small class="form-text text-muted">This is some placeholder block-level help
                            text for the above input. It's a bit lighter and easily wraps to a new
                            line.
                        </small>
                    </div>
                    <button type="submit" class="mt-1 btn btn-primary">Add New Customer</button>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
