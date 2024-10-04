@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Liste formulaire</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Liste formulaire</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Liste des formulaires</h5>
                        <a href="{{ route('formulaire.new', ['table' => $table, 'idTable' => $idTable]) }}"
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
                                    <th>Nom du formulaire</th>
                                    <th>Type du formulaire</th>
                                    <th>Options</th>
                                    <th>Etat</th>
                                    <th>Numéro d'odre</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($formulaires as $formulaire)
                                    @php
                                        $options = json_decode($formulaire->options, true);
                                    @endphp
                                    <tr>
                                        <td>{{ $formulaire->nom }}</td>
                                        <td>{{ $formulaire->type }}</td>
                                        <td>
                                            @if ($options)
                                                <ul>
                                                    @foreach ($options as $option)
                                                        <li>{{ $option['option'] }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                Aucune
                                            @endif


                                        </td>
                                        <td>{{ $formulaire->etat }}</td>
                                        <td>{{ $formulaire->ordre }}</td>
                                        <td>
                                            <a class="dropdown-trigger btn lighten-2"
                                                data-target="dropdown{{ $formulaire->id }}" style="font-size:0.8em;">Action
                                                <span class="fas fa-angle-down"></span></a>
                                            <ul id="dropdown{{ $formulaire->id }}" class="dropdown-content"
                                                tabindex="{{ $formulaire->id }}" style="min-width: 300px;">
                                                <li tabindex="{{ $formulaire->id }}">
                                                    <a href="{{ route('formulaire.edit', ['idformulaire' => $formulaire->id, 'table' => $table, 'idTable' => $idTable]) }}"
                                                        class=""><i class="ti-pencil" aria-hidden="true"></i>Modifier
                                                        la garantie</a>
                                                </li>
                                                <li tabindex="{{ $formulaire->id }}">
                                                    <a href="{{ route('formulaire.delete', ['idformulaire' => $formulaire->id, 'table' => $table, 'idTable' => $idTable]) }}"
                                                        class=""><i class="ti-close" aria-hidden="true"></i>Supprimer
                                                        la garantie</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @php
                                        $formulaire = null;
                                    @endphp
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom du formulaire</th>
                                    <th>Type du formulaire</th>
                                    <th>Options</th>
                                    <th>Etat</th>
                                    <th>Numéro d'odre</th>
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
