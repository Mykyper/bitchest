<?php

namespace App\Http\Controllers;

use App\Models\Crypto;
use Illuminate\Http\Request;

class CryptoController extends Controller
{
    public function index()
    {
        // Liste des noms de crypto-monnaies à enregistrer
        $cryptos = ['Bitcoin', 'Ethereum', 'Litecoin','Ripple','Bitcoin Cash','Cardano','NEM','Stellar','IOTA','Dash'];
    
        foreach ($cryptos as $cryptoName) {
            $firstCotation = $this->getFirstCotation($cryptoName);
            $cotationForToday = $this->getCotationFor($cryptoName);
    
            // Créer une nouvelle instance de Crypto et l'ajouter à la base de données
            $crypto = new Crypto();
            $crypto->nom = $cryptoName;
            $crypto->first_cotation = $firstCotation;
            $crypto->last_cotation = $cotationForToday;
            $crypto->save();
        }
        


        // Faites quelque chose après l'insertion des cryptos dans la base de données
    }
    

    public function getFirstCotation($cryptoname)
    {
        return ord(substr($cryptoname, 0, 1)) + rand(0, 10);
    }

    public function getCotationFor($cryptoname)
    {
        $variation = ((rand(0, 99) > 40) ? 1 : -1) * ((rand(0, 99) > 49) ? ord(substr($cryptoname, 0, 1)) : ord(substr($cryptoname, -1))) * (rand(1, 10) * .01);
        return $variation;
    }
public function listCrypto()
{
    $cryptos = Crypto::all();

    return view('crypto_list', ['cryptos' => $cryptos]);
}
public function listCrypto2()
{
    $cryptos = Crypto::all();

    return view('user_home', ['cryptos' => $cryptos]);
}
}
