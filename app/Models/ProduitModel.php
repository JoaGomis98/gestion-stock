<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Models\FournisseurModel;
use App\Models\CategorieModel;
use App\Models\ProduitModel;

class ProduitModel extends Model
{
    protected $table = "produits";
    protected $primaryKey = "id";

    protected $allowedFields = [
        'code_produit',
        'nom',
        'categorie_id',
        'fournisseur_id',
        'prix',
        'quantite',
        'stock_min'
    ];

    // Active les timestamps automatiques
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Active soft delete
    protected $useSoftDeletes = true;


    //Recuperer les produits avec le nom de leur categorie (produits + nom de la categorie)
    
    public function getProduitsDetails()
{
    return $this->select('produits.*, categories.nom as cat_nom, fournisseurs.nom as fourn_nom')
                ->join('categories', 'categories.id = produits.categorie_id', 'left') 
                ->join('fournisseurs', 'fournisseurs.id = produits.fournisseur_id', 'left')
                ->where('produits.deleted_at', null) // Pour ne pas voir les produits supprimés (soft delete)
                ->findAll();
}

}