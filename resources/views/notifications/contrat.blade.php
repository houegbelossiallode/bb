@extends('notifications.layouts.template')
@section('section')
    <div>
        <h1>
            FELICITATION !!!
        </h1>
        <h2>
            @if ($type == 'client')
                @if ($contrat->offre->dossier->client->type == 'Personne morale')
                    {{ $contrat->offre->dossier->client->entreprise->raisonSociale }}
                @else
                    {{ $contrat->offre->dossier->client->user->sexe . ' ' . $contrat->offre->dossier->client->user->nom . ' ' . $contrat->offre->dossier->client->user->prenom }}
                @endif
            @else
                {{ $contrat->proposition->compagnie->nom }}
            @endif
        </h2>
        <h2>
            @if ($type == 'client')
                <p>Vous êtes actuellement en relation avec la compagnie {{ $contrat->proposition->compagnie->nom }}t</p>
            @else
                <p>Votre proposition a été validée avec succès !</p>
            @endif
        </h2> <br>
        <p>Veuillez trouver ci-joint votre contrat</p>



    </div>
@endsection
