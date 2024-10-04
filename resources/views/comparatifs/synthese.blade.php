<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Synthese</title>
    <style>
        .header {
            width: 90%;
            margin: auto;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .header1 {
            text-align: left;
        }

        .header2 {
            text-align: right;
        }

        .table {
            width: 90%;
            margin: auto;
            border: 2px solid black;
            border-collapse: collapse;
        }

        .table td {
            border: 2px solid black;
            padding: 8px;
            text-align: center;
        }


        .info {
            width: 90%;
            margin: 40px auto;
        }

        .infoplus {
            width: 100%;
            border: 2px solid black;
            border-collapse: collapse;
        }

        .infoplus td {
            border: 1px solid black;
            padding-left: 10px;
        }

        .benef {
            width: 90%;
            margin: 40px auto;
        }

        .benef strong {
            margin-left: 20px
        }

        .infobenef {
            width: 100%;
            border: 2px solid black;
            border-collapse: collapse;
        }

        .infobenef td {
            padding-left: 10px;
        }

        .detail {
            width: 90%;
            margin: 40px auto;
        }

        .detail strong {
            margin-left: 20px
        }

        .tabledetail {
            width: 100%;
            border: 2px solid black;
            border-collapse: collapse;
        }

        .tabledetail td {
            border: 2px solid black;
            padding: 8px;
            text-align: center;
        }

        .td {
            text-align: right;
            padding-right: 10px;
        }

        footer {
            width: 80%;
            margin: 40px auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <table class="header">
            <tr>
                <td class="header1"><img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents($image)) }}"
                        alt="" width="100px"></td>
                <td class="header2"><b>SOCIETE AFRICAINE D'ETUDE ET DE COURTAGE SARL</b></td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td width="30%">&nbsp;</td>
                <td width="40%">
                    <div
                        style="padding:10px; background-color: rgb(18, 18, 102); color: white; text-align:center; border-radius:50%">
                        <b>SYNTHESE
                            DES
                            OFFRES</b>
                    </div>
                </td>
                <td width="30%">&nbsp;</td>
            </tr>
        </table>
        {{-- <table class="table">
            <tr>
                <td width="25%">DATE / HOUR <br> {{ $infoTransfert->created_at }}</td>
                <td width="50%">CONCEPT <br> Money transfer</td>
                <td width="25%">OPERATION CURRENCY <br> {{ $devise }}</td>
            </tr>
        </table> --}}
        <div class="info">
            <p><b style="background-color: grey;"><u>CLIENT</u></b> :
                {{ $offre->dossieroffre->client->type == 'Personne physique' ? $offre->dossieroffre->client->user->nom . ' ' . $offre->dossieroffre->client->user->prenom : $offre->dossieroffre->client->entreprise->raisonSociale }}
            </p>
            <p><b style="background-color: grey;"><u>INFORMATIONS RECUES DU CLIENT</u></b> : </p>
            @if ($offre->dossieroffre->client->type == 'Personne physique')
                <ul>
                    <li>Téléphone : {{ $offre->dossieroffre->client->user->tel }} </li>
                    <li>Adresse : {{ $offre->dossieroffre->client->user->adresse }} </li>
                </ul>
            @else
                <ul>
                    <li>Activité : {{ $offre->dossieroffre->client->entreprise->secteur }}</li>
                    <li>Adresse : {{ $offre->dossieroffre->client->entreprise->adresse }} </li>
                </ul>
            @endif
            <p><b style="background-color: grey;"><u>PRODUIT</u></b> : {{ $offre->produit->nomProduit }}</p>
            <p><b style="background-color: grey;"><u>INFORMATIONS SUR L'APPEL D'OFFRE DU CLIENT</u></b> : </p>
            @php
                $informations = json_decode($offre->informationRequise, true);

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
                                $info['type'] == 'm2' ||
                                $info['type'] == '%')
                            {{ $info['information'] . ' ' . $info['type'] }}
                        @else
                            {{ $info['information'] }}
                        @endif
                    </li>
                @endforeach
            </ul>
            <p><b style="background-color: grey;"><u>INFORMATIONS SUR LES GARANTIES SOUHAITEES PAR LE
                        CLIENT</u></b> : </p>

            <ul>
                @foreach ($offre->details as $detail)
                    <li>{{ $detail->garantie->libelle }}
                        @php
                            $detailoffres = json_decode($detail->detailOffres, true);

                        @endphp
                        @foreach ($detailoffres as $detailoffre)
                            <p>{{ $detailoffre['nom'] }} : @if ($detailoffre['type'] == 'file')
                                @elseif ($detailoffre['type'] == 'FCFA')
                                    {{ number_format($detailoffre['information'], 0, ',', '.') . ' FCFA' }}
                                @elseif (
                                    $detailoffre['type'] == 'Kg' ||
                                        $detailoffre['type'] == 'ans' ||
                                        $detailoffre['type'] == 'mois' ||
                                        $detailoffre['type'] == 'jours' ||
                                        $detailoffre['type'] == 'Cv' ||
                                        $detailoffre['type'] == 'm2' ||
                                        $detailoffre['type'] == '%')
                                    {{ $detailoffre['information'] . ' ' . $detailoffre['type'] }}
                                @else
                                    {{ $detailoffre['information'] }}
                                @endif
                            </p>
                        @endforeach
                    </li>
                @endforeach
            </ul>
            <p><b style="background-color: grey;"><u>COMPAGNIE D'ASSURANCE CONSULTEES ET RETENUES</u></b> : </p>
            <ul>
                @foreach ($offre->dossieroffre->publications as $pub)
                    <li>{{ $pub->compagnie->nom }}</li>
                @endforeach

            </ul>

            <p><b style="background-color: grey;"><u>OFFRES FINANCIERES</u></b> : </p>
            <table class="infoplus">
                <tr>
                    <td>Compagnies</td>
                    @foreach ($offre->propositions as $propo)
                        <td><b>{{ $propo->compagnie->nom }}</b></td>
                    @endforeach
                </tr>
                <tr>
                    <td>Primes TTC/RCCE (en FCFA)</td>
                    @foreach ($offre->propositions as $proposition)
                        <td> {{ number_format($proposition->primeTotale, 0, ',', '.') . ' FCFA' }}</td>
                    @endforeach
                </tr>
            </table>
        </div>
        <div class="benef">
            <p><b style="background-color: grey;"><u>AVIS TECHNIQUES / SUGGESTIONS / RECOMMANDATIONS</u></b></p>
            <p>{{ $avis }}</p>
        </div>


    </div>
    <footer>
        <p>Agréée par arrêté N°422/MDEF/DC/SGM/DGE/DA du 23.05.06 - N°IFU 3200800566617 <br> <b>Tel/Fax : +229 21 31 42
                88 - Portable : +229 69 71 88 88 / 97 07 27 27</b> <br> <b>Email : saeco@saecobenin.com -
                www.saecobenin.com</b></p>
    </footer>
</body>

</html>
