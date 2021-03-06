function initialize(n, t) {
    var f, r, i, e, u;
    try {
        infowindow = new google.maps.InfoWindow;
        f = {
            scrollwheel: !1,
            zoom: 14,
            center: new google.maps.LatLng(n, t),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map_canvas"), f);
        (n == "" || t == "" || n == null || t == null) && (n = 21.0287974, t = 105.8523542);
        r = new google.maps.LatLng(n, t);
        marker = new google.maps.Marker({
            map: map,
            position: r,
            draggable: !0
        });
        map.setCenter(r);
        i = new google.maps.Marker({
            icon: {
                path: "M -3,0 0,-3 3,0 0,3 z",
                strokeColor: "#cec9c1",
                scale: 3
            },
            map: map,
            position: new google.maps.LatLng(10.871692, 106.535366)
        });
        google.maps.event.addListener(map, "zoom_changed", function() {
            var n = map.getZoom();
            n <= 17 ? n == 15 ? i.setMap(map) : i.setMap(null) : i.setMap(map)
        });
        e = '<style>a{text-decoration: none;color: blue}<\/style><div id="content"><div id="siteNotice"><\/div><strong id="firstHeading" class="firstHeading">Công ty bất động sản Trần Anh<\/strong><div id="bodyContent">phan văn hớn quận 12, 58a cầu Lớn, Xuân Thới Thượng, Hóc Môn, Ho Chi Minh City, Vietnam<p><a href="http://datnengiatot.net" target="_blank" rel="nofollow">datnengiatot.net<\/a><\/p><p><a href="https://plus.google.com/111846113810994069762/about?socpid=238&socfid=maps_api_v3:smartmapsiw">more info<\/a><\/p><\/div><\/div>';
        u = new google.maps.InfoWindow({
            content: e
        });
        google.maps.event.addListener(i, "click", function() {
            u != null && u.open(map, i)
        });
        google.maps.event.addListener(map, "click", function(n) {
            placeMarker(n.latLng)
        });
        google.maps.event.addListener(marker, "dragstart", function() {
            infowindow != null && infowindow.close()
        });
        google.maps.event.addListener(marker, "dragend", getAddress);
        geocoder = new google.maps.Geocoder;
        getAddress()
    } catch (o) {}
}

function initializeAddress(n, t, i) {
    var e, u, r, o, f;
    try {
        n != "0" && t != "0" ? (infowindow = new google.maps.InfoWindow, e = {
            scrollwheel: !1,
            zoom: 14,
            center: new google.maps.LatLng(n, t),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }, map = new google.maps.Map(document.getElementById("map_canvas"), e), (n == "" || t == "" || n == null || t == null) && (n = 21.0287974, t = 105.8523542), u = new google.maps.LatLng(n, t), marker = new google.maps.Marker({
            map: map,
            position: u,
            draggable: !0
        }), map.setCenter(u), google.maps.event.addListener(map, "click", function(n) {
            placeMarker(n.latLng)
        }), google.maps.event.addListener(marker, "dragstart", function() {
            infowindow != null && infowindow.close()
        }), google.maps.event.addListener(marker, "dragend", getAddress), r = new google.maps.Marker({
            icon: {
                path: "M -3,0 0,-3 3,0 0,3 z",
                strokeColor: "#cec9c1",
                scale: 3
            },
            map: map,
            position: new google.maps.LatLng(10.871692, 106.535366)
        }), google.maps.event.addListener(map, "zoom_changed", function() {
            var n = map.getZoom();
            n <= 17 ? n == 15 ? r.setMap(map) : r.setMap(null) : r.setMap(map)
        }), o = '<style>a{text-decoration: none; color: blue}<\/style><div id="content"><div id="siteNotice"><\/div><strong id="firstHeading" class="firstHeading">Công ty bất động sản Trần Anh<\/strong><div id="bodyContent">phan văn hớn quận 12, 58a cầu Lớn, Xuân Thới Thượng, Hóc Môn, Ho Chi Minh City, Vietnam<p><a href="http://datnengiatot.net" target="_blank" rel="nofollow">datnengiatot.net<\/a><\/p><p><a href="https://plus.google.com/111846113810994069762/about?socpid=238&socfid=maps_api_v3:smartmapsiw">more info<\/a><\/p><\/div><\/div>', f = new google.maps.InfoWindow({
            content: o
        }), google.maps.event.addListener(r, "click", function() {
            f != null && f.open(map, r)
        }), geocoder = new google.maps.Geocoder, showAdd(i)) : $("#map_canvas").css("display", "none")
    } catch (s) {
        console.log(s)
    }
}

function placeMarker(n) {
    try {
        marker.setMap(null);
        marker = new google.maps.Marker({
            position: n,
            map: map,
            draggable: !0
        });
        google.maps.event.addListener(marker, "dragstart", function() {
            infowindow != null && infowindow.close()
        });
        google.maps.event.addListener(marker, "dragend", getAddress);
        map.setCenter(n);
        getAddress()
    } catch (t) {
        console.log(t)
    }
}

function showProjectLocation(n, t, i) {
    marker.setMap(null);
    map.setCenter(new google.maps.LatLng(n, t));
    document.getElementById("txtPositionX").value = n;
    document.getElementById("txtPositionY").value = t;
    marker = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(n, t),
        draggable: !0
    });
    n != "" && t != "" && n != 0 && t != 0 ? geocoder.geocode({
        latLng: new google.maps.LatLng(n, t)
    }, function(n, t) {
        t == google.maps.GeocoderStatus.OK && n != null && n[0] != null && (addressReturn = n[0].formatted_address, infowindow != null && (infowindow.setContent("<span id='address'><b>Địa chỉ : <\/b>" + i + "<\/span>"), infowindow.open(map, marker)))
    }) : showLocation(i);
    google.maps.event.addListener(marker, "dragstart", function() {
        infowindow != null && infowindow.close()
    });
    google.maps.event.addListener(marker, "dragend", getAddress)
}

