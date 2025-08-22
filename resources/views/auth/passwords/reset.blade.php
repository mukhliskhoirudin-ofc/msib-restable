@extends('backend.layouts.auth')

@section('title', 'Reset Password')

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{ url('/') }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <a href="{{ route('panel.dashboard.index') }}" class="b-brand text-primary">
                                        <img src="{{ asset('backend/assets/img/favicon/Restable.svg') }}"
                                            class="img-fluid logo-lg" alt="logo" width="180">
                                    </a>
                                </span>
                                <span class="app-brand-text demo text-body fw-bolder">{{ config('app.name') }}</span>
                            </a>
                        </div>
                        <!-- /Logo -->

                        <h4 class="mb-2">Reset Your Password 🔐</h4>
                        <p class="mb-4">Enter your new password below</p>

                        <form method="POST" action="{{ route('password.update') }}" id="formResetPassword" class="mb-3">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            {{-- Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ $email ?? old('email') }}" required autofocus autocomplete="email" />

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="mb-3 form-password-toggle">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <div class="input-group input-group-merge">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" placeholder="New Password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Confirm Password --}}
                            <div class="mb-3 form-password-toggle">
                                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                <div class="input-group input-group-merge">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="Confirm Password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>

                            {{-- Button --}}
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary d-grid w-100">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </form>

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                Back to login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
