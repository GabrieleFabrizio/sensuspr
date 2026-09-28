

/**
 * Chiamata Ajax 
 */
function ajaxCall(target, data, refresh){
	if (window.csrfToken) { data.csrf = window.csrfToken; }
	url = window.applicationURL + "index.php?" + $.param(data) + "&ajax=true";
	$.ajax({
			url: url
		, 	data: data
		,	beforeSend: function(jqXHR) {
				jqXHR.overrideMimeType("text/html;charset=UTF-8"); //iso-8859-1
        	}
	})
	  .done(function( data ) {
	    if (refresh)
	    	$("#"+target).html($("#"+target, data).html());
	    else
	    	$("#"+target).html(data);
	  });
}


function ajaxCallPlain(data){
	if (window.csrfToken) { data.csrf = window.csrfToken; }
	url = window.applicationURL + "index.php?" + $.param(data) + "&ajax=true";
	$.ajax({
			url: url
		, 	data: data
		,	beforeSend: function(jqXHR) {
				jqXHR.overrideMimeType("text/html;charset=UTF-8"); //iso-8859-1
        	}
	})
	  .done(function( data ) {
	  });
}

function ajaxCallPlainRedirect(data,link){
	if (window.csrfToken) { data.csrf = window.csrfToken; }
	url = window.applicationURL + "index.php?" + $.param(data) + "&ajax=true";
	$.ajax({
			url: url
		, 	data: data
		,	beforeSend: function(jqXHR) {
				jqXHR.overrideMimeType("text/html;charset=UTF-8"); //iso-8859-1
        	}
	})
	  .done(function() {
		console.log(link);
		window.location.href = link;
	  });
}

/**
 * Loader ajax
 */
$( document ).ajaxStart(function(e) {
       // console.log(e);
	  $( ".modalAjaxLoader" ).show();
	}).ajaxStop(function() {
		$( ".modalAjaxLoader" ).hide();
	});