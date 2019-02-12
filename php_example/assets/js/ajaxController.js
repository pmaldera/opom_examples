function CreateNewCar()
{
    var carId = document.getElementById("idCar").value;
    var carColor = document.getElementById("couleurCar").value;
    var selectElement = document.getElementById("brokenCar");
    var carBroken = selectElement.options[selectElement.selectedIndex].value;
    var data = {};
    data.req = 1;
    data.id = carId;
    data.color = carColor;
    if(carBroken === '1')
        data.broken = 1;
    else
        data.broken = 0;
    console.log(data);
    $.ajax({
        type: "POST",
        url: './api.php',
        data: data,
        success: function(result){
            console.log(result);
            $.ajax({
                type: "POST",
                url: './api.php',
                data: {req:2},
                success: function(result){
                    console.log(result);
                }
              });
        }
      });
}

function updateCarList(data)
{

}