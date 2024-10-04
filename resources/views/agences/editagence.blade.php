@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Modifer une agence</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Modifer une agence</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Modifer une agence</h5>
                <form action="{{ route('agence.update', $agence->id) }}" method="post">
                    @method('post')
                    @csrf
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="libelle" name="libelle" type="text"
                                class="validate @error('libelle') is-invalid @enderror"
                                value="{{ old('libelle') ?? $agence->libelle }}">
                            <label for="libelle">Nom de l'agence</label>
                            @error('libelle')
                                <span id="libelleHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <input id="adresse" name="adresse" type="text"
                                class="validate @error('adresse') is-invalid @enderror"
                                value="{{ old('adresse') ?? $agence->adresse }}">
                            <label for="adresse">Adresse de l'agence</label>
                            @error('adresse')
                                <span id="adresseHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light right submit" type="submit"
                                name="action">Modifier</button>

                        </div>

                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
