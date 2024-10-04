@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Production</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Production</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            @if ($production)
                @php
                    $informations = json_decode($production->informationRequise, true);

                @endphp
                <div class="col s12">
                    <div class="card">
                        <div class="p-10 bg-success">
                            <h5 class="m-b-0 white-text" style="text-align: center">
                                {{ 'PRODUCTION : ' . $production->reference . ' ( ' . $production->conditiongroupe->produit->nomProduit . ' )' }}
                            </h5>
                            <a class="dropdown-trigger btn white black-text" data-target="dropdown{{ $production->id }}"
                                style="font-size:0.8em;">Action
                                <span class="fas fa-angle-down">
                                </span></a>
                            <ul id="dropdown{{ $production->id }}" class="dropdown-content" tabindex="{{ $production->id }}"
                                style="min-width: 300px;">

                                <li tabindex="{{ $production->id }}">
                                    <a href="{{ route('production.edit', $production->id) }}" class=""><i
                                            class="ti-pencil" aria-hidden="true"></i>Modifier les
                                        informations sur la production</a>
                                </li>
                                <li tabindex="{{ $production->id }}">
                                    <a href="{{ route('production.delete', $production->id) }}" class=""><i
                                            class="ti-close" aria-hidden="true"></i>Supprimer toute
                                        la production </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-content">
                            <div class="container m-t-40">
                                <div class="row">
                                    <div class="col s12">
                                        <h5><i class="material-icons">check_box</i>INFORMATION SUR LA PRODUCTION
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
                                        @foreach ($production->conditiongroupe->produit->garanties as $garantie)
                                            <i class="material-icons">chevron_right</i><b>{{ $garantie->libelle }}</b>
                                            <br>
                                        @endforeach
                                        <h5 class="m-t-40"><i class="material-icons">check_box</i>LES CONDITIONS
                                        </h5>
                                        <br>
                                        @foreach ($production->conditiongroupe->liaisons as $liaison)
                                            <i class="material-icons">chevron_right</i><b>{{ $liaison->conditionvaleur->condition->libelle }}
                                                : </b>
                                            {{ $liaison->conditionvaleur->libelle }} <br>
                                        @endforeach
                                        <div class="m-t-40">
                                            <p><i class="material-icons">chevron_right</i><b>Reduction :</b>
                                                {{ $production->reduction . ' %' }}</p>
                                            <p><i class="material-icons">chevron_right</i><b>Prime
                                                    Totale :
                                                </b>{{ number_format($production->prime, 0, ',', '.') . ' FCFA' }}
                                            </p>
                                        </div>

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
