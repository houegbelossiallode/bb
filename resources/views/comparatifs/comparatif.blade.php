@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Comparatif</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Comparatif</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div>
                            @if (session()->has('success'))
                                <div class="card-panel teal lighten-2 white-text m-t-40">{{ session()->get('success') }}
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="card-panel red lighten-2 white-text m-t-40">{{ session()->get('error') }}</div>
                            @endif
                        </div>
                        <div class="table-container2 p-t-40">
                            <div class="row pricing-plan">
                                <div class="col s12 m6 l3 no-padding">
                                    <div class="pricing-box b-l">
                                        <div class="pricing-body">
                                            <div class="pricing-header">
                                                <h5 class="center-align">Comparatif</h5>
                                                <p class="center-align"><b>FCFA</b></p>
                                                <p class="uppercase">Prime totale</p>
                                            </div>
                                            <div class="price-table-content">
                                                @foreach ($formulaires as $formulaire)
                                                    <div class="price-row">{{ $formulaire['nom'] }}

                                                    </div>
                                                @endforeach

                                                @foreach ($garanties as $garantie)
                                                    <div class="price-row">
                                                        {{ $garantie->garantie->libelle }}
                                                    </div>
                                                    @php
                                                        $garantie = null;
                                                    @endphp
                                                @endforeach
                                                <div class="price-row">Accessoire</div>
                                                <div class="price-row">Taxe</div>
                                                <div class="price-row">Réduction</div>
                                                <div class="price-row">
                                                    <a class="waves-effect waves-light btn modal-trigger m-t-20"
                                                        href="#modal1">Comparatif</a>
                                                    <div id="modal1" class="modal">
                                                        <form action="{{ route('synthese', $offre->id) }}" method="post">
                                                            @csrf
                                                            <div class="modal-content">
                                                                <h4>Laisser un avis</h4>
                                                                <div class="input-field col s12">
                                                                    <textarea id="avis" name="avis" class="materialize-textarea validate @error('avis') is-invalid @enderror">{{ old('avis') }}</textarea>
                                                                    <label for="avis">Avis</label>
                                                                    @error('avis')
                                                                        <span id="avisHelp"
                                                                            class="form-text red-text">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button
                                                                    class="modal-action modal-close waves-effect waves-green btn-flat red white-text"
                                                                    type="reset">Fermer</button>

                                                                <button
                                                                    class="modal-action modal-close btn waves-effect waves-light right submit"
                                                                    type="submit" name="action">Synthèse</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($propositions as $proposition)
                                    @php
                                        $primeTotale = $proposition->primeTotale;
                                        //$stock = $primeTotale;
                                        $informations = json_decode($proposition->informationRequise, true);
                                    @endphp
                                    <div class="col s12 m6 l3 no-padding">
                                        <div class="pricing-box {{ $proposition->id == $minId ? 'featured-plan' : 'b-l' }}">
                                            <div class="pricing-body">
                                                <div class="pricing-header">
                                                    @if ($proposition->id == $minId)
                                                        <h6 class="price-lable yellow darken-4 white-text">Abordable</h6>
                                                    @endif
                                                    <h5 class="center-align blue-text">{{ $proposition->compagnie->nom }}
                                                    </h5>
                                                    <p class="center-align"><b>
                                                            {{ number_format($primeTotale, 0, ',', '.') . ' FCFA' }}</b>
                                                    </p>
                                                    <p class="uppercase">Prime totale</p>
                                                </div>
                                                <div class="price-table-content">
                                                    @foreach ($informations as $info)
                                                        <div class="price-row green-text"><i class="icon-check"></i>
                                                            @if ($info['type'] == 'file')
                                                            @elseif ($info['type'] == 'FCFA')
                                                                {{ number_format($info['information'], 0, ',', '.') . ' FCFA' }}
                                                            @elseif (
                                                                $info['type'] == 'Kg' ||
                                                                    $info['type'] == 'ans' ||
                                                                    $info['type'] == 'mois' ||
                                                                    $info['type'] == 'jours' ||
                                                                    $info['type'] == 'Cv' ||
                                                                    $info['type'] == 'm2')
                                                                {{ $info['information'] . ' ' . $info['type'] }}
                                                            @else
                                                                {{ $info['information'] }}
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                    @foreach ($proposition->offre->details as $detail)
                                                        @php
                                                            $detailPropositions = $detail->detailpropositions;
                                                            $count = 0;
                                                            $nomGaranrtie = '';
                                                            foreach ($detailPropositions as $detailProposition) {
                                                                if (
                                                                    $detailProposition->proposition_id ==
                                                                    $proposition->id
                                                                ) {
                                                                    $count += 1;
                                                                    $nomGarantie = $detail->garantie->libelle;
                                                                    $prime =
                                                                        $detailProposition->prime +
                                                                        $detailProposition->surPrime;
                                                                }
                                                            }
                                                        @endphp
                                                        @if ($count > 0)
                                                            <div class="price-row green-text">
                                                                <i class="icon-check"></i>
                                                                {{ number_format($prime, 0, ',', '.') . ' FCFA' }}
                                                            </div>
                                                        @else
                                                            <div class="price-row red-text"><i class="icon-close"></i> Néant
                                                            </div>
                                                        @endif
                                                        @php
                                                            $detail = null;
                                                        @endphp
                                                    @endforeach
                                                    @if ($proposition->accessoire > 0)
                                                        <div class="price-row green-text">
                                                            <i class="icon-check"></i>
                                                            {{ number_format($proposition->accessoire, 0, ',', '.') . ' FCFA' }}
                                                        </div>
                                                    @else
                                                        <div class="price-row red-text"><i class="icon-close"></i> Néant
                                                        </div>
                                                    @endif
                                                    @if ($proposition->taxe > 0)
                                                        <div class="price-row green-text">
                                                            <i class="icon-check"></i>
                                                            {{ number_format($proposition->taxe, 0, ',', '.') . ' FCFA' }}
                                                        </div>
                                                    @else
                                                        <div class="price-row red-text"><i class="icon-close"></i> Néant
                                                        </div>
                                                    @endif
                                                    @if ($proposition->reduction > 0)
                                                        <div class="price-row green-text">
                                                            <i class="icon-check"></i>
                                                            {{ $proposition->reduction . ' %' }}
                                                        </div>
                                                    @else
                                                        <div class="price-row red-text"><i class="icon-close"></i> Néant
                                                        </div>
                                                    @endif
                                                    <div class="price-row">
                                                        {{-- <a href="{{ route('validation', $proposition->id) }}"
                                                            class="btn waves-effect waves-light m-t-20">Valider</a> --}}

                                                        <a class="waves-effect waves-light btn modal-trigger m-t-20"
                                                            href="#modal2">Contrat</a>
                                                        <div id="modal2" class="modal">
                                                            <form
                                                                action="{{ route('validation', ['type' => 'indirect', 'id' => $proposition->id]) }}"
                                                                method="post">
                                                                @method('post')
                                                                @csrf
                                                                <div class="modal-content">
                                                                    <div class="container">
                                                                        <h3>Valider le contrat</h3>
                                                                        <div class="row">
                                                                            <div class="input-field col s12">
                                                                                <select name="duree" id="duree"
                                                                                    class="validate @error('duree') is-invalid @enderror">
                                                                                    <option value="" disabled
                                                                                        selected>Choisir la durée du contrat
                                                                                    </option>
                                                                                    @for ($i = 1; $i <= 240; $i++)
                                                                                        <option value={{ $i }}>
                                                                                            {{ $i . ' mois' }}</option>
                                                                                    @endfor
                                                                                </select>
                                                                                <label for="duree">Durée du
                                                                                    contrat</label>
                                                                            </div>
                                                                            <div class="input-field col s12 l6">
                                                                                <input id="debut" name="debut"
                                                                                    type="date"
                                                                                    class="validate @error('debut') is-invalid @enderror"
                                                                                    value="{{ old('debut') }}">
                                                                                <label for="debut">Date d'effet</label>
                                                                            </div>
                                                                            <div class="input-field col s12 l6">
                                                                                <input id="fin" name="fin"
                                                                                    type="date"
                                                                                    class="validate @error('fin') is-invalid @enderror"
                                                                                    value="{{ old('fin') }}">
                                                                                <label for="fin">Fin du
                                                                                    contrat</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button
                                                                        class="modal-action modal-close waves-effect waves-green btn-flat red white-text"
                                                                        type="reset">Fermer</button>

                                                                    <button
                                                                        class="modal-action modal-close btn waves-effect waves-light right submit"
                                                                        type="submit" name="action">Valider</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php

                                        $proposition = null;
                                    @endphp
                                @endforeach

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
