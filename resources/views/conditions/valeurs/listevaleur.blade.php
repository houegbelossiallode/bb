@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Liste valeur</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Liste valeur</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Liste des valeurs</h5>
                        <a href="{{ route('valeur.new', $idcondition) }}"
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
                                    <th>Valeur</th>
                                    <th>Condition</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($valeurs as $valeur)
                                    <tr>
                                        <td>{{ $valeur->libelle }}</td>
                                        <td>{{ $valeur->condition->libelle }}</td>
                                        <td>
                                            <a class="dropdown-trigger btn lighten-2"
                                                data-target="dropdown{{ $valeur->id }}" style="font-size:0.8em;">Action
                                                <span class="fas fa-angle-down">
                                                </span></a>
                                            <ul id="dropdown{{ $valeur->id }}" class="dropdown-content"
                                                tabindex="{{ $valeur->id }}" style="min-width: 300px;">

                                                <li tabindex="{{ $valeur->id }}">
                                                    <a href="{{ route('valeur.edit', ['idcondition' => $idcondition, 'idvaleur' => $valeur->id]) }}"
                                                        class=""><i class="ti-pencil" aria-hidden="true"></i>Modifier
                                                        la valeur</a>
                                                </li>
                                                <li tabindex="{{ $valeur->id }}">
                                                    <a href="{{ route('valeur.delete', ['idcondition' => $idcondition, 'idvaleur' => $valeur->id]) }}"
                                                        class=""><i class="ti-close" aria-hidden="true"></i>Supprimer
                                                        la valeur</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @php
                                        $valeur = null;
                                    @endphp
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Valeur</th>
                                    <th>Condition</th>
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
