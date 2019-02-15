<!--  HTML, CSS, Javascript : partie vue : le html pour la structure, le css pour le style, le javascript pour le ajax, les échanges avec l'api et l'actualisation des données/interface -->
<html>
    <head> <!-- Nos imports css pour les styles boostrap -->
        <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap-grid.min.css">
        <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap-reboot.min.css">
    </head>
    <body> <!-- Notre page commence ici -->
        <div class="col-6"> <!-- On fait une divison qui prend la moitié de la page, 6 colonnes sur 12 -->
            <table class="table"> <!-- On fait un tableau de la class table de bootstrap, plus joli -->
                <thead>
                    <tr> <!-- On définit le header du tableau -->
                        <th scope="col">Id</th>
                        <th scope="col">Color</th>
                        <th scope="col">Broken</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="carlist"> <!-- Le corps du tableau, très important de lui attribuer un id puisqu'on va le remplir en javascript -->
                </tbody>
            </table>
        </div>
        <div class="col-8"> <!-- Une autre div un peu plus large pour contenir nos inputes et buttons -->
            <input type="number" id="idCar" placeholder="Car id"> <!-- Un input pour l'id de la voiture à créer -->
            <input type="text" id="couleurCar" placeholder = "Car color"> <!-- Un input pour la couleur de la voiture à créer -->
            <select id="brokenCar"> <!-- Un input pour choisir si la voiture à créer est cassée ou non -->
                <option value=1>broken</option>
                <option value=0>not broken</option>
            </select>
            <button onclick=createNewCar() class="btn btn-primary">Create car</button> <!-- Un button qui enverra une requête à l'api pour créer une nouvelle voiture avec les données des inputs, en javascript -->
            <button onclick=updateCarList() class="btn btn-primary">Update car list</button> <!-- Un button qui demandera les données à l'api pour mettre à jour notre tableau, en javascript -->
        </div>
    </body>    
</html>

<script src="./assets/js/jquery-3.3.1.min"></script> <!-- jQuery, pour nous simplifier la vie ! -->
<script src="./assets/js/bootstrap.min.js"></script> <!-- Le javascript pour faire fonctionner bootstrap -->
<script src="./assets/js/bootstrap.bundle.min.js"></script>  <!-- Le javascript pour faire fonctionner bootstrap -->
<script src="./assets/js/ajaxController.js"></script>  <!-- Notre controller js qui va faire les appels à notre api et mettre à jour notre page -->
<script>
    updateCarList() // On va chercher les voitures et on les affiches dans le tableau (voir ajaxController.js)
</script>