<script>
    $(document).ready(function(){
		
	  // Suggerire film
		$("#sugg_on").click(function(){

			target = "sugg_film" + $(this).attr("id_film");
			
			var params = { 
					page: "cinema"
				, 	step: "likeFilm"
				, 	idFilm: $(this).attr("id_film")
				,	dinizio: $(this).attr("dinizio")
				,	ngiorni: $(this).attr("ngiorni")
				,	num_sugg: $(this).attr("num_sugg")
				,	flag_suggest: "on"
			};

			ajaxCall(target, params);
		});
		
	  // Rimuovere suggerimento film
		$("#sugg_off").click(function(){

			target = "sugg_film" + $(this).attr("id_film");
			
			var params = { 
					page: "cinema"
				, 	step: "likeFilm"
				, 	idFilm: $(this).attr("id_film")
				,	dinizio: $(this).attr("dinizio")
				,	ngiorni: $(this).attr("ngiorni")
				,	num_sugg: $(this).attr("num_sugg")
				,	flag_suggest: "off"
			};

			ajaxCall(target, params);
		});
		
	});   
</script>