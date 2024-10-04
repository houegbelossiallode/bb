@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Liste compagnie</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Liste compagnie</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Liste des compagnies</h5>
                        <a href="{{ route('compagnie.new') }}" class="waves-effect waves-light right btn green"><i
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
                                    <th>Nom de la compagnie</th>
                                    <th>Adresse</th>
                                    <th>Téléphone</th>
                                    <th>Logo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($compagnies as $compagnie)
                                    <tr>
                                        <td>{{ $compagnie->nom }}</td>
                                        <td>{{ $compagnie->adresse }}</td>
                                        <td>{{ $compagnie->tel }}</td>
                                        <td><img class="materialboxed"
                                                src="{{ asset('users/compagnies/' . $compagnie->logo) }}" alt=""
                                                width="50px"> </td>
                                        <td>
                                            <a class="dropdown-trigger btn lighten-2"
                                                data-target="dropdown{{ $compagnie->id }}" style="font-size:0.8em;">Action
                                                <span class="fas fa-angle-down">
                                                </span></a>
                                            <ul id="dropdown{{ $compagnie->id }}" class="dropdown-content"
                                                tabindex="{{ $compagnie->id }}" style="min-width: 300px;">

                                                <li tabindex="{{ $compagnie->id }}">
                                                    <a href="{{ route('compagnie.edit', $compagnie->id) }}"
                                                        class=""><i class="ti-pencil" aria-hidden="true"></i>Modifier
                                                        la compagnie</a>
                                                </li>
                                                <li tabindex="{{ $compagnie->id }}">
                                                    <a href="{{ route('compagnie.delete', $compagnie->id) }}"
                                                        class=""><i class="ti-close" aria-hidden="true"></i>Supprimer
                                                        la compagnie</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @php
                                        $compagnie = null;
                                    @endphp
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom de la compagnie</th>
                                    <th>Adresse</th>
                                    <th>Téléphone</th>
                                    <th>Logo</th>
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
