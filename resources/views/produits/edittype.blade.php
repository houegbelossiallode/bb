@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Modifier la branche</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Modifier la branche</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Modifier la branche</h5>
                <form action="{{ route('typeproduit.update', $type->id) }}" method="post">
                    @method('post')
                    @csrf
                    <div class="row m-t-40">
                        <div class="input-field col s6">
                            <select id="branche" name="branche" data-error=".errorTxt6"
                                class="validate @error('branche') is-invalid @enderror">
                                <option value="" disabled selected>Choisir le type d'assurance</option>
                                <option value="Vie" @if (old('branche') == 'Vie' || $type->branche == 'Vie') selected @endif>Vie</option>
                                <option value="Non vie" @if (old('branche') == 'Non vie' || $type->branche == 'Non vie') selected @endif>Non vie</option>
                            </select>
                            <label>Branche</label>
                            @error('branche')
                                <span id="brancheHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <input id="nom" name="nom" type="text"
                                class="validate @error('nom') is-invalid @enderror"
                                value="{{ old('nom') ?? $type->libelle }}">
                            <label for="nom">Nom de la branche</label>
                            @error('nom')
                                <span id="nomHelp" class="form-text red-text">{{ $message }}</span>
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
