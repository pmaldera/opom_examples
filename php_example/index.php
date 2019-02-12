<?php
    /*Ceci n'est PAS un exemple de MVC correct en php : techniquement
    la données à afficher est gérée avec du AJAX qui renvoie les données à traiter
    et elles sont actualisées avec du Javascript.
    
    Le php s'exécute UNE FOIS, AVANT l'affichage de la page, il est donc essentiel
    d'utiliser du javascript, html et css pour actualiser les données de la page
    sans avoir à la refresh.
    */
    require_once(__DIR__.'/src/Utilitaries/functions.php');
    require_once(__DIR__.'/src/Dao/Db.php');
    require_once(__DIR__.'/src/Dao/DaoCar.php');
    require_once(__DIR__.'/src/Car/Car.php');
    require_once(__DIR__.'/src/Car/CarController.php');
    require_once(__DIR__.'/src/Car/CarView.php');
    $carView = new CarView();
    $db = new Db('mysql', 'localhost', 'test', 'root', '');
    $db->connect();
    $daoCar = new DaoCar($db->getConnection());
?>

<html>
    <head>
    </head>
    <body>
        <?php
            if($db->isConnected())
                echo 'Database connected ! <br><br>';
            else
                echo 'Can\'t connect to the database';
            $carView->printCarList($daoCar->getAllCars());
        ?>

        <input type="number" id="idCar">
        <input type="text" id="couleurCar">
        <select id="brokenCar">
            <option value=1>broken</option>
            <option value=0>not broken</option>
        </select>
        <button onclick=CreateNewCar()>Create car</button>
    </body>    
</html>


<script src="./assets/js/ajaxController.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>