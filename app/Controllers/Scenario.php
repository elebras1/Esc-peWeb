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

    public function afficher_1ere_etape($code = null, $difficulte = null)
    {
        if ($this->request->getMethod()=="post")
        {
            $messages = [
                'reponse.required' => 'Veuillez entrer une réponse.'
            ];
            if (!$this->validate(['code_etape' => 'required', 'code_scenario' => 'required', 'difficulte_etape' => 'required', 'reponse' => 'required'], $messages))
            { 
                // La validation du formulaire a échoué, retour au formulaire !
                return redirect()->to('/scenario/afficher_1ere_etape/'.$next_etape->etp_code.'/'.$recuperation['difficulte_etape']);
            }

            $recuperation = $this->validator->getValidated();
            if($this->model->check_answer($recuperation['code_etape'], $recuperation['reponse']))
            {
                $numero_etape = $this->model->get_numero_by_code($recuperation['code_etape']);
                $next_etape = $this->model->get_next_etape($recuperation['code_scenario'], $numero_etape->etp_numero + 1);
                if($next_etape == null) {
                    //redirection vers la finalisation si pas d'etape suivante
                    return redirect()->to('/scenario/finaliser_scenario/'.$recuperation['code_etape'].$recuperation['code_scenario'].$recuperation['difficulte_etape']);
                }

                // reponse correcte, redirection vers la prochaine etape(concat : code etape & scenario)
                return redirect()->to('/scenario/franchir_etape/'.$next_etape->etp_code.'/'.$recuperation['difficulte_etape']);
            }

            // reponse incorrecte, redirection vers le formulaire avec l'erreur
            return redirect()->to('/scenario/afficher_1ere_etape/'.$recuperation['code_scenario'].'/'.$recuperation['difficulte_etape'])->with('erreur_reponse', 'Réponse incorrecte.');
        }


        if (empty($code) || empty($difficulte) || $difficulte > 3)
        {
            return view('templates/haut', ['erreur' => 'L\'information recherchée n\'existe pas !'])
            . view('etape/affichage_1ere_etape')
            . view('templates/bas');
        }
        
        else{
            $data['titre'] = 'Première étape :';
            $data['etape'] = $this->model->get_first_etape($code, $difficulte);
            $data['difficulte'] = $difficulte;
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

    public  function afficher_scenario($code = null) {
        $session=session();
        if ($session->has('user'))
        {
            if($session->role != 'O')
            {
                return redirect()->to('/compte/afficher_profil');
            }
            
            if(empty($code)) {
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
                        'regex_match' => 'Un intitulé ne doit contenir que des caractères alphanumériques, des espaces, et les caractères : ! ? . , : ;',
                    ],
                    'description' => [
                        'required' => 'Veuillez entrer votre nom.',
                        'max_length' => 'La description ne doit pas dépasser 380 caractères.',
                        'min_length' => 'La description doit avoir au moins 5 caractères.',
                        'regex_match' => 'La description ne doit contenir que des caractères alphanumériques, des espaces, et les caractères : ! ? . , : ; ( )',
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
                    'description' => 'required|max_length[380]|min_length[2]|regex_match[/^[0-9a-zA-ZÀ-ÿç\'\s!?.,:;()]+$/]',
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
        
        if (!$this->model->is_author_of_scenario($session->get('user'), $code)) {
            return redirect()->to('/scenario/lister');
        }
        
        //traitement post
        if ($this->request->getMethod() == 'post') {
            $recuperation = $this->request->getPost('submit_button');
    
            if ($recuperation == 1) {
                $this->model->delete_scenario($code);
            }
    
            return redirect()->to('/scenario/lister');
        }
        // L’utilisateur veut afficher le formulaire pour supprimer un scénario
        return view('templates/haut2', ['titre' => 'Supprimer un scénario', 'code' => $code])
            . view('scenario/scenario_supprimer')
            . view('templates/bas2');
    }

    public function franchir_etape($code = null, $difficulte = null)
    {
        if ($this->request->getMethod()=="post")
        {
            $messages = [
                'reponse.required' => 'Veuillez entrer une réponse.'
            ];
            if (! $this->validate(['code_etape' => 'required', 'code_scenario' => 'required', 'difficulte_etape' => 'required', 'reponse' => 'required'], $messages))
            { 
                // La validation du formulaire a échoué, retour au formulaire !
                return view('templates/haut')
                . view('etape/etape_franchir')
                . view('templates/bas');
            }

            $recuperation = $this->validator->getValidated();
            if($this->model->check_answer($recuperation['code_etape'], $recuperation['reponse']))
            {
                $numero_etape = $this->model->get_numero_by_code($recuperation['code_etape']);
                $next_etape = $this->model->get_next_etape($recuperation['code_scenario'], $numero_etape->etp_numero + 1);
                if($next_etape == null) {
                    return redirect()->to('/scenario/finaliser_scenario/'.$recuperation['code_etape'].$recuperation['code_scenario'].$recuperation['difficulte_etape']);
                }

                // reponse correcte, redirection vers la prochaine etape
                return redirect()->to('/scenario/franchir_etape/'.$next_etape->etp_code.'/'.$recuperation['difficulte_etape']);
            }

            // reponse incorrecte, redirection vers l'etape en cours avec l'erreur flash
            return redirect()->to('/scenario/franchir_etape/'.$recuperation['code_etape'].'/'.$recuperation['difficulte_etape'])->with('erreur_reponse', 'Réponse incorrecte.');
        }


        if (empty($code) || empty($difficulte) || $difficulte > 3)
        {
            return view('templates/haut', ['erreur' => 'L\'information recherchée n\'existe pas !'])
            . view('etape/affichage_1ere_etape')
            . view('templates/bas');
        }
        
        else{
            $data['titre'] = 'Etape :';
            $data['etape'] = $this->model->get_etape($code, $difficulte);
            $data['difficulte'] = $difficulte;
            return view('templates/haut', $data)
            . view('etape/etape_franchir')
            . view('templates/bas');
        }
    }

    public function finaliser_scenario($code = null)
    {
        $data['titre'] = 'Finalisation du scénario';
        if ($this->request->getMethod()=="post")
        {
            $messages = [
                'nom' => [
                    'required' => 'Veuillez entrer un nom.',
                    'max_length' => 'Le nom ne doit pas dépasser 80 caractères.',
                    'min_length' => 'Le nom doit avoir au moins 2 caractères.',
                    'alpha_numeric' => 'Le nom ne doit contenir que des caractères alphanumériques.',
                ],
                'email' => [
                    'required' => 'Veuillez entrer une adresse e-mail.',
                    'max_length' => 'L\'adresse e-mail ne doit pas dépasser 200 caractères.',
                    'min_length' => 'L\'adresse e-mail doit avoir au moins 8 caractères.',
                    'valid_email' => 'Veuillez entrer une adresse e-mail valide.',
                ]
            ];
            if (!$this->validate(['nom' => 'required|max_length[80]|min_length[2]|alpha_numeric', 'email' => 'required|max_length[200]|min_length[8]|valid_email', 'code_etape' => 'required', 'code_scenario' => 'required', 'difficulte' => 'required'], $messages))
            {
                //recuperation des input hidden + info scenario
                $data['code_etape'] = $this->request->getPost('code_etape');
                $data['code_scenario'] = $this->request->getPost('code_scenario');
                $data['difficulte'] = $this->request->getPost('difficulte');
                $data['scenario'] = $this->model->get_scenario($data['code_scenario']);
                //formulaire pas valide retour vers la vue actuel
                return view('templates/haut', $data)
                . view('scenario/scenario_finalisation')
                . view('templates/bas');
            }

            // La validation du formulaire a réussi, traitement du formulaire
            $recuperation = $this->validator->getValidated();
            $data['scenario'] = $this->model->get_scenario($recuperation['code_scenario']);
            //verification de l'existence d'un participant
            $participant = $this->model->get_participant_by_email($recuperation['email']);
            if (!empty($participant)) {
                //insertion seulement dans partie
                $this->model->set_partie($recuperation['difficulte'], $data['scenario']->snr_id, $participant->ptp_id);
            } else {
                //insertion dans participant et partie
                $this->model->set_participant($recuperation);
                $participant = $this->model->get_participant_by_email($recuperation['email']);
                $this->model->set_partie($recuperation['difficulte'], $data['scenario']->snr_id, $participant->ptp_id);
            }

            // affichage succes de la finalisation
            $data['partie'] = $this->model->get_partie($participant->ptp_id, $data['scenario']->snr_id);
            return view('templates/haut', $data)
            . view('scenario/scenario_finalisation')
            . view('templates/bas');
        }

        if(empty($code) || strlen($code) != 19)
        {
            return redirect()->to('scenario/afficher_scenarios');
        }

        $taille_code_etape = 8;
        $taille_code_scenario = 10;
        // split des codes
        $code_etape = substr($code, 0, $taille_code_etape);
        $code_scenario = substr($code, $taille_code_etape, $taille_code_scenario);
        $difficulte = substr($code, $taille_code_etape + $taille_code_scenario, 1);

        $data['scenario'] = $this->model->get_scenario($code_scenario);
        $data['code_etape'] = $code_etape;
        $data['code_scenario'] = $code_scenario;
        $data['difficulte'] = $difficulte;
        if(!$this->model->is_correct_code($code_scenario, $code_etape))
        {
            return redirect()->to('scenario/afficher_scenarios');
        }

        return view('templates/haut', $data)
        . view('scenario/scenario_finalisation')
        . view('templates/bas');
    }

}