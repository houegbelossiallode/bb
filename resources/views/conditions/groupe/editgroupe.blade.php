{{-- @extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Nouveau groupe</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Nouveau groupe</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Nouveau groupe</h5>
                <form action="{{ route('groupe.add', $idproduit) }}" method="post">
                    @method('post')
                    @csrf
                    <div class="row m-t-40">
                        <div class="input-field col s12 l6">
                            <h5 class="m-b-40">Sélectionner les conditions</h5>

                            @foreach ($conditions as $condition)
                                <h5 class="m-b-20">{{ $condition->libelle }}</h5>
                                <div class="m-b-40">
                                    @foreach ($condition->valeurs as $valeur)
                                        <p>
                                            <label>
                                                <input type="checkbox" id="condition" name="condition[]"
                                                    class="filled-in validate @error('condition') is-invalid @enderror"
                                                    value="{{ $valeur->id }}" />
                                                <span>{{ $valeur->libelle }}</span>
                                            </label>
                                        </p>
                                    @endforeach

                                </div>
                            @endforeach
                            @error('condition')
                                <span id="conditionHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>


                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light right submit" type="submit"
                                name="action">Grouper</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection --}}

@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Nouveau groupe</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Nouveau groupe</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Nouveau groupe</h5>
                <form action="{{ route('groupe.add', $idproduit) }}" method="post">
                    @method('post')
                    @csrf
                    <div class="row m-t-40">
                        <div class="input-field col s12 l6">
                            <h5 class="m-b-40">Sélectionner les conditions</h5>

                            @foreach ($conditions as $condition)
                                <h5 class="m-b-20">{{ $condition->libelle }}</h5>
                                <div class="m-b-40">
                                    @foreach ($condition->valeurs as $valeur)
                                        <p>
                                            <label>
                                                <input type="radio" id="condition_{{ $condition->id }}"
                                                    name="condition[{{ $condition->id }}]"
                                                    class="filled-in validate @error('condition') is-invalid @enderror"
                                                    value="{{ $valeur->id }}" />
                                                <span>{{ $valeur->libelle }}</span>
                                            </label>
                                        </p>
                                    @endforeach
                                </div>
                            @endforeach
                            @error('condition')
                                <span id="conditionHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light right submit" type="submit"
                                name="action">Grouper</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
