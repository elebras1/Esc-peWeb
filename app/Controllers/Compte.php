<?php
namespace App\Controllers;

use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Compte extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->model = model(Db_model::class);
    }
    public function lister()
    {
        $model = model(Db_model::class);
        $data['titre']="Liste de tous les comptes";
        $data['logins'] = $this->model->get_all_compte();
        $data['total'] = $this->model->get_number_compte();

        return view('templates/haut', $data)
        .view('compte/affichage_comptes')
        .view('templates/bas');
    }

    public function connecter()
    {
        $model = model(Db_model::class);
        // L’utilisateur a validé le formulaire en cliquant sur le bouton
        if ($this->request->getMethod()=="post"){
            if (! $this->validate(['pseudo' => 'required','mdp' => 'required']))
            { 
                // La validation du formulaire a échoué, retour au formulaire !
                return view('templates/haut', ['titre' => 'Se connecter'])
                . view('compte/compte_connecter')
                . view('templates/bas');
            }
            // La validation du formulaire a réussi, traitement du formulaire
            $username=$this->request->getVar('pseudo');
            $password=$this->request->getVar('mdp');
            if ($model->connect_compte($username,$password)==true)
            {
                $session=session();
                $session->set('user',$username);
                //adapter le haut et bas administrateur bootstrap2
                return view('templates/haut')
                . view('compte/compte_accueil')
                . view('templates/bas');
            }
            else
            { 
                return view('templates/haut', ['titre' => 'Se connecter'])
                . view('compte/compte_connecter')
                . view('templates/bas');
            }
        }
        return view('templates/haut', ['titre' => 'Se connecter'])
        . view('compte/compte_connecter')
        . view('templates/bas');
    }

    public function creer()
    {
        // L’utilisateur a validé le formulaire en cliquant sur le bouton
        if ($this->request->getMethod()=="post")
        {
            // Messages d'erreur de validation du formulaire
            $messages = [
                'pseudo' => [
                    'required' => 'Veuillez entrer un pseudo.',
                    'max_length' => 'Le pseudo ne doit pas dépasser 45 caractères.',
                    'min_length' => 'Le pseudo doit avoir au moins 2 caractères.',
                    'alpha_numeric' => 'Le pseudo ne doit contenir que des caractères alphanumériques.',
                ],
                'password' => [
                    'required' => 'Veuillez entrer un mot de passe.',
                    'max_length' => 'Le mot de passe ne doit pas dépasser 80 caractères.',
                    'min_length' => 'Le mot de passe doit avoir au moins 8 caractères.',
                    'regex_match' => 'Le mot de passe ne doit contenir que des caractères alphanumériques et les caractères spéciaux : ! @ # % & * ( ) _ + : < > ? - .'
                ],
                'password2' => [
                    'required' => 'Veuillez confirmer le mot de passe.',
                    'max_length' => 'La confirmation du mot de passe ne doit pas dépasser 80 caractères.',
                    'min_length' => 'La confirmation du mot de passe doit avoir au moins 8 caractères.',
                    'matches' => 'La confirmation du mot de passe ne correspond pas au mot de passe saisi.',
                ],
                'nom' => [
                    'required' => 'Veuillez entrer votre nom.',
                    'max_length' => 'Le nom ne doit pas dépasser 80 caractères.',
                    'min_length' => 'Le nom doit avoir au moins 2 caractères.',
                    'regex_match' => 'Le nom ne doit contenir que des lettres, des espaces ou des apostrophes.',
                ],
                'prenom' => [
                    'required' => 'Veuillez entrer votre prénom.',
                    'max_length' => 'Le prénom ne doit pas dépasser 80 caractères.',
                    'min_length' => 'Le prénom doit avoir au moins 2 caractères.',
                    'regex_match' => 'Le prénom ne doit contenir que des lettres, des espaces ou des apostrophes.',
                ],
                'email' => [
                    'required' => 'Veuillez entrer une adresse e-mail.',
                    'max_length' => 'L\'adresse e-mail ne doit pas dépasser 200 caractères.',
                    'min_length' => 'L\'adresse e-mail doit avoir au moins 8 caractères.',
                    'valid_email' => 'Veuillez entrer une adresse e-mail valide.',
                ],
                'role' => [
                    'required' => 'Veuillez selectionner un role.'
                ]
            ];

            if (!$this->validate([
                'pseudo' => 'required|max_length[45]|min_length[2]|alpha_numeric',
                'password' => 'required|max_length[80]|min_length[8]|regex_match[/^[a-zA-Z0-9!@#%&*()_+:<>?-]+$/]',
                'password2' => 'required|max_length[80]|min_length[8]|matches[password]',
                'nom' => 'required|max_length[80]|min_length[2]|regex_match[/^[a-zA-ZÀ-ÿç\'\s]+$/]',
                'prenom' => 'required|max_length[80]|min_length[2]|regex_match[/^[a-zA-ZÀ-ÿç\'\s]+$/]',
                'email' => 'required|max_length[200]|min_length[8]|valid_email',
                'role' => 'required'
            ], $messages)) {
                // La validation du formulaire a échoué, retour au formulaire !
                return view('templates/haut', ['titre' => 'Créer un compte'])
                . view('compte/compte_creer')
                . view('templates/bas');
            }
            // La validation du formulaire a réussi, traitement du formulaire
            $recuperation = $this->validator->getValidated();
            
            $this->model->set_compte($recuperation);
            $compte = $this->model->get_compte($recuperation['pseudo']);
            $this->model->set_profil($recuperation, $compte->cpt_id);
            $data['le_compte']=$recuperation['pseudo'];
            $data['le_message']="Nouveau nombre de comptes : ";
            //Appel de la fonction créée dans le précédent tutoriel :
            $data['total']=$this->model->get_number_compte();
            return redirect()->to('/compte/lister');
        }
        // L’utilisateur veut afficher le formulaire pour créer un compte
        return view('templates/haut', ['titre' => 'Créer un compte'])
        . view('compte/compte_creer')
        . view('templates/bas');
    }
}