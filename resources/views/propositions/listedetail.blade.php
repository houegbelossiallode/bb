@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Liste detail proposition</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Liste detail proposition</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Liste des details de proposition</h5>
                        <a href="{{ route('proposition.detail.new', $idproposition) }}"
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
                        <div class="table-container">
                            <table id="commerciaux" class="responsive-table display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Detail Offre</th>
                                        <th>Capital</th>
                                        <th>Primes nette</th>
                                        <th>Accessoires</th>
                                        <th>Sur prime</th>
                                        <th>Réduction</th>
                                        <th>Taxe</th>
                                        <th>Prime totale</th>
                                        <th>Avis</th>
                                        <th>Exclusions garanties</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $detail)
                                        <tr>
                                            <td>{{ $detail->detailoffre->garantie->libelle . ' (' . $detail->detailoffre->capital . ')' }}
                                            </td>
                                            <td>{{ $detail->capital . ' FCFA' }}</td>
                                            <td>{{ $detail->primeNette . ' FCFA' }}</td>
                                            <td>{{ $detail->accessoires . ' FCFA' }}</td>
                                            <td>{{ $detail->surPrime . ' FCFA' }}</td>
                                            <td>{{ $detail->reduction . ' FCFA' }}</td>
                                            <td>{{ $detail->taxe . ' FCFA' }}</td>
                                            <td>{{ $detail->primeTotale . ' FCFA' }}</td>
                                            <td>{{ $detail->avis }}</td>
                                            <td>{{ $detail->exclusionGaranties }}</td>
                                            <td>
                                                <a href="{{ route('proposition.detail.edit', ['iddetail' => $detail->id, 'idproposition' => $idproposition]) }}"
                                                    class="btn btn-small btn-outline edit-row-btn"><i class="ti-pencil"
                                                        aria-hidden="true"></i></a>
                                                <a href="{{ route('proposition.detail.delete', ['iddetail' => $detail->id, 'idproposition' => $idproposition]) }}"
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
                                        <th>Detail Offre</th>
                                        <th>Capital</th>
                                        <th>Primes nette</th>
                                        <th>Accessoires</th>
                                        <th>Sur prime</th>
                                        <th>Réduction</th>
                                        <th>Taxe</th>
                                        <th>Prime totale</th>
                                        <th>Avis</th>
                                        <th>Exclusions garanties</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
