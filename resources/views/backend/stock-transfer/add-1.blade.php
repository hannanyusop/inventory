@extends('backend.layouts.app')

@section('title', app_name() . ' | Transfer Stock')
<?php
    use Illuminate\Support\Facades\Session;
?>
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">

                    <h3 class="card-title">STEP 1: Customer Information</h3>
                    {{ html()->form('post', route('admin.stock-transfer.add', 'step=1'))->attribute('enctype', 'multipart/form-data')->open() }}

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="customer_id" class="">CUSTOMER</label>
                                {{ html()->select('customer_id', $customers)->value((Session::has('transfer_product'))?Session::get('transfer_product')['customer_id'] : "" )->class('form-control') }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="examplePassword11" class="">DATE</label>
                                {{ html()->input('text', 'date')->class('form-control')->attribute('data-toggle', 'datepicker')->value((Session::has('transfer_product'))?Session::get('transfer_product')['date'] : "" )->class('form-control') }}
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="mt-1 btn btn-primary">Next</button>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
