<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contrat</title>
    <style>
        .container {
            border: 2px solid black
        }

        .header {
            width: 90%;
            margin: auto;
            margin-bottom: 20px;
            border-collapse: collapse;

        }

        .colonne {
            border: 1px solid black,
        }
    </style>
</head>

<body>
    <div class="container">
        <table class="header">
            <tr>
                <td><img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents($image)) }}" alt=""
                        width="100px"></td>
                <td>
                    <div style="margin: auto; text-align:center">
                        <b>CONTRAT APPEL D'OFFRE <br> OFFRE
                            {{ $contrat->offre->dossieroffre->reference . ' (' . $contrat->offre->produit->nomProduit . ')' }}</b>
                    </div>

                </td>
                <td><img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('users/compagnies/' . $contrat->proposition->compagnie->logo))) }}"
                        alt="" width="60px"></td>
            </tr>
        </table>
        <table width="100%">
            <tr class="colonne">
                <td colspan="4"
                    style="padding:10px; background-color: rgb(242, 216, 157); border-bottom: 1px solid black; ">

                    <b>IDENTIFICATION DE L'ASSURE</b>

                </td>
            </tr>
            <tr>
                <td width="25%">Assuré</td>
                <td width="25%">
                    {{ $contrat->offre->dossieroffre->client->type == 'Personne physique' ? $contrat->offre->dossieroffre->client->user->nom . ' ' . $contrat->offre->dossieroffre->client->user->prenom : $contrat->offre->dossieroffre->client->entreprise->raisonSociale }}
                </td>
                <td width="25%">Téléphone
                </td>
                <td width="25%">
                    {{ $contrat->offre->dossieroffre->client->user->tel }}
                </td>
            </tr>
            <tr>
                <td width="25%">
                    {{ $contrat->offre->dossieroffre->client->type == 'Personne physique' ? 'Date de naissance ' : "Secteur d'activité" }}
                </td>
                <td width="25%">
                    {{ $contrat->offre->dossieroffre->client->type == 'Personne physique' ? $contrat->offre->dossieroffre->client->user->dateNaissance : $contrat->offre->dossieroffre->client->entreprise->secteur }}
                </td>
                <td width="25%">Adresse</td>
                <td width="25%">
                    {{ $contrat->offre->dossieroffre->client->type == 'Personne physique' ? $contrat->offre->dossieroffre->client->user->adresse : $contrat->offre->dossieroffre->client->entreprise->adresse }}
                </td>
            </tr>
            <tr class="colonne">
                <td colspan="4"
                    style="padding:10px; background-color: rgb(242, 216, 157); border-bottom: 1px solid black; ">

                    <b>INFORMATIONS SUR L'APPEL D'OFFRE</b>

                </td>
            </tr>
            <tr>
                <td colspan="4">
                    @php
                        $informations = json_decode($contrat->offre->informationRequise, true);

                    @endphp
                    <ul>
                        @foreach ($informations as $info)
                            <li>{{ $info['nom'] }} : @if ($info['type'] == 'file')
                                @elseif ($info['type'] == 'FCFA')
                                    {{ number_format($info['information'], 0, ',', '.') . ' FCFA' }}
                                @elseif (
                                    $info['type'] == 'Kg' ||
                                        $info['type'] == 'ans' ||
                                        $info['type'] == 'mois' ||
                                        $info['type'] == 'jours' ||
                                        $info['type'] == 'Cv' ||
                                        $info['type'] == 'm2')
                                    {{ $info['information'] . ' ' . $info['type'] }}
                                @else
                                    {{ $info['information'] }}
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            <tr class="colonne">
                <td colspan="4"
                    style="padding:10px; background-color: rgb(242, 216, 157); border-bottom: 1px solid black; ">

                    <b>GARANTIES ACCORDEES</b>

                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <ul>
                        @foreach ($contrat->proposition->details as $detail)
                            <li>{{ $detail->detailoffre->garantie->libelle }}
                                @php
                                    $detailpropositions = json_decode($detail->detailPropositions, true);

                                @endphp
                                @foreach ($detailpropositions as $detailproposition)
                                    <p>{{ $detailproposition['nom'] }} : @if ($detailproposition['type'] == 'file')
                                        @elseif ($detailproposition['type'] == 'FCFA')
                                            {{ number_format($detailproposition['information'], 0, ',', '.') . ' FCFA' }}
                                        @elseif (
                                            $detailproposition['type'] == 'Kg' ||
                                                $detailproposition['type'] == 'ans' ||
                                                $detailproposition['type'] == 'mois' ||
                                                $detailproposition['type'] == 'jours' ||
                                                $detailproposition['type'] == 'Cv' ||
                                                $detailproposition['type'] == 'm2')
                                            {{ $detailproposition['information'] . ' ' . $detailproposition['type'] }}
                                        @else
                                            {{ $detailproposition['information'] }}
                                        @endif
                                    </p>
                                @endforeach
                            </li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            <tr class="colonne">
                <td colspan="4"
                    style="padding:10px; background-color: rgb(242, 216, 157); border-bottom: 1px solid black; ">

                    <b>PRIME D'ASSURANCE</b>

                </td>
            </tr>
            <tr>
                <td width="25%">Prime nette</td>
                <td width="25%">
                    {{ number_format($primeTotale, 0, ',', '.') . ' FCFA' }}
                </td>
                <td width="25%">Taxe
                </td>
                <td width="25%">
                    {{ number_format(0, 0, ',', '.') . ' FCFA' }}
                </td>
            </tr>
            <tr>
                <td width="25%">Accessoire</td>
                <td width="25%">
                    {{ number_format(0, 0, ',', '.') . ' FCFA' }}
                </td>
                <td width="25%">Prime TTC
                </td>
                <td width="25%">
                    {{ number_format($primeTotale, 0, ',', '.') . ' FCFA' }}
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding:10px; border-top: 1px solid black; border-bottom: 1px solid black; ">
                    @php
                        $date = \Carbon\Carbon::parse($contrat->created_at)->format('d/m/Y');
                    @endphp
                    <b>Fait à COTONOU le {{ $date }}</b>

                </td>
            </tr>
            <tr>
                <td width="50%">
                    @php
                        $debut = \Carbon\Carbon::parse($contrat->debut)->format('d/m/Y');
                        $fin = \Carbon\Carbon::parse($contrat->fin)->format('d/m/Y');
                    @endphp
                    <ul>
                        <li>Durée du contrat : <b>{{ $contrat->duree }} </b> </li>
                        <li>Début du contrat : <b>{{ $debut }} </b> </li>
                        <li>Fin du contrat : <b>{{ $fin }} </b> </li>
                    </ul>
                </td>
                <td width="10%" colspan="2">
                    &nbsp;
                </td>
                <td width="40%">&nbsp;
                </td>
            </tr>
            {{-- <tr>
                <td width="50%" style="padding-bottom: 100px">
                    <img src="data:image/svg+xml;base64,{{ $qrCode }}" alt="QR Code" height="150px" style="margin: 0px;" />
                </td>
                <td width="10%" colspan="2" style="padding-bottom: 100px">
                    &nbsp;
                </td>
                <td width="40%" style="padding-bottom: 100px">&nbsp;
                </td>
            </tr> --}}


        </table>
    </div>

    <img src="data:image/svg+xml;base64,{{ $qrCode }}" alt="QR Code" height="100px" style="margin: 0px;" />

</body>

</html>
