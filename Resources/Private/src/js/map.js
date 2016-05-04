var BwrkMarkerMap = {
    map: {
        id: null,
        options: {
            center: {
                lat: null,
                lng: null
            },
            zoom: null,
            styles: [{
                "featureType": "water",
                "elementType": "geometry.fill",
                "stylers": [{"color": "#d3d3d3"}]
            }, {
                "featureType": "transit",
                "stylers": [{"color": "#808080"}, {"visibility": "off"}]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers": [{"visibility": "on"}, {"color": "#b3b3b3"}]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [{"color": "#ffffff"}]
            }, {
                "featureType": "road.local",
                "elementType": "geometry.fill",
                "stylers": [{"visibility": "on"}, {"color": "#ffffff"}, {"weight": 1.8}]
            }, {
                "featureType": "road.local",
                "elementType": "geometry.stroke",
                "stylers": [{"color": "#d7d7d7"}]
            }, {
                "featureType": "poi",
                "elementType": "geometry.fill",
                "stylers": [{"visibility": "on"}, {"color": "#ebebeb"}]
            }, {
                "featureType": "administrative",
                "elementType": "geometry",
                "stylers": [{"color": "#a7a7a7"}]
            }, {
                "featureType": "road.arterial",
                "elementType": "geometry.fill",
                "stylers": [{"color": "#ffffff"}]
            }, {
                "featureType": "road.arterial",
                "elementType": "geometry.fill",
                "stylers": [{"color": "#ffffff"}]
            }, {
                "featureType": "landscape",
                "elementType": "geometry.fill",
                "stylers": [{"visibility": "on"}, {"color": "#efefef"}]
            }, {
                "featureType": "road",
                "elementType": "labels.text.fill",
                "stylers": [{"color": "#696969"}]
            }, {
                "featureType": "administrative",
                "elementType": "labels.text.fill",
                "stylers": [{"visibility": "on"}, {"color": "#737373"}]
            }, {
                "featureType": "poi",
                "elementType": "labels.icon",
                "stylers": [{"visibility": "off"}]
            }, {
                "featureType": "poi",
                "elementType": "labels",
                "stylers": [{"visibility": "off"}]
            }, {
                "featureType": "road.arterial",
                "elementType": "geometry.stroke",
                "stylers": [{"color": "#d6d6d6"}]
            }, {
                "featureType": "road",
                "elementType": "labels.icon",
                "stylers": [{"visibility": "off"}]
            }, {
                "featureType": "poi",
                "elementType": "geometry.fill",
                "stylers": [{"color": "#dadada"}]
            }]
        },
        googleElement: null
    },
    geoCoder: null,
    distanceMatrix: null,
    geoCodeMarkers: [],
    searchBox: null,
    customMarkerIcon: null,
    markers: null,
    init: function () {
        var mapDiv = document.getElementById(this.map.id);
        this.map.googleElement = new google.maps.Map(mapDiv, this.map.options);

        this.geoCoder = new google.maps.Geocoder();
        this.distanceMatrix = new google.maps.DistanceMatrixService();
        this.searchBox = $('#' + this.map.id).parent('.tx-bwrk-markermap').find('.tx-bwrk-markermap__searchbox');

        var that = this;
        this.markers.forEach(function (element, index) {
            var tmpMarker = new google.maps.Marker({
                position: element.position,
                map: that.map.googleElement,
                title: element.title,
                icon: element.icon,
                marker_id: element.uid
            });
            tmpMarker.addListener('click', function () {
                $.ajax({
                    method: "GET",
                    url: "index.php",
                    data: {
                        'eID': 'bwrkMarkerWindow',
                        'tx_bwrkmarkermap_pi2[uid]': tmpMarker.marker_id
                    }
                }).done(function (content) {
                    new google.maps.InfoWindow({
                        content: content
                    }).open(that.map.googleElement, tmpMarker);
                });
            });
        });

        this.searchBox.find('form').submit(function () {
            var inputValue = $(this).find('input[name="tx-bwrk-markermap__searchbox-input"]').val();
            that.codeAddress(inputValue);
            return false;
        });

    },
    codeAddress: function (address) {
        var that = this;
        this.geoCoder.geocode({
                'address': address,
                'region': 'de'
            },
            function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    that.setMapOnAll(that.geoCodeMarkers, null);

                    var result = results[0];
                    var nearestMarkerObject = that.measureDistance(result.geometry.location);
                    var nearestMarker = new google.maps.Marker({
                        position: nearestMarkerObject.position
                    });
                    var locationMarker = new google.maps.Marker({
                        map: that.map.googleElement,
                        position: result.geometry.location,
                        icon: that.customMarkerIcon
                    });
                    that.geoCodeMarkers.push(locationMarker);

                    var markers = [];
                    markers[0] = locationMarker;
                    markers[1] = nearestMarker;
                    that.fitBounds(markers);
                }
            });
    },
    measureDistance: function (origin) {
        var lat = origin.lat();
        var lng = origin.lng();
        var R = 6371; // radius of earth in km
        var distances = [];
        var closest = -1;
        var that = this;

        for (i = 0; i < this.markers.length; i++) {
            var mlat = that.markers[i].position.lat;
            var mlng = that.markers[i].position.lng;
            var dLat = that.rad(mlat - lat);
            var dLong = that.rad(mlng - lng);
            var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(that.rad(lat)) * Math.cos(that.rad(lat)) * Math.sin(dLong / 2) * Math.sin(dLong / 2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            var d = R * c;
            distances[i] = d;
            if (closest == -1 || d < distances[closest]) {
                closest = i;
            }
        }
        return this.markers[closest];
    },
    setMapOnAll: function (markers, map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    },
    rad: function (x) {
        return x * Math.PI / 180;
    },
    fitBounds: function (markers) {
        var bounds = new google.maps.LatLngBounds();
        for (var i = 0; i < markers.length; i++) {
            bounds.extend(markers[i].getPosition());
        }
        this.map.googleElement.fitBounds(bounds);
    }
};
