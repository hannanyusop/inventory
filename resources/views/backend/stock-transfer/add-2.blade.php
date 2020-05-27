@extends('backend.layouts.app')

@section('title', app_name() . ' | Transfer Stock')
<?php
    use Illuminate\Support\Facades\Session;
?>

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="main-card mb-3 card">
                <div class="card-body">

                    <h3 class="card-title">STEP 2 :Add Product</h3>


                    {{ html()->form('post', route('admin.stock-transfer.add', 'step=2&add=true'))->attribute('enctype', 'multipart/form-data')->open() }}

                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label for="item_id" class="">PRODUCT</label>
                                <select id="item_id" name="item_id" class="form-control">
                                    @foreach($items as $item)
                                        <option value="{{ $item->id }}" data-price="{{ $item->price_customer}}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="position-relative form-group">
                                <label for="price_customer" class="">Actual(RM)</label>
                                {{ html()->text('price_customer')->class('form-control')->readonly() }}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="position-relative form-group">
                                <label for="price_adjustment" class="">Adjustment(RM)</label>
                                {{ html()->text('price_adjustment')->class('form-control') }}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="position-relative form-group">
                                <label for="qty" class="">Quantity</label>
                                {{ html()->text('qty')->class('form-control')->value(1) }}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="position-relative form-group">
                                <label for="qty" class="">Total(RM)</label>
                                {{ html()->text('total')->class('form-control') }}
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('admin.stock-transfer.add', 'step=1') }}" onclick="return confirm('Are you sure?')" class="btn btn-lg btn-warning">Back & Clear All Product</a>
                    <button type="submit" class="btn btn-lg btn-success">Save & Add Another Item</button>
                    <a href="{{ route('admin.stock-transfer.add', 'step=3') }}" class="btn btn-lg btn-primary">Dont Save & Next</a>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="main-card mb-3 card">
                <div class="card-body">

                    <h3 class="card-title">Added Product</h3>
                    <table class="mb-0 table">
                        <thead>
                        <tr>
                            <th>CODE</th>
                            <th>ADJUSTMENT</th>
                            <th>QTY</th>
                            <th>TTL</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sub = 0; ?>
                        @if(isset(Session::get('transfer_product')['product']))
                            @foreach(Session::get('transfer_product')['product'] as $key => $item)
                            <tr>
                                <td><a href="{{ route('admin.stock-transfer.remove-from-list', $key) }}" onclick="return confirm('Are you sure want to remove this product from list?')"><i class="fa fa-trash text-danger"></i> </a>{{ $item['code'] }}</td>
                                <td>{{ $item['price_adjustment'] }}</td>
                                <td>{{ $item['qty'] }}</td>
                                <td>{{ $item['total'] }}</td>
                                <?php $sub = $sub+$item['total'] ?>
                            </tr>
                            @endforeach
                        @endif
                        <tr>
                            <td class="ffont-weight-bold text-success" colspan="4"><b>TOTAL: RM<?= $sub ?></b></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-scripts')
<script type="text/javascript">

    $('#item_id').on('change', function() {

        $('#price_customer').val($(this).find(':selected').data('price'));
        $('#price_adjustment').val($(this).find(':selected').data('price'));
        updateTotal();
    });

    $('#qty').on('change', function () {
       updateTotal();
    });

    $('#price_adjustment').on('change', function () {
        updateTotal();
    });

    function updateTotal() {
        price = $('#price_adjustment').val();
        qty = $('#qty').val();
        $('#total').val(price*qty);
    }
</script>
@endpush
