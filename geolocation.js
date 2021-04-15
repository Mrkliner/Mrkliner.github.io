navigator.geolocation.getCurrentPosition(
    function(position) {
	    alert('Последний раз вас засекали здесь: ' +
		    position.coords.latitude + ", " + position.coords.longitude);
	}
);
