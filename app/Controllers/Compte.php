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
        $session=session();
        if ($session->has('user'))
        {
            if($session->role != 'A')
            {
                return redirect()->to('/compte/afficher_profil');
            }
            $data['titre']="Comptes";
            $data['logins'] = $this->model->get_all_compte();
            $data['total'] = $this->model->get_number_compte();

            return view('templates/haut2', $data)
            .view('compte/affichage_comptes')
            .view('templates/bas2');
        }
        else
        {
            return view('templates/haut', ['titre' => 'Se connecter'])
            . view('compte/compte_connecter')
            . view('templates/bas');
        }
    }

    public function connecter()
    {
        // L’utilisateur a validé le formulaire en cliquant sur le bouton
        if ($this->request->getMethod()=="post"){
            // Messages d'erreur de validation du formulaire
            $messages = [
                'pseudo.required' => 'Veuillez entrer un pseudo.',
                'mdp.required' => 'Veuillez entrer un mot de passe.',
            ];
            if (! $this->validate(['pseudo' => 'required','motDePasse' => 'required'], $messages))
            { 
                // La validation du formulaire a échoué, retour au formulaire !
                return view('templates/haut', ['titre' => 'Se connecter'])
                . view('compte/compte_connecter')
                . view('templates/bas');
            }
            // La validation du formulaire a réussi, traitement du formulaire
            $pseudo=$this->request->getVar('pseudo');
            $password=$this->request->getVar('motDePasse');
            if ($this->model->connect_compte($pseudo,$password)==true)
            {
                //recuperation du role
                $role = $this->model->get_profil($pseudo)->pfl_role;
                $session=session();
                $session->set('user',$pseudo);
                $session->set('role',$role);
                return redirect()->to('/compte/afficher_accueil');
            }
            else
            { 
                $this->validator->setError('pseudo', 'Identifiant ou mot de passe incorrect.');

                return view('templates/haut', ['titre' => 'Se connecter'])
                . view('compte/compte_connecter')
                . view('templates/bas');
            }
        }
        return view('templates/haut', ['titre' => 'Se connecter'])
        . view('compte/compte_connecter')
        . view('templates/bas');
    }

    public function afficher_accueil() 
    {
        $session = session();
        if (!$session->has('user'))
        {
            return redirect()->to('/compte/connecter');
        }
        $data['titre'] = 'Accueil';

        return view('templates/haut2', ['titre' => 'Accueil'])
        . view('compte/compte_accueil')
        . view('templates/bas2');
    }

    public function creer()
    {
        $session=session();
        if ($session->has('user'))
        {
            if($session->role != 'A')
            {
                return redirect()->to('/compte/afficher_profil');
            }
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
        else 
        {
            return view('templates/haut', ['titre' => 'Se connecter'])
            . view('compte/compte_connecter')
            . view('templates/bas');
        }
    }

    public function modifier()
    {
        $session=session();
        if ($session->has('user'))
        {
            $login = $session->get('user');
            $data['profil'] = $this->model->get_profil($login);
            // L’utilisateur a validé le formulaire en cliquant sur le bouton
            if ($this->request->getMethod()=="post")
            {
                // Messages d'erreur de validation du formulaire
                $messages = [
                    'password' => [
                        'required' => 'Veuillez entrer un mot de passe.',
                        'max_length' => 'Le mot de passe ne doit pas dépasser 80 caractères.',
                        'min_length' => 'Le mot de passe doit avoir au moins 8 caractères.',
                        'regex_match' => 'Le mot de passe ne doit contenir que des caractères alphanumériques et les caractères spéciaux : ! @ # % & * ( ) _ + : < > ? - .'
                    ],
                    'new_password' => [
                        'max_length' => 'La confirmation du mot de passe ne doit pas dépasser 80 caractères.',
                        'min_length' => 'La confirmation du mot de passe doit avoir au moins 8 caractères.',
                        'matches' => 'La confirmation du mot de passe ne correspond pas au mot de passe saisi.',
                    ],
                    'new_password2' => [
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
                    ]
                ];

                if (!$this->validate([
                    'password' => 'required|max_length[80]|min_length[8]|regex_match[/^[a-zA-Z0-9!@#%&*()_+:<>?-]+$/]',
                    'new_password' => 'required|max_length[80]|min_length[8]|regex_match[/^[a-zA-Z0-9!@#%&*()_+:<>?-]+$/]',
                    'new_password2' => 'matches[new_password]',
                    'nom' => 'required|max_length[80]|min_length[2]|regex_match[/^[a-zA-ZÀ-ÿç\'\s]+$/]',
                    'prenom' => 'required|max_length[80]|min_length[2]|regex_match[/^[a-zA-ZÀ-ÿç\'\s]+$/]',
                    'email' => 'required|max_length[200]|min_length[8]|valid_email'
                ], $messages)) {
                    // La validation du formulaire a échoué, retour au formulaire !
                    return view('templates/haut2', ['titre' => 'Modifier le profil'])
                    . view('compte/compte_modifier', $data)
                    . view('templates/bas2');
                }
                // La validation du formulaire a réussi, traitement du formulaire
                $recuperation = $this->validator->getValidated();

                if($data['profil']->cpt_mot_de_passe != hash('sha512', $recuperation['password'] . $this->model->get_salt()))
                {
                    return view('templates/haut2', ['titre' => 'Modifier le profil'])
                    . view('compte/compte_modifier', $data)
                    . view('templates/bas2');
                }
                
                $this->model->update_compte($recuperation, $data['profil']->cpt_id);
                $this->model->update_profil($recuperation, $data['profil']->cpt_id);

                return redirect()->to('/compte/afficher_profil');
            }
            // L’utilisateur veut afficher le formulaire pour créer un compte
            return view('templates/haut2', ['titre' => 'Modifier le profil'])
            . view('compte/compte_modifier', $data)
            . view('templates/bas2');
        }
        else 
        {
            return view('templates/haut', ['titre' => 'Se connecter'])
            . view('compte/compte_connecter')
            . view('templates/bas');
        }
    }

    public function afficher_profil()
    {
        $session=session();
        if ($session->has('user'))
        {
            $data['titre'] = 'Profil';
            $login = $session->get('user');
            $data['profil'] = $this->model->get_profil($login);

            return view('templates/haut2',$data)
            . view('compte/compte_profil')
            . view('templates/bas2');
        }
        else
        {
            return view('templates/haut', ['titre' => 'Se connecter'])
            . view('compte/compte_connecter')
            . view('templates/bas');
        }
    }
    
    public function deconnecter()
    {
        $session=session();
        $session->destroy();
        return view('templates/haut', ['titre' => 'Se connecter'])
        . view('compte/compte_connecter')
        . view('templates/bas');
    }

}