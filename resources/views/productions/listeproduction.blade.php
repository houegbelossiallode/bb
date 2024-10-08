@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Liste production</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Liste production</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Liste des productions</h5>
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
                                    <th>Compagnie</th>
                                    <th>Prime</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productions as $production)
                                    <tr>
                                        <td>{{ $production->reference }}</td>
                                        <td>{{ $production->client->user->nom . ' ' . $production->client->user->prenom }}
                                        </td>
                                        <td>{{ $production->compagnie->nom }}</td>
                                        <td>{{ number_format($production->prime, 2) }}</td>
                                        <td>{{ $production->statut }}</td>
                                        <td>
                                            <a class="dropdown-trigger btn lighten-2"
                                                data-target="dropdown{{ $production->id }}" style="font-size:0.8em;">Action
                                                <span class="fas fa-angle-down">
                                                </span></a>
                                            <ul id="dropdown{{ $production->id }}" class="dropdown-content"
                                                tabindex="{{ $production->id }}" style="min-width: 300px;">

                                                <li tabindex="{{ $production->id }}">
                                                    <a href="{{ route('production.unique', $production->id) }}"
                                                        class=""><i class="ti-eye" aria-hidden="true"></i>Générer le contrat</a>
                                                </li>
                                                <li tabindex="{{ $production->id }}">
                                                    <a href="{{ route('production.unique', $production->id) }}"
                                                        class=""><i class="ti-eye" aria-hidden="true"></i>Voir la
                                                        production</a>
                                                </li>
                                                <li tabindex="{{ $production->id }}">
                                                    <a href="{{ route('production.delete', $production->id) }}"
                                                        class=""><i class="ti-close" aria-hidden="true"></i>Supprimer
                                                        la production</a>
                                                </li>
                                                <li tabindex="{{ $production->id }}">
                                                    <a href="{{ route('production.edit', $production->id) }}" class=""><i
                                                            class="ti-pencil" aria-hidden="true"></i>Modifier les
                                                        informations sur la production</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @php
                                        $production = null;
                                    @endphp
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Référence</th>
                                    <th>Client</th>
                                    <th>Compagnie</th>
                                    <th>Statut</th>
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
