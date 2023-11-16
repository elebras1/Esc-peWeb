<?php
namespace App\Controllers;

use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Compte extends BaseController
{
    public function __construct()
    {
        //...
    }
    public function lister()
    {
        $model = model(Db_model::class);
        $data['titre']="Liste de tous les comptes";
        $data['logins'] = $model->get_all_compte();
        $data['total'] = $model->get_number_compte();

        return view('templates/haut', $data)
        .view('compte/affichage_comptes')
        .view('templates/bas');
    }

    public function creer()
    {
        helper('form');
        $model = model(Db_model::class);
        // L’utilisateur a validé le formulaire en cliquant sur le bouton
        if ($this->request->getMethod()=="post")
        {
            if (!$this->validate([
                'pseudo' => 'required|max_length[45]|min_length[2]',
                'password' => 'required|max_length[80]|min_length[8]',
                'password2' => 'required|max_length[80]|min_length[8]|matches[password]',
                'nom' => 'required|max_length[80]|min_length[2]',
                'prenom' => 'required|max_length[80]|min_length[2]',
                'email' => 'required|max_length[200]|min_length[8]'
            ])) {
                // La validation du formulaire a échoué, retour au formulaire !
                return view('templates/haut', ['titre' => 'Créer un compte'])
                . view('compte/compte_creer')
                . view('templates/bas');
            }
            // La validation du formulaire a réussi, traitement du formulaire
            $recuperation = $this->validator->getValidated();
            $model->set_compte($recuperation);
            $compte = $model->get_compte($recuperation['pseudo']);
            $model->set_profil($recuperation, $compte->cpt_id);
            $data['le_compte']=$recuperation['pseudo'];
            $data['le_message']="Nouveau nombre de comptes : ";
            //Appel de la fonction créée dans le précédent tutoriel :
            $data['total']=$model->get_number_compte();
            return view('templates/haut', $data)
            . view('compte/compte_succes')
            . view('templates/bas');
        }
        // L’utilisateur veut afficher le formulaire pour créer un compte
        return view('templates/haut', ['titre' => 'Créer un compte'])
        . view('compte/compte_creer')
        . view('templates/bas');
    }
}