$(document).ready(function()
{
	
	obtenerPuntaje();

	$(".like").on("click", function(e) {
		var id=$('#video').attr("data-id");
		var nombre=$(this).attr("name");
		var dataString = 'id='+ id + '&nombre='+ nombre;

		$.ajax({
			type: "POST",
			url: "votacion.php",
			data: dataString,
			cache: true,
			success: function(html) {
				$("#contenido").html(html);
		}});

		e.preventDefault();
	});
});

function obtenerPuntaje (votacion) {
	var id=$('#video').attr("data-id");
	var dataString = 'id='+ id;
	$.ajax({
		type: "POST",
		url: "votacion.php",
		data: dataString,
		cache: true,
		success: function(html) {
			$("#contenido").html(html);
	}});
}
