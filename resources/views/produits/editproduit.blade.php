@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Modifier produit</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Modifier produit</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Modifier produit</h5>
                <form action="{{ route('produit.update', $produit->id) }}" method="post">
                    @method('post')
                    @csrf
                    <div class="row m-t-40">
                        <div class="input-field col s6">
                            <select id="type" name="type" data-error=".errorTxt6"
                                class="validate @error('type') is-invalid @enderror">
                                <option value="" disabled selected>Choisir la branche</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" @if (old('type') == $type->id || $produit->typeproduit_id == $type->id) selected @endif>
                                        {{ $type->libelle }}
                                    </option>
                                @endforeach
                            </select>
                            <label>Branche</label>
                            @error('type')
                                <span id="typeHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <input id="nom" name="nom" type="text"
                                class="validate @error('nom') is-invalid @enderror"
                                value="{{ old('nom') ?? $produit->nomProduit }}">
                            <label for="nom">Nom du produit</label>
                            @error('nom')
                                <span id="nomHelp" class="form-text red-text">{{ $message }}</span>
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
