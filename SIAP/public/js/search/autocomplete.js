
$("#searchItem").change(event => {
	$.get(`/search/${event.target.value}`, function(res, sta){
		$("#negocioItem").empty();
		res.forEach(element => {
			$("#negocioItem").append(`<option value=${element.idnegocio}> ${element.nombre} </option>`);
		});
	});
});