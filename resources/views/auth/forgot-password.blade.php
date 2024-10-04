@extends('auth.layouts.template')
@section('section')
    <section id="wrapper" class="error-page">
        <div class="error-box" style="background:url({{ asset('assets/images/big/auth-bg.jpg') }}) no-repeat center center;">
            <div class="error-body center-align">
                <div class="card" style="width: 30%;margin: 0 auto;">
                    <div class="card-content">
                        <img src="{{ asset('assets/images/logo-icon.png') }}">
                        <h6>Récupérer votre mot de passe</h6>
                        <form action="{{ route('password.email') }}">
                            <div class="input-field">
                                <input class=" @error('email') is-invalid @enderror" type="email" name="email"
                                    placeholder="Email" value="{{ old('email') }}">
                                @error('email')
                                    <span id="emailHelp" class="form-text red-text">{{ $message }}</span>
                                @enderror
                            </div>
                            <button class="waves-effect waves-light btn indigo">Réinitialiser</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
