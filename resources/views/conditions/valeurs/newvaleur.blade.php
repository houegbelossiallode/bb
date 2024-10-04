@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Nouvelle valeur</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Nouvelle valeur</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Nouvelle valeur</h5>
                <form action="{{ route('valeur.add', $idcondition) }}" method="post">
                    @method('post')
                    @csrf
                    <div class="row">
                        <div class="input-field col s12 l6">
                            <input id="valeur" name="valeur" type="text"
                                class="validate @error('valeur') is-invalid @enderror" value="{{ old('valeur') }}">
                            <label for="valeur">Valeur</label>
                            @error('valeur')
                                <span id="valeurHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 l6">
                            <button class="btn waves-effect waves-light right submit" type="submit"
                                name="action">Enregistrer</button>

                        </div>

                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
