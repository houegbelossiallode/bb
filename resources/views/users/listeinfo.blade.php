@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Liste information</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Liste information</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Liste des informations</h5>
                        <a href="{{ route('info.new', $idclient) }}" class="waves-effect waves-light right btn green"><i
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
                                    <th>Titre</th>
                                    <th>Contenu</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($infos as $info)
                                    <tr>
                                        <td>{{ $info->titre }}</td>
                                        <td>{{ $info->contenu }}</td>
                                        <td>{{ $info->created_at }}</td>
                                        <td>
                                            <a href="{{ route('info.edit', ['idinfo' => $info->id, 'idclient' => $idclient]) }}"
                                                class="btn btn-small btn-outline edit-row-btn"><i class="ti-pencil"
                                                    aria-hidden="true"></i></a>
                                            <a href="{{ route('info.delete', ['idinfo' => $info->id, 'idclient' => $idclient]) }}"
                                                class="btn btn-small btn-outline delete-row-btn red"><i class="ti-close"
                                                    aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    @php
                                        $info = null;
                                    @endphp
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Titre</th>
                                    <th>Contenu</th>
                                    <th>Date</th>
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
