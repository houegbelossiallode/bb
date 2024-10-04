@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Liste detail offre</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Liste detail offre</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Liste des details d'offre</h5>
                        <a href="{{ route('offre.detail.new', $idoffre) }}"
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
                                    <th>Garantie</th>
                                    <th>Capital</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $detail)
                                    <tr>
                                        <td>{{ $detail->garantie->libelle }}</td>
                                        <td>{{ $detail->capital . ' FCFA' }}</td>
                                        <td>
                                            <a href="{{ route('offre.detail.edit', ['iddetail' => $detail->id, 'idoffre' => $idoffre]) }}"
                                                class="btn btn-small btn-outline edit-row-btn"><i class="ti-pencil"
                                                    aria-hidden="true"></i></a>
                                            <a href="{{ route('offre.detail.delete', ['iddetail' => $detail->id, 'idoffre' => $idoffre]) }}"
                                                class="btn btn-small btn-outline delete-row-btn red"><i class="ti-close"
                                                    aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    @php
                                        $detail = null;
                                    @endphp
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Garantie</th>
                                    <th>Capital</th>
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
