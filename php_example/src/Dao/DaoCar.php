<?php

require_once(__DIR__.'/../Car/Car.php');

class DaoCar
{
    private $dbConnection;

    public function __construct($pDbConnection)
    {
        $this->dbConnection = $pDbConnection;
    }

    public function createCar($pCar) : bool // Valeur de retour bool
    {
        try{
            /*On prepare une requête avec des placeholders qu'on va remplacer ensuite
            * Une requête préparée permet d'éviter les problèmes de sécurité
            * (injections par exemple) : ça ne nous dispense pas de filter les
            * inputs provenant des formulaires html !
            */
            $statment = $this->dbConnection->prepare(
                "INSERT INTO CAR (id, color, broken) VALUES (:id, :color, :broken)"
            );

            /*bindParam lie ce placeholder avec une référence donnée, la valeur réelle sera
            * récupérée au moment de l'exécution de la requête. 
            */
            /*bindValue copie la valeur et la met dans le placeholder, si cette valeur
            * change dans le temps, elle ne sera pas remplacée dans le placeholder
            */
            $statment->bindValue(':id', $pCar->getId());
            $statment->bindValue(':color', $pCar->getColor());
            echo 'adadad:' . ($pCar->isBroken() == true ? 1 : 0 );
            $statment->bindValue(':broken', ($pCar->isBroken() == true ? 1 : 0 ), PDO::PARAM_INT);
            
            return ($statment->execute()); // True or false en fonction de si ça a fonctionné
        }
        catch(PDOException $ex){
            return false;
        }
    }

    public function deleteCar($pCar) : bool // Valeur de retour bool
    {
        try{
            $statment = $this->dbConnection->prepare(
                "DELETE FROM CAR WHERE id = :id"
            );

            /*bindParam lie ce placeholder avec une référence donnée, la valeur réelle sera
            * récupérée au moment de l'exécution de la requête. 
            */
            /*bindValue copie la valeur et la met dans le placeholder, si cette valeur
            * change dans le temps, elle ne sera pas remplacée dans le placeholder
            */
            $statment->bindValue(':id', $pCar->getId());
            return ($statment->execute()); // True or false en fonction de si ça a fonctionné
        }
        catch(PDOException $ex){
            return false;
        }
    }

    public function getAllCars()
    {
        try{
            $array = array();
            $car;
            $statment = $this->dbConnection->prepare(
                "SELECT * FROM CAR"
            );
            $statment->execute();
            //On fetch avec les noms de colonnes
            while($row = $statment->fetch(PDO::FETCH_ASSOC))
            {
                $car = new Car();
                $car->setId($row['id']);
                $car->setColor($row['color']);
                if($row['broken'] == 0)
                    $car->setBroken(false);
                else
                    $car->setBroken(true);
                array_push($array, $car);
            }

            return $array;
        }
        catch(PDOException $ex){
            return array();
        }

    }
}

?>
