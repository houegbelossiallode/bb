@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Liste agence</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Liste agence</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Liste des agences</h5>
                        <a href="{{ route('agence.new') }}" class="waves-effect waves-light right btn green"><i
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
                                    <th>Nom de l'agence</th>
                                    <th>Adresse</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agences as $agence)
                                    <tr>
                                        <td>{{ $agence->libelle }}</td>
                                        <td>{{ $agence->adresse }}</td>
                                        <td>
                                            <a class="dropdown-trigger btn lighten-2"
                                                data-target="dropdown{{ $agence->id }}" style="font-size:0.8em;">Action
                                                <span class="fas fa-angle-down">
                                                </span></a>
                                            <ul id="dropdown{{ $agence->id }}" class="dropdown-content"
                                                tabindex="{{ $agence->id }}" style="min-width: 300px;">

                                                <li tabindex="{{ $agence->id }}">
                                                    <a href="{{ route('agence.edit', $agence->id) }}" class=""><i
                                                            class="ti-pencil" aria-hidden="true"></i>Modifier
                                                        l'agence</a>
                                                </li>
                                                <li tabindex="{{ $agence->id }}">
                                                    <a href="{{ route('agence.delete', $agence->id) }}" class=""><i
                                                            class="ti-close" aria-hidden="true"></i>Supprimer
                                                        l'agence</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @php
                                        $agence = null;
                                    @endphp
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom de l'agence</th>
                                    <th>Adresse</th>
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
