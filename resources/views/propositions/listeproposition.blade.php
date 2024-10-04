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
            @if ($uniqueProposition)
                @php
                    $informations = json_decode($uniqueProposition->informationRequise, true);

                @endphp
                <div class="col s12">
                    <div class="card">
                        <div class="p-10 bg-success">
                            <h5 class="m-b-0 white-text" style="text-align: center">
                                {{ 'OFFRE : ' . $uniqueProposition->offre->dossieroffre->reference . ' ( ' . $uniqueProposition->offre->produit->nomProduit . ' )' }}
                            </h5>
                            <a class="dropdown-trigger btn white black-text"
                                data-target="dropdown{{ $uniqueProposition->id }}" style="font-size:0.8em;">Action
                                <span class="fas fa-angle-down">
                                </span></a>
                            <ul id="dropdown{{ $uniqueProposition->id }}" class="dropdown-content"
                                tabindex="{{ $uniqueProposition->id }}" style="min-width: 300px;">
                                @if ($uniqueProposition->details()->count() != $uniqueProposition->offre->details()->count())
                                    <li>
                                        <a href="{{ route('proposition.detail.new', $uniqueProposition->id) }}"
                                            class=""><i class="ti-plus" aria-hidden="true"></i>Ajouter une
                                            garantie
                                        </a>
                                    </li>
                                @endif

                                <li tabindex="{{ $uniqueProposition->id }}">
                                    <a href="{{ route('proposition.edit', $uniqueProposition->id) }}" class=""><i
                                            class="ti-pencil" aria-hidden="true"></i>Modifier les
                                        informations sur la proposition</a>
                                </li>
                                <li tabindex="{{ $uniqueProposition->id }}">
                                    <a href="{{ route('proposition.delete', $uniqueProposition->id) }}" class=""><i
                                            class="ti-close" aria-hidden="true"></i>Supprimer toute
                                        la proposition </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-content">
                            <div class="container m-t-40">
                                <div class="row">
                                    <div class="col s12">
                                        <h5><i class="material-icons">check_box</i>INFORMATION SUR LA PROPOSITION
                                        </h5>
                                        <br>
                                        @foreach ($informations as $info)
                                            <i class="material-icons">chevron_right</i><b>{{ $info['nom'] }}
                                                :</b>
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
                                            @endif <br>
                                        @endforeach
                                        <h5 class="m-t-40"><i class="material-icons">check_box</i>LES
                                            GARANTIES
                                        </h5><br>
                                        @foreach ($uniqueProposition->details as $detail)
                                            @php
                                                $details = json_decode($detail->detailPropositions, true);

                                            @endphp

                                            <h6>{{ $detail->detailoffre->garantie->libelle }}</h6>
                                            @foreach ($details as $detailjsons)
                                                <p> <i class="material-icons">chevron_right</i><b>{{ $detailjsons['nom'] }}
                                                        :</b>
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
                                                </p>
                                                @php
                                                    $detailjsons = null;
                                                @endphp
                                            @endforeach
                                            <p><i class="material-icons">chevron_right</i><b>Prime :</b>
                                                {{ number_format($detail->prime, 0, ',', '.') . ' FCFA' }}</p>
                                            <p><i class="material-icons">chevron_right</i><b>Sur prime :</b>
                                                {{ number_format($detail->surPrime, 0, ',', '.') . ' FCFA' }}</p>

                                            <a href="{{ route('proposition.detail.edit', $detail->id) }}"
                                                class="btn btn-small"><i class="ti-pencil" aria-hidden="true"></i></a>
                                            <a href="{{ route('proposition.detail.delete', $detail->id) }}"
                                                class="btn btn-small red"><i class="ti-close" aria-hidden="true"></i> </a>
                                        @endforeach
                                        <p><i class="material-icons">chevron_right</i><b>Accessoire :</b>
                                            {{ number_format($uniqueProposition->accessoire, 0, ',', '.') . ' FCFA' }}</p>
                                        <p><i class="material-icons">chevron_right</i><b>Taxe :</b>
                                            {{ number_format($uniqueProposition->taxe, 0, ',', '.') . ' FCFA' }}</p>
                                        <p><i class="material-icons">chevron_right</i><b>Reduction :</b>
                                            {{ $uniqueProposition->reduction . ' %' }}</p>
                                        <p><i class="material-icons">chevron_right</i><b>Prime
                                                Totale :
                                            </b>{{ number_format($uniqueProposition->primeTotale, 0, ',', '.') . ' FCFA' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
