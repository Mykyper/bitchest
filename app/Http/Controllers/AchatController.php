<?php
namespace App\Http\Controllers;
use App\Models\CryptoAchat;
use App\Models\Crypto;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Userss;
class AchatController extends Controller
{
    public function create()
    {
         // Récupérer toutes les cryptos disponibles
    $cryptos = Crypto::all();

    // Passer les cryptos à la vue
    return view('achat', ['cryptos' => $cryptos]);
    }
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'crypto_id' => 'required|exists:cryptos,id',
            'quantite' => 'required|integer|min:1',
        ]);
    
        // Récupérer l'utilisateur actuellement authentifié
        $user = Auth::user();
    
        // Charger le portefeuille de l'utilisateur
        $user->load('wallet');
    
        // Vérifier si l'utilisateur a un portefeuille
        if ($user->wallet) {
            // Récupérer la crypto-monnaie et calculer le coût total de l'achat
            $crypto = Crypto::find($request->crypto_id);
            $cout_total = $crypto->first_cotation * $request->quantite;
    
            // Vérifier si la somme dans le portefeuille est suffisante
            if ($user->wallet->somme >= $cout_total) {
                // Créer une nouvelle instance de CryptoAchat et enregistrer dans la base de données
                CryptoAchat::create([
                    'portefeuille_id' => $user->wallet->id,
                    'crypto_id' => $request->crypto_id,
                    'quantite' => $request->quantite,
                ]);
    
                // Mettre à jour le solde du portefeuille
                $user->wallet->somme -= $cout_total;
                $user->wallet->save();
    
                // Mettre à jour l'utilisateur dans la session
                Auth::setUser($user);
    
                // Rediriger l'utilisateur après l'achat
                return redirect()->route('user_wallet')->with('success', 'Crypto achetée avec succès!');
            } else {
                // Rediriger avec un message d'erreur si le solde est insuffisant
                return redirect()->back()->with('error', 'Solde insuffisant pour effectuer l\'achat.');
            }
        } else {
            // Rediriger avec un message d'erreur si l'utilisateur n'a pas de portefeuille
            return redirect()->back()->with('error', 'Vous n\'avez pas de portefeuille associé. Veuillez contacter le support.');
        }
    }
}


