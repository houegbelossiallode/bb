<aside class="left-sidebar">
    <ul id="slide-out" class="sidenav">

        <li>
            <ul class="collapsible">
                <li class="small-cap"><span class="hide-menu">PERSONAL</span></li>
                <li>
                    <a href="javascript: void(0);" class="collapsible-header has-arrow"><i
                            class="material-icons">dashboard</i><span class="hide-menu"> Tableau de bord</span></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('home') }}"><i class="material-icons">adjust</i><span
                                        class="hide-menu">Tableau de bord</span></a></li>
                            <li><a href=""><i class="material-icons">adjust</i><span
                                        class="hide-menu">Comparatif</span></a></li>
                        </ul>
                    </div>
                </li>
                @if (Auth::user()->role == 'Courtier' || Auth::user()->role == 'Commercial')
                    <li>
                        <a href="javascript: void(0);" class="collapsible-header has-arrow"><i
                                class="material-icons">people</i><span class="hide-menu"> Utilisateurs
                            </span></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('users.liste') }}"><i class="material-icons">adjust</i><span
                                            class="hide-menu">Utilisateurs</span></a></li>
                                <li><a href="{{ route('compagnie.liste') }}"><i class="material-icons">adjust</i><span
                                            class="hide-menu">Compagnie</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="collapsible-header has-arrow"><i
                                class="material-icons">people</i><span class="hide-menu"> Réseau
                            </span></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('reseau.statut') }}"><i class="material-icons">adjust</i><span
                                            class="hide-menu">Statut</span></a></li>
                                @if (Auth::user()->role == 'Commercial')
                                    <li><a href="{{ route('hierachie.liste') }}"><i
                                                class="material-icons">adjust</i><span class="hide-menu">Mon
                                                réseau</span></a></li>
                                     <li><a href="{{ route('rds.index') }}"><i
                                                    class="material-icons">adjust</i><span class="hide-menu">
                                         Mes Rendez-vous
                                     </span></a></li>
                                     <li><a href="{{ route('info') }}"><i
                                        class="material-icons">adjust</i><span class="hide-menu">Les informations sur mes clients
                                    </span></a></li>
                                @endif

                                @if (Auth::user()->role == 'Courtier')
                                <li><a href="{{ route('objectif.liste') }}"><i class="material-icons">adjust</i><span
                                            class="hide-menu">Mes
                                            objectifs</span></a></li>
                                @endif
                                {{-- <li><a href="{{ route('compagnie.liste') }}"><i class="material-icons">adjust</i><span
                                            class="hide-menu">Compagnie</span></a></li> --}}
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="collapsible-header has-arrow"><i
                                class="material-icons">face</i><span class="hide-menu"> Client
                            </span></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('users.client.liste') }}"><i
                                            class="material-icons">adjust</i><span class="hide-menu">Clients</span></a>
                                </li>
                                <li><a href="{{ route('entreprise.liste') }}"><i class="material-icons">adjust</i><span
                                            class="hide-menu">Entreprise</span></a></li>
                            </ul>
                        </div>
                    </li>
                @endif
                <li class="small-cap"><span class="hide-menu">Produits</span></li>
                <li>
                    <a href="javascript: void(0);" class="collapsible-header has-arrow"><i
                            class="material-icons">art_track</i><span class="hide-menu"> Produits</span></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('produit.liste') }}"><i class="material-icons">adjust</i><span
                                        class="hide-menu">Produit</span></a></li>
                        </ul>
                    </div>
                </li>

                <li class="small-cap"><span class="hide-menu">Offres</span></li>
                <li>
                    <a href="javascript: void(0);" class="collapsible-header has-arrow"><i
                            class="material-icons">assessment</i><span class="hide-menu">Offres</span></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('offre.dossier') }}"><i class="material-icons">adjust</i><span
                                        class="hide-menu">Liste des offres</span></a></li>
                        </ul>
                    </div>
                </li>

                <li class="small-cap"><span class="hide-menu">Propositions</span></li>
                <li>
                    <a href="javascript: void(0);" class="collapsible-header has-arrow"><i
                            class="material-icons">assignment_return</i><span class="hide-menu">Propositions</span></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('proposition.liste') }}"><i class="material-icons">adjust</i><span
                                        class="hide-menu">Liste des propositions</span></a></li>
                        </ul>
                    </div>
                </li>

            </ul>
        </li>
    </ul>
</aside>
