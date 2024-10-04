@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Modifier le tarif</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Modifier le tarif</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Modifier le tarif</h5>
                <form action="{{ route('tarif.update', ['idproduit' => $idproduit, 'idtarif' => $tarif->id]) }}"
                    method="post">
                    @method('post')
                    @csrf
                    <div class="row m-t-40">
                        <div class="input-field col s12 l6">
                            <input id="tarif" name="tarif" type="number"
                                class="validate @error('tarif') is-invalid @enderror"
                                value="{{ old('tarif') ?? $tarif->tarif }}">
                            <label for="tarif">Tarif</label>
                            @error('tarif')
                                <span id="tarifHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 l6">
                            <input id="reduction" name="reduction" type="number"
                                class="validate @error('reduction') is-invalid @enderror"
                                value="{{ old('reduction') ?? $tarif->reduction }}">
                            <label for="reduction">Reduction</label>
                            @error('reduction')
                                <span id="reductionHelp" class="form-text red-text">{{ $message }}</span>
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
