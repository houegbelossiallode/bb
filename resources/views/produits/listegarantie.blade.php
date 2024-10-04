@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Liste garantie</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Liste garantie</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Liste des garanties</h5>
                        <a href="{{ route('garantie.new', $idproduit) }}"
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
                                    <th>Nom de la garantie</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($garanties as $garantie)
                                    <tr>
                                        <td>{{ $garantie->libelle }}</td>
                                        <td>{{ $garantie->description }}</td>
                                        <td>
                                            <a class="dropdown-trigger btn lighten-2"
                                                data-target="dropdown{{ $garantie->id }}" style="font-size:0.8em;">Action
                                                <span class="fas fa-angle-down"></span></a>

                                            <ul id="dropdown{{ $garantie->id }}" class="dropdown-content"
                                                tabindex="{{ $garantie->id }}" style="min-width: 300px;">
                                                <li tabindex="{{ $garantie->id }}">
                                                    <a class=""
                                                        href="{{ route('formulaire.liste', ['idTable' => $garantie->id, 'table' => 'Garantie']) }}"><i
                                                            class="ti-menu-alt" aria-hidden="true"></i>Configurer le
                                                        formulaire</a>
                                                </li>

                                                <li tabindex="{{ $garantie->id }}">
                                                    <a href="{{ route('garantie.edit', ['idgarantie' => $garantie->id, 'idproduit' => $idproduit]) }}"
                                                        class=""><i class="ti-pencil" aria-hidden="true"></i>Modifier
                                                        la garantie</a>
                                                </li>
                                                <li tabindex="{{ $garantie->id }}">
                                                    <a href="{{ route('garantie.delete', ['idgarantie' => $garantie->id, 'idproduit' => $idproduit]) }}"
                                                        class=""><i class="ti-close" aria-hidden="true"></i>Supprimer
                                                        la garantie</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @php
                                        $garantie = null;
                                    @endphp
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom de la garantie</th>
                                    <th>Description</th>
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
