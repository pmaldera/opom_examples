<?php
require_once(__DIR__.'/src/Utilitaries/functions.php');
require_once(__DIR__.'/src/Dao/Db.php');
require_once(__DIR__.'/src/Dao/DaoCar.php');
require_once(__DIR__.'/src/Car/Car.php');
require_once(__DIR__.'/src/Car/CarController.php');
require_once(__DIR__.'/src/Car/CarView.php');
$db = new Db('mysql', 'localhost', 'test', 'root', '');
$db->connect();
$daoCar = new DaoCar($db->getConnection());

if(isset($_POST) && isset($_POST['req']))
{
    if($_POST['req'] == 1) // On crée une voiture en bdd
    {
        if(isset($_POST['id']) && isset($_POST['color']) && isset($_POST['broken']))
        {
            // Il faudrait filtrer les variables en type et en valeur ici.
            $car = Car::create($_POST['id'],$_POST['color'], $_POST['broken']);
            if($daoCar->createCar($car))
                echo '1';
            else
                echo '0';
        }
    }
    else // On veut afficher les voitures
    {
        echo json_encode($daoCar->getAllCars());
    }
}
else
    echo 'broken';


?>