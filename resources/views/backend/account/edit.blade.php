@extends('backend.layouts.app')

@section('title', app_name() . ' | Update Details')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title"> Update Details</h5>
                    {{ html()->modelForm($user)->action((route('admin.account.update')))->open() }}

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="first_name" class="">FIRST NAME</label>
                                {{ html()->input('text', 'first_name')->placeholder('LAST NAME')->class('form-control') }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="code" class="">LAST NAME</label>
                                {{ html()->input('text', 'last_name')->placeholder('FIRST NAME')->class('form-control') }}
                            </div>
                        </div>
                    </div>




                    <div class="position-relative form-group">
                        <label for="email" class="">E-MAIL</label>
                        {{ html()->input('email', 'email')->placeholder('EMAIL')->class('form-control') }}
                    </div>

                    <button type="submit" class="mt-1 btn btn-primary">Update</button>
                    {{ html()->form()->close() }}
                </div>
            </div>

            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">  Change Password</h5>
                    {{ html()->form('POST', route('admin.account.update-password'))->open() }}

                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label for="password" class="">OLD PASSWORD</label>
                                {{ html()->input('password', 'password')->placeholder('OLD PASSWORD')->class('form-control') }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label for="new_password" class="">NEW PASSWORD</label>
                                {{ html()->input('password', 'new_password')->placeholder('NEW PASSWORD')->class('form-control') }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label for="confirm_password" class="">CONFIRM PASSWORD</label>
                                {{ html()->input('password', 'new_password_confirmation')->placeholder('CONFIRM NEW PASSWORD')->class('form-control') }}
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="mt-1 btn btn-primary">Change Password</button>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
