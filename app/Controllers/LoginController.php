<?php
namespace App\Controllers;


use App\Models\UserModel; 
use CodeIgniter\Controller;

class LoginController extends BaseController
{
    public function index()
    {
     return view('loginView');

        // Si déjà connecté, on redirige vers le dashboard (index)
        //if (session()->get('isLoggedIn')) {
         //   return redirect()->to('index');
        //}
        
    }

    public function auth()
    {
        $session = session();
        
        $userModel = new UserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $userModel->getUserByEmail($email);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                
                $ses_donnees = [
                    'id'         => $user['id'],
                    'nom'        => $user['nom'],
                    'email'      => $user['email'],
                    'role'       => $user['role'], 
                    'isLoggedIn' => true
                ];
                $session->set($ses_donnees);

                // On redirige vers la route dashboard
                return redirect()->to('index');

            } else {
                // Flashdata pour afficher l'erreur sur loginView
                return redirect()->back()->with('error', 'Mot de passe incorrect.');
            }
        } else {
            return redirect()->back()->with('error', 'Email introuvable.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}