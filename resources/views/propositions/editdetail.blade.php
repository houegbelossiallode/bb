@extends('layouts.app')
@section('section')
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Modifier détail</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                <a href="#!" class="breadcrumb">Modifier détail</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Modifier détail</h5>
                <form action="{{ route('proposition.detail.update', $detail->id) }}" method="post"
                    enctype="multipart/form-data">
                    @method('post')
                    @csrf
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
                        {{-- <h3 class="offre m-b-40 m-t-40">Tarification</h3> --}}

                        <div class="input-field col s6">
                            <input id="prime" name="prime" type="number"
                                class="validate @error('prime') is-invalid @enderror" value="{{ $detail->prime }}">
                            <label for="prime">Prime nette</label>
                            @error('prime')
                                <span id="primeHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <input id="surPrime" name="surPrime" type="number"
                                class="validate @error('surPrime') is-invalid @enderror" value="{{ $detail->surPrime }}">
                            <label for="surPrime">Sur prime</label>
                            @error('surPrime')
                                <span id="surPrimeHelp" class="form-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
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
