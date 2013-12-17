<?php echo $data['header'];?>
<?php echo $data['rightPanel'];?>
<div class="centerBox">
<h1>Song Manager</h1>
<h2>Page de gestion des chansons et des artistes</h2>
<hr/>
<br />

	<div id="tabs">
	
	<ul>
        <li><a href="#fragment-1"><span>Naviguer</span></a></li>
        <li><a href="#fragment-2"><span>Rechercher</span></a></li>
        <li><a href="#fragment-3"><span>Ajouter</span></a></li>
        <li><a href="#fragment-4"><span>Corbeil</span></a></li>
    </ul>
    
    <div id="fragment-1">
    	<table cellspacing="0" cellpadding="0" border="0">
    		<tr>
    			<td>
					<span>Ordre Alphabétique des Artistes : </span><br />
					<select id="sMgr_artist" class="resultBox">
						<option value="null" disabled selected>---Veuillez choisir une lettre</option>
						<option value="all">Tout les artistes</option>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="C">C</option>
						<option value="D">D</option>
						<option value="E">E</option>
						<option value="F">F</option>
						<option value="G">G</option>
						<option value="H">H</option>
						<option value="I">I</option>
						<option value="J">J</option>
						<option value="K">K</option>
						<option value="L">L</option>
						<option value="M">M</option>
						<option value="N">N</option>
						<option value="O">O</option>
						<option value="P">P</option>
						<option value="Q">Q</option>
						<option value="R">R</option>
						<option value="S">S</option>
						<option value="T">T</option>
						<option value="U">U</option>
						<option value="V">V</option>
						<option value="W">W</option>
						<option value="X">X</option>
						<option value="Y">Y</option>
						<option value="Z">Z</option>
					</select>
				</td>
					
				<td>
					<div id="langSel">
						<span>Langue : </span><br />
						<form>
							<input name="lang" type="radio" value="FR">Française
							<input name="lang" type="radio" value="EN">Anglaise
							<input name="lang" type="radio" value="BIL" checked>Bilingue
						</form>
					</div>
				</td>
			</tr>
		</table>
		<table cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td>
				<div id="artistResults" class="resultBox">
					<select id="artistSelect" size="20" class="resultBox">
					<optgroup id="optArtists" label="Liste des Artistes">
					</optgroup>
					</select>
				</div>
				</td>
				<td width="100"></td>
				<td>
					<div id="songResults" class="resultBox">
						<select id="songSelect" size="20" class="resultBox">
						 <optgroup id="optSongs" label="Liste des chansons">
						 </optgroup>
						</select>
					</div>
				</td>
			</tr>
		</table>
		
		
		<table cellspacing="0" cellpadding="0" border="0">
		<tr>
		<td width="350">
			<div id="artistUpdate">
			
			<input type="button" id="UpdateArtist" name="button">
			
			
			<script>
		
			$( "#UpdateArtist" ).button(
										{
											label: "Modifier l'Artist"
										});
	
		
			</script>
			</div>
		</td>
		
		<td width="100"></td>
		
		<td width="350">
			<div id="songUpdate">
			
			
			<input type="button" id="UpdateSong" name="button">
			
			
			<script>
		
			$( "#UpdateSong" ).button(
										{
											label: "Modifier la chanson"
										});
		
		
			</script>
			</div>
		</td>
		
		</tr>
		</table>
		
		<script>
			$("#UpdateArtist").click(function( event ) {
				if ($("#modifChanson").is(":visible")){
					$("#modifChanson").hide("blind", {}, "20");
				}
				
				$("#modifArtist").show("blind", {}, "20");
				//updateInfoArtist($("#artistSelect").val());
				$.getJSON('./index.php?artists&artistId=' + $("#artistSelect").val(), function (data){
					$('input#txtArtistName').attr("value", data[0]["singleArtist"][0].artist_name);
					$('input#txtArtistDateAdded').attr("value", data[0]["singleArtist"][0].date_added);
					$('input#txtArtistDateModified').attr("value", data[0]["singleArtist"][0].date_modified);
				});
				
			
			});

			$("#UpdateSong").click(function( event ) {

				if ($("#modifArtist").is(":visible")){
					$("#modifArtist").hide("blind", {}, "20");
				}

				global_refresh("songbyid", $("#songSelect").val());

				$("#modifChanson").show("blind", {}, "20");
			
				
				/*
				$.getJSON('./index.php?songs&songId=' + $("#songSelect").val(), function (data){
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
				*/
			
			});
		</script>
		
		
		<div id="modifArtist">
			<fieldset>
				<legend>Mise à jour de l'Artiste</legend>
					<label>Nom de l'artiste : </label><input type="text" id="txtArtistName" class="txtField">
					<label>Date d'ajout : </label><input type="text" id="txtArtistDateAdded" class="txtField" disabled>
					<label>Date de la dernière modification : </label><input type="text" id="txtArtistDateModified" class="txtField" disabled>
					
					<div class="btnUpdate">
						<input id="btnUpdateArtist">
						<input id="btnAnnulerUpdateArtist">
						<input id="btnSupprimerArtist">
					</div>
			</fieldset>
		</div>
		
		<script>
		$('input#btnUpdateArtist').button(
				{
					label: "Mettre à jour"
				});
		$('input#btnAnnulerUpdateArtist').button(
				{
					label: "Annuler"
				});
		$('input#btnSupprimerArtist').button(
				{
					label: "Supprimer l'Artist"
				});

		$('input#btnUpdateArtist').click(function( event ) {
			//alert("Mapping Event BTN ARTIST UPDATE");
			$( "#dialogUpdateArtist" ).dialog( "open" );
		});

		$("input#btnAnnulerUpdateArtist").click(function( event ) {
			//alert('Mapping Event BTN ARTIST CANCEL');
			$("#modifArtist").hide("blind", {}, "20");
		});
			
		</script>
		
		<div id="modifChanson">
			<fieldset>
				<legend>Mise à jour de la chanson</legend>
					<label>Titre : </label><input type="text" id="txtSongTitle" class="txtField">
					<label>Langue : </label><select id="selLang" class="txtFieldSel"><option value="EN">Anglaise</option><option value="FR">Française</option></select>
					<label>Date d'ajout : </label><input type="text" id="txtSongDateAdded" class="txtField" disabled>
					<label>Date de la dernière modification : </label><input type="text" id="txtSongDateModified" class="txtField" disabled>
					
					<div class="btnUpdate">
						<input id="btnUpdateChanson">
						<input id="btnAnnulerUpdateChanson">
						<input id="btnChangerArtist">
						<input id="btnSupprimerChanson">
					</div>
					
			</fieldset>
		</div>
		
		<script>
		$('input#btnUpdateChanson').button(
				{
					label: "Mettre à jour"
				});
		$('input#btnAnnulerUpdateChanson').button(
				{
					label: "Annuler"
				});

		$('input#btnChangerArtist').button(
				{
					label: "Changer l'Artiste"
				});
		$('input#btnSupprimerChanson').button(
				{
					label: "Supprimer la chanson"
				});

		$("input#btnUpdateChanson").click(function( event ) {
			alert('Mapping Event BTN Chanson UPDATE');
		});

		$("input#btnAnnulerUpdateChanson").click(function( event ) {
			//alert('Mapping Event BTN Chanson CANCEL');
			$("#modifChanson").hide("blind", {}, "20");
			
		});
		
		</script>
		
		<div id="dialogUpdateArtist" title="Confirmation de la mise à jour">Voulez-vous vraiment procéder à la mise à jour de l'Artiste ?</div>
		
		<script>
			$( "#dialogUpdateArtist" ).dialog({ 
				autoOpen: false,
				draggable: false,
				resizable: false,
				show: "blind",
				hide: "blind", 
				modal: true,
				width: 530,
				buttons: [ 

							{
								text: "Oui", 
								click: function() 
									{ 
										//$( this ).dialog( "close" ); 
										var artist = { "id_artist": $('select#artistSelect').val() , "artist_name": $('input#txtArtistName').val()};
										
										$.ajax({
										    type: "POST",
										    url: "./index.php?songManager",
										    // The key needs to match your method's input parameter (case-sensitive).
										    data: {updatedArtist: JSON.stringify(artist)},
										    //contentType: "application/json; charset=utf-8",

										    beforeSend: function(x) {
									            if (x && x.overrideMimeType) {
									              x.overrideMimeType("application/json;charset=UTF-8");
									            }
										    },
										    
										    success: function(data){
											      	$( this ).dialog( "close" );
											      	//alert(data);
											      	//global_refresh('artistbyid', $('select#artistSelect').val());
											    },
										    failure: function(errMsg) {
										        alert(errMsg);
										    }
										});
										$( this ).dialog( "close" );
										$("#modifArtist").hide("blind", {}, "20");
										$('div#songResults').hide("blind", {}, "20");
										global_refresh("artistbyletter", $("#sMgr_artist").val());
										
									}
							},
							
							{
								text: "Non", 
								click: function() 
									{ 
										$( this ).dialog( "close" ); 
									}
							}
							
						]
			
				});
		</script>
	
    </div>
    
     <div id="fragment-2">
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
    </div>
    
    <div id="fragment-3">
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
    </div>
    
    <div id="fragment-4">
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
    </div>
	
	<script>
		$( "#tabs" ).tabs();
	</script>
	
	</div>
</div>
<?php echo $data['footer'] ;?>
