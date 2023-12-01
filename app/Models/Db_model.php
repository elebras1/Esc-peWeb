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

    public function get_salt()
    {
        return $this->salt;
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
        $login = $saisie['pseudo'];
        $mot_de_passe = $saisie['password'] . $this->salt;
        $sql = "INSERT INTO t_compte_cpt(cpt_login, cpt_mot_de_passe) VALUES('".$login."',SHA2('".$mot_de_passe."', 512))";
        return $this->db->query($sql);
    }

    public function update_compte($saisie, $cpt_id)
    {
        $mot_de_passe = $saisie['new_password'] . $this->salt;;
        $sql = "UPDATE t_compte_cpt SET cpt_mot_de_passe = SHA2('".$mot_de_passe."', 512) WHERE cpt_id = ".$cpt_id.";";
        return $this->db->query($sql);
    }

    public function connect_compte($login, $mot_de_passe)
    {
        $mot_de_passe = $mot_de_passe . $this->salt;
        $sql = "SELECT cpt_login, cpt_mot_de_passe
            FROM t_compte_cpt JOIN t_profil_pfl USING(cpt_id)
            WHERE cpt_login='".$login."'
            AND cpt_mot_de_passe = SHA2('".$mot_de_passe."', 512)
            AND pfl_validite = 'A'";
        $resultat=$this->db->query($sql);

        if($resultat->getNumRows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function is_compte_login_exist($login)
    {
        $resultat = $this->db->query("SELECT cpt_id FROM t_compte_cpt WHERE cpt_login = '".$login."';");
        if($resultat->getNumRows() > 0)
        {
            return true;
        }
        else 
        {
            return false;
        }
    }

    /* fonctions de gestion des profils*/
    public function set_profil($saisie, $cpt_id)
    {
        //Récuparation (+ traitement si nécessaire) des données du formulaire
        $nom = addslashes($saisie['nom']);
        $prenom = addslashes($saisie['prenom']);
        $email = $saisie['email'];
        $role = $saisie['role'];
        $validite = $saisie['validite'];
        $sql = "INSERT INTO t_profil_pfl VALUES(".$cpt_id.",'".$nom."', '".$prenom."', '".$email."', CURDATE(), '".$role."', '".$validite."')";
        return $this->db->query($sql);
    }

    public function get_profil($login)
    {
        $resultat = $this->db->query("SELECT * FROM t_compte_cpt JOIN t_profil_pfl USING(cpt_id) WHERE cpt_login = '".$login."';");
        return $resultat->getRow();
    }

    public function update_profil($saisie, $cpt_id)
    {
        //Récuparation (+ traitement si nécessaire) des données du formulaire
        $nom = addslashes($saisie['nom']);
        $prenom = addslashes($saisie['prenom']);
        $email = $saisie['email'];
        $sql = "UPDATE t_profil_pfl SET pfl_prenom = '".$prenom."', pfl_nom = '".$nom."', pfl_email = '".$email."' WHERE cpt_id = ".$cpt_id.";";
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
    public function get_scenario($code)
    {
        $resultat = $this->db->query("SELECT * FROM t_scenario_snr WHERE snr_code = '".$code."'");
        return $resultat->getRow();
    }
    
    public function get_all_scenarios()
    {
        $resultat = $this->db->query("SELECT * FROM t_scenario_snr;");
        return $resultat->getResultArray();
    }

    public function get_number_scenario()
    {
        $resultat = $this->db->query("SELECT count(snr_id) FROM t_scenario_snr;");
        return $resultat->getResultArray();
    }
    
    public function get_all_scenarios_activate()
    {
        $resultat = $this->db->query
        (
            "SELECT snr_id, snr_code, snr_intitule, snr_image, cpt_login
            FROM t_compte_cpt RIGHT JOIN t_scenario_snr USING(cpt_id) LEFT JOIN t_etape_etp USING(snr_id)
            GROUP BY snr_id;"
        );
        return $resultat->getResultArray();
    }

    public function get_all_scenarios_nb_etapes()
    {
        $resultat = $this->db->query
        (
            "SELECT snr_id, snr_code, snr_intitule, snr_image, cpt_login, COUNT(etp_id) AS nb_etape
            FROM t_compte_cpt RIGHT JOIN t_scenario_snr USING(cpt_id) LEFT JOIN t_etape_etp USING(snr_id)
            GROUP BY snr_id;"
        );
        return $resultat->getResultArray();
    }

    /* fonctions de gestion des etapes */
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

    public function get_all_etape_of_scenario($id) 
    {
        $resultat = $this->db->query("SELECT * FROM t_etape_etp WHERE snr_id =".$id.";");
        return $resultat->getResultArray();
    }
}