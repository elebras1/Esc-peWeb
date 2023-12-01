<?php
namespace App\Controllers;

use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Scenario extends BaseController
{
    public function __construct()
    {
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
        if ($code == 0 || $difficulte == 0 || $difficulte > 3)
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
}