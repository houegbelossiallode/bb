@extends('notifications.layouts.template')
@section('section')
    <div>

        <p>
            {{  $rendezVousMessage}}
            avec le prospect  :

           {{ $nom . ' ' . $prenom }} 
        </p> <br>
        Détails du rendez-vous <a href="{{ $action }}"><button class="btn btn-success">Voir</button></a> 
    </div>
@endsection
