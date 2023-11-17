<?php
namespace App\Controllers;

use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Accueil extends BaseController
{
    public function __construct()
    {
        $this->model = model(Db_model::class);
    }

    public function afficher()
    {
        $data['actualites'] = $this->model->get_all_actualites(); 

        return view('templates/haut', $data)
            . view('affichage_accueil')
            . view('templates/bas');
    }
}