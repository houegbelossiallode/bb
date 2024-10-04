@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Nouvelle garantie</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Nouvelle garantie</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Nouvelle garantie</h5>
                <form action="{{ route('garantie.add', $idproduit) }}" method="post">
                    @method('post')
                    @csrf
                    <div class="row m-t-40">
                        <div class="input-field col s6">
                            <input id="libelle" name="libelle" type="text"
                                class="validate @error('libelle') is-invalid @enderror" value="{{ old('libelle') }}">
                            <label for="libelle">Nom de la garantie</label>
                            @error('libelle')
                                <span id="libelleHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <textarea id="description" name="description"
                                class="materialize-textarea validate @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            <label for="description">Description</label>
                            @error('description')
                                <span id="descriptionHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
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
