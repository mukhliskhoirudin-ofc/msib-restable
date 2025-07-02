@extends('backend.layouts.auth')

@section('title', 'Verify Email')

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">

                <!-- Verify Email Card -->
                <div class="card">
                    <div class="card-body">
                        <!-- Branding (Opsional) -->
                        <div class="app-brand justify-content-center mb-3">
                            <a href="{{ url('/') }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <!-- Logo bisa ditaruh di sini -->
                                </span>
                                <span class="app-brand-text demo text-body fw-bolder">{{ config('app.name') }}</span>
                            </a>
                        </div>

                        <h4 class="mb-2 text-center">{{ __('Verify Your Email Address') }}</h4>
                        <p class="mb-4 text-center">
                            {{ __('Before proceeding, please check your email for a verification link.') }}<br>
                            {{ __('If you did not receive the email') }},
                        </p>

                        @if (session('resent'))
                            <div class="alert alert-success text-center" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Click here to request another') }}
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-3">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>

                    </div>
                </div>
                <!-- /Verify Email Card -->

            </div>
        </div>
    </div>
@endsection
