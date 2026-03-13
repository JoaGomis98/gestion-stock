<?php
namespace App\Controllers;

use App\Models\ProduitModel;
use App\Models\CategorieModel;
use App\Models\FournisseurModel;

class ProduitController extends BaseController
{
    // Afficher la liste des produits 
    public function AfficherProduit() {
        $produitModel = new ProduitModel();
        $categorieModel = new CategorieModel();
        $fournisseurModel = new FournisseurModel();

        $donnee = [
            'produits'     => $produitModel->getProduitsDetails(),
            'categories'   => $categorieModel->findAll(),
            'fournisseurs' => $fournisseurModel->findAll()
        ];
 
        return view('produit', $donnee);
    }
    // Afficher le formulaire d'ajout
    public function createProduit() {
        $categorieModel = new CategorieModel();
        $fournisseurModel = new FournisseurModel();

        $donnee = [
            'categories'   => $categorieModel->findAll(),
            'fournisseurs' => $fournisseurModel->findAll()
        ];

        return view('produit/create', $donnee);
    }

    // Ajouter un produit 
    public function EnregistrerProduit() {
        $produitModel = new ProduitModel();
        
        $donnee = [
            'code_produit'    => $this->request->getPost('code_produit'),
            'nom'             => $this->request->getPost('nom'),
            'categorie_id'    => $this->request->getPost('categorie_id'), 
            'fournisseur_id'  => $this->request->getPost('fournisseur_id'),
            'prix'            => $this->request->getPost('prix'),
            'quantite'        => $this->request->getPost('quantite'),
            'stock_min'       => $this->request->getPost('stock_min'), 
        ];

        if ($produitModel->insert($donnee)) {
            return redirect()->to(site_url('produit'))->with('success', 'Produit ajouté avec succès !');
        } else {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de l\'ajout.');
        }
    }

    // Modifier un produit 
    public function UpdateProduit() {
        $produitModel = new ProduitModel();
        $id = $this->request->getPost('id');

        // 1. Vérifier si l'ID est présent
        if (!$id) {
            return redirect()->to(site_url('produit'))->with('error', 'Identifiant produit introuvable');
        }

        // 2. Préparation des données
        $donnee = [
            'code_produit'    => $this->request->getPost('code_produit'),
            'nom'             => $this->request->getPost('nom'),
            'categorie_id'    => $this->request->getPost('categorie_id'),  
            'fournisseur_id'  => $this->request->getPost('fournisseur_id'),
            'prix'            => $this->request->getPost('prix'),
            'quantite'        => $this->request->getPost('quantite'),
            'stock_min'       => $this->request->getPost('stock_min'),  
        ];

        // 3. Exécution de la mise à jour
        if ($produitModel->update($id, $donnee)) {
            return redirect()->to(site_url('produit'))->with('success', 'Le produit ' . $donnee['nom'] . ' a été mis à jour');
        } else {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de la mise à jour');
        }
    }
}