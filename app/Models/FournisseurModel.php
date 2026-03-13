<?php

namespace App\Models;

use CodeIgniter\Model;


class FournisseurModel extends Model
{
    
    protected $table      = 'fournisseurs'; 
    protected $primaryKey = 'id';

    
    protected $allowedFields = ['nom', 'email', 'telephone', 'adresse'];

 
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}