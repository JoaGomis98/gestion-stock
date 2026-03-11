<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{

    // afficher formulaire login
    public function loginform()
    {
        return view('login');
    }

    // afficher la liste des utilisateurs
    public function AfficherUser()
    {
        $userModel = new UserModel();

        $data['users'] = $userModel->afficherUsers();

        return view('gestionUtilisateur', $data);
    }

    // afficher formulaire ajout utilisateur
    public function create()
    {
        return view('createUser');
    }

    // ajouter utilisateur
    public function AjoutUser()
    {
        $userModel = new UserModel();

        $data = [
            'nom' => $this->request->getPost('nom'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role')
        ];

        $userModel->insert($data);

        return redirect()->to(site_url('gestionUtilisateur'));
    }

    // modifier utilisateur
    public function EditUser()
    {
        $id = $this->request->getPost('id');

        if ($id) {

            $userModel = new UserModel();

            $data = [
                'nom' => $this->request->getPost('nom'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role' => $this->request->getPost('role')
            ];

            $userModel->update($id, $data);
        }

        return redirect()->to(site_url('gestionUtilisateur'));
    }

    // supprimer utilisateur
    public function DeleteUser($id = null)
    {
        if ($id != null) {

            $userModel = new UserModel();

            $userModel->delete($id);
        }

        return redirect()->to(site_url('gestionUtilisateur'));
    }

    // login utilisateur
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