@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Nouveau détail</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Nouveau détail</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Nouveau détail</h5>
                <form action="{{ route('proposition.detail.add', $idproposition) }}" method="post"
                    enctype="multipart/form-data">
                    @method('post')
                    @csrf
                    <div class="row">
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
                                    style="display: {{ $errors->has('garantie-group.' . $index . '.*.information') || $errors->has('garantie-group.' . $index . '.*.fichier') || $errors->has('garantie-group.' . $index . '.prime') || $errors->has('garantie-group.' . $index . '.surPrime') || $errors->has('garantie-group.' . $index . '.accessoire') || $errors->has('garantie-group.' . $index . '.taxe') || $errors->has('garantie-group.' . $index . '.reduction') ? 'block' : 'none' }};">
                                    @php
                                        $details = json_decode($garantie->detailOffres, true);
                                    @endphp
                                    <div class="row">
                                        @foreach ($details as $i => $detail)
                                            <input type="hidden"
                                                name="garantie-group[{{ $index }}][{{ $i }}][nom]"
                                                value="{{ $detail['nom'] }}">
                                            <input type="hidden"
                                                name="garantie-group[{{ $index }}][{{ $i }}][type]"
                                                value="{{ $detail['type'] }}">

                                            @if ($detail['type'] == 'textarea')
                                                <div class="input-field col s12">
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
                                                            <span id="fichier{{ $index }}{{ $i }}Help"
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
                                        @endforeach
                                    </div>

                                    <h4 class="offre m-t-40 m-b-40">Tarification</h4>
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
                                            <input id="surprine{{ $index }}"
                                                name="garantie-group[{{ $index }}][surPrime]" type="number"
                                                class="validate @error('garantie-group.' . $index . '.surPrime') is-invalid @enderror"
                                                value="{{ old('garantie-group.' . $index . '.surPrime') }}">
                                            <label for="surprine{{ $index }}">Sur prime</label>
                                            @error('garantie-group.' . $index . '.surPrime')
                                                <span id="surPrime{{ $index }}Help"
                                                    class="form-text red-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <button class="btn waves-effect waves-light right submit" type="submit"
                            name="action">Ajouter</button>
                    </div>


                </form>

            </div>
        </div>

    </div>
@endsection
