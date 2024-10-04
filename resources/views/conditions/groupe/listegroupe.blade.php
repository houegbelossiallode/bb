@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Liste groupe</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Liste groupe</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Liste des groupes</h5>
                        <a href="{{ route('groupe.new', $idproduit) }}" class="waves-effect waves-light right btn green"><i
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

                        <table id="commerciaux" class="responsive-table display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Libelle</th>
                                    <th>Conditions</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groupes as $groupe)
                                    <tr>
                                        <td>{{ $groupe->libelle }}</td>
                                        <td>
                                            <ul>
                                                @foreach ($groupe->liaisons as $liaison)
                                                    <li><b>{{ $liaison->conditionvaleur->condition->libelle }} : </b>
                                                        {{ $liaison->conditionvaleur->libelle }}</li>
                                                @endforeach
                                            </ul>

                                        </td>
                                        <td>
                                            <a class="dropdown-trigger btn lighten-2"
                                                data-target="dropdown{{ $groupe->id }}" style="font-size:0.8em;">Action
                                                <span class="fas fa-angle-down">
                                                </span></a>
                                            <ul id="dropdown{{ $groupe->id }}" class="dropdown-content"
                                                tabindex="{{ $groupe->id }}" style="min-width: 300px;">
                                                <li tabindex="{{ $groupe->id }}">
                                                    <a href="{{ route('groupe.delete', ['idproduit' => $idproduit, 'idgroupe' => $groupe->id]) }}"
                                                        class=""><i class="ti-close" aria-hidden="true"></i>Supprimer
                                                        le groupe</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @php
                                        $groupe = null;
                                    @endphp
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Libelle</th>
                                    <th>Conditions</th>
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
