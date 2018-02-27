$(document).ready(function(){ // Se ejecuta una vez que el DOM de la pagina este listo
    $( "#searchItem" ).change(function() { //Captura cada vez que vea un cambio en el input con id "codigo"
    document.getElementById('nombreCliente').value = document.getElementById('searchItem').value;
    });
});



$(document).ready(function(){ // Se ejecuta una vez que el DOM de la pagina este listo
    $( "#codigo" ).change(function() { //Captura cada vez que vea un cambio en el input con id "codigo"
          //Ejecuta la accion a realizar
    });
});