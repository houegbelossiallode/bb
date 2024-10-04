@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Liste utilisateur</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Liste utilisateur</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Liste des utilisateurs</h5>
                        <a href="{{ route('users.new') }}" class="waves-effect waves-light right btn green"><i
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
                            <li class="tab"><a class="active" href="#commercial">Commerciaux</a></li>
                            <li class="tab"><a href="#personnel">Personnels</a></li>
                            {{-- <li class="tab"><a href="#client">Clients</a></li> --}}
                        </ul>
                        <div id="commercial">
                            <div class="p-15 p-b-0">
                                <table id="commerciaux" class="responsive-table display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Civilité(e)</th>
                                            <th>Nom complet</th>
                                            <th>Email</th>
                                            <th>Rôle</th>
                                            <th>Tel</th>
                                            <th>Adresse</th>
                                            <th>Agence</th>
                                            <th>Niveau</th>
                                            <th>chef</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($commerciaux as $commercial)
                                            <tr>
                                                <td>{{ $commercial->user->sexe }}</td>
                                                <td>{{ $commercial->user->nom . ' ' . $commercial->user->prenom }}</td>
                                                <td>{{ $commercial->user->email }}</td>
                                                <td><span
                                                        class="label {{ $commercial->user->role == 'Courtier' ? 'label-success' : 'label-info' }}">{{ $commercial->user->role }}</span>
                                                </td>
                                                <td>{{ $commercial->user->tel }}</td>
                                                <td>{{ $commercial->user->adresse }}</td>
                                                <td>{{ $commercial->agence->libelle }}</td>
                                                <td>{{ $commercial->user->role == 'Courtier' ? 'Courtier' : 'Niveau ' . $commercial->statut->niveau }}
                                                </td>
                                                <td>{{ $commercial->user->role == 'Courtier' ? 'Courtier' : ($commercial->chef ? $commercial->chef->user->nom . ' ' . $commercial->chef->user->prenom : '') }}
                                                </td>
                                                <td>
                                                    <a class="dropdown-trigger btn"
                                                        data-target="dropdown{{ $commercial->user->id }}"
                                                        style="font-size:0.8em;">Action
                                                        <span class="fas fa-angle-down">
                                                        </span></a>
                                                    <ul id="dropdown{{ $commercial->user->id }}" class="dropdown-content"
                                                        tabindex="{{ $commercial->user->id }}" style="min-width: 200px;">
                                                        @if ($commercial->user->role == 'Commercial')
                                                            <li tabindex="{{ $commercial->user->id }}">
                                                                <a href="{{ route('hierachie.new', $commercial->id) }}"
                                                                    class=""><i class="ti-pencil"
                                                                        aria-hidden="true"></i>Configurer l'hierachie</a>
                                                            </li>
                                                            <li tabindex="{{ $commercial->user->id }}">
                                                                <a href="{{ route('hierachie.liste', $commercial->id) }}"
                                                                    class=""><i class="ti-pencil"
                                                                        aria-hidden="true"></i>Voir l'hierachie</a>
                                                            </li>
                                                        @endif

                                                        <li tabindex="{{ $commercial->user->id }}">
                                                            <a href="{{ route('users.edit', ['id' => $commercial->id, 'role' => $commercial->user->role]) }}"
                                                                class=""><i class="ti-pencil"
                                                                    aria-hidden="true"></i>Modifier</a>
                                                        </li>
                                                        <li tabindex="{{ $commercial->user->id }}">
                                                            <a href="{{ route('users.delete', ['id' => $commercial->id, 'role' => $commercial->user->role]) }}"
                                                                class=""><i class="ti-close"
                                                                    aria-hidden="true"></i>Supprimer</a>
                                                        </li>
                                                    </ul>
                                                    {{-- <a href="{{ route('users.edit', ['id' => $commercial->id, 'role' => $commercial->user->role]) }}"
                                                        class="btn btn-small btn-outline edit-row-btn"><i class="ti-pencil"
                                                            aria-hidden="true"></i></a>
                                                    <a href="{{ route('users.delete', ['id' => $commercial->user->id, 'role' => $commercial->user->role]) }}"
                                                        class="btn btn-small btn-outline delete-row-btn red"><i
                                                            class="ti-close" aria-hidden="true"></i></a> --}}
                                                </td>
                                            </tr>
                                            @php
                                                $commercial = null;
                                            @endphp
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Civilité(e)</th>
                                            <th>Nom complet</th>
                                            <th>Email</th>
                                            <th>Rôle</th>
                                            <th>Tel</th>
                                            <th>Adresse</th>
                                            <th>Agence</th>
                                            <th>Niveau</th>
                                            <th>chef</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div id="personnel">
                            <div class="p-15 p-b-0">
                                <table id="personnels" class="responsive-table display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sexe</th>
                                            <th>Nom complet</th>
                                            <th>Email</th>
                                            <th>Tel</th>
                                            <th>Adresse</th>
                                            <th>Poste</th>
                                            <th>Compagnie</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($personnels as $personnel)
                                            <tr>
                                                <td>{{ $personnel->user->sexe }}</td>
                                                <td>{{ $personnel->user->nom . ' ' . $personnel->user->prenom }}</td>
                                                <td>{{ $personnel->user->email }}</td>
                                                <td>{{ $personnel->user->tel }}</td>
                                                <td>{{ $personnel->user->adresse }}</td>
                                                <td><span
                                                        class="label {{ $personnel->poste == 'Directeur' ? 'label-success' : 'label-info' }}">{{ $personnel->poste }}</span>
                                                </td>
                                                <td>{{ $personnel->compagnie->nom }}</td>
                                                <td>
                                                    {{-- <a href="{{ route('users.edit', ['id' => $personnel->id, 'role' => $personnel->user->role]) }}"
                                                        class="btn btn-small btn-outline edit-row-btn"><i class="ti-pencil"
                                                            aria-hidden="true"></i></a>
                                                    <a href="{{ route('users.delete', ['id' => $personnel->user->id, 'role' => $personnel->user->role]) }}"
                                                        class="btn btn-small btn-outline delete-row-btn red"><i
                                                            class="ti-close" aria-hidden="true"></i></a> --}}
                                                    <a class="dropdown-trigger btn"
                                                        data-target="dropdown{{ $personnel->user->id }}"
                                                        style="font-size:0.8em;">Action
                                                        <span class="fas fa-angle-down">
                                                        </span></a>
                                                    <ul id="dropdown{{ $personnel->user->id }}" class="dropdown-content"
                                                        tabindex="{{ $personnel->user->id }}" style="min-width: 200px;">
                                                        <li tabindex="{{ $personnel->user->id }}">
                                                            <a href="{{ route('users.edit', ['id' => $personnel->id, 'role' => $personnel->user->role]) }}"
                                                                class=""><i class="ti-pencil"
                                                                    aria-hidden="true"></i>Modifier</a>
                                                        </li>
                                                        <li tabindex="{{ $personnel->user->id }}">
                                                            <a href="{{ route('users.delete', ['id' => $personnel->id, 'role' => $personnel->user->role]) }}"
                                                                class=""><i class="ti-close"
                                                                    aria-hidden="true"></i>Supprimer</a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            @php
                                                $personnel = null;
                                            @endphp
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Sexe</th>
                                            <th>Nom complet</th>
                                            <th>Email</th>
                                            <th>Tel</th>
                                            <th>Adresse</th>
                                            <th>Poste</th>
                                            <th>Compagnie</th>
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
    </div>
@endsection
