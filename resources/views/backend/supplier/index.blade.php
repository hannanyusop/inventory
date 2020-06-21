@extends('backend.layouts.app')

@section('title', app_name() . ' | Supplier List' )

@section('content')

    <div class="row">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Supplier / <a href="{{ route('admin.supllier.index') }}">List</a> / View</h5>
            </div>
        </div>
    </div>


    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-briefcase icon-gradient bg-ripe-malin"></i>
                </div>
                <div>Supplier
                    <div class="page-title-subheading">Examples of just how powerful ArchitectUI really is!</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div>
                        {{ html()->form()->method('get')->class('form-inline')->open() }}
                            <div class="position-relative form-group">
                                <label for="name" class="sr-only">Name</label>
                                {{ html()->input('text', 'name')->class('form-control mr-2')->value((request()->has('name'))? request('name') : '')->placeholder('NAME') }}
                            </div>
                            <div class="position-relative form-group">
                                <label for="email" class="sr-only">Email</label>
                                {{ html()->input('text', 'email')->class('form-control mr-2')->value((request()->has('email'))? request('email') : '')->name('EMAIL')  }}
                            </div>
                            <button class="btn btn-primary mr-2">Search</button>
                        <a href="{{ route('admin.supplier.index') }}" class="btn btn-warning mr-2">Clear</a>
                            <a href="{{ route('admin.supplier.add') }}" class="btn btn-success">Add Supplier</a>
                        {{ html()->form()->close()  }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($suppliers as $supplier)
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="card-shadow-primary card-border mb-3 profile-responsive card">
                    <div class="dropdown-menu-header">
                        <div class="dropdown-menu-header-inner bg-alternate">
                            <div class="menu-header-image opacity-2"></div>
                            <div class="menu-header-content btn-pane-right">
                                <div>
                                    <h5 class="menu-header-title">{{ $supplier->name }}</h5>
                                    <h6 class="menu-header-subtitle">
                                        {{ $supplier->email }}<br>
                                        <small>{{ $supplier->phone_number }}</small>
                                    </h6>
                                </div>
                                <div class="menu-header-btn-pane">
                                    <a href="{{ route('admin.supplier.edit', $supplier->id) }}" class="btn-wide btn-hover-shine btn-pill btn btn-warning">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="widget-content pt-2 pl-0 pb-2 pr-0">
                                <div class="text-center">
                                    <h5 class="widget-heading opacity-4 mb-0">{{ $supplier->phone_number }}</h5>
                                </div>
                            </div>
                        </li>
                        <li class="p-0 list-group-item">
                            <div class="grid-menu grid-menu-2col">
                                <div class="no-gutters row">
                                    <div class="col-sm-6">
                                        <a href="{{ route('admin.supplier.view', $supplier->id) }}" class="btn-icon-vertical btn-square btn-transition br-bl btn btn-outline-link">
                                            <i class="fa fa-eye btn-icon-wrapper btn-icon-lg mb-3"> </i>View Details
                                        </a>
                                    </div>
                                    <div class="col-sm-6">

                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@endsection

