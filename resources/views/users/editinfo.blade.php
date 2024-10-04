@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Nouvelle information</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Nouvelle information</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Nouvelle information</h5>
                <form action="{{ route('info.update', ['idinfo' => $info->id, 'idclient' => $idclient]) }}" method="post">
                    @method('post')
                    @csrf
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="titre" name="titre" type="text"
                                class="validate @error('titre') is-invalid @enderror"
                                value="{{ old('titre') ?? $info->titre }}">
                            <label for="titre">Titre de l'information</label>
                            @error('titre')
                                <span id="titreHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12">
                            <textarea id="contenu" name="contenu" class="materialize-textarea validate @error('contenu') is-invalid @enderror">{{ old('contenu') ?? $info->contenu }}</textarea>
                            <label for="contenu">Contenu de l'information</label>
                            @error('contenu')
                                <span id="contenuHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light right submit" type="submit" name="action">Mettre à
                                jour</button>

                        </div>

                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
