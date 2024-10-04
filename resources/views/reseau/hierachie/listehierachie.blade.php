@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Hierachie réseau</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Hierachie réseau</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Hierachie réseau</h5>
                        <div class="m-t-40 m-b-40">
                            @if (session()->has('success'))
                                <div class="card-panel teal lighten-2 white-text">{{ session()->get('success') }}</div>
                            @endif
                            @if (session()->has('error'))
                                <div class="card-panel red lighten-2 white-text">{{ session()->get('error') }}</div>
                            @endif
                        </div>

                        <ul class="tabs tab-demo z-depth-1">
                            <li class="tab"><a href="#commercial">Chefs</a></li>
                            <li class="tab"><a href="#personnel">Collaborateurs</a></li>
                            <li class="tab"><a class="active" href="#client">Objectifs</a></li>
                        </ul>
                        <div id="commercial">
                            <div class="p-15 p-b-0">
                                <table id="commerciaux" class="responsive-table display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nom & Prénom</th>
                                            <th>Niveau</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($chefs as $chef)
                                            <tr>
                                                <td>{{ $chef->user->nom . ' ' . $chef->user->prenom }}</td>
                                                <td>{{ 'Niveau ' . $chef->statut->niveau }}</td>
                                            </tr>
                                            @php
                                                $chef = null;
                                            @endphp
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nom & Prénom</th>
                                            <th>Niveau</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div id="personnel">
                            {{-- <a href="{{ route('produit.new') }}" class="waves-effect waves-light right btn green m-t-40"><i
                                    class="ti-plus" aria-hidden="true"></i>Ajouter</a> --}}
                            <div class="p-15 p-b-0">
                                <table id="personnels" class="responsive-table display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nom & Prénom</th>
                                            <th>Niveau</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($collaborateurs as $collaborateur)
                                            <tr>
                                                <td>{{ $collaborateur->user->nom . ' ' . $collaborateur->user->prenom }}
                                                </td>
                                                <td>{{ 'Niveau ' . $collaborateur->statut->niveau }}</td>
                                            </tr>
                                            @php
                                                $collaborateur = null;
                                            @endphp
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nom & Prénom</th>
                                            <th>Niveau</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div id="client">
                            <a href="" class="waves-effect waves-light right btn green m-t-40"><i class="ti-plus"
                                    aria-hidden="true"></i>Ajouter</a>
                            <div class="p-15 p-b-0">
                                <table id="clients" class="responsive-table display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nombre de client</th>
                                            <th>Chiffre d'affaire</th>
                                            <th>Niveau</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($objectifs as $objectif)
                                            <tr>
                                                <td>{{ $objectif->nombre }}</td>
                                                <td>{{ $objectif->ca . ' FCFA' }}</td>
                                                <td>{{ 'Niveau ' . $objectif->statut->niveau }}</td>
                                                <td>
                                                    {{-- <a href="{{ route('objectif.edit', $objectif->id) }}"
                                                        class="btn btn-small btn-outline edit-row-btn"><i class="ti-pencil"
                                                            aria-hidden="true"></i></a>
                                                    <a href="{{ route('objectif.delete', $objectif->id) }}"
                                                        class="btn btn-small btn-outline delete-row-btn red"><i
                                                            class="ti-close" aria-hidden="true"></i></a> --}}
                                                </td>
                                            </tr>


                                            @php
                                                $objectif = null;
                                            @endphp
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre de client</th>
                                            <th>Chiffre d'affaire</th>
                                            <th>Niveau</th>
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
    </div>
@endsection
