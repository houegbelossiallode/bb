@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Liste renseignement</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Liste renseignement</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Liste des renseignements</h5>

                        <div>
                            @if (session()->has('success'))
                                <div class="card-panel teal lighten-2 white-text m-t-40">{{ session()->get('success') }}
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="card-panel red lighten-2 white-text m-t-40">{{ session()->get('error') }}</div>
                            @endif
                        </div>

                        <table id="commerciaux" class="responsive-table display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Garantie</th>
                                    <th>Information</th>
                                    <th>Valeur</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($renseignements as $renseignement)
                                    @if ($renseignement->informationgarantie->garantie->produit->id == $id)
                                        <tr>
                                            <td>
                                                {{ $renseignement->informationgarantie->garantie->produit->nomProduit }}
                                            </td>
                                            <td>
                                                {{ $renseignement->informationgarantie->garantie->libelle }}
                                            </td>
                                            <td>
                                                {{ $renseignement->informationgarantie->nom }}
                                            </td>
                                            <td>
                                                @if ($renseignement->informationgarantie->type === 'FCFA')
                                                    {{ number_format($renseignement->valeur, 0, ',', '.') . ' FCFA' }}
                                                @elseif (
                                                    $renseignement->informationgarantie->type === 'Kg' ||
                                                        $renseignement->informationgarantie->type === 'ans' ||
                                                        $renseignement->informationgarantie->type === 'mois' ||
                                                        $renseignement->informationgarantie->type === 'jours' ||
                                                        $renseignement->informationgarantie->type === 'Cv' ||
                                                        $renseignement->informationgarantie->type === 'm2' ||
                                                        $renseignement->informationgarantie->type === '%')
                                                    {{ $renseignement->valeur . ' ' . $renseignement->informationgarantie->type }}
                                                @else
                                                    Aucun
                                                @endif

                                            </td>
                                            <td>
                                                <a class="dropdown-trigger btn lighten-2"
                                                    data-target="dropdown{{ $renseignement->id }}"
                                                    style="font-size:0.8em;">Action
                                                    <span class="fas fa-angle-down">
                                                    </span></a>
                                                <ul id="dropdown{{ $renseignement->id }}" class="dropdown-content"
                                                    tabindex="{{ $renseignement->id }}" style="min-width: 300px;">

                                                    <li tabindex="{{ $renseignement->id }}">
                                                        <a href="{{ route('renseignement.edit', ['idproduit' => $id, 'idrenseignement' => $renseignement->id]) }}"
                                                            class=""><i class="ti-pencil"
                                                                aria-hidden="true"></i>Modifier
                                                            le renseignement</a>
                                                    </li>
                                                    <li tabindex="{{ $renseignement->id }}">
                                                        <a href="{{ route('renseignement.delete', ['idproduit' => $id, 'idrenseignement' => $renseignement->id]) }}"
                                                            class=""><i class="ti-close"
                                                                aria-hidden="true"></i>Supprimer
                                                            le renseignement</a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endif

                                    @php
                                        $renseignement = null;
                                    @endphp
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Produit</th>
                                    <th>Garantie</th>
                                    <th>Information</th>
                                    <th>Valeur</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
