@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.passwords.expired_password_box_title'))

@section('content')
    <div class="modal-dialog w-100 mx-auto">
        <div class="modal-content">
            <div class="modal-body">
                <div class="h5 modal-title text-center">
                    <h4 class="mt-2">
                        <div>Ops! Password Expired,</div>
                        <span>Please change your password for security reasons.</span>
                    </h4>
                </div>
                @include('includes.partials.messages')
                {{ html()->form('PATCH', route('frontend.auth.password.expired.update'))->open() }}
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="position-relative form-group">

                            {{ html()->password('old_password')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.frontend.old_password'))
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
                <div class="float-left">
                    <a href="{{ route('frontend.auth.password.reset') }}" class="btn-lg btn btn-link">Recover Password</a>
                </div>
                <div class="float-right">
                    <button class="btn btn-primary btn-lg">Login to Dashboard</button>
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
@endsection
