@extends('backend.layouts.app')

@section('title', app_name() . ' | Receive Stock')

@section('content')
    <div class="row">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-news-paper icon-gradient bg-ripe-malin"></i>
                    </div>
                    <div>Transfer Stock
                        <div class="page-title-subheading">Invoice</div>
                    </div>
                </div>
                <div>Receive Stock
                    <div class="page-title-subheading">Invoice</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Receive Stock</h5>
                    {{ html()->form('post', route('admin.stock-receive.add', 'step=4'))->attribute('enctype', 'multipart/form-data')->open() }}
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="customer_name" class="">Customer Name</label>
                                    {{ html()->text('customer_name', $invoice->customer->name)->class('form-control')->readonly() }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="customer_name" class="">Email</label>
                                    {{ html()->text('customer_name', $invoice->customer->email)->class('form-control')->readonly() }}
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="customer_name" class="">Phone Number</label>
                                    {{ html()->text('customer_name', $invoice->customer->phone_number)->class('form-control')->readonly() }}
                                </div>
                            </div>
                        </div>
                        <div class="position-relative form-group">
                            <label for="address" class="">Address</label>
                            {{ html()->textarea('address', $invoice->customer->address)->class('form-control')->attribute('disabled', true) }}
                        </div>

                        <h5 class="card-title">PRODUCT</h5>

                        <table class="mb-0 table">
                            <thead>
                            <tr>
                                <th>CODE</th>
                                <th>NAME</th>
                                <th>ACTUAL PRICE</th>
                                <th>ADJUSTMENT PRICE</th>
                                <th>QTY</th>
                                <th>TTL</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $sub = 0; ?>
                            @foreach($invoice->items as $key => $item)
                                <tr>
                                    <td>{{ $item->item->code }}</td>
                                    <td>{{ $item->item->name }}</td>
                                    <td>RM {{ $item['price'] }}</td>
                                    <td>RM {{ $item['price_adjustment'] }}</td>
                                    <td>{{ $item['qty'] }}</td>
                                    <td>RM {{ $item['qty']*$item['price_adjustment'] }}</td>
                                    <?php $sub = $sub+($item['qty']*$item['price_adjustment']) ?>
                                </tr>
                            @endforeach
                        </table>

                    <h5 class="float-right text-primary font-weight-bold m-5">
                        TOTAL: RM<?= $sub ?>
                    </h5><br>
                    <div class="position-relative form-group">
                        {{ html()->textarea('remark', $invoice->remark)->class('form-control')->placeholder('Remark')->attribute('disabled', 'readonly') }}
                    </div>

                        <a href="{{ route('admin.stock-receive.index') }}" class="btn btn-warning">Back</a>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
