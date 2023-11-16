<?php
namespace App\Controllers;

use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Accueil extends BaseController
{
    public function __construct()
    {
        //...
    }

    public function afficher()
    {
        $model = model(Db_model::class);
        $data['actualites'] = $model->get_all_actualites(); 

        return view('templates/haut', $data)
            . view('affichage_accueil')
            . view('templates/bas');
    }
}