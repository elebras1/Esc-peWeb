<?php
namespace App\Controllers;

use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Scenario extends BaseController
{
    public function __construct()
    {
        //...
    }

    public function lister()
    {
        $model = model(Db_model::class);
        $data['titre']="Liste de tous les scenarios";
        $data['scenarios'] = $model->get_all_scenarios(); 

        return view('templates/haut', $data)
            . view('scenario/affichage_scenarios')
            . view('templates/bas');
    }

    public function afficher_1ere_etape($code = 0, $difficulte = 0)
    {
        $model = model(Db_model::class);

        if ($code == 0 || $difficulte == 0)
        {
            return redirect()->to('/scenario/lister');
        }
        else{
            $data['titre'] = 'Première étape :';
            $data['etape'] = $model->get_first_etape($code, $difficulte);
            return view('templates/haut', $data)
            . view('etape/affichage_1ere_etape')
            . view('templates/bas');
        }
    }
}