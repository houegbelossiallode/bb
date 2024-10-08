@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Modifier le renseignement</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Modifier le renseignement</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Modifier le renseignement</h5>
                <form
                    action="{{ route('renseignement.update', ['idproduit' => $idproduit, 'idrenseignement' => $renseignement->id]) }}"
                    method="post">
                    @method('post')
                    @csrf
                    <div class="row m-t-40">
                        <div class="input-field col s6">
                            <input id="valeur" name="valeur" type="number"
                                class="validate @error('valeur') is-invalid @enderror"
                                value="{{ old('valeur') ?? $renseignement->valeur }}">
                            <label for="valeur">Valeur</label>
                            @error('valeur')
                                <span id="valeurHelp" class="form-text red-text">{{ $message }}</span>
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
