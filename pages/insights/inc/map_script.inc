<script>

function visualizzaScheda(idScheda,i)
{
	var params = { page: "cinema",step:"SchedaFilm",id:idScheda,idx:i};
	ajaxCall("schedafilm", params);
}

function visualizzaScheda1(idScheda,i)
{
	$.ajax({
	     type: "POST",
	     url: "subindex.php?page=cinema&step=SchedaFilm&id="+idScheda+"&idx="+i,
	     //url: "pages/cinema/SchedaFilm.php?id="+idScheda+"&idx="+i,
	     //url: "pages/cinema/controller.php?page=cinema&step=SchedaFilm&id="+idScheda+"&idx="+i+"&action=GetFilm",
	     data:  "id="+idScheda+"&idx="+i,
	     success: function(msg){
	    	 //jQuery("body").html(msg);


	    	 $('#schedafilm').html(msg);

	    		
	          alert( "Dati salvati: " + msg +"|"+idScheda+"|" + i );
	     },
	 	error: function (xhr, ajaxOptions, thrownError) {
	        alert(xhr.status);
	        alert(thrownError);
	      }
	});
}





 //<![CDATA[
var gmarkers = [];



function showMap()
{
    if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map_canvas"));                
        map.addControl(new GSmallMapControl());	     
		// Aggiunge una barra di controllo che permette tre tipi di visualizzazione: mappa, setellite e ibrida 
		map.addControl(new GMapTypeControl()); 
		// centra la mappa in questo punto (Lodi) con lo zoom a 10
        map.setCenter(new GLatLng(45.31695,9.506873), 9);   


	var icons = []; 

	// assegna alla variabile icons["topix"] tramite la funzione GIcon l'immagine "iconMap.png" (che è presente nella stessa directory del sorgente). 
	icons["topix"] = new GIcon(G_DEFAULT_ICON, "http://maps.gstatic.com/mapfiles/icon_green.png"); 
	// invio alla funzione che crea il Marker come secondo valore la variabile dell'icona 

	// ------------  Multisala Pieve Fissiraga --------------
		point_Pieve=new GLatLng(45.27550552943533, 9.456052780151367);

	var marker_Pieve = new GMarker(point_Pieve,icons["topix"]); 

	// Our info window content
    info_Pieve = "<a href=\'http://www.cinelandia.it/pieve-fissiraga-lo.html\' target=\'_blank\'><img src=\'imgs/PI_piccolo.jpg\'><br/><b><u>Multiplex Cinelandia Pieve</u></b></a><br/>Viale Nazioni Unite, 59 - Pieve Fissiraga<br/>6 sale, tel. 0371237012<br/> Prenotazioni: <b> 89.90.30.820</b>";
//	film_Pieve="<img src=\'imgs/locandina_mini_choice.jpg\' title=\'Titolochoice\' title=\'Titolo della VV choice\' />&nbsp;<img src=\'imgs/locandina_mini_1.jpg\' title=\'Titolo_1\' title=\'Titolo del film 1\' />&nbsp;<img src=\'imgs/locandina_mini_2.jpg\' title=\'Titolo_2\' title=\'Titolo del film 2\' />&nbsp;<br/><img src=\'imgs/locandina_mini_3.jpg\' title=\'Titolo_3\' title=\'Titolo del film 3\' '/>&nbsp;<img src=\'imgs/locandina_mini_4.jpg\' title=\'Titolo_4\' title=\'Titolo del film 4\'/>";
	
	//film_Pieve=palinsestoPieve;

	var infoTabs_Pieve = [
	  new GInfoWindowTab("Info", info_Pieve)//,
	 // new GInfoWindowTab("Film", film_Pieve)
	];

	marker_Pieve.myname="marker_Pieve";


	GEvent.addListener(marker_Pieve, "click", function() {
	  marker_Pieve.openInfoWindowTabsHtml(infoTabs_Pieve);
	});

    // Aggiunge il Marker 
    map.addOverlay(marker_Pieve);
	gmarkers.push(marker_Pieve);
	marker_Pieve.openInfoWindowTabsHtml(infoTabs_Pieve);


	// ------------  Cinema Lodi ----------------------------
		point_Lodi=new GLatLng(45.31695,9.506873);

	var marker_Lodi = new GMarker(point_Lodi,icons["topix"]); 

	// Our info window content
    info_Lodi = "<a href=\'http://www.cinemamodernolodi.it\' target=\'_blank\'><img src=\'imgs/LO_piccolo.jpg\'><br/><b><u>Multisala Cinema Moderno</u></b></a><br/>Corso Adda, 97 - Lodi<br/>2 sale, tel. 0371420017";
//	film_Lodi="<img src=\'imgs/locandina_mini_choice.jpg\' title=\'Titolochoice\' title=\'Titolo della VV choice\' />&nbsp;<img src=\'imgs/locandina_mini_1.jpg\' title=\'Titolo_1\' title=\'Titolo del film 1\'/>&nbsp;<img src=\'imgs/locandina_mini_2.jpg\' title=\'Titolo_4\' title=\'Titolo del film 4\' />&nbsp;<br/><img src=\'imgs/locandina_mini_3.jpg\' title=\'Titolo_5\' title=\'Titolo del film 5\' />";
	//film_Lodi=palinsestoLodi;

	var infoTabs_Lodi = [
	  new GInfoWindowTab("Info", info_Lodi)//,
	  // new GInfoWindowTab("Film", film_Lodi)
	];

	GEvent.addListener(marker_Lodi, "click", function() {
	  marker_Lodi.openInfoWindowTabsHtml(infoTabs_Lodi);
	});

	marker_Lodi.myname="marker_Lodi";
    // Aggiunge il Marker 
    map.addOverlay(marker_Lodi);
	gmarkers.push(marker_Lodi);
	marker_Lodi.openInfoWindowTabsHtml(infoTabs_Lodi);

	// --------------  Cinema Melzo -------------------------
		point_Melzo=new GLatLng(45.499706,9.419595);

	var marker_Melzo = new GMarker(point_Melzo,icons["topix"]); 

	// Our info window content
    info_Melzo = "<a href=\'http://www.arcadiacinema.com/index.php?id_menu=20\' target=\'_blank\'><img src=\'imgs/ME_piccolo.jpg\'><br/><b><u>Multiplex Arcadia Melzo</u></b></a><br/>Via Martiri delle Libertà - Melzo<br/>5 sale, tel. 0295416445";
//	film_Melzo="<img src=\'imgs/locandina_mini_choice.jpg\' title=\'Titolochoice\' title=\'Titolo della VV choice\'/>&nbsp;<img src=\'imgs/locandina_mini_1.jpg\' title=\'Titolo_1\' title=\'Titolo del film 1\'/>&nbsp;<img src=\'imgs/locandina_mini_2.jpg\' title=\'Titolo_2\' title=\'Titolo del film 2\'/><br/><img src=\'imgs/locandina_mini_3.jpg\' title=\'Titolo_3\' title=\'Titolo del film 3\'/>&nbsp;<img src=\'imgs/locandina_mini_5.jpg\' title=\'Titolo_5\' title=\'Titolo del film 5\'/>&nbsp;<img src=\'imgs/locandina_mini_6.jpg\' title=\'Titolo_6\' title=\'Titolo del film 6\'/>";
	//film_Melzo=palinsestoMelzo;

	var infoTabs_Melzo = [new GInfoWindowTab("Info", info_Melzo)//,
	                  	//new GInfoWindowTab("Film", film_Melzo)
		                  	];

	GEvent.addListener(marker_Melzo, "click", function() {
	  marker_Melzo.openInfoWindowTabsHtml(infoTabs_Melzo);
	});

	marker_Melzo.myname="marker_Melzo";

    // Aggiunge il Marker 
    map.addOverlay(marker_Melzo);
	gmarkers.push(marker_Melzo);
	marker_Melzo.openInfoWindowTabsHtml(infoTabs_Melzo);

//--------------  Cinema Cremona -------------------------
		point_Cremona=new GLatLng(45.15036471848606,9.999843835830688);

	var marker_Cremona = new GMarker(point_Cremona,icons["topix"]); 

	// Our info window content
    info_Cremona = "<a href=\'http://www.spaziocinemacremona.it/' target=\'_blank\'><img src=\'imgs/CR_piccolo.jpg\'><br/><b><u>SpazioCinema Cremona Po</u></b></a><br/>Via Castelleone 108 - Cremona<br/>7 sale, tel. 372803675";
	//film_Cremona=palinsestoCremona;

	var infoTabs_Cremona = [
	new GInfoWindowTab("Info", info_Cremona)//,
	//new GInfoWindowTab("Film", film_Cremona)
	];

	GEvent.addListener(marker_Cremona, "click", function() {
	  marker_Cremona.openInfoWindowTabsHtml(infoTabs_Cremona);
	});
	marker_Cremona.myname="marker_Cremona";
    // Aggiunge il Marker 
    map.addOverlay(marker_Cremona);
	gmarkers.push(marker_Cremona);
	marker_Cremona.openInfoWindowTabsHtml(infoTabs_Cremona);
	
	// --------------  Cinema Treviglio -------------------------
    point_Treviglio=new GLatLng(45.51907528594105,9.583039283752441);

	var marker_Treviglio = new GMarker(point_Treviglio,icons["topix"]); 

	// Our info window content
    info_Treviglio = "<a href=\'http://www.aristonmultisala.it/' target=\'_blank\'><img src=\'imgs/TR_piccolo.jpg\'><br/><b><u>Ariston Multisala</u></b></a><br/>Viale Monte Grappa - Treviglio<br/>6 sale, tel. 0363.419503";
	//film_Treviglio=palinsestoTreviglio;

	var infoTabs_Treviglio = [
	new GInfoWindowTab("Info", info_Treviglio)//,
	//new GInfoWindowTab("Film", film_Treviglio)
	];

	GEvent.addListener(marker_Treviglio, "click", function() {
	  marker_Treviglio.openInfoWindowTabsHtml(infoTabs_Treviglio);
	});
	marker_Treviglio.myname="marker_Treviglio";
    // Aggiunge il Marker 
    map.addOverlay(marker_Treviglio);
	gmarkers.push(marker_Treviglio);
	marker_Treviglio.openInfoWindowTabsHtml(infoTabs_Treviglio);
	
				

	// ------------  Multisala Portanova Crema --------------
		point_Portanova=new GLatLng(45.36921246825939, 9.68019962310791);

	var marker_Portanova = new GMarker(point_Portanova,icons["topix"]); 
       
	// Our info window content
    info_Portanova = "<a href=\'http://www.multisalaportanova.it/10020\' target=\'_blank\'><img src=\'imgs/PO_piccolo.jpg\'><br/><b><u>Multisala Portanova</u></b></a><br/>Via Indipendenza, 40 - Crema<br/>5 sale, tel. 0373218411";
//	film_Portanova="<img src=\'imgs/locandina_mini_choice.jpg\' title=\'Titolochoice\' title=\'Superman Returns\'/>&nbsp;<img src=\'imgs/locandina_mini_1.jpg\' title=\'Titolo_1\' title=\'Titolo del film 1\'/>&nbsp;<img src=\'imgs/locandina_mini_2.jpg\' title=\'Titolo_2\' title=\'Titolo del film 2\'/><br/><img src=\'imgs/locandina_mini_3.jpg\' title=\'Titolo_3\' title=\'Titolo del film 3\'/>&nbsp;<img src=\'imgs/locandina_mini_4.jpg\' title=\'Titolo_4\' title=\'Titolo del film 4\'/>&nbsp;<img src=\'imgs/locandina_mini_5.jpg\' title=\'Titolo_5\' title=\'Titolo del film 5\'>&nbsp;<img src=\'imgs/locandina_mini_6.jpg\' title=\'Titolo_6\' title=\'Titolo del film 6\' />";

	//film_Portanova= palinsestoPortanova;

	var infoTabs_Portanova = [	  
	  new GInfoWindowTab("Info", info_Portanova),
	  // new GInfoWindowTab("Film", film_Portanova)
	];


	GEvent.addListener(marker_Portanova, "click", function() {
	  marker_Portanova.openInfoWindowTabsHtml(infoTabs_Portanova);
	});

	marker_Portanova.myname="marker_Portanova";
    // Aggiunge il Marker
	map.addOverlay(marker_Portanova);
	gmarkers.push(marker_Portanova);
	marker_Portanova.openInfoWindowTabsHtml(infoTabs_Portanova);


    }
}

//]]>



	$(document).ready(function(){
		showMap();
		
		visualizzaScheda($('#VVChoice').html(),'0');
		});				

</script>