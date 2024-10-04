@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Liste publication</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Liste publication</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Liste des publications</h5>
                        <a href="{{ route('publication.new', $iddossier) }}"
                            class="waves-effect waves-light right btn green"><i class="ti-plus"
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

                        <table id="commerciaux" class="responsive-table display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Offre</th>
                                    <th>Compagnie</th>
                                    <th>Date</th>
                                    <th>Date limite</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pubs as $pub)
                                    @php
                                        $date = \Carbon\Carbon::parse($pub->created_at)->format('d/m/Y');
                                        $deadline = \Carbon\Carbon::parse($pub->deadline)->format('d/m/Y');
                                    @endphp
                                    <tr>
                                        <td>{{ $pub->dossieroffre->reference }}
                                        </td>
                                        <td>{{ $pub->compagnie->nom }}</td>
                                        <td>{{ $date }}</td>
                                        <td class="red-text">{{ $deadline }}</td>
                                        <td>
                                            <a class="dropdown-trigger btn lighten-2"
                                                data-target="dropdowntype{{ $pub->id }}"
                                                style="font-size:0.8em;">Action
                                                <span class="fas fa-angle-down">
                                                </span></a>
                                            <ul id="dropdowntype{{ $pub->id }}" class="dropdown-content"
                                                tabindex="{{ $pub->id }}" style="min-width: 300px;">

                                                <li tabindex="{{ $pub->id }}">
                                                    <a href="{{ route('publication.relance', ['idpublication' => $pub->id, 'iddossier' => $pub->dossieroffre->id]) }}"
                                                        class=""><i class="ti-pencil"
                                                            aria-hidden="true"></i>Relancer</a>
                                                </li>
                                                <li tabindex="{{ $pub->id }}">
                                                    <a href="{{ route('publication.delete', ['idpublication' => $pub->id, 'iddossier' => $pub->dossieroffre->id]) }}"
                                                        class=""><i class="ti-close" aria-hidden="true"></i>Supprimer
                                                        la publication</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @php
                                        $pub = null;
                                    @endphp
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Offre</th>
                                    <th>Compagnie</th>
                                    <th>Date</th>
                                    <th>Date limite</th>
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
