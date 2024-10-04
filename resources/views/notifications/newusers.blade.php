@extends('notifications.layouts.template')
@section('section')
    <div>
        <h1>
            Salut {{ $nom . ' ' . $prenom }}
        </h1>
        <p>
            Vous venez d'avoir un compte sur notre application de courtage <br> <br>
            Vous verrez vos informaations de connexion ci dessous. <br><br>

            Email : <b> {{ $email }}</b> <br>

            Mot de passe : <b>{{ $mpt }}</b>

        </p> <br>
    </div>
@endsection
