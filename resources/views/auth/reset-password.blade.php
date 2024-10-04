@extends('auth.layouts.template')
@section('section')
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">Material Admin</p>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center"
            style="background:url({{ asset('assets/images/big/auth-bg.jpg') }}) no-repeat center center;">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="{{ asset('assets/images/logo-icon.png') }}" alt="logo" /></span>
                        <h5 class="font-medium m-b-20">Changer votre mot de passe</h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ request()->route('token') }}">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input class=" @error('email') is-invalid @enderror" type="email" name="email"
                                        placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                        <span id="emailHelp" class="form-text red-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input class=" @error('password') is-invalid @enderror" type="password" name="password"
                                        placeholder="password" value="{{ old('password') }}">
                                    @error('password')
                                        <span id="passwordHelp" class="form-text red-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input class=" @error('password_confirmation') is-invalid @enderror" type="password"
                                        name="password_confirmation" placeholder="password_confirmation"
                                        value="{{ old('password_confirmation') }}">
                                    @error('password_confirmation')
                                        <span id="password_confirmationHelp"
                                            class="form-text red-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row m-t-40">
                                <div class="col s12">
                                    <button class="btn-large w100 blue accent-4" type="submit">Modifier</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="center-align m-t-20 db">
                        <a href="{{ route('login') }}">Se connecter</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
