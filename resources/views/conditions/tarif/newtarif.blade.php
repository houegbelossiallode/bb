@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Importer les tarifs</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Importer les tarifs</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Importer les tarifs</h5>
                <form action="{{ route('tarif.add', $id) }}" method="post" enctype="multipart/form-data">
                    @method('post')
                    @csrf
                    <div class="row m-t-40">
                        <div class="file-field input-field col s6">
                            <div class="btn darken-1">
                                <span>Importer le fichier</span>
                                <input type="file" id="fichier" name="fichier"
                                    class="validate @error('fichier') is-invalid @enderror">
                            </div>
                            <div class="file-path-wrapper">
                                <input id="file" name="information"
                                    class="file-path validate @error('information') is-invalid @enderror" type="text"
                                    value="{{ old('information') }}">
                                @error('fichier')
                                    <span id="fichierHelp" class="form-text red-text">{{ $message }}</span>
                                @enderror
                                @error('information')
                                    <span id="fileHelp" class="form-text red-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light right submit" type="submit"
                                name="action">Importer</button>

                        </div>

                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
