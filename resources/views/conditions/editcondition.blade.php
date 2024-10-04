@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Nouvelle condition</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Nouvelle condition</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Nouvelle condition</h5>
                <form action="{{ route('condition.update', ['idproduit' => $idproduit, 'idcondition' => $condition->id]) }}"
                    method="post">
                    @method('post')
                    @csrf
                    <div class="row">
                        <div class="input-field col s12 l6">
                            <input id="libelle" name="libelle" type="text"
                                class="validate @error('libelle') is-invalid @enderror"
                                value="{{ old('libelle') ?? $condition->libelle }}">
                            <label for="libelle">Libelle</label>
                            @error('libelle')
                                <span id="libelleHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 l6">
                            <input id="niveau" name="niveau" type="number"
                                class="validate @error('niveau') is-invalid @enderror"
                                value="{{ old('niveau') ?? $condition->niveau }}">
                            <label for="niveau">Niveau</label>
                            @error('niveau')
                                <span id="niveauHelp" class="form-text red-text">{{ $message }}</span>
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
