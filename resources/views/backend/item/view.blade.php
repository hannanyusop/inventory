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
                    <div class="page-title-subheading">View Product #{{ $item->id }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-2">

            <div class="mb-3 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        <i class="header-icon lnr-charts icon-gradient bg-happy-green"> </i>
                        Product View
                    </div>
                </div>
                <div class="card-body">

                    <h5>NAME           : {{ $item->name }}</h5>
                    <h5>CATEGORY           : {{ $item->category->name }}</h5>
                    <h5>SUPPLIER PRICE : {{ displayPrice($item->price_supplier) }}</h5>
                    <h5>CUSTOMER PRICE : {{ displayPrice($item->price_customer) }}</h5>
                    <h5>MARGIN         : {{ displayPrice($item->price_customer-$item->price_supplier) }}</h5>
                    <h5>QUANTITY ALERT : {{ ($item->quantity_alert_disabled == 1)? "When ".$item->qty_alert. " unit(s) left" : "OFF" }}</h5>
                    <h5>DESCRIPTION    : {{ $item->description }}</h5>
                </div>
                <div class="no-gutters row">
                    <div class="col-sm-6 col-md-4 col-xl-4">
                        <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                            <div class="icon-wrapper rounded-circle">
                                <div class="icon-wrapper-bg opacity-10 bg-warning"></div>
                                <i class="fa fa-tags text-dark opacity-8"></i>
                            </div>
                            <div class="widget-chart-content">
                                <div class="widget-subheading">Total Unit Sold</div>
                                <div class="widget-numbers">{{ $item->qty_total-$item->qty_left }}</div>
                            </div>
                        </div>
                        <div class="divider m-0 d-md-none d-sm-block"></div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-xl-4">
                        <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                            <div class="icon-wrapper rounded-circle">
                                <div class="icon-wrapper-bg opacity-9 bg-danger"></div>
                                <i class="fa fa-archive text-white"></i>
                            </div>
                            <div class="widget-chart-content">
                                <div class="widget-subheading">Total Unit Left</div>
                                <div class="widget-numbers">{{ $item->qty_left }}</div>
                            </div>
                        </div>
                        <div class="divider m-0 d-md-none d-sm-block"></div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-xl-4">
                        <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                            <div class="icon-wrapper rounded-circle">
                                <div class="icon-wrapper-bg opacity-9 bg-success"></div>
                                <i class="fa fa-anchor text-white"></i>
                            </div>
                            <div class="widget-chart-content">
                                <div class="widget-subheading">Total Unit</div>
                                <div class="widget-numbers text-success"><span>{{ $item->qty_total }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center d-block p-3 card-footer">
                    <a href="{{ route('admin.item.index') }}" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-warning btn-lg">
                        <span class="mr-1">Back To List</span>
                    </a>
                    <a href="{{ route('admin.item.edit', $item->id) }}" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary btn-lg">
                        <span class="mr-1">Edit</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
