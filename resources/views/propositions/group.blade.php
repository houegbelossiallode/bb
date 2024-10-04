@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Groupe de proposition</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Groupe de proposition</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Groupe de proposition</h5>
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
                                    <th>Offre</th>
                                    <th>Produit</th>
                                    <th>Compagnie</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($propositions as $proposition)
                                    <tr>
                                        <td>{{ 'Offre ' . $proposition->offre->dossieroffre->reference }}</td>
                                        <td>{{ $proposition->offre->produit->nomProduit }}</td>
                                        <td>{{ $proposition->compagnie->nom }}</td>
                                        <td>
                                            <a class="dropdown-trigger btn lighten-2"
                                                data-target="dropdown{{ $proposition->id }}" style="font-size:0.8em;">Action
                                                <span class="fas fa-angle-down">
                                                </span></a>
                                            <ul id="dropdown{{ $proposition->id }}" class="dropdown-content"
                                                tabindex="{{ $proposition->id }}" style="min-width: 300px;">

                                                <li tabindex="{{ $proposition->id }}">
                                                    <a href="{{ route('proposition.unique', $proposition->id) }}"
                                                        class=""><i class="ti-pencil" aria-hidden="true"></i>Voir la
                                                        propositions
                                                    </a>
                                                </li>
                                                <li tabindex="{{ $proposition->id }}">
                                                    <a href="{{ route('proposition.delete', $proposition->id) }}"
                                                        class=""><i class="ti-close" aria-hidden="true"></i>Supprimer
                                                        la proposition </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @php
                                        $proposition = null;
                                    @endphp
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Offre</th>
                                    <th>Produit</th>
                                    <th>Compagnie</th>
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
