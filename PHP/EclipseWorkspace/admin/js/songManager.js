global_refresh = null;

$(function(){
	
	//var selectedArtistId;
	/*
    $('#drag').draggable(); // appel du plugin
   
    $("#click").click(function( event ) {
    	alert("As you can see, the link no longer took you to jquery.com");
    	event.preventDefault();
    	
    	});
 	*/
	
	
	
	$('select#sMgr_artist').change(function() {
		//alert("test");
		selLetterChanged(this);
	});
	
	$('select#artistSelect').change(function() {
		//alert("test");
		selArtistChanged(this);
	});
	
	$('select#songSelect').change(function() {
		//alert("test");
		selSongChanged(this);
	});
	
	function selLetterChanged(Balise){
		$('div#songResults').hide("blind", {}, "20");
		$('div#songUpdate').hide("blind", {}, "20");
		$('div#artistUpdate').hide("blind", {}, "20");
		$('div#modifArtist').hide("blind", {}, "20");
		$('div#modifChanson').hide("blind", {}, "20");
		var OptionChoisi= $(Balise).val(); 
			
		
		//ClassBalise = $(Balise).attr("class"),
		IDBalise = $(Balise).attr("id");
		parametres = 'artists&letter='+OptionChoisi; 
		url = './index.php'; 
		//var IDBalise = $(Balise).attr("id");
		//var parametres = 'artists&letter='+OptionChoisi; 
		//var url = './index.php'; 
		
		if (OptionChoisi != null){ 
			
			refresh("artistbyletter", OptionChoisi);
			//alert(OptionChoisi);
			/*
			$.ajax({
					type: "GET", 
					url: url, 
					dataType: "json", 
					contentType: "application/json; charset=utf-8",
					success : AfficheSuccessArtist,
					data: parametres, 
					error: AfficheErreur 
				})
			
			*/
			/*
			var items = [];
			//items.push('<select id="artistSelect">');
			 
			$.getJSON('./index.php?artists&letter=' + OptionChoisi, function (data){
				//alert('./index.php?artists&letter=' + OptionChoisi);
				//alert(OptionChoisi);
				
				//alert(data[0]["multipleArtists"][1]["artist_name"]);
				
				
				
				$.each(data[0]["multipleArtists"], function(key) {
					 items.push('<option value="' + data[0]["multipleArtists"][key].id_artist + ' ">' + data[0]["multipleArtists"][key].artist_name + '</option>');
					 //document.write(data[key].artist_name + "\r\n");
					 
					 //var reflector = new Reflector(data);
					 //var props = Object.getOwnPropertyNames(data[key])
					 
					 //alert(data.multipleArtists);
					 /*
					 if (key == data.length - 1){
						 alert('Key: ' + key + ' ' + 'data.length - 1: ' + (data.length - 1));						 
						 items.push('</select>');
					 }
					 
				});
			
				
				
					 //alert(items[2].artist_name);
					 /*
					 $('<ul/>', {
					 'class': 'my-new-list',
					 html: items.join('')
					 }).appendTo('body');
					
					//items.push('</select>');			
					AfficheSuccessArtist(items);
			});
			*/
			
			//items.push('</select>');	
			
		}else{
			AfficheErreur();
		}
	}
	
	function selArtistChanged(Balise){
		$('div#songUpdate').hide("blind", {}, "20");
		$('div#modifArtist').hide("blind", {}, "20");
		$('div#modifChanson').hide("blind", {}, "20");
		
		var OptionChoisi= $(Balise).val(); 
		selectedArtistId = OptionChoisi;
		
		IDBalise = $(Balise).attr("id");
		parametres = 'songs&artistId='+OptionChoisi; 
		url = './index.php'; 

		
		if (OptionChoisi != null){ 
			
			refresh("songsperartistid",OptionChoisi);
			/*
			var items = [];

			 
			$.getJSON('./index.php?songs&artistId=' + OptionChoisi, function (data){

				$.each(data[0]["multipleSongs"], function(key) {
					 items.push('<option value="' + data[0]["multipleSongs"][key].id_song + ' ">' + data[0]["multipleSongs"][key].title + '</option>');
	
				});
		
				AfficheSuccessSongs(items);
				$('div#artistUpdate').show("blind", {}, "20");
			});
			*/

			//items.push('</select>');	
			
		}else{
			AfficheErreur();
		}
	}
	
	function refresh(componant,param){
		switch (componant)
			{
		case "songsperartistid":
			var items = [];
			$.getJSON('./index.php?songs&artistId=' + param, function (data){

				$.each(data[0]["multipleSongs"], function(key) {
					 items.push('<option value="' + data[0]["multipleSongs"][key].id_song + '">' + data[0]["multipleSongs"][key].title + '</option>');
	
				});
		
				AfficheSuccessSongs(items);
				$('div#artistUpdate').show("blind", {}, "20");
			});
			break;
		case "artistbyletter":
			var items = [];
			$.getJSON('./index.php?artists&letter=' + param, function (data){

				$.each(data[0]["multipleArtists"], function(key) {
					 items.push('<option value="' + data[0]["multipleArtists"][key].id_artist + '">' + data[0]["multipleArtists"][key].artist_name + '</option>');

				});
			
					AfficheSuccessArtist(items);
			});
			

			break;
		case "songbyid":
			$.getJSON('./index.php?songs&songId=' + param, function (data){
				$('input#txtSongTitle').attr("value", data[0]["singleSong"][0].title);
				
				$lang = data[0]["singleSong"][0].langue;

				if($lang == 'EN'){
					//$('select#selLang')['EN'].attr("selected", true);
					$('select#selLang').val('EN');
				}

				if($lang == 'FR'){
					//$('select#selLang')['FR'].attr("selected", true);
					$('select#selLang').val('FR');
				}
				
				$('input#txtSongDateAdded').attr("value", data[0]["singleSong"][0].date_added);
				$('input#txtSongDateModified').attr("value", data[0]["singleSong"][0].date_modified);

				
			});
			break;
			
		case "artistbyid":
			$.getJSON('./index.php?artists&artistId=' + param, function (data){
				$('input#txtArtistName').attr("value", data[0]["singleArtist"][0].name);
				$('input#txtArtistDateAdded').attr("value", data[0]["singleArtist"][0].date_added);
				$('input#txtArtistDateModified').attr("value", data[0]["singleArtist"][0].date_modified);				
			});
			break;
			}
	}
	
	global_refresh = refresh;
	
	function selSongChanged(Balise){
		//var OptionChoisi= $(Balise).val(); 
		if (!$("div#songUpdate").is(":visible")){
			$("div#songUpdate").show("blind", {}, "20");
		}
		$('div#modifChanson').hide("blind", {}, "20");
	}
	
	function AfficheSuccessArtist(items){
		//var parsed = null;
		//parsed = $.parseJSON(retourSucces);
		//alert(parsed);
		//alert(retourSucces);
		
		//$('select#artistSelect').hide();
		//$('select#artistSelect').css('display', 'none');
		//$('div#artistResults').append("<select>");
		
		$('optgroup#optArtists').html(items);
		$('div#artistResults').show("blind", {}, "20");
		//document.write(items);
		
	}
	
	function AfficheSuccessSongs(items){
		//var parsed = null;
		//parsed = $.parseJSON(retourSucces);
		//alert(parsed);
		//alert(retourSucces);
		
		//$('select#artistSelect').hide();
		//$('select#artistSelect').css('display', 'none');
		//$('div#artistResults').append("<select>");
		if (items.length == 0){
			items.push("<option value='null' disabled>Il n'y a aucune chanson pour cet artiste.</option>");
		}
		$('optgroup#optSongs').html(items);
		$('div#songResults').show("blind", {}, "20");
		//document.write(items);
		
	}
	
	/*
	function AfficheSuccessSongs(retourSucces){
		$('div#songsResults').empty();
		$('div#songsResults').append(retourSucces);
	}
	*/

	function AfficheErreur(){
		alert('Erreur!');
	}
	
	
});