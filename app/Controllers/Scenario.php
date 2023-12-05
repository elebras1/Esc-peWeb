<?php
namespace App\Controllers;

use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Scenario extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('text');
        $this->model = model(Db_model::class);
    }

    public function afficher_scenarios()
    {
        $data['titre']="Liste de tous les scenarios";
        $data['scenarios'] = $this->model->get_all_scenarios_activate(); 

        return view('templates/haut', $data)
            . view('scenario/affichage_scenarios')
            . view('templates/bas');
    }

    public function afficher_1ere_etape($code = 0, $difficulte = 0)
    {
        if (empty($code) || $difficulte == 0 || $difficulte > 3)
        {
            return redirect()->to('/scenario/afficher_scenarios');
        }
        else{
            $data['titre'] = 'Première étape :';
            $data['etape'] = $this->model->get_first_etape($code, $difficulte);
            return view('templates/haut', $data)
            . view('etape/affichage_1ere_etape')
            . view('templates/bas');
        }
    }

    public function lister()
    {
        $session=session();
        if ($session->has('user'))
        {
            if($session->role != 'O')
            {
                return redirect()->to('/compte/afficher_profil');
            }
            $data['titre'] = "Scénarios";
            $data['scenarios'] = $this->model->get_all_scenarios_nb_etapes();
            $data['nb_scenarios'] = $this->model->get_number_scenario();

            return view('templates/haut2', $data)
            .view('scenario/scenario_lister')
            .view('templates/bas2');
        }
        else
        {
            return redirect()->to('compte/connecter');
        }
    }

    public  function afficher_scenario($code = 0) {
        $session=session();
        if ($session->has('user'))
        {
            if($session->role != 'O')
            {
                return redirect()->to('/compte/afficher_profil');
            }
            
            if($code == 0) {
                redirect()->to('scenario/scenario_lister');
            }

            $data['scenario'] = $this->model->get_scenario($code);
            if(empty($data['scenario']))
            {
                return redirect()->to('/scenario/lister');
            }

            $data['etapes'] = $this->model->get_all_etape_of_scenario($data['scenario']->snr_id);
            $data['titre'] = 'Scenario';

            return view('templates/haut2', $data)
            .view('scenario/scenario_afficher')
            .view('templates/bas2');
        }
        else
        {
            return redirect()->to('compte/connecter');
        }
    }

    public function creer()
    {
        $session=session();
        if ($session->has('user'))
        {
            if($session->role != 'O')
            {
                return redirect()->to('/scenario/lister');
            }
            // L’utilisateur a validé le formulaire en cliquant sur le bouton
            if ($this->request->getMethod()=="post")
            {
                // Messages d'erreur de validation du formulaire
                $messages = [
                    'intitule' => [
                        'required' => 'Veuillez entrer un intitulé.',
                        'max_length' => 'Un intitulé ne doit pas dépasser 180 caractères.',
                        'min_length' => 'Un intitulé doit avoir au moins 5 caractères.',
                        'regex_match' => 'Le mot de passe ne doit contenir que des caractères alphanumériques, des espaces, et les caractères : ! ? . , : ;',
                    ],
                    'description' => [
                        'required' => 'Veuillez entrer votre nom.',
                        'max_length' => 'La description ne doit pas dépasser 380 caractères.',
                        'min_length' => 'La description doit avoir au moins 5 caractères.',
                        'regex_match' => 'La description ne doit contenir que des lettres, des espaces ou des apostrophes.',
                    ],
                    'statut' => [
                        'required' => 'Veuillez selectionner un statut.'
                    ],
                    'fichier' => [
                        'label' => 'Fichier image',
                        'rules' => [
                            'uploaded' => 'Veuillez télécharger un fichier image.',
                            'is_image' => 'Le fichier doit être une image valide.',
                            'mime_in' => 'Le format du fichier doit être parmi : jpg, jpeg, gif, png, webp.',
                            'max_size' => 'La taille du fichier ne doit pas dépasser 1000 Ko.',
                            'max_dims' => 'Les dimensions de l\'image ne doivent pas dépasser 1024x768 pixels.',
                        ]
                    ]
                ];

                if (!$this->validate([
                    'intitule' => 'required|max_length[180]|min_length[2]|regex_match[/^[0-9a-zA-ZÀ-ÿç\'\s!?.,:;]+$/]',
                    'description' => 'required|max_length[380]|min_length[2]|regex_match[/^[0-9a-zA-ZÀ-ÿç\'\s!?.,:;]+$/]',
                    'statut' => 'required',
                    'fichier' => [
                        'label' => 'Fichier image',
                        'rules' => [
                        'uploaded[fichier]',
                        'is_image[fichier]',
                        'mime_in[fichier,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                        'max_size[fichier,1000]',
                        'max_dims[fichier,1024,768]',
                        ]
                    ]
                ], $messages)) {
                    // La validation du formulaire a échoué, retour au formulaire !
                    return view('templates/haut2', ['titre' => 'Créer un scénario'])
                    . view('scenario/scenario_creer')
                    . view('templates/bas2');
                }
                // La validation du formulaire a réussi, traitement du formulaire
                $recuperation = $this->validator->getValidated();
                $fichier=$this->request->getFile('fichier');
                if(!empty($fichier)){
                    // Récupération du nom du fichier téléversé
                    $nom_fichier=$fichier->getName();
                    // Dépôt du fichier dans le répertoire ci/public/images
                    if($fichier->move("ressources",$nom_fichier)){
                        $recuperation['code'] = random_string('alnum', 10);
                        $recuperation['fichier'] = $nom_fichier;
                        $compte = $this->model->get_compte($session->get('user'));
                        $recuperation['id'] = $compte->cpt_id;

                        $this->model->set_scenario($recuperation);
        
                        return redirect()->to('/scenario/lister');
                    }
                }
            }
            // L’utilisateur veut afficher le formulaire pour créer un scenario
            return view('templates/haut2', ['titre' => 'Créer un scénario'])
            . view('scenario/scenario_creer')
            . view('templates/bas2');
        }
        else
        {
            return redirect()->to('compte/connecter');
        }
    }

    public function supprimer($code = null) {
        $session = session();
        
        if (!$session->has('user')) {
            return redirect()->to('compte/connecter');
        }
    
        if ($session->role != 'O') {
            return redirect()->to('/scenario/lister');
        }
        
        //traitement post
        if ($this->request->getMethod() == 'post') {
            $recuperation = $this->request->getPost('submit_button');
    
            if ($recuperation == 1) {
                $this->model->delete_indice_by_scenario($code);
                $this->model->delete_etape_by_scenario($code);
                $this->model->delete_partie_by_scenario($code);
                $this->model->delete_scenario($code);
            }
    
            return redirect()->to('/scenario/lister');
        }
    
        // L’utilisateur veut afficher le formulaire pour supprimer un scénario
        return view('templates/haut2', ['titre' => 'Supprimer un scénario', 'code' => $code])
            . view('scenario/scenario_supprimer')
            . view('templates/bas2');
    }
    

}