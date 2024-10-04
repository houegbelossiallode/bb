@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Nouvelle production</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Nouvelle production</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Nouvelle production</h5>
                <form action="{{ route('production.add', $groupe->id) }}" method="post" enctype="multipart/form-data">
                    @method('post')
                    @csrf
                    <div class="grey white-text p-10" style="border-radius: 5%">
                        <b><u>Informations produit</u></b>
                        <ul>
                            @foreach ($groupe->liaisons as $liaison)
                                <li>{{ $liaison->conditionvaleur->condition->libelle }} :
                                    <b>{{ $liaison->conditionvaleur->libelle }}</b>
                                </li>
                            @endforeach
                            <li id="champPrime">

                            </li>
                        </ul>
                    </div>
                    <div class="row m-t-20">
                        <div class="input-field col s12">
                            <select id="clientselect2" name="clientselect2">
                                <option value="" disabled selected>Choisir le client</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" @if (old('clientselect2') == $client->id) selected @endif>
                                        {{ $client->user->nom . ' ' . $client->user->prenom }}
                                    </option>
                                @endforeach
                            </select>
                            <label>Client</label>
                            @error('clientselect2')
                                <span id="clientselect2Help" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12">
                            <h5 class="m-b-40">Sélectionner les compagnies</h5>
                            @foreach ($compagnies as $compagnie)
                                @if ($compagnie['statut'] && $compagnie['statut'] == true)
                                    <p>
                                        <label>
                                            <input type="radio" id="compagnie" name="compagnie"
                                                class="filled-in validate @error('compagnie') is-invalid @enderror"
                                                value="{{ $compagnie->id }}"
                                                onchange="getSingleTarif({{ $groupe->id }})" />
                                            <span>{{ $compagnie->nom }}</span>
                                        </label>
                                    </p>
                                @endif
                            @endforeach
                            @error('compagnie')
                                <span id="compagnieHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>


                    </div>

                    <div class="row">
                        @foreach ($formulaires as $index => $formulaire)
                            <div>
                                <input type="hidden" name="repeater-group[{{ $index }}][nom]"
                                    value="{{ $formulaire->nom }}">
                                <input type="hidden" name="repeater-group[{{ $index }}][type]"
                                    value="{{ $formulaire->type }}">

                                @if ($formulaire->type == 'textarea')
                                    <div class="input-field col s6">
                                        <textarea id="textarea{{ $index }}" name="repeater-group[{{ $index }}][information]"
                                            class="materialize-textarea validate @error('repeater-group.' . $index . '.information') is-invalid @enderror">{{ old('repeater-group.' . $index . '.information') }}</textarea>
                                        <label for="textarea{{ $index }}">{{ $formulaire->nom }}</label>
                                        @error('repeater-group.' . $index . '.information')
                                            <span id="textarea{{ $index }}Help"
                                                class="form-text red-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @elseif ($formulaire->type == 'file')
                                    <div class="file-field input-field col s6">
                                        <div class="btn darken-1">
                                            <span>{{ $formulaire->nom }}</span>
                                            <input type="file" id="fichier{{ $index }}"
                                                name="repeater-group[{{ $index }}][fichier]"
                                                class="validate @error('repeater-group.' . $index . '.fichier') is-invalid @enderror">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input id="file{{ $index }}"
                                                name="repeater-group[{{ $index }}][information]"
                                                class="file-path validate @error('repeater-group.' . $index . '.information') is-invalid @enderror"
                                                type="text"
                                                value="{{ old('repeater-group.' . $index . '.information') }}">
                                            @error('repeater-group.' . $index . '.fichier')
                                                <span id="fichier{{ $index }}Help"
                                                    class="form-text red-text">{{ $message }}</span>
                                            @enderror
                                            @error('repeater-group.' . $index . '.information')
                                                <span id="file{{ $index }}Help"
                                                    class="form-text red-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @elseif ($formulaire->type == 'select')
                                    @php
                                        $options = json_decode($formulaire->options, true);
                                    @endphp
                                    <input type="hidden" name="repeater-group[{{ $index }}][options]"
                                        value='{{ $formulaire->options }}'>
                                    <div class="input-field col s6">
                                        <select id="select{{ $index }}"
                                            name="repeater-group[{{ $index }}][information]" data-error=".errorTxt6"
                                            class="validate @error('repeater-group.' . $index . '.information') is-invalid @enderror">
                                            <option value="" disabled selected>Choisir le type</option>
                                            @foreach ($options as $option)
                                                <option value="{{ $option['option'] }}"
                                                    {{ old('repeater-group.' . $index . '.information') == $option['option'] ? 'selected' : '' }}>
                                                    {{ $option['option'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="select{{ $index }}">{{ $formulaire->nom }}</label>
                                        @error('repeater-group.' . $index . '.information')
                                            <span id="select{{ $index }}Help"
                                                class="form-text red-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @elseif (
                                    $formulaire->type === 'FCFA' ||
                                        $formulaire->type === 'Kg' ||
                                        $formulaire->type === 'ans' ||
                                        $formulaire->type === 'mois' ||
                                        $formulaire->type === 'jours' ||
                                        $formulaire->type === 'Cv' ||
                                        $formulaire->type === 'm2' ||
                                        $formulaire->type === '%')
                                    <div class="input-field col s6">
                                        <input id="autre{{ $index }}"
                                            name="repeater-group[{{ $index }}][information]" type="number"
                                            class="validate @error('repeater-group.' . $index . '.information') is-invalid @enderror"
                                            value="{{ old('repeater-group.' . $index . '.information') }}">
                                        <label for="autre{{ $index }}">{{ $formulaire->nom }}</label>
                                        @error('repeater-group.' . $index . '.information')
                                            <span id="autre{{ $index }}Help"
                                                class="form-text red-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @else
                                    <div class="input-field col s6">
                                        <input id="autre{{ $index }}"
                                            name="repeater-group[{{ $index }}][information]"
                                            type="{{ $formulaire->type }}"
                                            class="validate @error('repeater-group.' . $index . '.information') is-invalid @enderror"
                                            value="{{ old('repeater-group.' . $index . '.information') }}">
                                        <label for="autre{{ $index }}">{{ $formulaire->nom }}</label>
                                        @error('repeater-group.' . $index . '.information')
                                            <span id="autre{{ $index }}Help"
                                                class="form-text red-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
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
