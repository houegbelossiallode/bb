@extends('layouts.app')

@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Modifier la production</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Modifier la production</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Modifier la production</h5>
                <form action="{{ route('production.update', $production->id) }}" method="post"
                    enctype="multipart/form-data">
                    @method('post')
                    @csrf
                    <div class="grey white-text p-10" style="border-radius: 5%">
                        <b><u>Informations produit</u></b>
                        <ul>
                            @foreach ($production->conditiongroupe->liaisons as $liaison)
                                <li>{{ $liaison->conditionvaleur->condition->libelle }} :
                                    <b>{{ $liaison->conditionvaleur->libelle }}</b>
                                </li>
                            @endforeach
                            <li id="champPrime">
                                <span>
                                    Prime : {{ number_format($production->prime, 0, ',', '.') . ' FCFA' }} <br>
                                    Réduction : {{ $production->reduction . ' %' }} <br>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="row m-t-20">
                        <div class="input-field col s12">
                            <select id="clientselect2" name="clientselect2">
                                <option value="" disabled selected>Choisir le client</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" @if (old('clientselect2') == $client->id || $production->client->id == $client->id) selected @endif>
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
                                                onchange="getSingleTarif({{ $production->conditiongroupe->id }})"
                                                {{ $production->compagnie->id == $compagnie->id ? 'checked' : '' }} />
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
                        @foreach ($informations as $index => $information)
                            <input type="hidden" name="repeater-group[{{ $index }}][nom]"
                                value="{{ $information['nom'] }}">
                            <input type="hidden" name="repeater-group[{{ $index }}][type]"
                                value="{{ $information['type'] }}">

                            @if ($information['type'] == 'textarea')
                            <div class="input-field col s6">
                                    <textarea id="champ{{ $index }}" name="repeater-group[{{ $index }}][information]"
                                        class="materialize-textarea validate @error('repeater-group.' . $index . '.information') is-invalid @enderror">{{ old('repeater-group.' . $index . '.information') ?? $information['information'] }}</textarea>
                                    <label for="champ{{ $index }}">{{ $information['nom'] }}</label>
                                    @error('repeater-group.' . $index . '.information')
                                        <span id="champ{{ $index }}Help"
                                            class="form-text red-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            @elseif ($information['type'] == 'file')
                                <div class="file-field input-field col s6">
                                    <div class="btn darken-1">
                                        <span>{{ $information['nom'] }}</span>
                                        <input type="file" name="repeater-group[{{ $index }}][fichier]">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input id="champ{{ $index }}"
                                            name="repeater-group[{{ $index }}][information]"
                                            class="file-path validate @error('repeater-group.' . $index . '.information') is-invalid @enderror"
                                            type="text" value="{{ old('repeater-group.' . $index . '.information') }}">
                                        @error('repeater-group.' . $index . '.information')
                                            <span id="champ{{ $index }}Help"
                                                class="form-text red-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @elseif ($information['type'] == 'select')
                                @php
                                    $options = json_decode($information['options'], true);
                                @endphp
                                <input type="hidden" name="repeater-group[{{ $index }}][options]"
                                    value='{{ $information['options'] }}'>
                                    <div class="input-field col s6">
                                    <select id="champ{{ $index }}"
                                        name="repeater-group[{{ $index }}][information]" data-error=".errorTxt6"
                                        class="validate @error('repeater-group.' . $index . '.information') is-invalid @enderror">
                                        <option value="" disabled selected>Choisir le type</option>
                                        @foreach ($options as $option)
                                            <option value="{{ $option['option'] }}"
                                                @if (old('repeater-group.' . $index . '.information') == $option['option'] ||
                                                        $information['information'] == $option['option']
                                                ) selected @endif>{{ $option['option'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label>{{ $information['information'] }}</label>
                                    @error('repeater-group.' . $index . '.information')
                                        <span id="champ{{ $index }}Help"
                                            class="form-text red-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            @elseif (
                                $information['type'] === 'FCFA' ||
                                    $information['type'] === 'Kg' ||
                                    $information['type'] === 'ans' ||
                                    $information['type'] === 'mois' ||
                                    $information['type'] === 'jours' ||
                                    $information['type'] === 'Cv' ||
                                    $information['type'] === 'm2' ||
                                    $information['type'] === '%')
                                <div class="input-field col s6">
                                    <input id="champ{{ $index }}"
                                        name="repeater-group[{{ $index }}][information]" type="number"
                                        class="validate @error('repeater-group.' . $index . '.information') is-invalid @enderror"
                                        value="{{ old('repeater-group.' . $index . '.information') ?? $information['information'] }}">
                                    <label for="champ{{ $index }}">{{ $information['nom'] }}</label>
                                    @error('repeater-group.' . $index . '.information')
                                        <span id="champ{{ $index }}Help"
                                            class="form-text red-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            @else
                            <div class="input-field col s6">
                                    <input id="champ{{ $index }}"
                                        name="repeater-group[{{ $index }}][information]"
                                        type="{{ $information['type'] }}"
                                        class="validate @error('repeater-group.' . $index . '.information') is-invalid @enderror"
                                        value="{{ old('repeater-group.' . $index . '.information') ?? $information['information'] }}">
                                    <label for="champ{{ $index }}">{{ $information['nom'] }}</label>
                                    @error('repeater-group.' . $index . '.information')
                                        <span id="champ{{ $index }}Help"
                                            class="form-text red-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                        @endforeach

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
