/**
 * ajaxLoad::
 * @param page: pagina da caricare
 * @param container: container del DOM da sostituire
 * @param callback: funzione javascript da richiamare dopo il load
 */
function ajaxMenuLoad(page, container, callback){
	 $.get("index.php",{"page":page}, function(data) {
		 console.log(data);
		 alert($(data).find("#main").html());
		 $("#"+container).html(data);
	 });
}

$(document).ready(function (){
	
	$(".vivi-menu-item").click(function(){	
		//alert(0);
		//alert($(this).attr("page"));
		ajaxMenuLoad($(this).attr("page"), "main", null);	
	});
    
    var p = $("#container").position();
   // alert(p);
    
   
    
   

});

// funzione per inviare una mail che linka ad una pagina (nello specifico usata in Rubrica) del portale
function invia(tipo, titolo){
	var domaininvia='www.rivieramayapropertyconsultants.com';
	var urlinvia=document.location.href;
	var subjPrefix= tipo + " da "+domaininvia+": ";
	var bodyPrefix="Puoi trovare questo articolo all'indirizzo:\n\n";
	var bodyFooter="\n\n----------\n http://"+domaininvia+"/ : l'unico portale che offre informazioni sempre aggiornate sui locali di Crema e dintorni";
	var subj=escape(subjPrefix+titolo);
	var body=escape(bodyPrefix+urlinvia+bodyFooter);
	var popup=window.open("mailto:?subject="+subj+"&body="+body,"mail");
} 

// visualizza / nascondi element
function visualizza(id){
  if (document.getElementById){
    if(document.getElementById(id).style.display == 'none'){
 //     document.getElementById(id).style.visibility = 'visible';
      document.getElementById(id).style.display = 'block';
    }else{
//      document.getElementById(id).style.visibility = 'hidden';
      document.getElementById(id).style.display = 'none';
    }
  }
}


var key = "BAD4@.56CEGFHIJKLVWdfTUhijXYZbacemngMNOPQRSopqrstuvz018923klwxy7";
var base = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz@.0123456789";

// per inserire un indirizzo email vedi http://www.dynamicobjects.com/d2r/archives/js-encrypt.html
function generateMailLink(encoded, linkText)
{
  document.write("<a hr"+"ef=\"ma"+"ilto"+":"+decode(encoded)+"\">"
+linkText+"</"+"a>");
}

function decode(str)
{
  return codec(key, base, str);
}

function codec(from, to, str)
{
  var codedResult = "";
  for (i = 0; i < str.length; i++) {
    current = str.charAt(i);
    idx = from.indexOf(current);
    nextVal = (idx == -1) ? current : to.charAt(idx);
    codedResult += nextVal;
  }
  return codedResult;
}