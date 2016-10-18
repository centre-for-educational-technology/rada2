"use strict";

function getLocation(callback, watch) {
    function handleError(error) {
        console.error('Geolocation error', error);
    }

    if ( navigator.geolocation ) {
        if ( watch === true ) {
            navigator.geolocation.watchPosition(callback, handleError);
        } else {
            navigator.geolocation.getCurrentPosition(callback, handleError);
        }
    } else {
        throw 'Geolocation is unavailable!';
    }
}
