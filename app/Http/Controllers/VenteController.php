<?php

namespace App\Http\Controllers;
use App\Models\Vente;
use App\Models\CryptoAchat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VenteController extends Controller
{
    public function showForm()
    {
        // Récupérer l'utilisateur et ses achats de la session
        $user = Session::get('user');
        $achats = Session::get('achats');
    
        // Vérifier si $achats est null, sinon remplacer par un tableau vide
        if ($achats === null) {
            $achats = [];
        }
    
        // Retourner la vue du formulaire avec les données
        return view('ventes', compact('user', 'achats'));
    }
    
    public function vendreCrypto(Request $request)
{
    // Récupérer l'utilisateur à partir de la session
    $user = Session::get('user');
 // Récupérer le portefeuille associé à l'utilisateur
    $portefeuille = $user->wallet;

    // Récupérer les achats effectués par ce portefeuille
    $achats = CryptoAchat::where('portefeuille_id', $portefeuille->id)
        ->where('id', $request->crypto_achat_id)
        ->get();
    // Valider les données de la requête
    $request->validate([
        'crypto_achat_id' => 'required|exists:crypto_achats,id',
    ]);

   

    // Vérifier si l'achat existe
    if ($achats->isEmpty()) {
        return redirect()->back()->with('error', 'Aucun achat trouvé pour ce portefeuille.');
    }

    // Récupérer l'achat de crypto-monnaie à vendre
    $cryptoAchat = $achats->first();

    // Calculer la valeur de la vente (par exemple, valeur initiale + gain)
    $valeurVente = $cryptoAchat->valeur_plus_gain;

    // Créer une nouvelle vente
    $vente = new Vente();
    $vente->crypto_achat_id = $cryptoAchat->id;
    $vente->portefeuille_id = $portefeuille->id;
    $vente->valeur_vente = $valeurVente;
    $vente->save();

    // Supprimer l'achat de crypto-monnaie de la base de données
    $cryptoAchat->delete();

    // Rediriger avec un message de succès
    return redirect()->back()->with('success', 'Crypto-monnaie vendue avec succès!');
}

}
