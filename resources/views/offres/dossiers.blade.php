@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Dossier d'offre</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Dossier d'offre</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Dossier d'offre</h5>
                        {{-- <a href="{{ route('compagnie.new') }}" class="waves-effect waves-light right btn green"><i
                                class="ti-plus" aria-hidden="true"></i>Ajouter</a> --}}
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
                                    <th>Référence</th>
                                    <th>Client</th>
                                    <th>Date de création</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dossieroffres as $dossieroffre)
                                    @php
                                        $date = \Carbon\Carbon::parse($dossieroffre->created_at)->format('d/m/Y');
                                    @endphp
                                    <tr>
                                        <td>{{ $dossieroffre->reference }}</td>
                                        <td>{{ $dossieroffre->client->user->nom . ' ' . $dossieroffre->client->user->prenom }}
                                        </td>
                                        <td>{{ $date }}</td>
                                        <td>
                                            <a class="dropdown-trigger btn lighten-2"
                                                data-target="dropdown{{ $dossieroffre->id }}"
                                                style="font-size:0.8em;">Action
                                                <span class="fas fa-angle-down">
                                                </span></a>
                                            <ul id="dropdown{{ $dossieroffre->id }}" class="dropdown-content"
                                                tabindex="{{ $dossieroffre->id }}" style="min-width: 300px;">

                                                <li tabindex="{{ $dossieroffre->id }}">
                                                    <a href="{{ route('offre.liste', $dossieroffre->id) }}"
                                                        class=""><i class="ti-pencil" aria-hidden="true"></i>Voir les
                                                        offres</a>
                                                </li>

                                                <li tabindex="{{ $dossieroffre->id }}">
                                                    <a class=""
                                                        href="{{ route('publication.new', $dossieroffre->id) }}"><i
                                                            class="ti-menu-alt" aria-hidden="true"></i>Publier l'offre</a>
                                                </li>
                                                {{-- <li tabindex="{{ $dossieroffre->id }}">
                                                    <a href="{{ route('proposition.new', $dossieroffre->id) }}"
                                                        class=""><i class="ti-plus" aria-hidden="true"></i>Postuler à
                                                        l'offre</a>
                                                </li> --}}
                                                {{-- <li tabindex="{{ $dossieroffre->id }}">
                                                    <a href="{{ route('proposition.liste.offre', $dossieroffre->id) }}"
                                                        class=""><i class="ti-plus" aria-hidden="true"></i>Voir les
                                                        propositions</a>
                                                </li> --}}

                                                {{-- <li tabindex="{{ $dossieroffre->id }}">
                                                    <a href="{{ route('dossieroffre.delete', $dossieroffre->id) }}"
                                                        class=""><i class="ti-close" aria-hidden="true"></i>Supprimer
                                                        la dossier</a>
                                                </li> --}}
                                            </ul>
                                        </td>
                                    </tr>
                                    @php
                                        $dossieroffre = null;
                                    @endphp
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Référence</th>
                                    <th>Client</th>
                                    <th>Date de création</th>
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
