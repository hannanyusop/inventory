@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.passwords.reset_password_box_title'))

@section('content')

    <div class="modal-dialog w-100 mx-auto">
        <div class="modal-content">
            <div class="modal-body">
                <div class="h5 modal-title text-center">
                    <h4 class="mt-2">
                        <div>Recover Password Now</div>
                    </h4>
                </div>
                @include('includes.partials.messages')
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                {{ html()->form('POST', route('frontend.auth.password.reset'))->class('form-horizontal')->open() }}
                {{ html()->hidden('token', $token) }}
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="position-relative form-group">
                            {{ html()->email('email')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="position-relative form-group">
                            {{ html()->password('password')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password'))
                                        ->required() }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="position-relative form-group">
                            {{ html()->password('password_confirmation')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                                        ->required() }}
                        </div>
                    </div>
                </div>
                <div class="position-relative form-check">
                    {{ html()->label(html()->checkbox('remember', true, 1) . ' ' . __('labels.frontend.auth.remember_me'))->for('remember') }}
                </div>
            </div>
            <div class="modal-footer clearfix">
                <div class="float-right">
                    <button class="btn btn-primary btn-lg">Update Password</button>
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>

@endsection
