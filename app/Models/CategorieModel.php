<?php
namespace App\Models;

use CodeIgniter\Model;

class CategorieModel extends Model
{
    protected $table      = 'categories';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nom', 'description'];

    // Timestamps pour savoir quand la catégorie a été créée
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}