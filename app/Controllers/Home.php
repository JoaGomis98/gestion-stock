<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProduitModel; 
// use App\Models\MouvementModel;

class Home extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $produitModel = new ProduitModel();

        $data = [
            // On récupère les vrais chiffres
            'totalUsers' => $userModel->countAllResults(),
            
           
            'totalProduits' => $produitModel->countAllResults(),
            'alertesStock'  => $produitModel->where('quantite <= stock_min')->countAllResults(),
            
            
            'entreesJour'   => 48
        ];

        return view('index', $data);
    }
}