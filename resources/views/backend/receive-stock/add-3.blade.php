@extends('backend.layouts.app')

@section('title', app_name() . ' | Receive Stock')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-cart icon-gradient bg-ripe-malin"></i>
                </div>
                <div>Receive Stock
                    <div class="page-title-subheading">STEP 3 : Transaction Confirmation</div>
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
                                    <label for="supplier_name" class="">Supplier Name</label>
                                    {{ html()->text('supplier_name', $supplier->name)->class('form-control')->readonly() }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="supplier_name" class="">Email</label>
                                    {{ html()->text('supplier_name', $supplier->email)->class('form-control')->readonly() }}
                                </div>
                            </div>
                        </div>
                        <div class="position-relative form-group">
                            <label for="address" class="">Address</label>
                            {{ html()->textarea('address', $supplier->name)->class('form-control')->attribute('disabled', true) }}
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
                            @if(Session::has('receive_product'))
                                @foreach(Session::get('receive_product')['product'] as $key => $item)
                                    <tr>
                                        <td>{{ $item['code'] }}</td>
                                        <td>{{ $item['name'] }}</td>
                                        <td>RM{{ $item['price_supplier'] }}</td>
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

                        <a href="{{ route('admin.stock-receive.add', 'step=2') }}" class="btn btn-warning btn-icon"><i class="fa fa-arrow-left btn-icon-wrapper"></i>Back</a>
                        <div class="float-right">
                            <button class="btn btn-success btn-icon"><i class="fa fa-save btn-icon-wrapper"></i> Save</button>
                        </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
