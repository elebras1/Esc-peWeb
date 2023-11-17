<?php
namespace App\Controllers;

use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Actualite extends BaseController
{
    public function __construct()
    {
        $this->model = model(Db_model::class);
    }

    public function afficher($numero = 0)
    {
        if ($numero == 0)
        {
            return redirect()->to('/');
        }
        else{
            $data['titre'] = 'Actualité :';
            $data['news'] = $this->model->get_actualite($numero);
            return view('templates/haut', $data)
            . view('actualite/affichage_actualite')
            . view('templates/bas');
        }
    }
}