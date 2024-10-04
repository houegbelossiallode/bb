@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Nouveau champs</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Nouveau champs</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Nouveau champs</h5>
                <form action="{{ route('formulaire.add', ['table' => $table, 'idTable' => $idTable]) }}" method="post">
                    @method('post')
                    @csrf
                    <div class="row m-t-40">
                        <div class="input-field col s6">
                            <div class="switch">
                                <label>
                                    Inactif
                                    <input type="checkbox" name="etat" checked>
                                    <span class="lever"></span>
                                    Actif
                                </label>
                            </div>
                        </div>
                        <div class="input-field col s6">
                            <input id="num" name="num" type="number"
                                class="validate @error('num') is-invalid @enderror" value="{{ old('num') }}">
                            <label for="num">Numéro d'ordre</label>
                            @error('num')
                                <span id="numHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <input id="nom" name="nom" type="text"
                                class="validate @error('nom') is-invalid @enderror" value="{{ old('nom') }}">
                            <label for="nom">Nom du champs</label>
                            @error('nom')
                                <span id="nomHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <select id="typechamp" name="type" data-error=".errorTxt6"
                                class="validate @error('typechamp') is-invalid @enderror">
                                <option value="" disabled selected>Choisir le type</option>
                                <option value="text" @if (old('typechamp') == 'text') selected @endif>Texte court
                                </option>
                                <option value="textarea" @if (old('typechamp') == 'textarea') selected @endif>
                                    Texte long
                                </option>
                                <option value="number" @if (old('typechamp') == 'number') selected @endif>
                                    Nombre
                                </option>
                                <option value="date" @if (old('typechamp') == 'date') selected @endif>
                                    Date
                                </option>
                                <option value="file" @if (old('typechamp') == 'file') selected @endif>
                                    Fichier
                                </option>
                                <option value="select" @if (old('typechamp') == 'select') selected @endif>
                                    Champs de selection
                                </option>
                                <option value="FCFA" @if (old('typechamp') == 'FCFA') selected @endif>
                                    Monetaire
                                </option>
                                <option value="Kg" @if (old('typechamp') == 'Kg') selected @endif>
                                    Poids
                                </option>
                                <option value="ans" @if (old('typechamp') == 'ans') selected @endif>
                                    Année
                                </option>
                                <option value="mois" @if (old('typechamp') == 'mois') selected @endif>
                                    Mois
                                </option>
                                <option value="jours" @if (old('typechamp') == 'jours') selected @endif>
                                    Jours
                                </option>
                                <option value="Cv" @if (old('typechamp') == 'Cv') selected @endif>
                                    Chevaux
                                </option>
                                <option value="m2" @if (old('typechamp') == 'm2') selected @endif>
                                    Superficie
                                </option>
                                <option value="%" @if (old('typechamp') == '%') selected @endif>
                                    Pourcentage
                                </option>
                            </select>
                            <label>Type du champs</label>
                            @error('typechamp')
                                <span id="typechampHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div id="blocChamp" style="display: {{ $errors->has('option') ? 'block' : 'none' }}">

                            <div class="row email-repeater">
                                <div data-repeater-list="repeater-group">
                                    @foreach (old('repeater-group', [[]]) as $index => $oldGroup)
                                        <div data-repeater-item>
                                            <div class="input-field col s10">
                                                <input id="options" type="text"
                                                    name="repeater-group[{{ $index }}][options]"
                                                    class="validate @error('repeater-group.' . $index . '.options') is-invalid @enderror"
                                                    value="{{ $oldGroup['options'] ?? '' }}">
                                                <label for="options">Options</label>
                                                @error('repeater-group.' . $index . '.options')
                                                    <span id="libelleHelp"
                                                        class="form-text red-text">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="input-field col s2">
                                                <button data-repeater-delete="" class="btn red waves-effect waves-light"
                                                    type="button"><i class="material-icons">clear</i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <button type="button" data-repeater-create=""
                                    class="btn teal waves-effect waves-light m-l-10"><i class="material-icons">add</i>
                                </button>
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
