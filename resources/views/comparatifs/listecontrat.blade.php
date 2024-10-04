@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Contrat d'offre</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Contrat d'offre</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Contrat d'offre</h5>
                        <a href="{{ route('compagnie.new') }}" class="waves-effect waves-light right btn green"><i
                                class="ti-plus" aria-hidden="true"></i>Ajouter</a>
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
                                    <th>Numéro de police</th>
                                    <th>Offre</th>
                                    <th>Durée de contrat</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contrats as $contrat)
                                    @php
                                        $debut = \Carbon\Carbon::parse($contrat->debut)->format('d/m/Y');
                                        $fin = \Carbon\Carbon::parse($contrat->fin)->format('d/m/Y');
                                    @endphp
                                    <tr>
                                        <td>{{ $contrat->numero }}</td>
                                        <td>{{ $contrat->offre->dossieroffre->reference . ' (' . $contrat->offre->produit->nomProduit . ')' }}
                                        </td>
                                        <td>{{ $contrat->duree }}</td>
                                        <td>{{ $debut }}</td>
                                        <td>{{ $fin }}</td>
                                        <td>
                                            <a class="dropdown-trigger btn lighten-2"
                                                data-target="dropdown{{ $contrat->id }}" style="font-size:0.8em;">Action
                                                <span class="fas fa-angle-down">
                                                </span></a>
                                            <ul id="dropdown{{ $contrat->id }}" class="dropdown-content"
                                                tabindex="{{ $contrat->id }}" style="min-width: 300px;">

                                                <li tabindex="{{ $contrat->id }}">
                                                    <a href="{{ route('contrat', $contrat->id) }}" class=""><i
                                                            class="ti-pencil" aria-hidden="true"></i>Générer le contrat</a>
                                                </li>

                                                <li tabindex="{{ $contrat->id }}">
                                                    <a class=""
                                                        href="{{ route('publication.new', $contrat->id) }}"><i
                                                            class="ti-menu-alt" aria-hidden="true"></i>Supprimer le
                                                        contrat</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @php
                                        $contrat = null;
                                    @endphp
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Numéro de police</th>
                                    <th>Offre</th>
                                    <th>Durée de contrat</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
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
