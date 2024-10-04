@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Liste realisation</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Liste realisation</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Liste des realisations</h5>
                        <a href="{{ route('realisation.new', $id) }}" class="waves-effect waves-light right btn green"><i
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
                                        <th>Nom & Prénom</th>
                                        <th>Niveau</th>
                                        <th>Nombre de client</th>
                                        <th>Chiffre d'affaire</th>
                                        <th>Date realisation</th>
                                        <th>Note</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($realisations as $realisation)
                                        @php
                                            $pourcentage = ($realisation->ca / $realisation->objectif->ca) * 100;
                                        @endphp
                                        <tr>
                                            <td><span
                                                    class="label {{ $realisation->objectif->type == 'Challenge' ? 'label-success' : 'label-info' }}">{{ $realisation->objectif->type }}</span>
                                            </td>
                                            <td>{{ $realisation->commercial->user->nom . ' ' . $realisation->commercial->user->prenom }}
                                            </td>
                                            <td>{{ 'Niveau ' . $realisation->objectif->statut->niveau }}</td>
                                            <td>{{ $realisation->nombre }}</td>
                                            <td>{{ number_format($realisation->ca, 0, ',', '.') . ' FCFA' }}</td>
                                            <td>{{ $realisation->date }}</td>
                                            <td><span
                                                    class="label {{ $realisation->date > $realisation->objectif->fin ? 'label-danger' : ($realisation->ca < $realisation->objectif->ca ? 'label-warning' : 'label-success') }}">{{ $realisation->date > $realisation->objectif->fin ? 'Retard' : $pourcentage . ' %' }}</span>
                                            </td>
                                            <td>
                                                <a class="dropdown-trigger btn lighten-2"
                                                    data-target="dropdowntype{{ $realisation->id }}"
                                                    style="font-size:0.8em;">Action
                                                    <span class="fas fa-angle-down">
                                                    </span></a>
                                                <ul id="dropdowntype{{ $realisation->id }}" class="dropdown-content"
                                                    tabindex="{{ $realisation->id }}" style="min-width: 300px;">

                                                    <li tabindex="{{ $realisation->id }}">
                                                        <a href="{{ route('realisation.edit', ['idrealisation' => $realisation->id, 'idobjectif' => $id]) }}"
                                                            class=""><i class="ti-pencil"
                                                                aria-hidden="true"></i>Modifier
                                                            la realisation</a>
                                                    </li>
                                                    <li tabindex="{{ $realisation->id }}">
                                                        <a href="{{ route('realisation.delete', ['idrealisation' => $realisation->id, 'idobjectif' => $id]) }}"
                                                            class=""><i class="ti-close"
                                                                aria-hidden="true"></i>Supprimer
                                                            la realisation</a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>


                                        @php
                                            $realisation = null;
                                        @endphp
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Type d'objectif</th>
                                        <th>Nom & Prénom</th>
                                        <th>Niveau</th>
                                        <th>Nombre de client</th>
                                        <th>Chiffre d'affaire</th>
                                        <th>Date realisation</th>
                                        <th>Note</th>
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
