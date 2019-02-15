<?php

// PHP : Partie modèle et controller : crée les entitées, les gèrent et se charge de répondre aux appels ajax avec les données nécessaires

// require_once est comme un import sous java, si le fichier n'existe pas : erreur.
require_once(__DIR__.'/src/Utilitaries/functions.php'); // __DIR__ nous permet de partir du dossier du fichier actuel.
require_once(__DIR__.'/src/Dao/Db.php');
require_once(__DIR__.'/src/Dao/DaoCar.php');
require_once(__DIR__.'/src/Car/Car.php');
$db = new Db('mysql', 'localhost', 'test', 'root', ''); // On crée une connexion à la base (voir le fichier pour plus d'infos)
$db->connect(); // On se connecte
$daoCar = new DaoCar($db->getConnection()); // On donne cette connextion à l'objet DAO pour interagir avec la bae

if(isset($_POST) && isset($_POST['req'])) // Si on a un tableau de paramètres pour la requête POST et qu'on a un id de requête
{
    $_POST['req'] = filter_var($_POST['req'],FILTER_VALIDATE_INT); // On filtre, si ce n'est pas un int, ça retourne faux.
    if($_POST['req'] == 1) // On crée une voiture en bdd
    {
        if(isset($_POST['id']) && isset($_POST['color']) && isset($_POST['broken']))
        {
            $_POST['id'] = filter_var($_POST['id'],FILTER_VALIDATE_INT); // On vérifie que c'est un int, sinon false
            $_POST['color'] = filter_var($_POST['color'],FILTER_SANITIZE_STRING); // On conserve que les données d'une string, sinon false
            $_POST['broken'] = filter_var($_POST['broken'],FILTER_VALIDATE_INT,array("options" => array("min_range"=>0, "max_range"=>1))); // On vérifie que c'est un int entre 0 et 1, sinon false
            
            if($_POST['id'] != false && $_POST['color'] != false && $_POST['broken'] != false) // Si toutes les valeurs sont bonnes on continue
            {
                $car = Car::create($_POST['id'],$_POST['color'], $_POST['broken']); // On crée une voiture avec les données obtenues
                if($daoCar->createCar($car)) // On crée la voiture en bdd, si ça fonctionne ça retourne true, sinon false, voir DaoCar.php
                    echo '1';
                else
                    echo '0';
            }
            else // Sinon erreur
                echo '0';
        }
        else
            echo '0';
    }
    else if ($_POST['req'] == 2) // On veut afficher les voitures
    {
        echo json_encode($daoCar->getAllCars()); // On récupère les voitures, on les affiche encodées en JSON
    }
    else if($_POST['req'] == 3) // On veut supprimer une voiture
    {
        if(isset($_POST['id'])) 
        {
            $_POST['id'] = filter_var($_POST['id'],FILTER_VALIDATE_INT); // On vérifie que c'est un int, sinon false
            if($_POST['id'] != false)
            {
                $car = Car::create($_POST['id'],'', false); // On crée une voiture, sans couleur et pas cassée : on s'en fout un a besoin que de l'id
                if($daoCar->deleteCar($car)) // On supprime cette voiture en bdd, si ça marche ça return true, sinon false
                    echo '1';
                else
                    echo '0';
            }
        }
    }
    else // erreur
    {
        echo '0';
    }
    
}
else
    echo 'bad access';


?>