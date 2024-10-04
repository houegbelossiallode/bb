@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Nouvelle assignation</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Nouvelle assignation</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Nouvelle assignation</h5>
                <form action="{{ route('publication.add', $iddossier) }}" method="post">
                    @method('post')
                    @csrf
                    <div class="row m-t-40">
                        <div class="input-field col s12 l6">
                            <h5 class="m-b-40">Sélectionner les compagnies qui verront l'offre</h5>
                            @foreach ($compagnies as $compagnie)
                                <p>
                                    <label>
                                        <input type="checkbox" id="compagnie" name="compagnie[]"
                                            class="filled-in validate @error('compagnie') is-invalid @enderror"
                                            value="{{ $compagnie->id }}" />
                                        <span>{{ $compagnie->nom }}</span>
                                    </label>
                                </p>
                            @endforeach
                            @error('compagnie')
                                <span id="compagnieHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>


                    </div>

                    <div class="row m-t-40">
                        <div class="input-field col s12 l6">
                            <input id="date" name="date" type="date"
                                class="validate @error('date') is-invalid @enderror" value="{{ old('date') }}">
                            <label for="date">Dead line</label>
                            @error('date')
                                <span id="dateHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light right submit" type="submit"
                                name="action">Publier</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
