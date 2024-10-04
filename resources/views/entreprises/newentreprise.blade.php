@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Nouvelle entreprise</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Nouvelle entreprise</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Nouvelle entreprise</h5>
                <form action="{{ route('entreprise.add') }}" method="post">
                    @method('post')
                    @csrf
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="raison" name="raison" type="text"
                                class="validate @error('raison') is-invalid @enderror" value="{{ old('raison') }}">
                            <label for="raison">Raison sociale</label>
                            @error('raison')
                                <span id="raisonHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <input id="secteur" name="secteur" type="text"
                                class="validate @error('secteur') is-invalid @enderror" value="{{ old('secteur') }}">
                            <label for="secteur">Secteur d'activité</label>
                            @error('secteur')
                                <span id="secteurHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <input id="adresse" name="adresse" type="text"
                                class="validate @error('adresse') is-invalid @enderror" value="{{ old('adresse') }}">
                            <label for="adresse">Adresse de la entreprise</label>
                            @error('adresse')
                                <span id="adresseHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <button class="btn waves-effect waves-light right submit" type="submit"
                                name="action">Enregistrer</button>

                        </div>

                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
