<?php
    $mysqli = new mysqli('localhost','e22206510sql','o3mGSKFu','e22206510_db1');
    if ($mysqli->connect_errno) {
        echo "Erreur de connexion";
    }
    //$uploaddir = '/home/2023DIFAL3/e22206510/public_html/gabarit/pages/documents/';
    $uploaddir = dirname(__DIR__) . '/documents/';
    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
    
    echo $uploadfile;
    echo '<pre>';
    
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        $requete = "UPDATE t_scenario_snr SET snr_image='".basename($_FILES['userfile']['name'])."' WHERE snr_id = 1;";

        echo($requete);

        $resultat = $mysqli->query($requete);

        if (!$resultat)
        {
            echo "Error: La requête a echoué \n";
            echo "Errno: " . $mysqli->errno . "\n";
            echo "Error: " . $mysqli->error . "\n";
            exit();
        } else {
            header("Location: ../index.php");
        }
    } else {
        echo "Le fichier n’a pas été téléchargé. Il y a eu un problème !\n";
        print_r($_FILES);
    }
?>