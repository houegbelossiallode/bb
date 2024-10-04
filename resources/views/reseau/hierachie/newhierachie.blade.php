@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Attribuer un chef</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Attribuer un chef</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Attribuer un chef</h5>
                <form action="{{ route('hierachie.add', $id) }}" method="post">
                    @method('post')
                    @csrf
                    <div class="row m-t-40">
                        <div class="input-field col s6">
                            <select id="chef" name="chef" data-error=".errorTxt6"
                                class="validate @error('chef') is-invalid @enderror">
                                <option value="" disabled selected>Choisir le chef</option>
                                @foreach ($chefs as $chef)
                                    <option value="{{ $chef->id }}" @if (old('chef') == $chef->id) selected @endif>
                                        {{ $chef->user->nom . ' ' . $chef->user->prenom }}</option>
                                @endforeach
                            </select>
                            <label>Attribuer un chef</label>
                            @error('chef')
                                <span id="chefHelp" class="form-text red-text">{{ $message }}</span>
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
