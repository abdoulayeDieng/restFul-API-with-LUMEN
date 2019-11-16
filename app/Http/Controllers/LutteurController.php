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

        return Lutteur::create($request->all());
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
            return ['status'=>404, 'message'=>"Aucun lutteur n'a l'idenfiant ".$id];
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
            return ['status'=>404, 'message'=>"Aucun lutteur n'a l'idenfiant ".$id];
        
        $lutteur->update($request->all());
        
        return $lutteur;
    }

    // Supprimer un lutteur via son identifiant
    public function delete($id)
    {
        $lutteur = Lutteur::find($id);
        if(!$lutteur)
            return ['status'=>404, 'message'=>"Aucun lutteur n'a l'idenfiant ".$id];
        $lutteur->delete();
        return  "Le lutteur identifié par $id a été supprimé";
    }
}
