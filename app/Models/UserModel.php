<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom', 'email', 'password', 'role'];

    // Active les timestamps automatiques
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Active soft delete
    protected $useSoftDeletes = true;

    //fonction pour afficher la liste de tous les utlisateurs
    public function afficherUsers()
    {
        return $this->findAll();
    }

    //Filtrer un utilisateur par son email
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}