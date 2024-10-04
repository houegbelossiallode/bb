@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Nouvelle production</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Nouvelle production</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <div class="m-t-40">
                    @if (session()->has('success'))
                        <div class="card-panel teal lighten-2 white-text m-t-40">{{ session()->get('success') }}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="card-panel red lighten-2 white-text m-t-40">{{ session()->get('error') }}</div>
                    @endif
                </div>
                @isset($etat)
                    @if ($etat == 0)
                        <div class="card-panel red lighten-2 white-text m-t-40">Aucun groupe de combinaison pour ces conditions
                        </div>
                    @endif
                @endisset
                <h5 class="card-title">Nouvelle production</h5>

                @isset($groupes)
                    <form id="tarifForm">
                        @method('post')
                        @csrf
                        <div class="row m-t-40">
                            <div class="input-field col s12">
                                <h5 class="m-b-40">Sélectionner le groupe de conditions</h5>

                                @foreach ($groupes as $groupe)
                                    @php
                                        $conditions = [];

                                        foreach ($groupe->liaisons as $liaison) {
                                            if ($liaison->conditionvaleur) {
                                                $conditions[] = $liaison->conditionvaleur->libelle;
                                            }
                                        }

                                        $conditionsString = implode(', ', $conditions);

                                    @endphp
                                    <p>
                                        <label>
                                            <input type="radio" id="groupe" name="groupe"
                                                class="filled-in validate @error('groupe') is-invalid @enderror"
                                                value="{{ $groupe->id }}" onchange="updateProductionLink()" />
                                            <span>{{ $conditionsString }}</span>
                                        </label>
                                    </p>
                                @endforeach
                                @error('groupe')
                                    <span id="groupeHelp" class="form-text red-text">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-field col s12">
                                <h5 class="m-b-40">Sélectionner les compagnies</h5>
                                @foreach ($compagnies as $compagnie)
                                    @if ($compagnie['statut'] && $compagnie['statut'] == true)
                                        <p>
                                            <label>
                                                <input type="checkbox" id="compagnie" name="compagnie[]"
                                                    class="filled-in validate @error('compagnie') is-invalid @enderror"
                                                    value="{{ $compagnie->id }}" />
                                                <span>{{ $compagnie->nom }}</span>
                                            </label>
                                        </p>
                                    @endif
                                @endforeach
                                @error('compagnie')
                                    <span id="compagnieHelp" class="form-text red-text">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <button class="btn waves-effect waves-light left" onclick="getTarif(event)">Obtenez le
                                    tarif</button>
                                <a class="btn waves-effect waves-light right disabled" id="productionButton"
                                    href="{{ route('production') }}">Produire</a>
                            </div>

                        </div>
                    </form>
                @else
                    <form action="{{ route('group.get') }}" method="POST">
                        @method('post')
                        @csrf
                        <div class="row m-t-40">
                            <div class="input-field col s12 l6">
                                <h5 class="m-b-40">Sélectionner les conditions</h5>

                                @foreach ($conditions as $condition)
                                    <h5 class="m-b-20">{{ $condition->libelle }}</h5>
                                    <div class="m-b-40">
                                        @foreach ($condition->valeurs as $valeur)
                                            <p>
                                                <label>
                                                    <input type="radio" id="condition_{{ $condition->id }}"
                                                        name="condition[{{ $condition->id }}]"
                                                        class="filled-in validate @error('condition') is-invalid @enderror"
                                                        value="{{ $valeur->id }}" />
                                                    <span>{{ $valeur->libelle }}</span>
                                                </label>
                                            </p>
                                        @endforeach
                                    </div>
                                @endforeach
                                @error('condition')
                                    <span id="conditionHelp" class="form-text red-text">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <button class="btn waves-effect waves-light right" type="submit">Suivant</button>
                            </div>
                        </div>
                    </form>
                @endisset

                <div id="tarif-result" style="margin-top: 20px;"></div>

            </div>
        </div>
    </div>
@endsection
