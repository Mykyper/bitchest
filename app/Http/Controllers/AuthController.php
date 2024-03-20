<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Userss;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function connexion(Request $request)
{
    // Valider les données du formulaire
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Authentifier l'utilisateur en vérifiant une table spécifique (ici, la table des administrateurs)
    $admin = Admin::where('mail', $credentials['email'])->first();

    // Vérifier si un administrateur avec cet e-mail existe
    if ($admin) {
        // Vérifier si le mot de passe correspond
        if (Hash::check($credentials['password'], $admin->password)) {
            // Authentifier l'administrateur
            Auth::guard('admin')->login($admin);

            // Rediriger l'administrateur authentifié vers une nouvelle page (par exemple, le tableau de bord)
            return redirect()->route('list_users');
        }
    }
    // Recherche de l'utilisateur dans la table spécifique (par exemple, la table des utilisateurs)
$user = Userss::where('mail', $credentials['email'])->first();
// Vérifier si un utilisateur avec cet e-mail existe
if ($user) {
    // Vérifier si le mot de passe correspond
    if (Hash::check($credentials['password'], $user->password)) {
        // Authentifier l'utilisateur
        Auth::guard('web')->login($user);

        // Rediriger l'utilisateur authentifié vers une nouvelle page
        return view('/Wallet');
    }
}

    // Retourner à la page de connexion avec un message d'erreur
    return redirect()->back()->with('error', 'Adresse e-mail ou mot de passe incorrect.');
}
}
