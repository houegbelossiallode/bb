@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Nouvel objectif</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Nouvel objectif</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Nouvel objectif</h5>
                <form action="{{ route('objectif.add') }}" method="post">
                    @method('post')
                    @csrf
                    <div class="row m-t-40">
                        <div class="input-field col s12 l6">
                            <input id="nbr" name="nbr" type="number"
                                class="validate @error('nbr') is-invalid @enderror" value="{{ old('nbr') }}">
                            <label for="nbr">Nombre de client</label>
                            @error('nbr')
                                <span id="nbrHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 l6">
                            <input id="ca" name="ca" type="number"
                                class="validate @error('ca') is-invalid @enderror" value="{{ old('ca') }}">
                            <label for="ca">Chiffre d'affaire</label>
                            @error('ca')
                                <span id="caHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 l6">
                            <input id="debut" name="debut" type="date"
                                class="validate @error('debut') is-invalid @enderror" value="{{ old('debut') }}">
                            <label for="debut">Date de début</label>
                            @error('debut')
                                <span id="debutHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 l6">
                            <input id="fin" name="fin" type="date"
                                class="validate @error('fin') is-invalid @enderror" value="{{ old('fin') }}">
                            <label for="fin">Date de fin</label>
                            @error('fin')
                                <span id="finHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 l6">
                            <select id="niveau" name="niveau" data-error=".errorTxt6"
                                class="validate @error('niveau') is-invalid @enderror">
                                <option value="" disabled selected>Statut</option>
                                @foreach ($niveaux as $niveau)
                                    <option value="{{ $niveau->id }}" @if (old('niveau') == $niveau->id) selected @endif>
                                        {{ 'Niveau ' . $niveau->niveau }}
                                    </option>
                                @endforeach
                            </select>
                            <label>Sélectionnez le statut</label>
                            @error('niveau')
                                <span id="niveauHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 l6">
                            <select id="type" name="type" data-error=".errorTxt6"
                                class="validate @error('type') is-invalid @enderror">
                                <option value="" disabled selected>Type</option>
                                <option value="Periodique" @if (old('type') == 'Periodique') selected @endif>
                                    Periodique
                                </option>
                                <option value="Challenge" @if (old('type') == 'Challenge') selected @endif>
                                    Challenge
                                </option>
                            </select>
                            <label>Type d'objectif</label>
                            @error('type')
                                <span id="typeHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row" id="blocRecompense"
                        style="display: {{ $errors->has('recompense') ? 'block' : 'none' }}">
                        <div class="input-field col s12">
                            <textarea id="recompense" name="recompense"
                                class="materialize-textarea validate @error('recompense') is-invalid @enderror">{{ old('recompense') }}</textarea>
                            <label for="recompense">Recompense</label>
                            @error('recompense')
                                <span id="recompenseHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
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
