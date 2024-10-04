@extends('layouts.app')
@section('section')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Détails du rendez-vous</h3>
        </div>
        <div class="card-body">
            
            <p><strong>Date du rendez-vous :</strong> {{ \Carbon\Carbon::parse($rendezvous->date_du_rdv)->format('d/m/Y') }}</p>
            <p><strong>Notes :</strong> {{ $rendezvous->notes }}</p>

            <hr>

            @if($rendezvous->client)
                <h5 class="card-title">Informations du client</h5>
                <p><strong>Nom du client :</strong> {{ $rendezvous->client->user->nom }}</p>
                <p><strong>Prénom du client :</strong> {{ $rendezvous->client->user->prenom }}</p>
            @else
                <p>Le client n'a pas été trouvé.</p>
            @endif
        </div>
        
    </div>
</div>
@endsection