@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Nouvelle production</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Nouvelle production</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Nouvelle production</h5>
                <form action="{{ route('tarif.get') }}" method="POST">
                    @method('post')
                    @csrf
                    <div class="row m-t-40">
                        <div class="input-field col s12 l6">
                            <h5 class="m-b-40">Sélectionner les conditions</h5>

                            {{-- @foreach ($conditions as $condition)
                                <h5 class="m-b-20">{{ $condition->libelle }}</h5>
                                <div class="m-b-40">
                                    <div class="input-field col s12">
                                        <select name="condition_{{ $condition->id }}" class="form-control">
                                            <option value="">Choisissez une valeur</option>
                                            @foreach ($condition->valeurs as $valeur)
                                                <option value="{{ $valeur->id }}">{{ $valeur->libelle }}</option>
                                            @endforeach
                                        </select>
                                        <label for="condition_{{ $condition->id }}">{{ $condition->libelle }}</label>
                                    </div>
                                </div>
                            @endforeach
                            @error('condition')
                                <span id="conditionHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror --}}

                            @foreach ($groupes as $groupe)
                                <p>
                                    <label>
                                        <input type="radio" id="groupe" name="groupe"
                                            class="filled-in validate @error('groupe') is-invalid @enderror"
                                            value="{{ $groupe->id }}" />
                                        <span>{{ $groupe->libelle }}</span>
                                    </label>
                                </p>
                            @endforeach
                            @error('groupe')
                                <span id="groupeHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light right" type="submit">Obtenez le
                                tarif</button>
                        </div>
                    </div>
                </form>
                <div id="tarif-result" style="margin-top: 20px;"></div>
            </div>
        </div>
    </div>
@endsection
