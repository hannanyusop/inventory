@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.passwords.reset_password_box_title'))

@section('content')
    <div class="modal-dialog w-100 mx-auto">
        <div class="modal-content">
            <div class="modal-body">
                <div class="h5 modal-title text-center">
                    <img class="" src="{{ asset('img/backend/brand/logo-square.png') }}">
                    <h4 class="mt-2">
                        <div>Forgot Password?</div>
                        <span></span>
                    </h4>
                </div>
                @include('includes.partials.messages')
                {{ html()->form('POST', route('frontend.auth.password.email.post'))->open() }}
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="position-relative form-group">
                            {{ html()->email('email')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                        ->required()
                                        ->autofocus() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer clearfix">
                <div class="float-left">
                    <a href="{{ route('frontend.auth.login') }}" class="btn-lg btn btn-link"> Already Remember? Login Now</a>
                </div>
                <div class="float-right">
                    <button class="btn btn-success btn-lg">Send Password Reset Link</button>
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
@endsection
