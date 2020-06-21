@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-home icon-gradient bg-ripe-malin"></i>
                </div>
                <div>Dashboard
                    <div class="page-title-subheading">Hye! {{ auth()->user()->fullname }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-primary border-primary card">
                <div class="widget-chat-wrapper-outer">
                    <div class="widget-chart-content">
                        <div class="widget-title opacity-5 text-uppercase">Customers</div>
                        <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                            <div class="widget-chart-flex align-items-center">
                                <div>
                                    {{ $box['customer'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-danger border-danger card">
                <div class="widget-chat-wrapper-outer">
                    <div class="widget-chart-content">
                        <div class="widget-title opacity-5 text-uppercase">Supplier</div>
                        <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                            <div class="widget-chart-flex align-items-center">
                                <div>
                                    {{ $box['supplier'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-warning border-warning card">
                <div class="widget-chat-wrapper-outer">
                    <div class="widget-chart-content">
                        <div class="widget-title opacity-5 text-uppercase">Products Sold</div>
                        <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                            <div class="widget-chart-flex align-items-center">
                                <div>
                                    {{ displayPrice($box['total_sale']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-success border-success card">
                <div class="widget-chat-wrapper-outer">
                    <div class="widget-chart-content">
                        <div class="widget-title opacity-5 text-uppercase">Total Stock</div>
                        <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                            <div class="widget-chart-flex align-items-center">
                                <div>
                                    {{ displayPrice($box['total_stock']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-shadow-primary card-border mb-3 profile-responsive card">
                <ul class="list-group list-group-flush">
                    <li class="p-0 list-group-item">
                        <div class="grid-menu grid-menu-2col">
                            <div class="no-gutters row">
                                <div class="col-sm-2">
                                    <div class="p-2">
                                        <a href="{{ route('admin.stock-receive.add')  }}" class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-dark">
                                            <i class="pe-7s-upload text-dark opacity-7 btn-icon-wrapper mb-2"> </i>Receive Stock
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="p-2">
                                        <a href="{{ route('admin.stock-transfer.add')  }}" class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-danger">
                                            <i class="pe-7s-download text-danger opacity-7 btn-icon-wrapper mb-2"></i>New Transfer List
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="p-2">
                                        <a href="{{ route('admin.item.add')  }}" class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-success">
                                            <i class="fa fa-tags text-success opacity-7 btn-icon-wrapper mb-2"></i>Add Products
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="p-2">
                                        <a href="{{ route('admin.supplier.add')  }}" class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-warning">
                                            <i class="fa fa-briefcase text-warning opacity-7 btn-icon-wrapper mb-2"></i>Add Supplier
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="p-2">
                                        <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-info">
                                            <i class="fa fa-users text-info opacity-7 btn-icon-wrapper mb-2"></i>Add Customer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    Quantity Alert
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th class="text-center">Qty Left</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($qty_alert as $item)
                            <tr>
                                <td class="text-muted">{{ $item->code }}</td>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">{{ $item->qty_left }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.item.view', $item->id) }}" id="PopoverCustomT-1" class="btn btn-primary btn-sm">Details</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-block text-center card-footer">
                    <a href="{{ route('admin.item.index') }}" class="btn-wide btn btn-success">View All Products</a>
                </div>
            </div>
        </div>

    </div>
@endsection
