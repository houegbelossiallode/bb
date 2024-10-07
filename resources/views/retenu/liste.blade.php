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
                                    <th>Client</th>
                                    <th>Commercial</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($retenus as $retenu)
                                    <tr>
                                        <td>{{ $retenu->titre }}</td>
                                        <td>{{ $retenu->contenu }}</td>
                                        <td>{{ $retenu->client->user->nom .' ' .  $retenu->client->user->prenom}}</td>
                                        <td>{{ $retenu->commercial->user->nom .' ' .  $retenu->commercial->user->prenom}}</td>
                                        <td>{{ $retenu->created_at }}</td>
                                     <!-- 
                                        <td>
                                            <a href=""
                                                class="btn btn-small btn-outline edit-row-btn"><i class="ti-pencil"
                                                    aria-hidden="true"></i></a>
                                            <a href=""
                                                class="btn btn-small btn-outline delete-row-btn red"><i class="ti-close"
                                                    aria-hidden="true"></i></a>
                                        </td>
                                    -->  
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
