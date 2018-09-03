(function (window) {
    let marker;
    let map;
    let geocoder;
    let defaultCenter = {lat: 50, lng: 10};


    window.init = function () {
        geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(
            document.getElementById('map'),
            {
                zoom  : 4,
                center: defaultCenter
            }
        );

        let address = $('#address').val();
        if (address !== '') {
            getAddressInfo(address);
        }
    };


    $(function () {
        $('#search-for-address').click(function (e) {
            e.preventDefault();

            getAddressInfo($('#address').val());
        });
    });

    function getAddressInfo(address) {
        geocoder.geocode({'address': address}, function (results, status) {
            if (results.length > 0) {
                map.setCenter(results[0].geometry.location);
                map.setZoom(8);
                marker = new google.maps.Marker({
                    map     : map,
                    position: results[0].geometry.location
                });

                $('#latitude').val(results[0].geometry.location.lat);
                $('#longitude').val(results[0].geometry.location.lng);

                $('#submit-button').prop("disabled", false);
            } else {
                map.setCenter(defaultCenter);
                map.setZoom(4);
                marker.setMap(null);

                $('#latitude').val('');
                $('#longitude').val('');

                $('#submit-button').prop("disabled", true);
            }
        });
    }
})(window);
