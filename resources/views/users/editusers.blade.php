@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Nouvel utilisateur</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Nouvel utilisateur</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <form action="{{ route('handleupdate', ['id' => $user->id, 'role' => $role]) }}" method="post">
                    @method('post')
                    @csrf
                    <div class="row">
                        <div class="input-field col s12 l6">
                            <input id="nom" name="nom" type="text"
                                class="validate @error('nom') is-invalid @enderror"
                                value="{{ old('nom') ?? $user->user->nom }}">
                            <label for="nom">Nom</label>
                            @error('nom')
                                <span id="nomHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 l6">
                            <input id="prenom" name="prenom" type="text"
                                class="validate @error('prenom') is-invalid @enderror"
                                value="{{ old('prenom') ?? $user->user->prenom }}">
                            <label for="prenom">Prenom</label>
                            @error('prenom')
                                <span id="prenomHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 l6">
                            <select id="sexe" name="sexe" data-error=".errorTxt6"
                                class="validate @error('sexe') is-invalid @enderror">
                                <option value="" disabled selected>Choisir votre genre</option>
                                <option value="Mr" @if (old('sexe') == 'Mr' || $user->user->sexe == 'Mr') selected @endif>Monsieur</option>
                                <option value="Mme" @if (old('sexe') == 'Mme' || $user->user->sexe == 'Mme') selected @endif>Madame
                                </option>
                                <option value="Mlle" @if (old('sexe') == 'Mlle' || $user->user->sexe == 'Mlle') selected @endif>Mademoiselle
                                </option>
                            </select>
                            <label>Civilité(e)</label>
                            @error('sexe')
                                <span id="sexeHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 l6">
                            <input id="date" name="date" type="date"
                                class="validate @error('date') is-invalid @enderror"
                                value="{{ old('date') ?? $user->user->dateNaissance }}">
                            <label for="date">Date de naissance</label>
                            @error('date')
                                <span id="dateHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 l6">
                            <input id="email" name="email" type="email"
                                class="validate @error('email') is-invalid @enderror"
                                value="{{ old('email') ?? $user->user->email }}">
                            <label for="email">Email</label>
                            @error('email')
                                <span id="emailHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 l6">
                            <input id="tel" name="tel" type="text"
                                class="validate @error('tel') is-invalid @enderror"
                                value="{{ old('tel') ?? $user->user->tel }}">
                            <label for="tel">Téléphone</label>
                            @error('tel')
                                <span id="telHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 l6">
                            <input id="adresse" name="adresse" type="text"
                                class="validate @error('adresse') is-invalid @enderror"
                                value="{{ old('adresse') ?? $user->user->adresse }}">
                            <label for="adresse">Adresse</label>
                            @error('adresse')
                                <span id="adresseHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        @if ($role == 'Commercial')
                            <div class="input-field col s12 l6">
                                <select id="niveau" name="niveau" data-error=".errorTxt6"
                                    class="validate @error('niveau') is-invalid @enderror">
                                    <option value="" disabled selected>Choisir le niveau</option>
                                    @foreach ($niveaux as $niveau)
                                        <option value="{{ $niveau->id }}"
                                            @if (old('niveau') == $niveau->id || $user->statut_id == $niveau->id) selected @endif>
                                            {{ 'Niveau ' . $niveau->niveau }}
                                        </option>
                                    @endforeach
                                </select>
                                <label>Niveau</label>
                                @error('niveau')
                                    <span id="niveauHelp" class="form-text red-text">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-field col s12 l6">
                                <select id="agence" name="agence" data-error=".errorTxt6"
                                    class="validate @error('agence') is-invalid @enderror">
                                    <option value="" disabled selected>Choisir l'agence</option>
                                    @foreach ($agences as $agence)
                                        <option value="{{ $agence->id }}"
                                            @if (old('agence') == $agence->id || $user->agence->id == $agence->id) selected @endif>
                                            {{ $agence->libelle }}
                                        </option>
                                    @endforeach
                                </select>
                                <label>Agence</label>
                                @error('agence')
                                    <span id="agenceHelp" class="form-text red-text">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-field col s12 l6">
                                <input id="code" name="code" type="text"
                                    class="validate @error('code') is-invalid @enderror" value="{{ old('code') ?? $user->code }}">
                                <label for="code">Code Commercial</label>
                                @error('code')
                                    <span id="posteHelp" class="form-text red-text">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                        @if ($role == 'Personnel')
                            <div class="input-field col s12 l6">
                                <select id="compagnie" name="compagnie" data-error=".errorTxt6"
                                    class="validate @error('compagnie') is-invalid @enderror">
                                    <option value="" disabled selected>Choisir votre compagnie</option>
                                    @foreach ($compagnies as $compagnie)
                                        <option value="{{ $compagnie->id }}"
                                            @if (old('compagnie') == $compagnie->id || $user->compagnie_id == $compagnie->id) selected @endif>{{ $compagnie->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                <label>Compagnie</label>
                                @error('compagnie')
                                    <span id="compagnieHelp" class="form-text red-text">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-field col s12 l6">
                                <input id="poste" name="poste" type="text"
                                    class="validate @error('poste') is-invalid @enderror"
                                    value="{{ old('poste') ?? $user->poste }}">
                                <label for="poste">Poste</label>
                                @error('poste')
                                    <span id="posteHelp" class="form-text red-text">{{ $message }}</span>
                                @enderror

                            </div>
                        @endif
                        @if ($role == 'Prospect')
                            <div class="input-field col s12 l6">
                                <select id="type" name="type" data-error=".errorTxt6"
                                    class="validate @error('type') is-invalid @enderror">
                                    <option value="" disabled selected>Choisir le type de prospect</option>
                                    <option value="Personne physique" @if (old('type') == 'Personne physique' || $user->type == 'Personne physique') selected @endif>
                                        Personne
                                        physique</option>
                                    <option value="Personne morale" @if (old('type') == 'Personne morale' || $user->type == 'Personne morale') selected @endif>
                                        Personne
                                        morale</option>
                                </select>
                                <label>Type</label>
                                @error('type')
                                    <span id="typeHelp" class="form-text red-text">{{ $message }}</span>
                                @enderror
                            </div>
                            <div id="blocType"
                                style="display: {{ $user->type == 'Personne morale' || $errors->has('entreprise') || $errors->has('poste') ? 'block' : 'none' }}">
                                <div class="input-field col s12 l6">
                                    <select id="entreprise" name="entreprise" data-error=".errorTxt6"
                                        class="validate @error('entreprise') is-invalid @enderror">
                                        <option value="" disabled selected>Choisir votre entreprise</option>
                                        @foreach ($entreprises as $entreprise)
                                            <option value="{{ $entreprise->id }}"
                                                @if (old('entreprise') == $entreprise->id || $user->entreprise_id == $entreprise->id) selected @endif>
                                                {{ $entreprise->raisonSociale }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label>Entreprise</label>
                                    @error('entreprise')
                                        <span id="entrepriseHelp" class="form-text red-text">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input-field col s12 l6">
                                    <input id="posteclient" name="posteclient" type="text"
                                        class="validate @error('posteclient') is-invalid @enderror"
                                        value="{{ old('posteclient') ?? $user->poste }}">
                                    <label for="posteclient">Poste</label>
                                    @error('posteclient')
                                        <span id="posteclientHelp" class="form-text red-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light right submit" type="submit"
                                name="action">Mettre à
                                jour</button>

                        </div>

                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
