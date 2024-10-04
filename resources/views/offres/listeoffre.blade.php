@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Liste offre</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Liste offre</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h5 class="card-title">Référence : <span class="green-text">{{ $dossieroffre->reference }}</span>
                    </h5>
                    <a href="{{ route('offre.new', ['table' => 'dossier', 'idtable' => $dossieroffre->id]) }}"
                        class="waves-effect waves-light right btn green m-b-40"><i class="ti-plus"
                            aria-hidden="true"></i>Ajouter</a>
                    <div class="m-t-40">
                        @if (session()->has('success'))
                            <div class="card-panel teal lighten-2 white-text m-t-40">{{ session()->get('success') }}
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="card-panel red lighten-2 white-text m-t-40">{{ session()->get('error') }}</div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="p-10 bg-info">
                        <h5 class="m-b-0 white-text" style="text-align: center">
                            {{ 'REFERENCE : ' . $dossieroffre->reference }}</h5>
                    </div>
                    <div class="card-content">
                        @foreach ($dossieroffre->offres as $offre)
                            @php
                                $informations = json_decode($offre->informationRequise, true);

                            @endphp
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col s12">

                                        <h3><i class="material-icons blue-text">brightness_1</i>
                                            {{ $offre->produit->nomProduit }} </h3><a
                                            class="dropdown-trigger btn light-blue lighten-2"
                                            data-target="dropdown{{ $offre->id }}" style="font-size:0.8em;">Action
                                            <span class="fas fa-angle-down">
                                            </span></a>
                                        <ul id="dropdown{{ $offre->id }}" class="dropdown-content"
                                            tabindex="{{ $offre->id }}" style="min-width: 300px;">
                                            @if ($offre->details()->count() != $offre->produit->garanties()->count())
                                                <li>
                                                    <a href="{{ route('offre.detail.new', ['iddossier' => $dossieroffre->id, 'idoffre' => $offre->id]) }}"
                                                        class=""><i class="ti-plus" aria-hidden="true"></i>Ajouter une
                                                        garantie
                                                    </a>
                                                </li>
                                            @endif
                                            <li tabindex="{{ $offre->id }}">
                                                <a href="{{ route('proposition.new', $offre->id) }}" class=""><i
                                                        class="ti-plus" aria-hidden="true"></i>Postuler à
                                                    l'offre</a>
                                            </li>
                                            <li tabindex="{{ $offre->id }}">
                                                <a href="{{ route('proposition.liste', $offre->id) }}" class=""><i
                                                        class="ti-plus" aria-hidden="true"></i>Voir la proposition</a>
                                            </li>
                                            <li tabindex="{{ $offre->id }}">
                                                <a href="{{ route('comparatif', $offre->id) }}" class=""><i
                                                        class="ti-plus" aria-hidden="true"></i>Voir le
                                                    comparatif des
                                                    propositions</a>
                                            </li>
                                            <li tabindex="{{ $offre->id }}">
                                                <a class=""
                                                    href="{{ route('formulaire.liste', ['idTable' => $offre->id, 'table' => 'Offre']) }}"><i
                                                        class="ti-menu-alt" aria-hidden="true"></i>Configurer le
                                                    formulaire</a>
                                            </li>
                                            <li tabindex="{{ $offre->id }}">
                                                <a href="{{ route('offre.edit', ['iddossier' => $dossieroffre->id, 'idoffre' => $offre->id]) }}"
                                                    class=""><i class="ti-pencil" aria-hidden="true"></i>Modifier les
                                                    informations sur l'offre</a>
                                            </li>
                                            <li tabindex="{{ $offre->id }}">
                                                <a href="{{ route('offre.delete', ['iddossier' => $dossieroffre->id, 'idoffre' => $offre->id]) }}"
                                                    class=""><i class="ti-close" aria-hidden="true"></i>Supprimer
                                                    toute
                                                    l'offre </a>
                                            </li>

                                        </ul>
                                        <div class="container m-t-40">
                                            <div class="row">
                                                <div class="col s12">
                                                    <h5><i class="material-icons">check_box</i>INFORMATION SUR L'OFFRE</h5>
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
                                                    <h5 class="m-t-40"><i class="material-icons">check_box</i>LES GARANTIES
                                                    </h5><br>
                                                    @foreach ($offre->details as $detail)
                                                        @php
                                                            $details = json_decode($detail->detailOffres, true);

                                                        @endphp

                                                        <h6>{{ $detail->garantie->libelle }}</h6>
                                                        @foreach ($details as $detailjsons)
                                                            <i class="material-icons">chevron_right</i><b>{{ $detailjsons['nom'] }}
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
                                                            @endif <br>
                                                            @php
                                                                $detailjsons = null;
                                                            @endphp
                                                        @endforeach
                                                        @if (Auth::user()->role == 'Courtier')
                                                            <div class="container m-t-40 m-b-40">
                                                                <div class="row">
                                                                    <div class="col s12">
                                                                        <a href="{{ route('offre.detail.edit', ['iddossier' => $dossieroffre->id, 'iddetail' => $detail->id]) }}"
                                                                            class="btn btn-small"><i class="ti-pencil"
                                                                                aria-hidden="true"></i></a>
                                                                        <a href="{{ route('offre.detail.delete', ['iddossier' => $dossieroffre->id, 'iddetail' => $detail->id]) }}"
                                                                            class="btn btn-small red"><i class="ti-close"
                                                                                aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
