<?php

namespace App\Models;
use CodeIgniter\Model;

class Db_model extends Model
{
    protected $db;

    private $salt;

    public function __construct()
    {
        $this->db = db_connect(); //charger la base de données
        // ou
        // $this->db = \Config\Database::connect();
        $this->salt = "s1a2l3t4";
    }

    /* fonctions de gestion des comptes*/ 
    public function get_all_compte()
    {
        $resultat = $this->db->query("SELECT * FROM t_compte_cpt JOIN t_profil_pfl USING (cpt_id) ORDER BY pfl_validite, pfl_date_inscription;");
        return $resultat->getResultArray();
    }

    public function get_compte($login)
    {
        $resultat = $this->db->query("SELECT cpt_id FROM t_compte_cpt WHERE cpt_login = '".$login."'");
        return $resultat->getRow();
    }

    public function get_number_compte()
    {
        $resultat = $this->db->query("SELECT count(cpt_id) AS number FROM t_compte_cpt;");
        return $resultat->getRow();
    }
    
    public function set_compte($saisie)
    {
        //Récuparation (+ traitement si nécessaire) des données du formulaire
        $login = addslashes($saisie['pseudo']);
        $mot_de_passe = $saisie['password'] . $this->salt;
        $sql = "INSERT INTO t_compte_cpt(cpt_login, cpt_mot_de_passe) VALUES('".$login."',SHA2('".$mot_de_passe."', 512))";
        return $this->db->query($sql);
    }

    /* fonctions de gestion des comptes*/
    public function set_profil($saisie, $cpt_id)
    {
        //Récuparation (+ traitement si nécessaire) des données du formulaire
        $nom = addslashes($saisie['nom']);
        $prenom = addslashes($saisie['prenom']);
        $email = $saisie['email'];
        $role = $saisie['role'];
        $sql = "INSERT INTO t_profil_pfl VALUES(".$cpt_id.",'".$nom."', '".$prenom."', '".$email."', CURDATE(), '".$role."', 'D')";
        return $this->db->query($sql);
    }

    /* fonctions de gestion des actualites */
    public function get_all_actualites()
    {
        $resultat = $this->db->query("SELECT act_id, act_titre, act_description, act_date, cpt_login FROM t_actualite_act JOIN t_compte_cpt USING(cpt_id) WHERE act_statut = 'A';");
        return $resultat->getResultArray();
    }

    public function get_actualite($numero)
    {
        $resultat = $this->db->query("SELECT * FROM t_actualite_act WHERE act_id=".$numero.";");
        return $resultat->getRow();
    }

    /* fonctions de gestion des scenarios */
    public function get_all_scenarios()
    {
        $resultat = $this->db->query
        (
            "SELECT DISTINCT cpt_login, snr_code, snr_intitule, etp_code, etp_intitule, snr_image
            FROM t_compte_cpt JOIN t_scenario_snr USING(cpt_id)
            JOIN t_etape_etp USING(snr_id)
            JOIN t_indice_idc USING(etp_id)
            WHERE etp_numero = 1
            AND snr_statut = 'A';"
        );
        return $resultat->getResultArray();
    }

    public function get_first_etape($code, $difficulte)
    {
        $resultat = $this->db->query
        (
            "SELECT *
            FROM t_scenario_snr JOIN t_etape_etp USING(snr_id)
            LEFT JOIN t_indice_idc ON t_etape_etp.etp_id = t_indice_idc.etp_id AND idc_difficulte = ".$difficulte."
            JOIN t_ressource_rsc USING(rsc_id)
            WHERE snr_code = '".$code."'
            AND etp_numero = 1;"
        );
        return $resultat->getRow();
    }
}