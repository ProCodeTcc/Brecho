//função para pegar a latitude e longitude
function getLatLon(endereco){
	$.getJSON('https://open.mapquestapi.com/geocoding/v1/address?key=tilU5UlHpeaAm5aWQ0hNINrf8R9BnRCz&location='+endereco, function(dados){
		$('#txtlat').val(dados.results[0].locations[0].latLng.lat);
		$('#txtlong').val(dados.results[0].locations[0].latLng.lng);
	});
}