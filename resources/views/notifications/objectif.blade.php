@extends('notifications.layouts.template')
@section('section')
    <div>
        <h1>{{ $objectif->type }} </h1>
        <h2>{{ 'Objectifi lié au Niveau ' . $objectif->statut->niveau }} </h2>
        <h4 style="color: blue"> {{ 'Date début : ' . $debut }}</h4>
        <h4 style="color: red"> {{ 'Date limite : ' . $fin }}</h4>
        <p>

            Nombre de client : <b> {{ $objectif->nombre }}</b> <br> <br>

            Chiffre d'affaire : <b>{{ number_format($objectif->ca, 0, ',', '.') . ' FCFA' }}</b> <br> <br>

            @if ($objectif->type == 'Challenge')
                Recompense : <b>{{ $objectif->recompense }}</b>
            @endif

        </p> <br>
    </div>
@endsection
