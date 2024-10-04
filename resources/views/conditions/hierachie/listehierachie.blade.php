@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Hierachie condition</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Hierachie condition</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Hierachie condition</h5>
                        <div class="m-t-40 m-b-40">
                            @if (session()->has('success'))
                                <div class="card-panel teal lighten-2 white-text">{{ session()->get('success') }}</div>
                            @endif
                            @if (session()->has('error'))
                                <div class="card-panel red lighten-2 white-text">{{ session()->get('error') }}</div>
                            @endif
                        </div>

                        <ul class="tabs tab-demo z-depth-1">
                            <li class="tab"><a href="#commercial">Superieures</a></li>
                            <li class="tab"><a class="active" href="#personnel">Inferieure</a></li>
                        </ul>
                        <div id="commercial">
                            <div class="p-15 p-b-0">
                                <table id="commerciaux" class="responsive-table display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Libelle</th>
                                            <th>Niveau</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($superieures as $superieure)
                                            <tr>
                                                <td>{{ $superieure->libelle }}</td>
                                                <td>{{ 'Niveau ' . $superieure->niveau }}</td>
                                            </tr>
                                            @php
                                                $superieure = null;
                                            @endphp
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Libelle</th>
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
                                            <th>Libelle</th>
                                            <th>Niveau</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inferieures as $inferieure)
                                            <tr>
                                                <td>{{ $inferieure->libelle }}</td>
                                                <td>{{ 'Niveau ' . $inferieure->niveau }}</td>
                                            </tr>
                                            @php
                                                $inferieure = null;
                                            @endphp
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Libelle</th>
                                            <th>Niveau</th>
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
