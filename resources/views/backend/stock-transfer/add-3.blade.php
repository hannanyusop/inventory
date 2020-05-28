@extends('backend.layouts.app')

@section('title', app_name() . ' | Transfer Stock')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-news-paper icon-gradient bg-ripe-malin"></i>
                </div>
                <div>Receive Stock
                    <div class="page-title-subheading">STEP 3: Transaction Confirmation</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Transfer Stock</h5>
                    {{ html()->form('post', route('admin.stock-transfer.add', 'step=4'))->attribute('enctype', 'multipart/form-data')->open() }}
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="customer_name" class="">Customer Name</label>
                                    {{ html()->text('customer_name', $customer->name)->class('form-control')->readonly() }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="customer_name" class="">Email</label>
                                    {{ html()->text('customer_name', $customer->email)->class('form-control')->readonly() }}
                                </div>
                            </div>
                        </div>
                        <div class="position-relative form-group">
                            <label for="address" class="">Address</label>
                            {{ html()->textarea('address', $customer->name)->class('form-control')->attribute('disabled', true) }}
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
                            @if(Session::has('transfer_product'))
                                @foreach(Session::get('transfer_product')['product'] as $key => $item)
                                    <tr>
                                        <td>{{ $item['code'] }}</td>
                                        <td>{{ $item['name'] }}</td>
                                        <td>RM{{ $item['price_customer'] }}</td>
                                        <td>RM{{ $item['price_adjustment'] }}</td>
                                        <td>{{ $item['qty'] }}</td>
                                        <td>{{ $item['total'] }}</td>
                                        <?php $sub = $sub+$item['total'] ?>
                                    </tr>
                                @endforeach
                            @endif
                        </table>

                    <h5 class="float-right text-primary font-weight-bold m-5">
                        TOTAL: RM<?= $sub ?>
                    </h5><br>
                    <div class="position-relative form-group">
                        {{ html()->textarea('remark')->class('form-control')->placeholder('Remark') }}
                    </div>

                        <a href="{{ route('admin.stock-transfer.add', 'step=2') }}" class="btn btn-warning">Modify Product List</a>
                        <button class="btn btn-success">Save</button>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
