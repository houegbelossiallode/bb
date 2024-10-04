@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Nouveau client</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Nouveau client</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Nouveau client</h5>
                <form action="{{ route('users.add') }}" method="post">
                    @method('post')
                    @csrf
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="nom" name="nom" type="text"
                                class="validate @error('nom') is-invalid @enderror" value="{{ old('nom') }}">
                            <label for="nom">Nom</label>
                            @error('nom')
                                <span id="nomHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <input id="prenom" name="prenom" type="text"
                                class="validate @error('prenom') is-invalid @enderror" value="{{ old('prenom') }}">
                            <label for="prenom">Prenom</label>
                            @error('prenom')
                                <span id="prenomHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 l6">
                            <select id="sexe" name="sexe" data-error=".errorTxt6"
                                class="validate @error('sexe') is-invalid @enderror">
                                <option value="" disabled selected>Choisir votre genre</option>
                                <option value="Mr" @if (old('sexe') == 'Mr') selected @endif>Monsieur</option>
                                <option value="Mme" @if (old('sexe') == 'Mme') selected @endif>Madame
                                </option>
                                <option value="Mlle" @if (old('sexe') == 'Mlle') selected @endif>Mademoiselle
                                </option>
                            </select>
                            <label>Civilité(e)</label>
                            @error('sexe')
                                <span id="sexeHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <input id="email" name="email" type="email"
                                class="validate @error('email') is-invalid @enderror" value="{{ old('email') }}">
                            <label for="email">Email</label>
                            @error('email')
                                <span id="emailHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <input id="tel" name="tel" type="text"
                                class="validate @error('tel') is-invalid @enderror" value="{{ old('tel') }}">
                            <label for="tel">Téléphone</label>
                            @error('tel')
                                <span id="telHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <input id="adresse" name="adresse" type="text"
                                class="validate @error('adresse') is-invalid @enderror" value="{{ old('adresse') }}">
                            <label for="adresse">Adresse</label>
                            @error('adresse')
                                <span id="adresseHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <input id="date" name="date" type="date"
                                class="validate @error('date') is-invalid @enderror" value="{{ old('date') }}">
                            <label for="date">Date de naissance</label>
                            @error('date')
                                <span id="dateHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <select id="role" name="role" data-error=".errorTxt6"
                                class="validate @error('role') is-invalid @enderror">
                                <option value="Prospect" selected>Prospect</option>
                            </select>
                            <label>Role</label>
                            @error('role')
                                <span id="roleHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <select id="type" name="type" data-error=".errorTxt6"
                                class="validate @error('type') is-invalid @enderror">
                                <option value="" disabled selected>Choisir le type de prospect</option>
                                <option value="Personne physique" @if (old('type') == 'Personne physique') selected @endif>
                                    Personne
                                    physique</option>
                                <option value="Personne morale" @if (old('type') == 'Personne morale') selected @endif>Personne
                                    morale</option>
                            </select>
                            <label>Type</label>
                            @error('type')
                                <span id="typeHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div id="blocType"
                            style="display: {{ $errors->has('entreprise') || $errors->has('poste') ? 'block' : 'none' }}">
                            <div class="input-field col s6">
                                <select id="entreprise" name="entreprise" data-error=".errorTxt6"
                                    class="validate @error('entreprise') is-invalid @enderror">
                                    <option value="" disabled selected>Choisir votre entreprise</option>
                                    @foreach ($entreprises as $entreprise)
                                        <option value="{{ $entreprise->id }}"
                                            @if (old('entreprise') == $entreprise->id) selected @endif>
                                            {{ $entreprise->raisonSociale }}
                                        </option>
                                    @endforeach
                                </select>
                                <label>Entreprise</label>
                                @error('entreprise')
                                    <span id="entrepriseHelp" class="form-text red-text">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-field col s6">
                                <input id="posteclient" name="posteclient" type="text"
                                    class="validate @error('posteclient') is-invalid @enderror"
                                    value="{{ old('posteclient') }}">
                                <label for="posteclient">Poste</label>
                                @error('posteclient')
                                    <span id="posteclientHelp" class="form-text red-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light right submit" type="submit"
                                name="action">Enregistrer</button>

                        </div>

                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
