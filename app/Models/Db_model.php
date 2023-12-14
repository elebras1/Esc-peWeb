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
    //Récupère tous les comptes utilisateur avec leurs profils associés, triés par validité, rôle, date d'inscription et login.
    public function get_all_compte()
    {
        $resultat = $this->db->query("SELECT * FROM t_compte_cpt JOIN t_profil_pfl USING (cpt_id) ORDER BY pfl_validite, pfl_role, pfl_date_inscription, cpt_login;");
        return $resultat->getResultArray();
    }

    //Récupère l'id d'un compte en fonction du login.
    public function get_compte($login)
    {
        $resultat = $this->db->query("SELECT cpt_id FROM t_compte_cpt WHERE cpt_login = '" . $login . "'");
        return $resultat->getRow();
    }

    //Récupère le nombre total de compte.
    public function get_number_compte()
    {
        $resultat = $this->db->query("SELECT nbComptes() AS nb;");
        return $resultat->getRow();
    }

    //Ajoute un compte.
    public function set_compte($saisie)
    {
        //Récuparation (+ traitement si nécessaire) des données du formulaire
        $login = htmlspecialchars($saisie['pseudo']);
        $mot_de_passe = htmlspecialchars($saisie['password'] . $this->salt);
        $sql = "INSERT INTO t_compte_cpt(cpt_login, cpt_mot_de_passe) VALUES('" . $login . "',SHA2('" . $mot_de_passe . "', 512))";
        return $this->db->query($sql);
    }

    //Modifie un compte.
    public function update_compte($saisie, $cpt_id)
    {
        $mot_de_passe = htmlspecialchars($saisie['new_password']);
        $sql = "CALL updateCompte('".$mot_de_passe."',".$cpt_id.")";
        return $this->db->query($sql);
    }

    //Vérifie la connexion d'un utilisateur.
    public function connect_compte($login, $mot_de_passe)
    {
        $mot_de_passe = $mot_de_passe . $this->salt;
        $sql = "SELECT cpt_login, cpt_mot_de_passe
            FROM t_compte_cpt JOIN t_profil_pfl USING(cpt_id)
            WHERE cpt_login='" . $login . "'
            AND cpt_mot_de_passe = SHA2('" . $mot_de_passe . "', 512)
            AND pfl_validite = 'A'";
        $resultat = $this->db->query($sql);

        if ($resultat->getNumRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Verifie si un compte ayant un login précis existe.
    public function is_compte_login_exist($login)
    {
        $resultat = $this->db->query("SELECT cpt_id FROM t_compte_cpt WHERE cpt_login = '" . $login . "';");
        if ($resultat->getNumRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Vérifie si un compte est l'auteur d'un scénario.
    public function is_author_of_scenario($login, $code)
    {
        $resultat = $this->db->query("SELECT snr_id FROM t_compte_cpt JOIN t_scenario_snr USING(cpt_id) WHERE cpt_login = '" . $login . "' AND snr_code = '" . $code . "';");
        if ($resultat->getNumRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /* fonctions de gestion des profils*/
    //Ajoute un profil.
    public function set_profil($saisie, $cpt_id)
    {
        //Récuparation (+ traitement si nécessaire) des données du formulaire
        $nom = htmlspecialchars(addslashes($saisie['nom']));
        $prenom = htmlspecialchars(addslashes($saisie['prenom']));
        $email = htmlspecialchars($saisie['email']);
        $role = htmlspecialchars($saisie['role']);
        $validite = $saisie['validite'];
        $sql = "INSERT INTO t_profil_pfl VALUES(" . $cpt_id . ",'" . $nom . "', '" . $prenom . "', '" . $email . "', CURDATE(), '" . $role . "', '" . $validite . "')";
        return $this->db->query($sql);
    }

    //Retourne le profil selon le login.
    public function get_profil($login)
    {
        $resultat = $this->db->query("SELECT * FROM t_compte_cpt JOIN t_profil_pfl USING(cpt_id) WHERE cpt_login = '" . $login . "';");
        return $resultat->getRow();
    }

    //Modifie le profil.
    public function update_profil($saisie, $cpt_id)
    {
        //Récuparation (+ traitement si nécessaire) des données du formulaire
        $nom = htmlspecialchars(addslashes($saisie['nom']));
        $prenom = htmlspecialchars(addslashes($saisie['prenom']));
        $email = htmlspecialchars($saisie['email']);
        $sql = "UPDATE t_profil_pfl SET pfl_prenom = '" . $prenom . "', pfl_nom = '" . $nom . "', pfl_email = '" . $email . "' WHERE cpt_id = " . $cpt_id . ";";
        return $this->db->query($sql);
    }

    /* fonctions de gestion des actualites */
    //Retourne les 5 dernières actualités les plus récentes
    public function get_last_actualites()
    {
        $resultat = $this->db->query("SELECT act_id, act_titre, act_description, act_date, cpt_login FROM t_actualite_act JOIN t_compte_cpt USING(cpt_id) WHERE act_statut = 'A' ORDER BY act_date DESC LIMIT 5;");
        return $resultat->getResultArray();
    }

    //Retourne une actualité par rapport a son numéro.
    public function get_actualite($numero)
    {
        $resultat = $this->db->query("SELECT * FROM t_actualite_act WHERE act_id=" . $numero . ";");
        return $resultat->getRow();
    }

    /* fonctions de gestion des scenarios */
    //Retourne le scénario correspondant a un code.
    public function get_scenario($code)
    {
        $resultat = $this->db->query("SELECT * FROM t_scenario_snr WHERE snr_code = '" . $code . "'");
        return $resultat->getRow();
    }

    //Retourne tout les scénarios.
    public function get_all_scenarios()
    {
        $resultat = $this->db->query("SELECT * FROM t_scenario_snr;");
        return $resultat->getResultArray();
    }

    //Retourne le nombre de scénarios
    public function get_number_scenario()
    {
        $resultat = $this->db->query("SELECT count(snr_id) FROM t_scenario_snr;");
        return $resultat->getResultArray();
    }

    //Retourne tout les scénarios activés et leurs auteurs.
    public function get_all_scenarios_activate()
    {
        $resultat = $this->db->query("SELECT * FROM t_compte_cpt JOIN t_scenario_snr USING(cpt_id) WHERE snr_statut = 'A'");
        return $resultat->getResultArray();
    }

    //Retourne tout les scénarios avec le compte, les étapes et indices associés
    public function get_all_scenarios_nb_etapes()
    {
        $resultat = $this->db->query
        (
            "SELECT snr_id, snr_code, snr_intitule, snr_image, snr_statut, cpt_login, COUNT(etp_id) AS nb_etape
            FROM t_compte_cpt RIGHT JOIN t_scenario_snr USING(cpt_id) LEFT JOIN t_etape_etp USING(snr_id)
            GROUP BY snr_id
            ORDER BY snr_statut, snr_id;"
        );
        return $resultat->getResultArray();
    }

    //Vérfie la concordance des codes d'un scénario et étape fournit
    public function is_correct_code($code_scenario, $code_etape)
    {
        $resultat = $this->db->query(
            "SELECT * FROM t_scenario_snr 
            JOIN t_etape_etp USING(snr_id) 
            WHERE snr_code = '".$code_scenario."' 
            AND etp_id IN (SELECT etp_id FROM t_etape_etp WHERE etp_code = '".$code_etape."')
            ORDER BY etp_numero DESC LIMIT 1"
        );

        if ($resultat->getNumRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    //Ajoute un scénario
    public function set_scenario($saisie)
    {
        $code = htmlspecialchars($saisie['code']);
        $intitule = htmlspecialchars(addslashes($saisie['intitule']));
        $description = htmlspecialchars(addslashes($saisie['description']));
        $image = htmlspecialchars($saisie['fichier']);
        $statut = htmlspecialchars($saisie['statut']);
        $id = htmlspecialchars($saisie['id']);
        $sql = "INSERT INTO t_scenario_snr (snr_code, snr_intitule, snr_description, snr_image, snr_statut, cpt_id) 
                VALUES ('" . $code . "', '" . $intitule . "', '" . $description . "', '" . $image . "', '" . $statut . "', " . $id . ")";
        return $this->db->query($sql);
    }

    //Supprime un scénario.
    public function delete_scenario($code)
    {
        $sql = "DELETE FROM t_scenario_snr WHERE snr_code='" . $code . "'";
        return $this->db->query($sql);
    }

    /* fonctions de gestion des etapes */
    //Récupère la première étape d'un scénario.
    public function get_first_etape($code, $difficulte)
    {
        $resultat = $this->db->query
        (
            "SELECT *
            FROM t_scenario_snr JOIN t_etape_etp USING(snr_id)
            LEFT JOIN t_indice_idc ON t_etape_etp.etp_id = t_indice_idc.etp_id AND idc_difficulte = " . $difficulte . "
            JOIN t_ressource_rsc USING(rsc_id)
            WHERE snr_code = '" . $code . "'
            AND etp_numero = 1;"
        );
        return $resultat->getRow();
    }

    //Récupère une étape par rapport a sa difficulté 
    public function get_etape($code, $difficulte) {
        $resultat = $this->db->query(
            "SELECT *
            FROM t_scenario_snr JOIN t_etape_etp USING(snr_id) JOIN t_ressource_rsc USING(rsc_id)
            LEFT JOIN t_indice_idc ON t_etape_etp.etp_id = t_indice_idc.etp_id AND idc_difficulte = " . $difficulte . "
            WHERE etp_code = '" . $code . "'"
        );
        return $resultat->getRow();
    }

    //Recupère l'étape suivante
    public function get_next_etape($snr_code, $etp_numero) {
        $resultat = $this->db->query("SELECT etp_code FROM t_scenario_snr JOIN t_etape_etp USING(snr_id) WHERE snr_code = '".$snr_code."' AND etp_numero = '".$etp_numero."'");
        if ($resultat->getNumRows() == null) {
            return null;
        }
        return $resultat->getRow();
    }

    //Récupère toutes les étapes d'un scénario.
    public function get_all_etape_of_scenario($id)
    {
        $resultat = $this->db->query("SELECT * FROM t_etape_etp WHERE snr_id =" . $id . ";");
        return $resultat->getResultArray();
    }

    /*public function delete_etape_by_scenario($code)
    {
        $sql = "DELETE FROM t_etape_etp WHERE etp_id IN (SELECT etp_id FROM t_scenario_snr JOIN t_etape_etp USING(snr_id) WHERE snr_code = '" . $code . "')";
        return $this->db->query($sql);
    }*/

    //Vérifie si la réponse est correcte.
    public function check_answer($code, $reponse)
    {
        $reponse = addslashes($reponse);
        $resultat = $this->db->query("SELECT * FROM t_etape_etp WHERE etp_code = '".$code."' AND etp_reponse = '".$reponse."'");

        if ($resultat->getNumRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    //Récupère le numéro d'une étape par rapport a son code.
    public function get_numero_by_code($code)
    {
        $resultat = $this->db->query("SELECT etp_numero FROM t_etape_etp WHERE etp_code = '".$code."'");
        return $resultat->getRow();
    }

    /* fonctions de gestion des indices */
    /*public function delete_indice_by_scenario($code)
    {
        $sql = "DELETE FROM t_indice_idc WHERE idc_id IN 
                (SELECT idc_id FROM t_scenario_snr JOIN t_etape_etp USING(snr_id) JOIN t_indice_idc USING(etp_id) WHERE snr_code = '" . $code . "')";
        return $this->db->query($sql);
    }*/

    /* fonctions de gestion des parties */
    /*public function delete_partie_by_scenario($code)
    {
        $sql = "DELETE FROM t_partie_prt WHERE snr_id IN (SELECT snr_id FROM t_scenario_snr JOIN t_partie_prt USING(snr_id) WHERE snr_code = '" . $code . "')";
        return $this->db->query($sql);
    }*/

    //Ajoute une partie.
    public function set_partie($difficulte, $id_snr, $id_ptp)
    {
        $sql = "INSERT INTO t_partie_prt VALUES(".$id_ptp.", ".$id_snr.", NOW(), NOW(), ".$difficulte.")";
        return $this->db->query($sql);
    }

    //Récupère une partie par rapport a son participant et scénario
    public function get_partie($id_ptp, $id_snr) {
        $resultat = $this->db->query("SELECT * FROM t_partie_prt WHERE ptp_id = ".$id_ptp." AND snr_id = ".$id_snr."");
        return $resultat->getRow();
    }

    /* fonctions de gestion des participations */
    //Récupère un participant par rapport a son email.
    public function get_participant_by_email($email) {
        $sql = "SELECT * FROM t_participant_ptp WHERE ptp_email = '".$email."'";
        return $this->db->query($sql)->getRow();
    }

    //Ajoute un participant.
    public function set_participant($saisie)
    {
        $nom = htmlspecialchars($saisie['nom']);
        $email = htmlspecialchars($saisie['email']);
        $sql = "INSERT t_participant_ptp (ptp_email, ptp_nom) VALUES('".$email."', '".$nom."')";
        return $this->db->query($sql);
    }
}