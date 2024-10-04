@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Nouvel utilisateur</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="#" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Nouvel utilisateur</a>
            </div>
        </div>
    </div>


    @if (session('success'))
    <div class="alert alert-success">
     {{ session('success') }}
    </div>
    @endif


    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Nouvel utilisateur</h5>
                <form action="{{ route('rds.update', $rd) }}" method="post">
                    @method('post')
                    @csrf
                    <div class="row">

                        <div class="col s6">
                            <div class="input-field">

                                <input id="icon_prefix4" type="text" class="validate datepicker" name="date_du_rdv"
                                value="{{ $rd->date_du_rdv }}">
                                <label for="icon_prefix4">Date du Rendez-Vous</label>
                            </div>
                            @error('date_du_rdv')
                            <span id="compagnieHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>


                            <div class="input-field col s6">
                                <select id="prospect_id" name="prospect_id" data-error=".errorTxt6"
                                    class="validate @error('prospect_id') is-invalid @enderror">
                                    <option value="" disabled selected>Choisir le prospect</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}" {{ $client->id== $rd->client_id ? 'selected': '' }}
                                           >{{ $client->nom}}
                                        </option>
                                    @endforeach
                                </select>
                                <label>Prospect</label>
                                @error('prospect_id')
                                    <span id="compagnieHelp" class="form-text red-text">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col s6">
                                <div class="input-field">
                                    <input id="prime" name="prime" type="text"
                                    class="validate @error('prime') is-invalid @enderror" value="{{ $rd->prime }}">
                                <label for="prime">Prime attendue</label>
                                </div>
                                @error('prime')
                                <span id="compagnieHelp" class="form-text red-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-field col s6">
                                <textarea id="notes" name="notes"
                                    class="materialize-textarea validate @error('notes') is-invalid @enderror">{{ $rd->notes }}</textarea>
                                <label for="contenu">Notes</label>
                                @error('notes')
                                    <span id="prenomHelp" class="form-text red-text">{{ $message }}</span>
                                @enderror
                            </div>


                        </div>


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
