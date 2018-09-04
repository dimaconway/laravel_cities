(function (window) {
    let marker;
    let map;
    let geocoder;

    let defaultOptions = {
        zoom  : 4,
        center: {lat: 50, lng: 10}
    };
    let cityOptions = {
        zoom: 10
    };


    window.init = function () {
        let options;

        let strLatitude = $('#latitude').val();
        let latitude = Number(strLatitude);
        let strLongitude = $('#longitude').val();
        let longitude = Number(strLongitude);

        let isLocationSet = strLatitude !== '' && !isNaN(latitude)
            && strLatitude !== '' && !isNaN(longitude);

        if (isLocationSet) {
            cityOptions.center = {lat: latitude, lng: longitude};
            options = cityOptions;
        } else {
            options = defaultOptions;
        }

        geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(
            document.getElementById('map'),
            options
        );

        if (isLocationSet) {
            marker = new google.maps.Marker({
                map     : map,
                position: options.center
            });
        } else {
            marker = new google.maps.Marker()
        }
    };


    $(function () {
        $('#search-for-address').click(function (e) {
            e.preventDefault();

            let address = $('#address').val();

            geocoder.geocode({'address': address}, function (results, status) {
                marker.setMap(null);

                if (results.length > 0) {
                    cityOptions.center = results[0].geometry.location;
                    map.setOptions(cityOptions);

                    marker = new google.maps.Marker({
                        map     : map,
                        position: cityOptions.center
                    });

                    $('#latitude').val(Number(cityOptions.center.lat().toFixed(6)));
                    $('#longitude').val(Number(cityOptions.center.lng().toFixed(6)));
                } else {
                    map.setOptions(defaultOptions);

                    $('#latitude').val('');
                    $('#longitude').val('');
                }
            });
        });
    });
})(window);
