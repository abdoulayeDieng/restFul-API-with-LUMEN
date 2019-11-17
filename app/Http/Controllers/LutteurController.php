<?php

namespace App\Http\Controllers;

use App\Lutteur;
use Illuminate\Http\Request;

class LutteurController extends Controller
{
     //Création d'un lutteur
    public function create(Request $request)
    {
        $this->validate($request,[
            'pseudo'=>'required|unique:lutteurs',
            'poids'=>'required|numeric'
        ]);

        return response()->json(Lutteur::create($request->all()),201);
    }

    // Récupérer tous les lutteurs
    public function showAll()
    {
        return Lutteur::all();
    }

    // Récupérer un lutteur via son identifiant
    public function showOne($id)
    {
        $lutteur = Lutteur::find($id);
        if(!$lutteur)
            return response()->json(['message'=>"Aucun lutteur n'a l'idenfiant ".$id], 404) ;
        return $lutteur;
    }

    // Mettre à jour un lutteur via son identifiant
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'pseudo'=>'required|unique:lutteurs,pseudo,'.$id,
            'poids'=>'required|numeric'
        ]);

        $lutteur = Lutteur::find($id);
        
        if(!$lutteur)
            return response()->json(['message'=>"Aucun lutteur n'a l'idenfiant ".$id], 404) ;
        
        $lutteur->update($request->all());
        
        return $lutteur;
    }

    // Supprimer un lutteur via son identifiant
    public function delete($id)
    {
        $lutteur = Lutteur::find($id);
        if(!$lutteur)
            return response()->json(['message'=>"Aucun lutteur n'a l'idenfiant ".$id], 404) ;
        $lutteur->delete();
        return response()->json(['message'=>"Le lutteur identifié par $id a été supprimé"]) ;
    }
}
