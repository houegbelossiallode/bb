@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Attribuer une condition supérieure</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Attribuer une condition supérieure</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Attribuer une condition supérieure</h5>
                <form action="{{ route('condition.hierachie.add', $id) }}" method="post">
                    @method('post')
                    @csrf
                    <div class="row m-t-40">
                        <div class="input-field col s6">
                            <select id="superieure" name="superieure" data-error=".errorTxt6"
                                class="validate @error('superieure') is-invalid @enderror">
                                <option value="" disabled selected>Choisir la condition supérieure</option>
                                @foreach ($superieures as $superieure)
                                    <option value="{{ $superieure->id }}" @if (old('superieure') == $superieure->id) selected @endif>
                                        {{ $superieure->libelle }}</option>
                                @endforeach
                            </select>
                            <label>Attribuer une condition supérieure</label>
                            @error('superieure')
                                <span id="superieureHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
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
