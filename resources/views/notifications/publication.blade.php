@extends('notifications.layouts.template')
@section('section')
    <div>
        <h1>
            @if ($compagnie == 'client')
                @if ($dossier->client->type == 'Personne morale')
                    {{ $dossier->client->entreprise->raisonSociale }}
                @else
                    {{ $dossier->client->user->nom }}
                @endif
            @else
                {{ $compagnie->nom }}
            @endif

        </h1>
        <h2> {{ 'OFFRE : ' . $dossier->reference }}</h2>
        <h2 style="color: red"> {{ 'Date limite : ' . $date }}</h2> <br>

        @foreach ($dossier->offres as $offre)
            Produit : <b>{{ $offre->produit->nomProduit }}</b>
            @php
                $informations = json_decode($offre->informationRequise, true);
            @endphp
            <p>
                @foreach ($informations as $information)
                    @if ($information['type'] == 'file')
                        Fichier inclu : <b>{{ $information['nom'] }}</b> <br>
                    @elseif ($information['type'] == 'FCFA')
                        {{ $information['nom'] }} :
                        <b>{{ number_format($information['information'], 0, ',', '.') . ' FCFA' }}</b> <br>
                    @elseif (
                        $information['type'] == 'Kg' ||
                            $information['type'] == 'ans' ||
                            $information['type'] == 'mois' ||
                            $information['type'] == 'jours' ||
                            $information['type'] == 'Cv' ||
                            $information['type'] == 'm2' ||
                            $information['type'] == '%')
                        {{ $information['nom'] }} : <b>{{ $information['information'] . ' ' . $information['type'] }}</b>
                        <br>
                    @else
                        {{ $information['nom'] }} : <b>{{ $information['information'] }}</b> <br>
                    @endif
                @endforeach

            </p>
            <h2>GARANTIES</h2>
            @foreach ($offre->details as $detail)
                @php
                    $detailoffres = json_decode($detail->detailOffres, true);
                @endphp
                <h3>{{ $detail->garantie->libelle }}</h3>
                <p>
                    @foreach ($detailoffres as $detailoffre)
                        @if ($detailoffre['type'] == 'file')
                            Fichier inclu : <b>{{ $detailoffre['nom'] }}</b> <br>
                        @elseif ($detailoffre['type'] == 'FCFA')
                            {{ $detailoffre['nom'] }} :
                            <b>{{ number_format($detailoffre['information'], 0, ',', '.') . ' FCFA' }}</b> <br>
                        @elseif (
                            $detailoffre['type'] == 'Kg' ||
                                $detailoffre['type'] == 'ans' ||
                                $detailoffre['type'] == 'mois' ||
                                $detailoffre['type'] == 'jours' ||
                                $detailoffre['type'] == 'Cv' ||
                                $detailoffre['type'] == 'm2' ||
                                $detailoffre['type'] == '%')
                            {{ $detailoffre['nom'] }} :
                            <b>{{ $detailoffre['information'] . ' ' . $detailoffre['type'] }}</b>
                            <br>
                        @else
                            {{ $detailoffre['nom'] }} : <b>{{ $detailoffre['information'] }}</b> <br>
                        @endif
                    @endforeach
                </p>
            @endforeach
            <br><br>
        @endforeach


    </div>
@endsection
@section('bouton')
    <div align="center">
        <a href="http://127.0.0.1:8000/offre/liste/{{ $offre->client_id }}"><button
                style="background-color: #1f98d1; padding-top: 5px; padding-bottom: 5px; width: 100px; color:beige; border:none">
                Postuler </button></a>
    </div>
@endsection
