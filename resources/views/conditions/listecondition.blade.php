@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Liste condition</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Liste condition</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Liste des conditions</h5>
                        <a href="{{ route('condition.new', $idproduit) }}"
                            class="waves-effect waves-light right btn green"><i class="ti-plus"
                                aria-hidden="true"></i>Ajouter</a>
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
                                    <th>Libelle</th>
                                    <th>Niveau</th>
                                    <th>Superieur</th>
                                    <th>Produit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($conditions as $condition)
                                    <tr>
                                        <td>{{ $condition->libelle }}</td>
                                        <td>{{ 'Niveau ' . $condition->niveau }}</td>
                                        <td>{{ $condition->superieure ? $condition->superieure->libelle : '' }}</td>
                                        <td>{{ $condition->produit->nomProduit }}</td>
                                        <td>
                                            <a class="dropdown-trigger btn lighten-2"
                                                data-target="dropdown{{ $condition->id }}" style="font-size:0.8em;">Action
                                                <span class="fas fa-angle-down">
                                                </span></a>
                                            <ul id="dropdown{{ $condition->id }}" class="dropdown-content"
                                                tabindex="{{ $condition->id }}" style="min-width: 300px;">
                                                <li tabindex="{{ $condition->id }}">
                                                    <a href="{{ route('valeur.liste', $condition->id) }}" class=""><i
                                                            class="ti-pencil" aria-hidden="true"></i>Configurer les valeurs
                                                        de la
                                                        condition</a>
                                                </li>
                                                <li tabindex="{{ $condition->id }}">
                                                    <a href="{{ route('condition.hierachie.new', $condition->id) }}"
                                                        class=""><i class="ti-pencil"
                                                            aria-hidden="true"></i>Configurer l'hierachie</a>
                                                </li>
                                                <li tabindex="{{ $condition->id }}">
                                                    <a href="{{ route('condition.hierachie.liste', $condition->id) }}"
                                                        class=""><i class="ti-pencil" aria-hidden="true"></i>Voir
                                                        l'hierachie</a>
                                                </li>
                                                <li tabindex="{{ $condition->id }}">
                                                    <a href="{{ route('condition.edit', ['idproduit' => $idproduit, 'idcondition' => $condition->id]) }}"
                                                        class=""><i class="ti-pencil" aria-hidden="true"></i>Modifier
                                                        la condition</a>
                                                </li>
                                                <li tabindex="{{ $condition->id }}">
                                                    <a href="{{ route('condition.delete', ['idproduit' => $idproduit, 'idcondition' => $condition->id]) }}"
                                                        class=""><i class="ti-close" aria-hidden="true"></i>Supprimer
                                                        la condition</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @php
                                        $condition = null;
                                    @endphp
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Libelle</th>
                                    <th>Niveau</th>
                                    <th>Superieur</th>
                                    <th>Produit</th>
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
