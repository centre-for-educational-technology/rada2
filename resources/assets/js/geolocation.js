"use strict";

function getLocation(callback, watch, handleError) {
    if ( typeof handleError !== 'function' ) {
        function handleError(error) {
            if ( console && console.error && typeof console.error === 'function' ) {
                console.error('Geolocation error', error);
            }
        }
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