function showLocation(n) {
    if (n != null && n != "") {
        var t = n.split(",");
        t.length >= 3 && $.trim(t[t.length - 3]).toLowerCase() == "thanh xuân" && (t[t.length - 3] = "Thanh Xuân Bắc");
        n = t.join(",");
        marker != null && marker.setMap(null);
        geocoder.geocode({
            address: n
        }, function(t, i) {
            i == google.maps.GeocoderStatus.OK && (map.setCenter(t[0].geometry.location), marker = new google.maps.Marker({
                map: map,
                position: t[0].geometry.location,
                draggable: !0
            }), document.getElementById("txtPositionX").value = t[0].geometry.location.lat(), document.getElementById("txtPositionY").value = t[0].geometry.location.lng(), addressReturn = t[0].formatted_address, infowindow != null && (infowindow.setContent("<span id='address'><b>Địa chỉ : <\/b>" + n + "<\/span>"), infowindow.open(map, marker)));
            google.maps.event.addListener(marker, "dragstart", function() {
                infowindow != null && infowindow.close()
            });
            google.maps.event.addListener(marker, "dragend", getAddress)
        })
    } else alert("Địa chỉ không hợp lệ")
}

function getAddress() {
    var r;
    try {
        var n = marker.getPosition(),
            t = n.lat(),
            i = n.lng();
        document.getElementById("txtPositionX").value = t;
        document.getElementById("txtPositionY").value = i;
        r = new google.maps.LatLng(t, i);
        geocoder.geocode({
            latLng: r
        }, function(n, t) {
            t == google.maps.GeocoderStatus.OK && n != null && n[0] != null && (addressReturn = n[0].formatted_address, infowindow != null && (infowindow.setContent("<span id='address'><b>Địa chỉ : <\/b>" + n[0].formatted_address + "<\/span>"), infowindow.open(map, marker)))
        });
        map.setCenter(n)
    } catch (u) {
        console.log(u)
    }
}

function showAdd(n) {
    var u;
    try {
        var t = marker.getPosition(),
            i = t.lat(),
            r = t.lng();
        document.getElementById("txtPositionX").value = i;
        document.getElementById("txtPositionY").value = r;
        u = new google.maps.LatLng(i, r);
        geocoder.geocode({
            latLng: u
        }, function(t, i) {
            i == google.maps.GeocoderStatus.OK && t[0] && (infowindow != null && (n != "" ? infowindow.setContent("<span id='address'><b>Địa chỉ : <\/b>" + n + "<\/span>") : infowindow.setContent("<span id='address'><b>Địa chỉ : <\/b>" + t[0].formatted_address + "<\/span>"), infowindow.open(map, marker)), addressReturn = t[0].formatted_address)
        });
        map.setCenter(t)
    } catch (f) {
        console.log(f)
    }
}

function strAddress() {
    return addressReturn
}

function strLatLng() {
    try {
        var n = $("#txtPositionX").val(),
            t = $("#txtPositionY").val();
        return n + "," + t
    } catch (i) {
        console.log(i)
    }
}

function ShowLocation() {
    var n = "",
        f = $("#hddcboCityP").val(),
        i = $("#hddcboDistP").val(),
        r = $("#hddcboStreetP").val(),
        u = $("#hddcboWardP").val(),
        t;
    $("#hddcboProjectP").val() <= 0 ? r != "" && r > 0 ? n = $("#ddlStreets option:selected").text() + ", " : u != "" && u > 0 && (n = n + $("#ddlWard option:selected").text() + ", ") : n = $("#ddlProjects option:selected").text() + ", " + n;
    i != "" && i > 0 && (n = n + $("#ddlDistrict option:selected").text() + ", ");
    f != "-1" && (n = n + $("#ddlCity option:selected").text() + " ");
    n = n + ", Việt Nam";
    t = strLatLng().split(",");
    $("#hddLatitude").val(t[0]);
    $("#hddLongtitude").val(t[1]);
    showLocation(n);
    $("#mapinfo").show()
}

function loadProjectMap(n) {
    var t = "",
        o = $("#hddcboCityP").val(),
        i = $("#hddcboDistP").val(),
        r = $("#hddcboStreetP").val(),
        u = $("#hddcboWardP").val(),
        f, e;
    n != "" && n != -1 ? t = $('#cboProjectP .pncontainer li[rel="' + n + '"]').html() + ", " + t : r != "" && r > 0 ? t = $('#cboStreetP .pncontainer li[rel="' + r + '"]').html() + ", " : u != "" && u > 0 && (t = t + $('#cboWardP .pncontainer li[rel="' + u + '"]').html() + ", ");
    i != "" && i > 0 && (t = t + $('#cboDistP .pncontainer li[rel="' + i + '"]').html() + ", ");
    o != "-1" && (t = t + $('#cboCityP .pncontainer li[rel="' + o + '"]').html() + " ");
    t = t + ", Việt Nam";
    initialize("", "");
    f = $('#cboProjectP .pncontainer li[rel="' + n + '"]').attr("lat");
    e = $('#cboProjectP .pncontainer li[rel="' + n + '"]').attr("lng");
    n != "" && n != -1 && f != "null" && e != "null" ? showProjectLocation(f, e, t) : showLocation(t)
}
var map = undefined,
    marker = null,
    geocoder, infowindow = null,
    addressReturn, latlngReturn;
$(function() {
    initializeAddress($("#hddLatitude").val(), $("#hddLongtitude").val(), $("#hddDiadiem").val())
});
//# sourceMappingURL=GoogleMapControl.min.js.map