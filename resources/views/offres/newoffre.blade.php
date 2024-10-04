@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Nouvelle offre</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Nouvelle offre</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Nouvelle offre</h5>
                <form action="{{ route('offre.add', ['table' => $table, 'idtable' => $idtable]) }}" method="post"
                    enctype="multipart/form-data">
                    @method('post')
                    @csrf

                    @if ($table == 'client')
                        <div class="row">

                            <div class="input-field col s12 l6">
                                <p>
                                    <label>
                                        <input class="with-gap" id="btn-radio1" name="type" type="radio" value="new"
                                            {{ old('type') == 'new' ? 'checked' : '' }} onclick="toggleRefField(this)" />
                                        <span>Nouvelle offre</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input class="with-gap" id="btn-radio2" name="type" type="radio" value="old"
                                            {{ old('type') == 'old' ? 'checked' : '' }} onclick="toggleRefField(this)" />
                                        <span>Ajouter à une offre</span>
                                    </label>
                                </p>
                                @error('type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input-field col s12 l6" id="refField"
                                style="display: {{ $errors->has('ref') ? 'block' : 'none' }}">
                                <input id="ref" name="ref" type="text"
                                    class="validate @error('ref') is-invalid @enderror" value="{{ old('ref') }}">
                                <label for="ref">Réference de l'offre</label>
                                @error('ref')
                                    <span id="refHelp" class="form-text red-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="input-field col s12">
                            <select id="produit" name="produit" data-error=".errorTxt6"
                                class="validate @error('produit') is-invalid @enderror" required>
                                <option value="" disabled selected>Choisir le produit</option>
                                @foreach ($produits as $produit)
                                    <option value="{{ $produit->id }}" @if (old('produit') == $produit->id) selected @endif
                                        onchange="toggleProduit(this)">
                                        {{ $produit->nomProduit }}
                                    </option>
                                @endforeach
                            </select>
                            <label>Produits</label>
                            @error('produit')
                                <span id="produitHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div id="formulaires" class="row"></div>
                    <div id="garanties" class="row"></div>
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
