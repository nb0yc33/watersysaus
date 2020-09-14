<html>
    <head>  
    	<meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<title> Water Systems Australia </title>
    	<link rel="stylesheet" href="css/civilian-page.css">
    	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
     	integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
         crossorigin=""/>
         <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
     	integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
         crossorigin=""></script>

    <?php include("header.php"); ?>        
    </head>
    <body>    

    <div class="Vision">
       
    </div>

        <div class="control">
            <div class="controls">
                <a href="#" class="menu_button"><svg width="2.5em" height="2.5em" viewBox="0 0 16 16" class="bi bi-file-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM8.5 6a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V10a.5.5 0 0 0 1 0V8.5H10a.5.5 0 0 0 0-1H8.5V6z"/>
                </svg></a>
                <a href="#" class="menu_button"><svg width="2.5em" height="2.5em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                </svg></a>
                <a href="#" class="menu_button"><svg width="2.5em" height="2.5em" viewBox="0 0 16 16" class="bi bi-exclamation-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                </svg></a>
                
                
            </div>
            <div class="map" id="map_id"></div>
        </div>
    
    <section>
        <div class="wave wave1"></div>
        <div class="wave wave2" ></div>
        <div class="wave wave3"></div>
        <div class="wave wave4"></div>
    </section>

    </body>
    <script>
    	let mymap = L.map('map_id').setView([-27.47, 153.02], 14);
    	L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    	attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    	maxZoom: 18,
    	id: 'mapbox/streets-v11',
    	tileSize: 512,
    	zoomOffset: -1,
    	accessToken: 'pk.eyJ1Ijoicy1uYXJsbyIsImEiOiJja2Vod3F3Z3UwZXN6MnJvaHNneWhyNWRoIn0.Bix4XksIzlP276mM3_Bd0g'
    	}).addTo(mymap);
    </script>
    <script type="text/javascript">
        const buttons = document.querySelectorAll('a.menu_button');
        buttons.forEach(btn => {
            btn.addEventListener('click', function (e) {
                let x = e.clientX - e.target.offsetLeft;
                let y = e.clientY - e.target.offsetTop;

                let ripples = document.createElement('span');
                ripples.style.left = x + "px";
                ripples.style.top = y + "px";
                this.appendChild(ripples);

                setTimeout(() => {
                    ripples.remove()
                }, 1000);
            })
        })
    </script>
</html>
























