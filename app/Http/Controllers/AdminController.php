<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\Userss;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function traiterConnexion(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Vérifier les informations d'identification de l'administrateur
        $admin = Admin::where('mail', $request->email)
                      ->where('password', $request->password)
                      ->first();
    
        // Vérifier les informations d'identification de l'utilisateur
        $user = Userss::where('mail', $request->email)
                      ->where('password', $request->password)
                      ->first();
    
        if ($admin) {
            // Stocker l'identifiant de l'utilisateur dans la session
            $request->session()->put('admin', $admin);
    
            // Rediriger l'administrateur vers une autre page si l'authentification réussit
            return redirect()->route('list_users');
        } elseif ($user) {
            // Stocker l'identifiant de l'utilisateur dans la session
            $request->session()->put('user', $user);
    
            // Rediriger l'utilisateur vers une autre page si l'authentification réussit
            return redirect()->route('cryptos.user');
        } else {
            // Rediriger l'utilisateur vers la page de connexion avec un message d'erreur si l'authentification échoue
            return back()->withErrors(['email' => 'The credentials provided are incorrect.']);
        }
    }
    
   
    
    public function modifierAdmin(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required',
            'pseudo' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Récupérer l'administrateur authentifié
        $admin = Auth::guard('admin')->user();
    
        if ($admin) {
            // Mettre à jour les informations de l'administrateur
            $hashedPassword = Hash::make($request->input('password'));
            $admin->update([
                'nom' => $request->input('name'),
                'pseudo' => $request->input('pseudo'),
                'prenom' => $request->input('surname'),
                'mail' => $request->input('email'),
                'password' => $hashedPassword,
            ]);
    
            // Rediriger l'administrateur vers une autre page après la modification
            return redirect()->route('list_users');
        } else {
            // L'administrateur n'est pas authentifié
            return back()->withErrors(['email' => 'Administrateur non authentifié.']);
        }
    }
    
}