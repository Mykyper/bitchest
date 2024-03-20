<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Userss;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'mail' => 'required|email|unique:users',
            'pseudo' => 'required',
        ]);

        // Générer un mot de passe aléatoire
        $randomPassword = Str::random(10);
        $hashedPassword = Hash::make($randomPassword);
        // Créer un portefeuille pour l'utilisateur
        $wallet = new Wallet();
        $wallet->somme = 500; // Initialisez la somme du portefeuille
        $wallet->save();

        // Créer un nouvel utilisateur
        $user = new Userss();
        $user->nom = $request->input('name');
        $user->prénom = $request->input('surname');
        $user->pseudo = $request->input('pseudo');
        $user->mail = $request->input('mail');
        $user->password = $hashedPassword;
        $user->portefeuille_id = $wallet->id;
        $user->save();

        // Retourner à la vue avec le mot de passe généré aléatoirement
        return view('create')->with('password', $randomPassword);
    }


    public function listUsers()
    {
        $users = Userss::all();
        return view('users', compact('users'));
    }
    public function showUpdateForm($id)
    {
        $user = Userss::findOrFail($id);
        return view('modify_user', compact('user'));
    }
    public function update(Request $request, $id) 
{
    // Valider les données du formulaire
    $request->validate([
        'name' => 'required',
        'surname' => 'required',
        'mail' => 'required|email',
    ]);

    // Récupérer l'utilisateur actuellement authentifié
    $user = Userss::findOrFail($id);

    // Mettre à jour les données de l'utilisateur
    $user->update([
        'nom' => $request->input('name'),
        'prénom' => $request->input('surname'),
        'mail' => $request->input('mail'),
        
    ]);

    // Rediriger l'utilisateur vers une autre page après la mise à jour
    return back();
}
    public function showDeleteConfirmation($userId)
    {
        $user = Userss::findOrFail($userId);
        return view('delete', ['user' => $user]);
    }

    public function deleteUser(Request $request, $id)
    {
        // Supprimer l'utilisateur
        $user = Userss::findOrFail($id);
        $user->delete();

        // Rediriger vers une autre page après la suppression
        return redirect()->route('list_users')->with('success', 'Utilisateur supprimé avec succès.');
    }
    public function traiterConnexion(Request $request)
{
    // Valider les données du formulaire
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Vérifier les informations d'identification de l'utilisateur
    $user = Userss::where('mail', $request->email)
        ->where('password', $request->password)
        ->first();

    if ($user) {
        // Stocker l'ID de l'utilisateur dans la session
        $request->session()->put('user', $user->id);

        // Rediriger l'utilisateur vers une autre page si l'authentification réussit
        return redirect()->route('user_home');
    } else {
        // Rediriger l'utilisateur vers la page de connexion avec un message d'erreur si l'authentification échoue
        return back()->withErrors(['email' => 'The credentials provided are incorrect.']);
    }
}

public function index()
{
    $user = Auth::user();
    return view('wallet', compact('user'));
}

public function edit()
{
    $user = Auth::user();
    return view('modify_user2', compact('user'));
}

public function ModifierUser(Request $request, $id)
{
    // Valider les données du formulaire
    $request->validate([
        'name' => 'required',
        'surname' => 'required',
        'email' => 'required|email',
        'password' => 'nullable|min:6|confirmed',
    ]);

    // Récupérer l'utilisateur à mettre à jour
    $user = Auth::user();

    // Mettre à jour les données de l'utilisateur
    $user->nom = $request->input('name');
    $user->prénom = $request->input('surname');
    $user->mail = $request->input('email');
    if ($request->filled('password')) {
        $user->password =$request->input('password');
    }
    $user->save();

    // Rediriger l'utilisateur vers une autre page après la mise à jour
    return redirect()->route('user_home')->with('success', 'Votre profil a été mis à jour avec succès.');
}

public function approvisionner(Request $request)
{
    // Vérifiez d'abord si l'utilisateur est connecté
    if (!Auth::check()) {
        return redirect()->route('login'); // Redirigez vers la page de connexion si l'utilisateur n'est pas connecté
    }

    // Validez et récupérez la valeur à ajouter au solde
    $request->validate([
        'montant' => 'required|numeric|min:0', // Assurez-vous que le montant est numérique et positif
    ]);
    $montant = $request->montant;

    // Récupérez l'utilisateur à partir de la base de données avec son portefeuille
    $user = Auth::user()->load('wallet');

    // Mettez à jour le solde dans la base de données
    $nouvelleSomme = $user->wallet->somme + $montant;
    $user->wallet->update(['somme' => $nouvelleSomme]);

    // Redirigez l'utilisateur vers la page du tableau de bord avec un message de succès
    return view('Wallet');
}
    
}
