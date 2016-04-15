var MarkerMap = {
    entityUid: null,
    modelName: null,
    addressFieldName: null,
    defaultLat: null,
    defaultLng: null,
    geoCoder: null,
    init: function(mapId)
    {
        this.initMap(mapId);
        this.initGeoCoder();
        //this.reverseGeoCode(this.defaultLat, this.defaultLng, this.addressFieldName);
        this.eventOnDrag();
    },
    marker: null,
    map: null,
    initMap: function(mapId)
    {
        this.map = new google.maps.Map(document.getElementById(mapId), this.getOptions());
        this.marker = this.defaultMarker();
    },
    initGeoCoder: function()
    {
        this.geoCoder = new google.maps.Geocoder();
    },
    getOptions: function()
    {
        return {
            lat: this.defaultLat,
            zoom: 13,
            center: this.mapOrigin(),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        };
    },
    mapOrigin: function()
    {
        return new google.maps.LatLng(this.defaultLat, this.defaultLng);
    },
    defaultMarker: function()
    {
        return new google.maps.Marker({
            map: this.map,
            position: this.mapOrigin(),
            draggable: true
        });
    },
    refreshMap: function()
    {
        google.maps.event.trigger(this.map, 'resize');
        //Ext.fly(TxBwrkMarkermap.tabPrefix + '-MENU').un('click', TxBwrkMarkermap.refreshMap);
    },
    reverseGeoCode:  function(lat, lng, addressFieldName) {
        var latLng = new google.maps.LatLng(lat, lng);
        this.geoCoder.geocode({'latLng': latLng}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK && results[1] && typeof addressFieldName != 'undefined') {
                var address = document.getElementsByName(addressFieldName)[0];
                address.value = results[1].formatted_address;
            }
        });
    },
    codeAddress : function() {
        // called with button click
        var that = this;
        var addressValue = document.getElementsByName('data['+MarkerMap.modelName+']['+MarkerMap.entityUid+'][address]')[0].value;
        var zipValue = document.getElementsByName('data['+MarkerMap.modelName+']['+MarkerMap.entityUid+'][zip]')[0].value;
        var cityValue = document.getElementsByName('data['+MarkerMap.modelName+']['+MarkerMap.entityUid+'][city]')[0].value;
        var countryCodeValue = document.getElementsByName('data['+MarkerMap.modelName+']['+MarkerMap.entityUid+'][country_code]')[0].value;
        var address = addressValue+', '+countryCodeValue+' '+zipValue+' ' + cityValue;

        this.geoCoder.geocode({'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {

                var lat = results[0].geometry.location.lat();
                var lng = results[0].geometry.location.lng();

                // Update fields
                that.fields.set(lat, lng);

                that.map.setCenter(results[0].geometry.location);
                that.marker.setPosition(results[0].geometry.location);
            } else {
                alert("Die Geocodierung hat einen Fehler: " + status);
            }
        });
    },
    fields: {
        lat: null,
        lng: null,
        set: function(lat, lng) {
            this.lat = lat;
            this.lng = lng;

            var fieldName = 'data['+MarkerMap.modelName+']['+MarkerMap.entityUid+']';

            document.getElementsByName(fieldName+'[lat]')[0].value = lat;
            document.querySelectorAll('[data-formengine-input-name="'+fieldName+'[lat]"]')[0].value = lat;

            document.getElementsByName(fieldName+'[lng]')[0].value = lng;
            document.querySelectorAll('[data-formengine-input-name="'+fieldName+'[lng]"]')[0].value = lng;
        }
    },
    eventOnDrag: function()
    {
        var that = this;

        google.maps.event.addListener(this.marker, 'dragend', function() {
            var marker = that.marker;
            var markerPosition = marker.getPosition();

            var lat = markerPosition.lat().toFixed(6);
            var lng = markerPosition.lng().toFixed(6);

            // Update Fields
            that.fields.set(lat, lng);

            // Update address
            //that.reverseGeoCode(markerPosition.lat(), markerPosition.lng());
        });
    }

};