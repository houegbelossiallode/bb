@extends('layouts.app')
@section('section')

<div class="page-titles">
    <div class="d-flex align-items-center">
        <h5 class="font-medium m-b-0">Mes rendez-vous</h5>
        <div class="custom-breadcrumb ml-auto">
            <a href="{{ route('home') }}" class="breadcrumb">Home</a>
            <a href="#!" class="breadcrumb">Mes rendez-vous</a>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h5 class="card-title">Mes rendez-vous</h5>
                    <a href="{{ route('rds.create') }}" class="waves-effect waves-light right btn green"><i
                            class="ti-plus" aria-hidden="true"></i>Ajouter</a>
                    <div class="m-t-40 m-b-40">
                        @if (session()->has('success'))
                            <div class="card-panel teal lighten-2 white-text">{{ session()->get('success') }}</div>
                        @endif
                        @if (session()->has('error'))
                            <div class="card-panel red lighten-2 white-text">{{ session()->get('error') }}</div>
                        @endif
                    </div>

                    <ul class="tabs tab-demo z-depth-1">
                        <li class="tab"><a class="active" href="#manager">Prospect</a></li>

                    </ul>
                    <div id="manager">
                        <div class="p-15 p-b-0">
                            <table id="manager" class="responsive-table display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nom </th>
                                        <th>Prenom </th>
                                        <th>Produit</th>
                                        <th>Notes</th>
                                        <th>prime</th>
                                        <th>Date de RDV</th>
                                        <th>Nom et prénom du commercial</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($tousLesRendezVous as $rd)

                                    <tr>
                                        <td>{{ $rd->client->user->nom }}</td>
                                        <td>{{ $rd->client->user->prenom }}</td>
                                        <td>{{ $rd->produit->nomProduit }}</td>
                                        <td>{{ $rd->notes}}</td>
                                        <td>{{ $rd->prime}}</td>
                                        <td>{{ \Carbon\Carbon::parse($rd->date_du_rdv)->format('d/m/Y')}}</td>
                                        <td>{{ $rd->commercial->user->nom . ' ' .  $rd->commercial->user->prenom}}</td>
                                        <td>

                                                <a href="{{ route('rds.edit', $rd->id) }}"
                                                    class="btn btn-small btn-outline edit-row-btn"><i class="ti-pencil"
                                                        aria-hidden="true"></i></a>
                                                <a href="{{ route('rds.delete', $rd->id) }}"
                                                    class="btn btn-small btn-outline delete-row-btn red"><i
                                                        class="ti-close" aria-hidden="true"></i></a>


                                    </td>
                                    </tr>

                                   @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>




                    </div>

                </div>
            </div>
        </div>
    </div>
</div>






@endsection
