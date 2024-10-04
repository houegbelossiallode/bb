@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Modifier réalisation</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Modifier réalisation</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Modifier réalisation</h5>
                <form
                    action="{{ route('realisation.update', ['idrealisation' => $idrealisation, 'idobjectif' => $idobjectif]) }}"
                    method="post">
                    @method('post')
                    @csrf
                    <div class="row m-t-40">
                        <div class="input-field col s12 l6">
                            <input id="nombre" name="nombre" type="number"
                                class="validate @error('nombre') is-invalid @enderror"
                                value="{{ old('nombre') ?? $realisation->nombre }}">
                            <label for="nombre">Nombre de client</label>
                            @error('nombre')
                                <span id="nombreHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 l6">
                            <input id="ca" name="ca" type="number"
                                class="validate @error('ca') is-invalid @enderror"
                                value="{{ old('ca') ?? $realisation->ca }}">
                            <label for="ca">Chiffre d'affaire</label>
                            @error('ca')
                                <span id="caHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 l6">
                            <input id="date" name="date" type="date"
                                class="validate @error('date') is-invalid @enderror"
                                value="{{ old('date') ?? $realisation->date }}">
                            <label for="date">Date de realisation</label>
                            @error('date')
                                <span id="dateHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
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
