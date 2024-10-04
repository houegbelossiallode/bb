@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Liste client</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Liste client</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Liste des clients</h5>
                        <a href="{{ route('users.client.new') }}" class="waves-effect waves-light right btn green"><i
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
                        <div class="table-container">
                            <table id="clients" class="responsive-table display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Civilité(e)</th>
                                        <th>Nom complet</th>
                                        <th>Date de naissance</th>
                                        <th>Email</th>
                                        <th>Tel</th>
                                        <th>Adresse</th>
                                        <th>Type</th>
                                        <th>Entreprise</th>
                                        <th>Poste</th>
                                        <th>statut</th>
                                        <th>Commercial</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr>
                                            <td>{{ $client->user->sexe }}</td>
                                            <td>{{ $client->user->nom . ' ' . $client->user->prenom }}</td>
                                            <td>{{ $client->user->dateNaissance }}</td>
                                            <td>{{ $client->user->email }}</td>
                                            <td>{{ $client->user->tel }}</td>
                                            <td>{{ $client->user->adresse }}</td>
                                            <td>{{ $client->type }}</td>
                                            <td>{{ $client->entreprise->raisonSociale ?? 'Absent' }}</td>
                                            <td>{{ $client->poste ?? 'Absent' }}</td>
                                            <td><span
                                                    class="label {{ $client->statut == 'Client' ? 'label-success' : 'label-danger' }}">{{ $client->user->role }}</span>
                                            </td>
                                            <td>{{ $client->commercial->user->nom . ' ' . $client->commercial->user->prenom }}
                                            </td>
                                            <td>
                                                <a class="dropdown-trigger btn lighten-2"
                                                    data-target="dropdown{{ $client->id }}"
                                                    style="font-size:0.8em;">Action
                                                    <span class="fas fa-angle-down">
                                                    </span></a>
                                                <ul id="dropdown{{ $client->id }}" class="dropdown-content"
                                                    tabindex="{{ $client->id }}" style="min-width: 300px;">

                                                    <li tabindex="{{ $client->id }}">
                                                        <a class="" href="{{ route('info.liste', $client->id) }}"><i
                                                                class="ti-menu-alt" aria-hidden="true"></i>Enregister des
                                                            informations sur le client</a>
                                                    </li>
                                                    <li tabindex="{{ $client->id }}">
                                                        <a href="{{ route('offre.new', ['table' => 'client', 'idtable' => $client->id]) }}"
                                                            class=""><i class="ti-menu" aria-hidden="true"></i>Faire
                                                            une demande
                                                            d'offre</a>
                                                    </li>
                                                    <li tabindex="{{ $client->id }}">
                                                        <a href="{{ route('users.edit', ['id' => $client->id, 'role' => $client->user->role]) }}"
                                                            class=""><i class="ti-pencil"
                                                                aria-hidden="true"></i>Modifier le client</a>
                                                    </li>
                                                    <li tabindex="{{ $client->id }}">
                                                        <a href="{{ route('users.delete', ['id' => $client->id, 'role' => $client->user->role]) }}"
                                                            class=""><i class="ti-close"
                                                                aria-hidden="true"></i>Supprimer le client</a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        @php
                                            $client = null;
                                        @endphp
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Civilité(e)</th>
                                        <th>Date de naissance</th>
                                        <th>Email</th>
                                        <th>Tel</th>
                                        <th>Adresse</th>
                                        <th>Type</th>
                                        <th>Entreprise</th>
                                        <th>Poste</th>
                                        <th>statut</th>
                                        <th>Commercial</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
