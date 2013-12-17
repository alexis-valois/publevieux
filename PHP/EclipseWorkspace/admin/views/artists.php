
<?php 
   	/*
   	foreach ($data['artists'] as $artist){
		echo '<option value=' . $artist['artist_name'] . '>' . $artist['artist_name'] . "</option>\r\n";
	}
	*/
	$utf8Data;
	$multipleArtists;
	$singleArtist;
	
	//array_push($utf8Data, "multipleArtists");
	//array_push($utf8Data, "singleArtist");
	
	foreach ($data['artists'] as $artist){
		//var_dump( utf8_encode($artist['id_artist']));
		$multipleArtists[] =
										array(
											'id_artist'    	 => $artist['id_artist'],
											'artist_name'	 => $artist['artist_name'],
											'date_added'  	 => $artist['date_added'],
											'date_modified'  => $artist['date_modified']
										);
									
		
		//echo nl2br("RAW : " . $artist['artist_name'] . ", UTF8_Encoded : " . utf8_decode($artist['artist_name']) . "\r\n", false);
	}
	$singleArtist[] = 
										array(
													'id_artist'    	 => $data['artist'][0]['id_artist'],
													'artist_name'	 => $data['artist'][0]['artist_name'],
													'date_added'  	 => $data['artist'][0]['date_added'],
													'date_modified'  => $data['artist'][0]['date_modified']
										);
	
	
	$utf8Data[] = array(
							"multipleArtists" 	=> $multipleArtists,
							"singleArtist"		=> $singleArtist
						);
	
	//echo nl2br("RAW : " . $artist['artist_name'] . ", UTF8_Encoded : " . utf8_decode($artist['artist_name']) . "\r\n", false);
	//var_dump($multipleArtists);
	echo json_encode($utf8Data);
       
?>
