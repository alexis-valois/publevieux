<?php 
/*
$utf8Data = array();
foreach ($data['songs'] as $song){
	$utf8Data[] = array(
						'id_song'    	 => utf8_encode($song['id_song']),
						'title'      	 => utf8_encode($song['title']),
						'langue'     	 => utf8_encode($song['langue']),
						'date_added' 	 => utf8_encode($song['date_added']),
						'date_modified'  => utf8_encode($song['date_modified'])
						);
}
echo json_encode($utf8Data);
*/
$utf8Data;
$multipleSongs;
$singleSong;

foreach ($data['songs'] as $song){

$multipleSongs[] =
	array(
			'id_song'    	 => $song['id_song'],
			'title'			 => $song['title'],
			'langue'		 => $song['langue'],
			'date_added'  	 => $song['date_added'],
			'date_modified'  => $song['date_modified']
	);
		
}
$singleSong[] =
array(
		'id_song'    	 => $data['song'][0]['id_song'],
		'title'			 =>	$data['song'][0]['title'],
		'langue'		 => $data['song'][0]['langue'],
		'date_added'  	 => $data['song'][0]['date_added'],
		'date_modified'  => $data['song'][0]['date_modified']
);


$utf8Data[] = array(
		"multipleSongs" 	=> $multipleSongs,
		"singleSong"		=> $singleSong
);

echo json_encode($utf8Data);
 
?>


