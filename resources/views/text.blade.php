@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Liste proposition</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Liste proposition</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            @foreach ($propositions as $proposition)
                @php
                    $informations = json_decode($proposition->informationRequise, true);

                @endphp
                <div class="col s6">
                    <div class="card">
                        <div class="p-10 bg-success">
                            <h5 class="m-b-0 white-text">
                                {{ $proposition->offre->produit->nomProduit . '(' . $proposition->offre->client->user->nom . ' ' . $proposition->offre->client->user->prenom . ')' }}
                            </h5>
                        </div>
                        <div class="card-content">
                            <ul class="collapsible">
                                <li>
                                    <div class="collapsible-header">Information proposition</div>
                                    <div class="collapsible-body">
                                        <ul>
                                            @foreach ($informations as $info)
                                                <li><b>{{ $info['nom'] }} :</b>
                                                    @if ($info['type'] == 'file')
                                                        <a class=""
                                                            href='{{ asset('storage/' . $info['information']) }}'>Voir</a>
                                                    @elseif ($info['type'] == 'FCFA')
                                                        {{ number_format($info['information'], 0, ',', '.') . ' FCFA' }}
                                                    @elseif (
                                                        $info['type'] == 'Kg' ||
                                                            $info['type'] == 'ans' ||
                                                            $info['type'] == 'mois' ||
                                                            $info['type'] == 'jours' ||
                                                            $info['type'] == 'Cv' ||
                                                            $info['type'] == 'm2' ||
                                                            $info['type'] == '%')
                                                        {{ $info['information'] . ' ' . $info['type'] }}
                                                    @else
                                                        {{ $info['information'] }}
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                                @foreach ($proposition->details as $detail)
                                    @php
                                        $details = json_decode($detail->detailPropositions, true);

                                    @endphp
                                    <li>
                                        <div class="collapsible-header">{{ $detail->detailoffre->garantie->libelle }}</div>
                                        <div class="collapsible-body">
                                            <ul class="m-b-40">
                                                @foreach ($details as $detailjsons)
                                                    <li><b>{{ $detailjsons['nom'] }} :</b>
                                                        @if ($detailjsons['type'] == 'file')
                                                            <a class=""
                                                                href='{{ asset('storage/' . $detailjsons['information']) }}'>Voir</a>
                                                        @elseif ($detailjsons['type'] == 'FCFA')
                                                            {{ number_format($detailjsons['information'], 0, ',', '.') . ' FCFA' }}
                                                        @elseif (
                                                            $detailjsons['type'] == 'Kg' ||
                                                                $detailjsons['type'] == 'ans' ||
                                                                $detailjsons['type'] == 'mois' ||
                                                                $detailjsons['type'] == 'jours' ||
                                                                $detailjsons['type'] == 'Cv' ||
                                                                $detailjsons['type'] == 'm2' ||
                                                                $detailjsons['type'] == '%')
                                                            {{ $detailjsons['information'] . ' ' . $detailjsons['type'] }}
                                                        @else
                                                            {{ $detailjsons['information'] }}
                                                        @endif
                                                    </li>
                                                    @php
                                                        $detailjsons = null;
                                                    @endphp
                                                @endforeach
                                                <li><b>Prime : {{ $detail->prime }}</b></li>
                                                <li><b>Sur prime : {{ $detail->surPrime }}</b></li>
                                                <li><b>Accessoire : {{ $detail->accessoire }}</b></li>
                                                <li><b>Taxe : {{ $detail->taxe }}</b></li>
                                                <li><b>Reduction : {{ $detail->reduction }}</b></li>
                                                <li><b>Prime Totale : {{ $detail->primeTotale }}</b></li>
                                            </ul>
                                            <a href="{{ route('proposition.detail.edit', $detail->id) }}"
                                                class="btn btn-small"><i class="ti-pencil" aria-hidden="true"></i></a>
                                            <a href="{{ route('proposition.detail.delete', $detail->id) }}"
                                                class="btn btn-small red"><i class="ti-close" aria-hidden="true"></i> </a>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                            <a class="dropdown-trigger btn light-green lighten-2"
                                data-target="dropdown{{ $proposition->id }}" style="font-size:0.8em;">Action
                                <span class="fas fa-angle-down">
                                </span></a>
                            <ul id="dropdown{{ $proposition->id }}" class="dropdown-content"
                                tabindex="{{ $proposition->id }}" style="min-width: 300px;">
                                @if ($proposition->details()->count() != $proposition->offre->details()->count())
                                    <li>
                                        <a href="{{ route('proposition.detail.new', $proposition->id) }}" class=""><i
                                                class="ti-plus" aria-hidden="true"></i>Ajouter une
                                            garantie
                                        </a>
                                    </li>
                                @endif

                                <li tabindex="{{ $proposition->id }}">
                                    <a href="{{ route('proposition.edit', $proposition->id) }}" class=""><i
                                            class="ti-pencil" aria-hidden="true"></i>Modifier les
                                        informations sur la proposition</a>
                                </li>
                                <li tabindex="{{ $proposition->id }}">
                                    <a href="{{ route('proposition.delete', $proposition->id) }}" class=""><i
                                            class="ti-close" aria-hidden="true"></i>Supprimer toute
                                        la proposition </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
