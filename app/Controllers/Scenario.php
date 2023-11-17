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

    public function lister()
    {
        $data['titre']="Liste de tous les scenarios";
        $data['scenarios'] = $this->model->get_all_scenarios(); 

        return view('templates/haut', $data)
            . view('scenario/affichage_scenarios')
            . view('templates/bas');
    }

    public function afficher_1ere_etape($code = 0, $difficulte = 0)
    {
        if ($code == 0 || $difficulte == 0)
        {
            return redirect()->to('/scenario/lister');
        }
        else{
            $data['titre'] = 'Première étape :';
            $data['etape'] = $this->model->get_first_etape($code, $difficulte);
            return view('templates/haut', $data)
            . view('etape/affichage_1ere_etape')
            . view('templates/bas');
        }
    }
}