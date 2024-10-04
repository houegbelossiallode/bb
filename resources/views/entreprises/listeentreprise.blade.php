@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Liste entreprise</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Liste entreprise</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Liste des entreprises</h5>
                        <a href="{{ route('entreprise.new') }}" class="waves-effect waves-light right btn green"><i
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
                                    <th>Raison sociale</th>
                                    <th>Secteur d'activité</th>
                                    <th>Adresse</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($entreprises as $entreprise)
                                    <tr>
                                        <td>{{ $entreprise->raisonSociale }}</td>
                                        <td>{{ $entreprise->secteur }}</td>
                                        <td>{{ $entreprise->adresse }}</td>
                                        <td>
                                            <a class="dropdown-trigger btn lighten-2"
                                                data-target="dropdown{{ $entreprise->id }}" style="font-size:0.8em;">Action
                                                <span class="fas fa-angle-down">
                                                </span></a>
                                            <ul id="dropdown{{ $entreprise->id }}" class="dropdown-content"
                                                tabindex="{{ $entreprise->id }}" style="min-width: 300px;">

                                                <li tabindex="{{ $entreprise->id }}">
                                                    <a href="{{ route('entreprise.edit', $entreprise->id) }}"
                                                        class=""><i class="ti-pencil" aria-hidden="true"></i>Modifier
                                                        l'entreprise</a>
                                                </li>
                                                <li tabindex="{{ $entreprise->id }}">
                                                    <a href="{{ route('entreprise.delete', $entreprise->id) }}"
                                                        class=""><i class="ti-close" aria-hidden="true"></i>Supprimer
                                                        l'entreprise</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @php
                                        $entreprise = null;
                                    @endphp
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Raison sociale</th>
                                    <th>Secteur d'activité</th>
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
