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
                        <h5 class="font-medium m-b-20">Se connecter</h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <form class="col s12" action="{{ route('login') }}" method="POST">
                            @csrf
                            <!-- email -->
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="email" type="email" name="email"
                                        class="validate @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                    <label for="email">Email</label>
                                    @error('email')
                                        <span id="emailHelp" class="form-text red-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- pwd -->
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="password" type="password" name="password"
                                        class="validate @error('password') is-invalid @enderror">
                                    <label for="password">Password</label>
                                    @error('password')
                                        <span id="passwordHelp" class="form-text red-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- pwd -->
                            <div class="row m-t-5">
                                <div class="col s7">
                                    <label>
                                        <input type="checkbox" />
                                        <span>Se souvenir de moi?</span>
                                    </label>
                                </div>
                                <div class="col s5 right-align"><a href="#" class="link" id="to-recover">Mot de
                                        passe oublié?</a></div>
                            </div>
                            <!-- pwd -->
                            <div class="row m-t-40">
                                <div class="col s12">
                                    <button class="btn-large w100 blue accent-4" type="submit">Se connecter</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div id="recoverform">
                    <div class="logo">
                        <span class="db"><img src="{{ asset('assets/images/logo-icon.png') }}" alt="logo" /></span>
                        <h5 class="font-medium m-b-20">Récupérer votre mot de passe</h5>
                        <span>Entrez votre email et des instructions vous seront envoyées !</span>
                    </div>
                    <div class="row">
                        <!-- Form -->
                        <form class="col s12" action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <!-- email -->
                            <div class="row">
                                <div class="input-field col s12">
                                    <input class="validate @error('email') is-invalid @enderror" type="email"
                                        name="email" placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                        <span id="emailHelp" class="form-text red-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- pwd -->
                            <div class="row m-t-20">
                                <div class="col s12">
                                    <button class="btn-large w100 red" type="submit" name="action">Réinitialiser</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Login box.scss -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Page wrapper scss in scafholding.scss -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Page wrapper scss in scafholding.scss -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right Sidebar -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right Sidebar -->
            <!-- ============================================================== -->
        </div>
    </div>
@endsection
