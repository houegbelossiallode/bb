@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Liste tarif</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Liste tarif</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Liste des tarifs</h5>

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
                                    <th>Produit</th>
                                    <th>Conditions</th>
                                    <th>Tarif</th>
                                    <th>Reduction</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tarifs as $tarif)
                                    @if ($tarif->conditiongroupe->produit->id == $id)
                                        <tr>
                                            <td>
                                                {{ $tarif->conditiongroupe->produit->nomProduit }}
                                            </td>
                                            <td>
                                                <ul>
                                                    @foreach ($tarif->conditiongroupe->liaisons as $liaison)
                                                        <li><b>{{ $liaison->conditionvaleur->condition->libelle }} : </b>
                                                            {{ $liaison->conditionvaleur->libelle }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>{{ number_format($tarif->tarif, 0, ',', '.') . ' FCFA' }}</td>
                                            <td>{{ $tarif->reduction . ' %' }}</td>
                                            <td>
                                                <a class="dropdown-trigger btn lighten-2"
                                                    data-target="dropdown{{ $tarif->id }}"
                                                    style="font-size:0.8em;">Action
                                                    <span class="fas fa-angle-down">
                                                    </span></a>
                                                <ul id="dropdown{{ $tarif->id }}" class="dropdown-content"
                                                    tabindex="{{ $tarif->id }}" style="min-width: 300px;">

                                                    <li tabindex="{{ $tarif->id }}">
                                                        <a href="{{ route('tarif.edit', ['idproduit' => $id, 'idtarif' => $tarif->id]) }}"
                                                            class=""><i class="ti-pencil"
                                                                aria-hidden="true"></i>Modifier
                                                            le tarif</a>
                                                    </li>
                                                    <li tabindex="{{ $tarif->id }}">
                                                        <a href="{{ route('tarif.delete', ['idproduit' => $id, 'idtarif' => $tarif->id]) }}"
                                                            class=""><i class="ti-close"
                                                                aria-hidden="true"></i>Supprimer
                                                            le tarif</a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endif

                                    @php
                                        $tarif = null;
                                    @endphp
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Produit</th>
                                    <th>Conditions</th>
                                    <th>Tarif</th>
                                    <th>Reduction</th>
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
