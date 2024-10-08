@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Liste produit</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Liste produit</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Liste des produits</h5>
                        <div class="m-t-40 m-b-40">
                            @if (session()->has('success'))
                                <div class="card-panel teal lighten-2 white-text">{{ session()->get('success') }}</div>
                            @endif
                            @if (session()->has('error'))
                                <div class="card-panel red lighten-2 white-text">{{ session()->get('error') }}</div>
                            @endif
                        </div>

                        <ul class="tabs tab-demo z-depth-1">
                            <li class="tab"><a href="#commercial">Type produit</a></li>
                            <li class="tab"><a class="active" href="#personnel">Produits</a></li>
                        </ul>
                        <div id="commercial">
                            <a href="{{ route('typeproduit.new') }}"
                                class="waves-effect waves-light right btn green m-t-40"><i class="ti-plus"
                                    aria-hidden="true"></i>Ajouter</a>
                            <div class="p-15 p-b-0">
                                <table id="commerciaux" class="responsive-table display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Libellé</th>
                                            <th>Type d'assurance</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($types as $type)
                                            <tr>
                                                <td>{{ $type->libelle }}</td>
                                                <td>{{ $type->branche }}</td>
                                                <td>
                                                    <a class="dropdown-trigger btn lighten-2"
                                                        data-target="dropdowntype{{ $type->id }}"
                                                        style="font-size:0.8em;">Action
                                                        <span class="fas fa-angle-down">
                                                        </span></a>
                                                    <ul id="dropdowntype{{ $type->id }}" class="dropdown-content"
                                                        tabindex="{{ $type->id }}" style="min-width: 300px;">

                                                        <li tabindex="{{ $type->id }}">
                                                            <a href="{{ route('typeproduit.edit', $type->id) }}"
                                                                class=""><i class="ti-pencil"
                                                                    aria-hidden="true"></i>Modifier
                                                                le type produit</a>
                                                        </li>
                                                        <li tabindex="{{ $type->id }}">
                                                            <a href="{{ route('typeproduit.delete', $type->id) }}"
                                                                class=""><i class="ti-close"
                                                                    aria-hidden="true"></i>Supprimer
                                                                le type produit</a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            @php
                                                $type = null;
                                            @endphp
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Libellé</th>
                                            <th>Type d'assurance</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div id="personnel">
                            <a href="{{ route('produit.new') }}" class="waves-effect waves-light right btn green m-t-40"><i
                                    class="ti-plus" aria-hidden="true"></i>Ajouter</a>
                            <div class="p-15 p-b-0">
                                <table id="personnels" class="responsive-table display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nom produit</th>
                                            <th>Branche</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($produits as $produit)
                                            <tr>
                                                <td>{{ $produit->nomProduit }}</td>
                                                <td>{{ $produit->typeproduit->libelle }}</td>
                                                <td>
                                                    <a class="dropdown-trigger btn lighten-2"
                                                        data-target="dropdown{{ $produit->id }}"
                                                        style="font-size:0.8em;">Action
                                                        <span class="fas fa-angle-down">
                                                        </span></a>
                                                    <ul id="dropdown{{ $produit->id }}" class="dropdown-content"
                                                        tabindex="{{ $produit->id }}" style="min-width: 300px;">

                                                        <li tabindex="{{ $produit->id }}">
                                                            <a href="{{ route('produit.edit', $produit->id) }}"
                                                                class=""><i class="ti-pencil"
                                                                    aria-hidden="true"></i>Modifier
                                                                le produit</a>
                                                        </li>
                                                        <li tabindex="{{ $produit->id }}">
                                                            <a href="{{ route('garantie.liste', $produit->id) }}"
                                                                class=""><i class="ti-shine"
                                                                    aria-hidden="true"></i>Configurer les garanties</a>
                                                        </li>
                                                        <li tabindex="{{ $produit->id }}">
                                                            <a class=""
                                                                href="{{ route('formulaire.liste', ['idTable' => $produit->id, 'table' => 'Produit']) }}"><i
                                                                    class="ti-menu-alt" aria-hidden="true"></i>Configurer le
                                                                formulaire Appel d'offre</a>
                                                        </li>
                                                        <li tabindex="{{ $produit->id }}">
                                                            <a class=""
                                                                href="{{ route('formulaire.liste', ['idTable' => $produit->id, 'table' => 'Production']) }}"><i
                                                                    class="ti-menu-alt" aria-hidden="true"></i>Configurer le
                                                                formulaire Production</a>
                                                        </li>
                                                        <li tabindex="{{ $produit->id }}">
                                                            <a class=""
                                                                href="{{ route('formulaire.liste', ['idTable' => $produit->id, 'table' => 'ProduitAssureur']) }}"><i
                                                                    class="ti-menu-alt" aria-hidden="true"></i>Configurer le
                                                                formulaire Offre Assureur</a>
                                                        </li>
                                                        <li tabindex="{{ $produit->id }}">
                                                            <a href="{{ route('condition.liste', $produit->id) }}"
                                                                class=""><i class="ti-shine"
                                                                    aria-hidden="true"></i>Configurer la production</a>
                                                        </li>
                                                        <li tabindex="{{ $produit->id }}">
                                                            <a href="{{ route('groupe.liste', $produit->id) }}"
                                                                class=""><i class="ti-shine"
                                                                    aria-hidden="true"></i>Configurer le groupage</a>
                                                        </li>
                                                        <li tabindex="{{ $produit->id }}">
                                                            <a href="{{ route('grille.tarification', $produit->id) }}"
                                                                class=""><i class="ti-pencil"
                                                                    aria-hidden="true"></i>Exporter la grille de
                                                                tarification</a>
                                                        </li>
                                                        <li tabindex="{{ $produit->id }}">
                                                            <a href="{{ route('tarif.liste', $produit->id) }}"
                                                                class=""><i class="ti-pencil"
                                                                    aria-hidden="true"></i>Voir la grille de
                                                                tarification</a>
                                                        </li>
                                                        <li tabindex="{{ $produit->id }}">
                                                            <a href="{{ route('renseignement.grille', $produit->id) }}"
                                                                class=""><i class="ti-pencil"
                                                                    aria-hidden="true"></i>Exporter la grille info garantie
                                                                </a>
                                                        </li>
                                                        <li tabindex="{{ $produit->id }}">
                                                            <a href="{{ route('renseignement.liste', $produit->id) }}"
                                                                class=""><i class="ti-pencil"
                                                                    aria-hidden="true"></i>Voir la grille info garantie
                                                                </a>
                                                        </li>
                                                        <li tabindex="{{ $produit->id }}">
                                                            <a href="{{ route('production.new', $produit->id) }}"
                                                                class=""><i class="ti-pencil"
                                                                    aria-hidden="true"></i>Production</a>
                                                        </li>
                                                        <li tabindex="{{ $produit->id }}">
                                                            <a href="{{ route('produit.delete', $produit->id) }}"
                                                                class=""><i class="ti-close"
                                                                    aria-hidden="true"></i>Supprimer
                                                                le produit</a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            @php
                                                $produit = null;
                                            @endphp
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nom produit</th>
                                            <th>Branche</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        {{-- <div id="client">
                            <a href="{{ route('garantie.new') }}"
                                class="waves-effect waves-light right btn green m-t-40"><i class="ti-plus"
                                    aria-hidden="true"></i>Ajouter</a>
                            <div class="p-15 p-b-0">
                                <table id="clients" class="responsive-table display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nom garantie</th>
                                            <th>Description</th>
                                            <th>Nom du produit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($garanties as $garantie)
                                            <tr>
                                                <td>{{ $garantie->libelle }}</td>
                                                <td>{{ $garantie->description }}</td>
                                                <td>{{ $garantie->produit->nomProduit }}</td>
                                                <td>
                                                    <a href="{{ route('garantie.edit', $garantie->id) }}"
                                                        class="btn btn-small btn-outline edit-row-btn"><i class="ti-pencil"
                                                            aria-hidden="true"></i></a>
                                                    <a href="{{ route('garantie.delete', $garantie->id) }}"
                                                        class="btn btn-small btn-outline delete-row-btn red"><i
                                                            class="ti-close" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>


                                            @php
                                                $garantie = null;
                                            @endphp
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nom garantie</th>
                                            <th>Description</th>
                                            <th>Nom du produit</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
