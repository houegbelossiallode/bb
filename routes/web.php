<?php

use App\Http\Controllers\AgenceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompagnieController;
use App\Http\Controllers\ComparatifController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\FormulaireController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\PropositionController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\RenseignementController;
use App\Http\Controllers\ReseauController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

// Route::get('/', function () {
//     return redirect()->route('home');
// });





Route::middleware('auth')->group(function () {

    //Route Entreprise
    Route::get('/entreprise/new', [EntrepriseController::class, 'newentreprise'])->name('entreprise.new');
    Route::post('/entreprise/add', [EntrepriseController::class, 'handlenewentreprise'])->name('entreprise.add');
    Route::get('/entreprise/liste', [EntrepriseController::class, 'listeentreprise'])->name('entreprise.liste');
    Route::get('/entreprise/edit/{id}', [EntrepriseController::class, 'editentreprise'])->name('entreprise.edit');
    Route::get('/entreprise/delete/{id}', [EntrepriseController::class, 'deleteentreprise'])->name('entreprise.delete');
    Route::post('/entreprise/update/{id}', [EntrepriseController::class, 'handleupdateentreprise'])->name('entreprise.update');

    //Route User
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('/users/new', [UsersController::class, 'newusers'])->name('users.new');
    Route::post('/users/add', [UsersController::class, 'handlenewusers'])->name('users.add');
    Route::get('/users/liste', [UsersController::class, 'listeusers'])->name('users.liste');
    Route::get('/users/client/liste', [UsersController::class, 'listeclients'])->name('users.client.liste');
    Route::get('/users/client/new', [UsersController::class, 'newclients'])->name('users.client.new');
    Route::get('/users/edit/{id}/{role}', [UsersController::class, 'updateusers'])->name('users.edit');
    Route::get('/users/delete/{id}/{role}', [UsersController::class, 'deleteusers'])->name('users.delete');
    Route::post('/users/update/{id}/{role}', [UsersController::class, 'handleupdate'])->name('handleupdate');

    //Route reseau
    Route::get('/reseau/statut', [ReseauController::class, "statut"])->name('reseau.statut');
    Route::get('/reseau/statut/new', [ReseauController::class, "newstatut"])->name('statut.new');
    Route::get('/reseau/statut/delete/{id}', [ReseauController::class, "deletestatut"])->name('statut.delete');
    Route::get('/reseau/hierachie/new/{id}', [ReseauController::class, "newhierachie"])->name('hierachie.new');
    Route::post('/reseau/hierachie/add/{id}', [ReseauController::class, "addhierachie"])->name('hierachie.add');
    Route::get('/reseau/hierachie/liste/{id?}', [ReseauController::class, "listehierachie"])->name('hierachie.liste');

    //Route objectif
    Route::get('/reseau/objectif/new', [ReseauController::class, "newobjectif"])->name('objectif.new');
    Route::post('/reseau/objectif/add', [ReseauController::class, "addobjectif"])->name('objectif.add');
    Route::get('/reseau/objectif/edit/{id}', [ReseauController::class, "editobjectif"])->name('objectif.edit');
    Route::post('/reseau/objectif/update/{id}', [ReseauController::class, "updateobjectif"])->name('objectif.update');
    Route::get('/reseau/objectif/liste', [ReseauController::class, "listeobjectif"])->name('objectif.liste');
    Route::get('/reseau/objectif/pub/{id}', [ReseauController::class, "pubobjectif"])->name('objectif.pub');
    Route::get('/reseau/objectif/delete/{id}', [ReseauController::class, "deleteobjectif"])->name('objectif.delete');

    //Route realisation
    Route::get('export-objectif/{id}', [ReseauController::class, 'exportExcel'])->name('table.realisation');

    Route::get('/reseau/realisation/new/{id}', [ReseauController::class, "newrealisation"])->name('realisation.new');
    Route::post('/reseau/realisation/add/{id}', [ReseauController::class, "addrealisation"])->name('realisation.add');
    Route::get('/reseau/realisation/edit/{idrealisation}/{idobjectif}', [ReseauController::class, "editrealisation"])->name('realisation.edit');
    Route::post('/reseau/realisation/update/{idrealisation}/{idobjectif}', [ReseauController::class, "updaterealisation"])->name('realisation.update');
    Route::get('/reseau/realisation/liste/{id}', [ReseauController::class, "listerealisation"])->name('realisation.liste');
    Route::get('/reseau/realisation/delete/{idrealisation}/{idobjectif}', [ReseauController::class, "deleterealisation"])->name('realisation.delete');



    //Route information client
    Route::get('/info/liste', [NotificationController::class, 'info'])->name('info');
    Route::get('/users/client/info/liste/{id}', [UsersController::class, 'listeinfo'])->name('info.liste');
    Route::get('/users/client/info/new/{id}', [UsersController::class, 'newinfo'])->name('info.new');
    Route::post('/users/client/info/add/{id}', [UsersController::class, 'addinfo'])->name('info.add');
    Route::get('/users/client/info/edit/{idinfo}/{idclient}', [UsersController::class, 'editinfo'])->name('info.edit');
    Route::post('/users/client/info/update/{idinfo}/{idclient}', [UsersController::class, 'updateinfo'])->name('info.update');
    Route::get('/users/client/info/delete/{idinfo}/{idclient}', [UsersController::class, 'deleteinfo'])->name('info.delete');

    //Route compagnie
    Route::get('/compagnie/new', [CompagnieController::class, 'newcompagnie'])->name('compagnie.new');
    Route::post('/compagnie/add', [CompagnieController::class, 'handlenewcompagnie'])->name('compagnie.add');
    Route::get('/compagnie/liste', [CompagnieController::class, 'listecompagnie'])->name('compagnie.liste');
    Route::get('/compagnie/edit/{id}', [CompagnieController::class, 'editcompagnie'])->name('compagnie.edit');
    Route::get('/compagnie/delete/{id}', [CompagnieController::class, 'deletecompagnie'])->name('compagnie.delete');
    Route::post('/compagnie/update/{id}', [CompagnieController::class, 'handleupdatecompagnie'])->name('compagnie.update');

    //Route agence

    Route::get('/agence/new', [AgenceController::class, 'newagence'])->name('agence.new');
    Route::post('/agence/add', [AgenceController::class, 'handlenewagence'])->name('agence.add');
    Route::get('/agence/liste', [AgenceController::class, 'listeagence'])->name('agence.liste');
    Route::get('/agence/edit/{id}', [AgenceController::class, 'editagence'])->name('agence.edit');
    Route::get('/agence/delete/{id}', [AgenceController::class, 'deleteagence'])->name('agence.delete');
    Route::post('/agence/update/{id}', [AgenceController::class, 'handleupdateagence'])->name('agence.update');

    //Route Branche
    Route::get('/branche/new', [ProduitController::class, 'newbranche'])->name('branche.new');
    Route::post('/branche/add', [ProduitController::class, 'addbranche'])->name('branche.add');
    Route::get('/branche/edit/{id}', [ProduitController::class, 'editbranche'])->name('branche.edit');
    Route::post('/branche/update/{id}', [ProduitController::class, 'updatebranche'])->name('branche.update');
    Route::get('/branche/delete/{id}', [ProduitController::class, 'deletebranche'])->name('branche.delete');

    //Route type produit
    Route::get('/typeproduit/new', [ProduitController::class, 'newtype'])->name('typeproduit.new');
    Route::post('/typeproduit/add', [ProduitController::class, 'addtype'])->name('typeproduit.add');
    //Route::get('/typeproduit/liste', [ProduitController::class, 'listetype'])->name('typeproduit.liste');
    Route::get('/typeproduit/edit/{id}', [ProduitController::class, 'edittype'])->name('typeproduit.edit');
    Route::post('/typeproduit/update/{id}', [ProduitController::class, 'updatetype'])->name('typeproduit.update');
    Route::get('/typeproduit/delete/{id}', [ProduitController::class, 'deletetype'])->name('typeproduit.delete');

    //Route produit
    Route::get('/produit/new', [ProduitController::class, 'newproduit'])->name('produit.new');
    Route::post('/produit/add', [ProduitController::class, 'addproduit'])->name('produit.add');
    Route::get('/produit/liste', [ProduitController::class, 'listeproduit'])->name('produit.liste');
    Route::get('/produit/edit/{id}', [ProduitController::class, 'editproduit'])->name('produit.edit');
    Route::post('/produit/update/{id}', [ProduitController::class, 'updateproduit'])->name('produit.update');
    Route::get('/produit/delete/{id}', [ProduitController::class, 'deleteproduit'])->name('produit.delete');

    //Route formulaire
    Route::get('/formulaire/new/{table}/{idTable}', [FormulaireController::class, 'newformulaire'])->name('formulaire.new');
    Route::post('/formulaire/add/{table}/{idTable}', [FormulaireController::class, 'addformulaire'])->name('formulaire.add');
    Route::get('/formulaire/liste/{table}/{idTable}', [FormulaireController::class, 'listeformulaire'])->name('formulaire.liste');
    Route::get('/formulaire/edit/{idformulaire}/{table}/{idTable}', [FormulaireController::class, 'editformulaire'])->name('formulaire.edit');
    Route::post('/formulaire/update/{idformulaire}/{table}/{idTable}', [FormulaireController::class, 'updateformulaire'])->name('formulaire.update');
    Route::get('/formulaire/delete/{idformulaire}/{table}/{idTable}', [FormulaireController::class, 'deleteformulaire'])->name('formulaire.delete');

    //Route garantie
    Route::get('/garantie/liste/{id}', [ProduitController::class, 'listegarantie'])->name('garantie.liste');
    Route::get('/garantie/new/{id}', [ProduitController::class, 'newgarantie'])->name('garantie.new');
    Route::post('/garantie/add/{id}', [ProduitController::class, 'addgarantie'])->name('garantie.add');
    Route::get('/garantie/edit/{idgarantie}/{idproduit}', [ProduitController::class, 'editgarantie'])->name('garantie.edit');
    Route::post('/garantie/update/{idgarantie}/{idproduit}', [ProduitController::class, 'updategarantie'])->name('garantie.update');
    Route::get('/garantie/delete/{idgarantie}/{idproduit}', [ProduitController::class, 'deletegarantie'])->name('garantie.delete');

    //Route offre
    Route::get('/offre/new/{table}/{idtable}', [OffreController::class, 'newoffre'])->name('offre.new');
    Route::post('/offre/add/{table}/{idtable}', [OffreController::class, 'addoffre'])->name('offre.add');
    Route::get('/offre/liste/{id}', [OffreController::class, 'listeoffre'])->name('offre.liste');
    Route::get('/offre/dossier/{id?}', [OffreController::class, 'dossieroffre'])->name('offre.dossier');
    Route::get('/offre/edit/{iddossier}/{idoffre}', [OffreController::class, 'editoffre'])->name('offre.edit');
    Route::post('/offre/update/{iddossier}/{idoffre}', [OffreController::class, 'updateoffre'])->name('offre.update');
    Route::get('/offre/delete/{iddossier}/{idoffre}', [OffreController::class, 'deleteoffre'])->name('offre.delete');

    //Route détail offre
    Route::get('/offre/detail/new/{iddossier}/{idoffre}', [OffreController::class, 'newdetail'])->name('offre.detail.new');
    Route::post('/offre/detail/add/{iddossier}/{idoffre}', [OffreController::class, 'adddetail'])->name('offre.detail.add');
    // Route::get('/offre/detail/liste/{id}', [OffreController::class, 'listedetail'])->name('offre.detail.liste');
    Route::get('/offre/detail/edit/{iddossier}/{iddetail}', [OffreController::class, 'editdetail'])->name('offre.detail.edit');
    Route::post('/offre/detail/update/{iddossier}/{iddetail}', [OffreController::class, 'updatedetail'])->name('offre.detail.update');
    Route::get('/offre/detail/delete/{iddossier}/{iddetail}', [OffreController::class, 'deletedetail'])->name('offre.detail.delete');

    //Route détail offre
    Route::get('/offre/publication/new/{id}', [PublicationController::class, 'newpublication'])->name('publication.new');
    Route::post('/offre/publication/add/{id}', [PublicationController::class, 'addpublication'])->name('publication.add');
    Route::get('/offre/publication/liste/{id}', [PublicationController::class, 'listepublication'])->name('publication.liste');
    Route::get('/offre/publication/relance/{idpublication}/{iddossier}', [PublicationController::class, 'relancepublication'])->name('publication.relance');
    Route::get('/offre/publication/delete/{idpublication}/{iddossier}', [PublicationController::class, 'deletepublication'])->name('publication.delete');

    //Route Comparatif

    Route::get('/proposition/comparatif/{id}', [ComparatifController::class, 'comparatif'])->name('comparatif');
    Route::post('/proposition/synthese/{id}', [ComparatifController::class, 'synthese'])->name('synthese');
    Route::post('/proposition/validation/{type}/{id}', [ComparatifController::class, 'validation'])->name('validation');
    Route::get('/contrat', [ComparatifController::class, 'listecontrat'])->name('liste.contrat');
    Route::get('/contrat/{id}', [ComparatifController::class, 'contrat'])->name('contrat');

    //Route proposition
    Route::get('/proposition/new/{id}', [PropositionController::class, 'newproposition'])->name('proposition.new');
    Route::post('/proposition/add/{id}', [PropositionController::class, 'addproposition'])->name('proposition.add');
    Route::get('/proposition/liste/{id?}', [PropositionController::class, 'listeproposition'])->name('proposition.liste');
    Route::get('/proposition/liste/unique/{id}', [PropositionController::class, 'listeuniqueproposition'])->name('proposition.unique');
    //Route::get('/proposition/liste/{id}', [PropositionController::class, 'listepropositionByOffre'])->name('proposition.liste.offre');
    Route::get('/proposition/edit/{id}}', [PropositionController::class, 'editproposition'])->name('proposition.edit');
    Route::post('/proposition/update/{id}}', [PropositionController::class, 'updateproposition'])->name('proposition.update');
    Route::get('/proposition/delete/{id}}', [PropositionController::class, 'deleteproposition'])->name('proposition.delete');

    //Route détail proposition
    Route::get('/proposition/detail/new/{id}', [PropositionController::class, 'newdetail'])->name('proposition.detail.new');
    Route::post('/proposition/detail/add/{id}', [PropositionController::class, 'adddetail'])->name('proposition.detail.add');
    // Route::get('/proposition/detail/liste/{id}', [PropositionController::class, 'listedetail'])->name('proposition.detail.liste');
    Route::get('/proposition/detail/edit/{iddetail}', [PropositionController::class, 'editdetail'])->name('proposition.detail.edit');
    Route::post('/proposition/detail/update/{iddetail}', [PropositionController::class, 'updatedetail'])->name('proposition.detail.update');
    Route::get('/proposition/detail/delete/{iddetail}', [PropositionController::class, 'deletedetail'])->name('proposition.detail.delete');


    //Route formulaire offre
    Route::get('information/{id}', [OffreController::class, 'formulaire']);

    //Production

    Route::get('/condition/new/{id}', [ConditionController::class, 'newcondition'])->name('condition.new');
    Route::post('/condition/add/{id}', [ConditionController::class, 'addcondition'])->name('condition.add');
    Route::get('/condition/liste/{id}', [ConditionController::class, 'listecondition'])->name('condition.liste');
    Route::get('/condition/edit/{idproduit}/{idcondition}', [ConditionController::class, 'editcondition'])->name('condition.edit');
    Route::post('/condition/update/{idproduit}/{idcondition}', [ConditionController::class, 'updatecondition'])->name('condition.update');
    Route::get('/condition/delete/{idproduit}/{idcondition}', [ConditionController::class, 'deletecondition'])->name('condition.delete');

    Route::get('/condition/hierachie/new/{id}', [ConditionController::class, "newhierachie"])->name('condition.hierachie.new');
    Route::post('/condition/hierachie/add/{id}', [ConditionController::class, "addhierachie"])->name('condition.hierachie.add');
    Route::get('/condition/hierachie/liste/{id?}', [ConditionController::class, "listehierachie"])->name('condition.hierachie.liste');

    Route::get('/condition/valeur/new/{id}', [ConditionController::class, 'newvaleur'])->name('valeur.new');
    Route::post('/condition/valeur/add/{id}', [ConditionController::class, 'addvaleur'])->name('valeur.add');
    Route::get('/condition/valeur/liste/{id}', [ConditionController::class, 'listevaleur'])->name('valeur.liste');
    Route::get('/condition/valeur/edit/{idcondition}/{idvaleur}', [ConditionController::class, 'editvaleur'])->name('valeur.edit');
    Route::post('/condition/valeur/update/{idcondition}/{idvaleur}', [ConditionController::class, 'updatevaleur'])->name('valeur.update');
    Route::get('/condition/valeur/delete/{idcondition}/{idvaleur}', [ConditionController::class, 'deletevaleur'])->name('valeur.delete');

    Route::get('/condition/groupe/new/{id}', [ConditionController::class, 'newgroupe'])->name('groupe.new');
    Route::post('/condition/groupe/add/{id}', [ConditionController::class, 'addgroupe'])->name('groupe.add');
    Route::get('/condition/groupe/liste/{id}', [ConditionController::class, 'listegroupe'])->name('groupe.liste');
    Route::get('/condition/groupe/edit/{idproduit}/{idgroupe}', [ConditionController::class, 'editgroupe'])->name('groupe.edit');
    Route::post('/condition/groupe/update/{idproduit}/{idgroupe}', [ConditionController::class, 'updategroupe'])->name('groupe.update');
    Route::get('/condition/groupe/delete/{idproduit}/{idgroupe}', [ConditionController::class, 'deletegroupe'])->name('groupe.delete');


    Route::get('export-grille/{id}', [ConditionController::class, 'exportExcel'])->name('grille.tarification');


    Route::get('/condition/tarif/new/{id}', [ConditionController::class, 'newtarif'])->name('tarif.new');
    Route::post('/condition/tarif/add/{id}', [ConditionController::class, 'addtarif'])->name('tarif.add');
    Route::get('/condition/tarif/liste/{id}', [ConditionController::class, 'listetarif'])->name('tarif.liste');
    Route::get('/condition/tarif/edit/{idproduit}/{idtarif}', [ConditionController::class, 'edittarif'])->name('tarif.edit');
    Route::post('/condition/tarif/update/{idproduit}/{idtarif}', [ConditionController::class, 'updatetarif'])->name('tarif.update');
    Route::get('/condition/tarif/delete/{idproduit}/{idtarif}', [ConditionController::class, 'deletetarif'])->name('tarif.delete');


    //Route renseignement garantie

    Route::get('renseignement/grille/{id}', [RenseignementController::class, 'exportExcel'])->name('renseignement.grille');


    Route::get('/garantie/renseignement/new/{id}', [RenseignementController::class, 'newrenseignement'])->name('renseignement.new');
    Route::post('/garantie/renseignement/add/{id}', [RenseignementController::class, 'addrenseignement'])->name('renseignement.add');
    Route::get('/garantie/renseignement/liste/{id}', [RenseignementController::class, 'listerenseignement'])->name('renseignement.liste');
    Route::get('/garantie/renseignement/edit/{idproduit}/{idrenseignement}', [RenseignementController::class, 'editrenseignement'])->name('renseignement.edit');
    Route::post('/garantie/renseignement/update/{idproduit}/{idrenseignement}', [RenseignementController::class, 'updaterenseignement'])->name('renseignement.update');
    Route::get('/garantie/renseignement/delete/{idproduit}/{idrenseignement}', [RenseignementController::class, 'deleterenseignement'])->name('renseignement.delete');

    //  Route production
    Route::get('/simulation/new/{id}', [ProductionController::class, 'newproduction'])->name('production.new');
    Route::get('/production/new/{id?}', [ProductionController::class, 'production'])->name('production');
    Route::post('/production/add/{id}', [ProductionController::class, 'addproduction'])->name('production.add');
    Route::get('/production/liste', [ProductionController::class, 'listeproduction'])->name('production.liste');
    Route::get('/production/liste/{id}', [ProductionController::class, 'uniqueproduction'])->name('production.unique');
    Route::get('/production/edit/{id}', [ProductionController::class, 'editproduction'])->name('production.edit');
    Route::post('/production/update/{id}', [ProductionController::class, 'updateproduction'])->name('production.update');
    Route::get('/production/delete/{id}', [ProductionController::class, 'deleteproduction'])->name('production.delete');
    Route::post('/simulation', [ProductionController::class, 'getGroup'])->name('group.get');
    Route::post('/tarif', [ProductionController::class, 'getTarif'])->name('tarif.get');
    Route::get('/tarif/{idgroupe}/{idcompagnie}', [ProductionController::class, 'getSingleTarif'])->name('tarif.single');


    Route::get('/notifications/read/{id}' , [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

    //Route Rendez-vous
    Route::middleware('auth')->prefix('rds')->group(function() {
    Route::get('/',[RendezVousController::class,'index'])->name('rds.index');
    Route::get('/create', [RendezVousController::class, 'create'])->name('rds.create');
    Route::post('/store', [RendezVousController::class, 'store'])->name('rds.store');
    Route::get('/edit/{rd}',[RendezVousController::class, 'edit'])->name('rds.edit');
    Route::post('/update/{rd}',[RendezVousController::class, 'update'])->name('rds.update');
    Route::get('/delete/{rd}',[RendezVousController::class, 'delete'])->name('rds.delete');
    Route::get('/show/{id}',[RendezVousController::class, 'show'])->name('rds.show');
});




    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
});
