<?php

namespace App\Http\Controllers;

use App\Lutteur;
use Illuminate\Http\Request;

class LutteurController extends Controller
{
    protected $lutteur;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Lutteur $lutteur)
    {
        // Injection du modèle Lutteur
        $this->lutteur = $lutteur;
    }

    //Création d'un lutteur
    public function create(Request $request)
    {
        $this->validate($request,[
            'pseudo'=>'required|unique:lutteurs',
            'poids'=>'required|numeric'
        ]);

        $lutteur = $this->lutteur->create([
            'pseudo'=>$request->input('pseudo'),
            'poids'=>$request->input('poids')
        ]);

        return $lutteur;
    }

    // Récupérer tous les lutteurs
    public function showAll()
    {
        return $this->lutteur->all();
    }

    // Récupérer un lutteur via son identifiant
    public function showOne($id)
    {
        $lutteur = $this->lutteur->find($id);
        if(!$lutteur)
            return ['status'=>404, 'message'=>"Aucun lutteur n'a l'idenfiant ".$id];
        return $lutteur;
    }

    // Mettre à jour un lutteur via son identifiant
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'pseudo'=>'required|unique:lutteurs',
            'poids'=>'required|numeric'
        ]);

        $lutteur = $this->lutteur->find($id);
        
        if(!$lutteur)
            return ['status'=>404, 'message'=>"Aucun lutteur n'a l'idenfiant ".$id];
        
        $lutteur->update([
            'pseudo'=>$request->input('pseudo'),
            'poids'=>$request->input('poids')
        ]);
        
        return $lutteur;
    }

    // Supprimer un lutteur via son identifiant
    public function delete($id)
    {
        $lutteur = $this->lutteur->find($id);
        if(!$lutteur)
            return ['status'=>404, 'message'=>"Aucun lutteur n'a l'idenfiant ".$id];
        $lutteur->delete();
        return  "Le lutteur identifié par $id a été supprimé";
    }
}
