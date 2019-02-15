function createNewCar()
{
    var carId = $('#idCar').val(); // On va chercher la valeur de l'input avec l'id 'idCar' sur notre page
    var carColor = $("#couleurCar").val(); // Idem pour l'id "couleurCar"
    var selectElement = document.getElementById("brokenCar"); // Pareil mais sans jQuery, on va chercher le select ...
    var carBroken = selectElement.options[selectElement.selectedIndex].value; // Puis on récupère la valeur de l'élément selecté dans ce select
    var data = { // On crée l'objet qui va contenir les informations de notre requête 
        req: 1, // L'id de notre requête, notre api saura que l'id 1 sera pour créer une voiture
        id: carId, // L'id de notre voiture
        color: carColor, // La couleur de notre voiture
        broken : 0 // Si la voiture est cassée
    };
    // On traduit ensuite la data récupérée en html, en js, pour dire si notre voiture est cassée ou non.
    if(carBroken === '1')
        data.broken = 1;
    else
        data.broken = 0;
    $.ajax({ // On fait notre requête, merci jQuery c'est très simple
        type: "POST", // On envoie un post, et non un get
        url: './api.php', // A l'url de l'api
        data: data, // Avec les données qui on a définit plus haut
        success: function(result){ // Si on a une réponse, on met à jour la liste des voitures : il faudra TOUJOURS avoir une réponse, on la vérifera, si elle est négative: erreur, si elle est positive : action
            updateCarList(); // On met à jour la liste des voitures
            console.log(result);
        }
      });
}

function updateCarList() // Méthode de mise à jour de la liste de voitures
{
    $.ajax({
        type: "POST",
        url: './api.php',
        data: {req:2}, // id de requête = 2, l'api saura que pour l'id 2 elle devra fournir les données des voitures en bdd
        success: function(result){ // Quand on reçoit ces données (qui sont en JSON)
            data = JSON.parse(result); // On les parse
            var carList = $('#carlist'); // On récupère le body du tableau
            carList.empty(); // On le vide
            data.forEach(function(car) { // Pour chaque voiture dans le tableau de voitures récupéré depuis le JSON
                carList.append( // On ajouteu ne ligne avec les infos et un button pour delete
                    '<tr>'+
                    '<th scope="row">' + car.id + '</th>'+
                    '<td>' + car.color + '</td>' +
                    '<td>' + car.broken + '</td>' +
                    '<td><button class = "btn btn-danger" onclick=deleteCar('+ car.id + ')>Delete</button></td>'+
                    '</tr>'
                );
            });
        }
      });
}

function deleteCar(id) // Méthode pour supprimer une voiture avec son id
{
    $.ajax({ // id de requête = 3, avec l'id de la voiture à supprimer en bdd
        type: "POST",
        url: './api.php',
        data: {
            req:3, 
            id:id
        },
        success: function(result){
            updateCarList(); // Une fois fait on met à jour notre tableau
        }
      });
}

