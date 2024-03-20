<?php
namespace App;
use App\Models\Crypto;

class CryptoUtils
{
    public static function getFirstCotation($cryptoname)
    {
        // Obtention de la valeur de mise sur le marché
        $firstCotation = ord(substr($cryptoname, 0, 1)) + rand(0, 10);; // Votre implémentation de getFirstCotation() ici

        // Création d'une nouvelle instance du modèle Crypto
        $crypto = new Crypto();
        $crypto->name = $cryptoname;
        $crypto->first_cotation = $firstCotation;
        $crypto->save();

        return $firstCotation;
    }

    public static function getCotationFor($cryptoname)
    {
        // Obtention de la dernière cotation
        $lastCotation = ((rand(0, 99) > 40) ? 1 : -1) * ((rand(0, 99) > 49) ? ord(substr($cryptoname, 0, 1)) : ord(substr($cryptoname, -1))) * (rand(1, 10) * .01); // Votre implémentation de getCotationFor() ici

        // Recherche de la crypto-monnaie dans la base de données
        $crypto = Crypto::where('nom', $cryptoname)->first();

        // Mise à jour de la dernière cotation
        $crypto->last_cotation = $lastCotation;
        $crypto->save();

        return $lastCotation;
    }
}
