@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Nouvelle compagnie</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Nouvelle compagnie</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Nouvelle compagnie</h5>
                <form action="{{ route('compagnie.add') }}" method="post" enctype="multipart/form-data">
                    @method('post')
                    @csrf
                    <div class="row">
                        <div class="input-field col s12 l6">
                            <input id="nom" name="nom" type="text"
                                class="validate @error('nom') is-invalid @enderror" value="{{ old('nom') }}">
                            <label for="nom">Nom de la compagnie</label>
                            @error('nom')
                                <span id="nomHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 l6">
                            <input id="adresse" name="adresse" type="text"
                                class="validate @error('adresse') is-invalid @enderror" value="{{ old('adresse') }}">
                            <label for="adresse">Adresse de la compagnie</label>
                            @error('adresse')
                                <span id="adresseHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 l6">
                            <input id="tel" name="tel" type="number"
                                class="validate @error('tel') is-invalid @enderror" value="{{ old('tel') }}">
                            <label for="tel">Téléphone de la compagnie</label>
                            @error('tel')
                                <span id="telHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="file-field input-field col s12 l6">
                            <div class="btn darken-1">
                                <span>Importer le logo</span>
                                <input type="file" id="logo" name="logo"
                                    class="validate @error('logo') is-invalid @enderror">
                            </div>
                            <div class="file-path-wrapper">
                                <input id="file" name="information"
                                    class="file-path validate @error('information') is-invalid @enderror" type="text"
                                    value="{{ old('information') }}">
                                @error('logo')
                                    <span id="logoHelp" class="form-text red-text">{{ $message }}</span>
                                @enderror
                                @error('information')
                                    <span id="fileHelp" class="form-text red-text">{{ $message }}</span>
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
