@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Liste objectif</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Liste objectif</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Liste des objectifs</h5>
                        <a href="{{ route('objectif.new') }}" class="waves-effect waves-light right btn green"><i
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
                                        <th>Type d'objectif</th>
                                        <th>Nombre de client</th>
                                        <th>Chiffre d'affaire</th>
                                        <th>Date début</th>
                                        <th>Date fin</th>
                                        <th>Niveau</th>
                                        <th>Recompense</th>
                                        <th>Etat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($objectifs as $objectif)
                                        @php
                                            $debut = \Carbon\Carbon::parse($objectif->debut)->format('d/m/Y');
                                            $fin = \Carbon\Carbon::parse($objectif->fin)->format('d/m/Y');
                                        @endphp
                                        <tr>
                                            <td><span
                                                    class="label {{ $objectif->type == 'Challenge' ? 'label-success' : 'label-info' }}">{{ $objectif->type }}</span>
                                            </td>
                                            <td>{{ $objectif->nombre }}</td>
                                            <td>{{ number_format($objectif->ca, 0, ',', '.') . ' FCFA' }}</td>
                                            <td>{{ $debut }}</td>
                                            <td>{{ $fin }}</td>
                                            <td>{{ 'Niveau ' . $objectif->statut->niveau }}</td>
                                            <td>{{ $objectif->recompense }}</td>
                                            <td><span
                                                    class="label {{ $objectif->etat == 0 ? 'label-danger' : 'label-info' }}">{{ $objectif->etat == 0 ? 'Non ventiller' : 'Ventiller' }}</span>
                                            </td>
                                            <td>
                                                <a class="dropdown-trigger btn lighten-2"
                                                    data-target="dropdowntype{{ $objectif->id }}"
                                                    style="font-size:0.8em;">Action
                                                    <span class="fas fa-angle-down">
                                                    </span></a>
                                                <ul id="dropdowntype{{ $objectif->id }}" class="dropdown-content"
                                                    tabindex="{{ $objectif->id }}" style="min-width: 300px;">

                                                    <li tabindex="{{ $objectif->id }}">
                                                        <a href="{{ route('objectif.pub', $objectif->id) }}"
                                                            class=""><i class="ti-pencil"
                                                                aria-hidden="true"></i>Ventiller</a>
                                                    </li>
                                                    <li tabindex="{{ $objectif->id }}">
                                                        <a href="{{ route('table.realisation', $objectif->id) }}"
                                                            class=""><i class="ti-pencil"
                                                                aria-hidden="true"></i>Exporter la table de réalisation</a>
                                                    </li>
                                                    <li tabindex="{{ $objectif->id }}">
                                                        <a href="{{ route('realisation.liste', $objectif->id) }}"
                                                            class=""><i class="ti-pencil"
                                                                aria-hidden="true"></i>Réalisation</a>
                                                    </li>
                                                    <li tabindex="{{ $objectif->id }}">
                                                        <a href="{{ route('objectif.edit', $objectif->id) }}"
                                                            class=""><i class="ti-pencil"
                                                                aria-hidden="true"></i>Modifier
                                                            l'objectif</a>
                                                    </li>
                                                    <li tabindex="{{ $objectif->id }}">
                                                        <a href="{{ route('objectif.delete', $objectif->id) }}"
                                                            class=""><i class="ti-close"
                                                                aria-hidden="true"></i>Supprimer
                                                            l'objectif</a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>


                                        @php
                                            $objectif = null;
                                        @endphp
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Type d'objectif</th>
                                        <th>Nombre de client</th>
                                        <th>Chiffre d'affaire</th>
                                        <th>Date début</th>
                                        <th>Date fin</th>
                                        <th>Niveau</th>
                                        <th>Recompense</th>
                                        <th>Etat</th>
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
