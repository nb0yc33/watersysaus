
// Icon variables 
var redIcon = L.icon({ // red is for test sites not yet tested
    iconUrl: "images/Red_Marker_New.png",
    iconSize: [25, 50],
    iconAnchor: [12, 48],
    popupAnchor: [-25, -50],
    });

var orangeIcon = L.icon({ // orange is for pending tests
    iconUrl: "images/Orange_Marker_New.png",
    iconSize: [25, 50],
    iconAnchor: [12, 48],
    popupAnchor: [-25, -50],
    });

var greenIcon = L.icon({ // green is for completed tests
    iconUrl: "images/Green_Marker_New.png",
    iconSize: [25, 50],
    iconAnchor: [12, 48],
    popupAnchor: [-25, -50],
    });


let map = L.map('mapid').setView([-27.47, 153.02], 10);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1Ijoicy1uYXJsbyIsImEiOiJja2Vod3F3Z3UwZXN6MnJvaHNneWhyNWRoIn0.Bix4XksIzlP276mM3_Bd0g'
}).addTo(map);

// The map search functionality (SEB)
var arcgisOnline = L.esri.Geocoding.arcgisOnlineProvider(); // search provider
  L.esri.Geocoding.geosearch({
    providers: [
      arcgisOnline,
    ]
  }).addTo(map);

// Convert Table to JSON object
var tableToObj = function(table) {
    var rows = table.rows,
    row_length = rows.length,
    i = 0,
    j = 0,
    keys = [],
    obj, list = [];
    for (; i < row_length; i++) {
        if (i == 0) {
        for (; j < rows[i].children.length; j++) {
            keys.push(rows[i].children[j].innerHTML);
        }
    } else {
        obj = {};
        for (j = 0; j < rows[i].children.length; j++) {
            obj[keys[j]] = rows[i].children[j].innerHTML;
        }
        list.push(obj);
    }
}
return list;
};

function getTableLength(table) {
    var rows = table.rows,
    row_length = rows.length
    return row_length;
}

function addMarkers() {
    let tableLength = getTableLength(document.getElementById('data-table')); 
    let tableContents = tableToObj(document.getElementById('data-table'));

    for (let i = 0; i < tableLength - 1; i++) {
        var lat = tableContents[i].Latitude; // the longitude
        var long = tableContents[i].Longitude; // the latitude
        var status = tableContents[i].TestStatus; // the test status    
        if (status == 0) {
            L.marker([lat, long], {icon: redIcon}).addTo(map);
        } else if (status == 1) {
            L.marker([lat, long], {icon: orangeIcon}).addTo(map);
        } else {
            L.marker([lat, long], {icon: greenIcon}).addTo(map);
        }
    }   
}
//loads the markers
addMarkers();