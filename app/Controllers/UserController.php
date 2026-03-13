<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{

    //=====afficher formulaire login========
    public function loginform()
    {
        return view('login');
    }

    // afficher la liste des utilisateurs
    public function AfficherUser()
    {
        $userModel = new UserModel();

        $data['users'] = $userModel->afficherUsers();

        return view('utilisateur', $data);
    }

    //=========afficher formulaire ajout utilisateur=======
    public function create()
    {
        return view('user/create');
    }

   public function AjoutUser()
{
    $userModel = new UserModel();

    // 1. Préparation des données
    $data = [
        'nom'      => $this->request->getPost('nom'),
        'email'    => $this->request->getPost('email'),
        // On hache le mot de passe pour la sécurité
        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'role'     => $this->request->getPost('role')
    ];

    // 2. Insertion avec test de réussite
    if ($userModel->insert($data)) {
        // Succès : Redirection avec un message vert
        return redirect()->to(site_url('utilisateur'))
                         ->with('success', 'L\'utilisateur ' . $data['nom'] . ' a été créé avec succès.');
    } else {
        // Échec : Retour au formulaire avec les erreurs
        return redirect()->back()
                         ->withInput()
                         ->with('error', 'Impossible de créer l\'utilisateur (l\'email est peut-être déjà utilisé).');
    }
}
   

//=========Modifier un utilisateur==========
   public function UpdateUser()
{
    $id = $this->request->getPost('id');

    // Vérifie si l'ID existe
    if (!$id) {
        return redirect()->back()->with('error', 'Identifiant utilisateur introuvable.');
    }

    $userModel = new UserModel();

    // 1. Préparation des données de base
    $data = [
        'nom'   => $this->request->getPost('nom'),
        'email' => $this->request->getPost('email'),
        'role'  => $this->request->getPost('role')
    ];

    // 2. Gestion intelligente du mot de passe
    $newPassword = $this->request->getPost('password');
    if (!empty($newPassword)) {
        // L'admin veut changer le mot de passe
        $data['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
    }

    // 3. Exécution de la mise à jour
    if ($userModel->update($id, $data)) {
        
        return redirect()->to(site_url('utilisateur'))
                         ->with('success', 'Le compte de ' . $data['nom'] . ' a été mis à jour.');
    } else {
        return redirect()->back()
                         ->withInput()
                         ->with('error', 'Erreur lors de la mise à jour.');
    }
}


//=======Supprimer un utilisateur===========+
    public function DeleteUser($id = null)
{
    // 1. Vérifier si l'ID est présent
    if ($id == null) {
        return redirect()->back()->with('error', 'Utilisateur introuvable.');
    }

    $userModel = new \App\Models\UserModel();

    // 2. [OPTIONNEL] Empêcher de supprimer l'admin actuellement connecté
    if (session()->get('user_id') == $id) {
        return redirect()->back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte !');
    }

    // 3. Suppression avec feedback
    if ($userModel->delete($id)) {
        return redirect()->to(site_url('utilisateur'))
                         ->with('success', 'Utilisateur supprimé avec succès.');
    } else {
        return redirect()->back()->with('error', 'Impossible de supprimer cet utilisateur.');
    }
}



    //========login utilisateur==============
    public function login()
    {
        $userModel = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {

            session()->set([
                'id' => $user['id'],
                'nom' => $user['nom'],
                'email' => $user['email'],
                'role' => $user['role'],
                'isLogged' => true
            ]);

            return redirect()->to(site_url('index'));

        } else {

            return redirect()->back()->with('errorMessage', 'Email ou mot de passe incorrect');
        }
    }

    // logout
    public function logout()
    {
        session()->destroy();

        return redirect()->to(site_url('login'));
    }

}