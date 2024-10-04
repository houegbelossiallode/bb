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
                <form action="{{ route('offre.detail.add', ['iddossier' => $iddossier, 'idoffre' => $idoffre]) }}"
                    method="post" enctype="multipart/form-data">
                    @method('post')
                    @csrf

                    @foreach ($garanties as $index => $garantie)
                        <div>
                            <label for="garantie_{{ $garantie->id }}">
                                <input type="checkbox" id="garantie_{{ $garantie->id }}"
                                    name="garantie-group[{{ $index }}][id]" value="{{ $garantie->id }}"
                                    onchange="toggleFormulaires({{ $garantie->id }})">
                                <span>{{ $garantie->libelle }}</span>
                            </label>

                            <!-- Formulaires liés à la garantie -->
                            <div id="formulaires_{{ $garantie->id }}" style="display: none;">
                                @foreach ($garantie->infos as $i => $formulaire)
                                    <input type="hidden"
                                        name="garantie-group[{{ $index }}][{{ $i }}][nom]"
                                        value="{{ $formulaire->nom }}">
                                    <input type="hidden"
                                        name="garantie-group[{{ $index }}][{{ $i }}][type]"
                                        value="{{ $formulaire->type }}">

                                    @if ($formulaire->type == 'textarea')
                                        <div class="input-field col s6">
                                            <textarea id="champ{{ $index }}{{ $i }}"
                                                name="garantie-group[{{ $index }}][{{ $i }}][information]"
                                                class="materialize-textarea validate"></textarea>
                                            <label
                                                for="champ{{ $index }}{{ $i }}">{{ $formulaire->nom }}</label>

                                        </div>
                                    @elseif ($formulaire->type == 'file')
                                        <div class="file-field input-field col s6">
                                            <div class="btn darken-1">
                                                <span>{{ $formulaire->nom }}</span>
                                                <input type="file"
                                                    name="garantie-group[{{ $index }}][{{ $i }}][fichier]">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input id="champ{{ $index }}{{ $i }}"
                                                    name="garantie-group[{{ $index }}][{{ $i }}][information]"
                                                    class="file-path validate" type="text" value="">

                                            </div>
                                        </div>
                                    @elseif ($formulaire->type == 'select')
                                        @php
                                            $options = json_decode($formulaire['options'], true);
                                        @endphp
                                        <input type="hidden"
                                            name="garantie-group[{{ $index }}][{{ $i }}][options]"
                                            value='{{ $formulaire['options'] }}'>
                                        <div class="input-field col s12">
                                            <select id="champ{{ $index }}{{ $i }}"
                                                name="garantie-group[{{ $index }}][{{ $i }}][information]"
                                                data-error=".errorTxt6" class="validate">
                                                <option value="" disabled selected>Choisir le type</option>
                                                @foreach ($options as $option)
                                                    <option value="{{ $option['option'] }}">
                                                        {{ $option['option'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label
                                                for="champ{{ $index }}{{ $i }}">{{ $formulaire->nom }}</label>
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
                                                <input id="champ{{ $index }}{{ $i }}"
                                                    name="garantie-group[{{ $index }}][{{ $i }}][information]"
                                                    type="number" class="validate" value="">
                                                <label
                                                    for="champ{{ $index }}{{ $i }}">{{ $formulaire->nom }}</label>

                                            </div>
                                        @else
                                            <div class="input-field col s6">
                                                <input id="champ{{ $index }}{{ $i }}"
                                                    name="garantie-group[{{ $index }}][{{ $i }}][information]"
                                                    type="{{ $formulaire->type }}" class="validate" value="">
                                                <label
                                                    for="champ{{ $index }}{{ $i }}">{{ $formulaire->nom }}</label>

                                            </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <button class="btn waves-effect waves-light right submit" type="submit" name="action">Ajouter</button>
                </form>

            </div>
        </div>

    </div>
@endsection
