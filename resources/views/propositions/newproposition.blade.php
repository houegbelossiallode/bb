@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Nouvelle proposition</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Nouvelle proposition</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Nouvelle proposition</h5>
                <div class="m-t-40 m-b-40">
                    @if (session()->has('success'))
                        <div class="card-panel teal lighten-2 white-text">{{ session()->get('success') }}</div>
                    @endif
                    @if (session()->has('error'))
                        <div class="card-panel red lighten-2 white-text">{{ session()->get('error') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <form action="{{ route('proposition.add', $idoffre) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <h4 class="offre m-t-40 m-b-40">INFORMATIONS SUR L'OFFRE</h4>
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
                        <h4 class="offre m-t-40 m-b-40">INFORMATIONS SUR LES GARANTIES</h4>
                        @foreach ($garanties as $index => $garantie)
                            <div>
                                <label for="garantie_{{ $garantie->id }}">
                                    <input type="checkbox" id="garantie_{{ $garantie->id }}"
                                        name="garantie-group[{{ $index }}][id]" value="{{ $garantie->id }}"
                                        onchange="toggleFormulaires({{ $garantie->id }})"
                                        {{ $errors->has('garantie-group.' . $index . '.*.information') || $errors->has('garantie-group.' . $index . '.*.fichier') || $errors->has('garantie-group.' . $index . '.prime') || $errors->has('garantie-group.' . $index . '.surPrime') || $errors->has('garantie-group.' . $index . '.accessoire') || $errors->has('garantie-group.' . $index . '.taxe') || $errors->has('garantie-group.' . $index . '.reduction') ? 'checked' : '' }}>
                                    <span>{{ $garantie->garantie->libelle }}</span>
                                </label>

                                <!-- Formulaires liés à la garantie -->
                                <div id="formulaires_{{ $garantie->id }}"
                                    style="display: {{ $errors->has('garantie-group.' . $index . '.*.information') || $errors->has('garantie-group.' . $index . '.*.fichier') || $errors->has('garantie-group.' . $index . '.prime') || $errors->has('garantie-group.' . $index . '.surPrime') || $errors->has('garantie-group.' . $index . '.accessoire') || $errors->has('garantie-group.' . $index . '.taxe') || $errors->has('garantie-group.' . $index . '.reduction') ? 'block' : 'none' }};"
                                    class="container-fluid">
                                    @php
                                        $details = json_decode($garantie->detailOffres, true);
                                    @endphp
                                    <div class="row">
                                        <h6>Proposition</h6>
                                        @foreach ($details as $i => $detail)
                                            @if (
                                                $detail['type'] === 'FCFA' ||
                                                    $detail['type'] === 'Kg' ||
                                                    $detail['type'] === 'ans' ||
                                                    $detail['type'] === 'mois' ||
                                                    $detail['type'] === 'jours' ||
                                                    $detail['type'] === 'Cv' ||
                                                    $detail['type'] === 'm2' ||
                                                    $detail['type'] === '%')
                                                <div class="col s12 l6">
                                                    <b>{{ $detail['nom'] . ' suggéré(e)' }} : </b> <span
                                                        class="red-text">{{ $detail['information'] . ' ' . $detail['type'] }}</span>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        @foreach ($details as $i => $detail)
                                            <input type="hidden"
                                                name="garantie-group[{{ $index }}][{{ $i }}][nom]"
                                                value="{{ $detail['nom'] }}">
                                            <input type="hidden"
                                                name="garantie-group[{{ $index }}][{{ $i }}][type]"
                                                value="{{ $detail['type'] }}">

                                            @if ($detail['nom'] == 'Franchise' || $detail['nom'] == 'franchise' || $detail['nom'] == 'FRANCHISE')
                                                <div class="input-field col s6">
                                                    <input id="champ{{ $index }}{{ $i }}"
                                                        name="garantie-group[{{ $index }}][{{ $i }}][information]"
                                                        type="number"
                                                        class="validate @error('garantie-group.' . $index . '.' . $i . '.information') is-invalid @enderror"
                                                        value="{{ $detail['information'] }}" readonly>
                                                    <label
                                                        for="champ{{ $index }}{{ $i }}">{{ $detail['nom'] }}</label>
                                                    @error('garantie-group.' . $index . '.' . $i . '.information')
                                                        <span id="champ{{ $index }}{{ $i }}Help"
                                                            class="form-text red-text">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            @else
                                                @if ($detail['type'] == 'textarea')
                                                    <div class="input-field col s6">
                                                        <textarea id="champ{{ $index }}{{ $i }}"
                                                            name="garantie-group[{{ $index }}][{{ $i }}][information]"
                                                            class="materialize-textarea validate @error('garantie-group.' . $index . '.' . $i . '.information') is-invalid @enderror">{{ old('garantie-group.' . $index . '.' . $i . '.information') }}</textarea>
                                                        <label
                                                            for="champ{{ $index }}{{ $i }}">{{ $detail['nom'] }}</label>
                                                        @error('garantie-group.' . $index . '.' . $i . '.information')
                                                            <span id="champ{{ $index }}{{ $i }}Help"
                                                                class="form-text red-text">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                @elseif ($detail['type'] == 'file')
                                                    <div class="file-field input-field col s6">
                                                        <div class="btn darken-1">
                                                            <span>{{ $detail['nom'] }}</span>
                                                            <input type="file"
                                                                id="fichier{{ $index }}{{ $i }}"
                                                                name="garantie-group[{{ $index }}][{{ $i }}][fichier]"
                                                                class="validate @error('garantie-group.' . $index . '.' . $i . '.fichier') is-invalid @enderror">
                                                        </div>
                                                        <div class="file-path-wrapper">
                                                            <input id="champ{{ $index }}{{ $i }}"
                                                                name="garantie-group[{{ $index }}][{{ $i }}][information]"
                                                                class="file-path validate @error('garantie-group.' . $index . '.' . $i . '.information') is-invalid @enderror"
                                                                type="text" value="">
                                                            @error('garantie-group.' . $index . '.' . $i . '.information')
                                                                <span id="champ{{ $index }}{{ $i }}Help"
                                                                    class="form-text red-text">{{ $message }}</span>
                                                            @enderror
                                                            @error('garantie-group.' . $index . '.' . $i . '.fichier')
                                                                <span
                                                                    id="fichier{{ $index }}{{ $i }}Help"
                                                                    class="form-text red-text">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @elseif ($detail['type'] == 'select')
                                                    @php
                                                        $options = json_decode($detail['options'], true);
                                                    @endphp
                                                    <input type="hidden"
                                                        name="garantie-group[{{ $index }}][{{ $i }}][options]"
                                                        value='{{ $detail['options'] }}'>
                                                    <div class="input-field col s6">
                                                        <select id="champ{{ $index }}{{ $i }}"
                                                            name="garantie-group[{{ $index }}][{{ $i }}][information]"
                                                            data-error=".errorTxt6"
                                                            class="validate @error('garantie-group.' . $index . '.' . $i . '.information') is-invalid @enderror">
                                                            <option value="" disabled selected>Choisir le type
                                                            </option>
                                                            @foreach ($options as $option)
                                                                <option value="{{ $option['option'] }}"
                                                                    {{ old('garantie-group.' . $index . '.' . $i . '.information') == $option['option'] ? 'selected' : '' }}>
                                                                    {{ $option['option'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <label
                                                            for="champ{{ $index }}{{ $i }}">{{ $detail['nom'] }}</label>
                                                        @error('garantie-group.' . $index . '.' . $i . '.information')
                                                            <span id="champ{{ $index }}{{ $i }}Help"
                                                                class="form-text red-text">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                @elseif (
                                                    $detail['type'] === 'FCFA' ||
                                                        $detail['type'] === 'Kg' ||
                                                        $detail['type'] === 'ans' ||
                                                        $detail['type'] === 'mois' ||
                                                        $detail['type'] === 'jours' ||
                                                        $detail['type'] === 'Cv' ||
                                                        $detail['type'] === 'm2' ||
                                                        $detail['type'] === '%')
                                                    <div class="input-field col s6">
                                                        <input id="champ{{ $index }}{{ $i }}"
                                                            name="garantie-group[{{ $index }}][{{ $i }}][information]"
                                                            type="number"
                                                            class="validate @error('garantie-group.' . $index . '.' . $i . '.information') is-invalid @enderror"
                                                            value="{{ old('garantie-group.' . $index . '.' . $i . '.information') }}">
                                                        <label
                                                            for="champ{{ $index }}{{ $i }}">{{ $detail['nom'] }}</label>
                                                        @error('garantie-group.' . $index . '.' . $i . '.information')
                                                            <span id="champ{{ $index }}{{ $i }}Help"
                                                                class="form-text red-text">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                @else
                                                    <div class="input-field col s6">
                                                        <input id="champ{{ $index }}{{ $i }}"
                                                            name="garantie-group[{{ $index }}][{{ $i }}][information]"
                                                            type="{{ $detail['type'] }}"
                                                            class="validate @error('garantie-group.' . $index . '.' . $i . '.information') is-invalid @enderror"
                                                            value="{{ old('garantie-group.' . $index . '.' . $i . '.information') }}">
                                                        <label
                                                            for="champ{{ $index }}{{ $i }}">{{ $detail['nom'] }}</label>
                                                        @error('garantie-group.' . $index . '.' . $i . '.information')
                                                            <span id="champ{{ $index }}{{ $i }}Help"
                                                                class="form-text red-text">{{ $message }}</span>
                                                        @enderror

                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>

                                    <h4 class="offre m-t-40 m-b-40">TARIFICATION PARTIELLE</h4>
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input id="prime{{ $index }}"
                                                name="garantie-group[{{ $index }}][prime]" type="number"
                                                class="validate @error('garantie-group.' . $index . '.prime') is-invalid @enderror"
                                                value="{{ old('garantie-group.' . $index . '.prime') }}">
                                            <label for="prime{{ $index }}">Prime nette</label>
                                            @error('garantie-group.' . $index . '.prime')
                                                <span id="prime{{ $index }}Help"
                                                    class="form-text red-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="surprime{{ $index }}"
                                                name="garantie-group[{{ $index }}][surPrime]" type="number"
                                                class="validate @error('garantie-group.' . $index . '.surPrime') is-invalid @enderror"
                                                value="{{ old('garantie-group.' . $index . '.surPrime') }}">
                                            <label for="surprime{{ $index }}">Sur prime</label>
                                            @error('garantie-group.' . $index . '.surPrime')
                                                <span id="surPrime{{ $index }}Help"
                                                    class="form-text red-text">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- <div class="input-field col s6">
                                            <input id="primetotale{{ $index }}"
                                                name="garantie-group[{{ $index }}][primeTotale]" type="number"
                                                class="validate" value="" readonly>
                                            <label for="primetotale{{ $index }}">Prime
                                                Totale</label>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <h4 class="offre m-t-40 m-b-40">TARIFICATION TOTALE</h4>
                        <div class="input-field col s6">
                            <input id="accessoire" name="accessoire" type="number"
                                class="validate @error('accessoire') is-invalid @enderror"
                                value="{{ old('accessoire') }}">
                            <label for="accessoire">Accessoire</label>
                            @error('accessoire')
                                <span id="accessoireHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <input id="taxe" name="taxe" type="number"
                                class="validate @error('taxe') is-invalid @enderror" value="{{ old('taxe') }}">
                            <label for="taxe">Taxe</label>
                            @error('taxe')
                                <span id="taxeHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <input id="reduction" name="reduction" type="number"
                                class="validate @error('reduction') is-invalid @enderror"
                                value="{{ old('reduction') }}">
                            <label for="reduction">Réduction</label>
                            @error('reduction')
                                <span id="reductionHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">

                        <div class="input-field col s12 L6">
                            <button class="btn waves-effect waves-light right submit" type="submit"
                                name="action">Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
