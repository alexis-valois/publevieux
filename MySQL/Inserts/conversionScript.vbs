Const ForReading = 1
Const ForAppending = 8

Dim outputFileName '= "PubLeVieuxInsert.sql"
Dim outputBaseNameEN 
outputFileName = "PubLeVieuxInsert.sql"
outputBaseNameEN = "PubLeVieuxInsert - EN"
Dim inputFileFranco '= "listeFranco.txt"
inputFileFranco = "listeFranco.txt"
Dim inputFileAnglo '= "listeAnglo.txt"
inputFileAnglo = "listeAnglo.txt"

Set objFSO = CreateObject("Scripting.FileSystemObject")
Set objOutputFile = objFSO.CreateTextFile(objFSO.GetAbsolutePathName(".") + "/" + outputFileName)
Set objInputFileFranco = objFSO.OpenTextFile(objFSO.GetAbsolutePathName(".") + "/" + inputFileFranco, ForReading)
Set objInputFileAnglo = objFSO.OpenTextFile(objFSO.GetAbsolutePathName(".") + "/" + inputFileAnglo, ForReading)

'Set objOutputFile = objFSO.OpenTextFile(inputFileFranco,ForAppending,True)
objOutputFile.WriteLine("-- ---------------------- FRANCO ---------------------------")
objOutputFile.WriteLine("")

Dim tempArtist
Dim tempSong
Set historiqueArtist = CreateObject("System.Collections.ArrayList")
Do Until objInputFileFranco.AtEndOfStream 'OR counter = 50
	strNextLine = objInputFileFranco.Readline
	arrArtistSong = Split(strNextLine, "-")
	tempArtist = RTrim(LTrim(arrArtistSong(0)))
	'tempArtist = tempArtist.RTrim()
	'tempArtist = tempArtist.LTrim()
	tempSong = RTrim(LTrim(arrArtistSong(1)))
	'tempSong = tempSong.RTrim()
	'tempSong = tempSong.LTrim()
	If (Not historiqueArtist.Contains(tempArtist)) Then
		objOutputFile.WriteLine("INSERT INTO `Artist` (`first_name`,`last_name`,`artist_name`) VALUES (NULL, NULL, '" & formatString(tempArtist) & "');")
		historiqueArtist.add(tempArtist)
	End If
	artistPrecedent = tempArtist
	objOutputFile.WriteLine("INSERT INTO `Song` (`title`,`langue`,`fk_id_artist`,`fk_id_band`) VALUES ('" & formatString(tempSong) & "', 'FR' , (SELECT `id_artist` FROM Artist WHERE `artist_name` = '" & formatString(tempArtist) & "'), NULL);")
Loop
'historiqueArtist.Clear
objInputFileFranco.Close
objOutputFile.Close

Dim counter
Do Until objInputFileAnglo.AtEndOfStream
	Set objOutputFileEN = objFSO.CreateTextFile(objFSO.GetAbsolutePathName(".") & "/" & outputBaseNameEN & counter & ".sql")	
	
		For i = 0 To 5000 
			If (Not objInputFileAnglo.AtEndOfStream) Then
			strNextLine = objInputFileAnglo.Readline
			arrArtistSong = Split(strNextLine, "-")
			tempArtist = RTrim(LTrim(arrArtistSong(0)))
			'tempArtist = tempArtist.RTrim()
			'tempArtist = tempArtist.LTrim()
			tempSong = RTrim(LTrim(arrArtistSong(1)))
			'tempSong = tempSong.RTrim()
			'tempSong = tempSong.LTrim()
				If (Not historiqueArtist.Contains(tempArtist)) Then
					objOutputFileEN.WriteLine("INSERT INTO `Artist` (`first_name`,`last_name`,`artist_name`) VALUES (NULL, NULL, '" & formatString(tempArtist) & "');")
					historiqueArtist.add(tempArtist)
				End If
			artistPrecedent = tempArtist
			objOutputFileEN.WriteLine("INSERT INTO `Song` (`title`,`langue`,`fk_id_artist`,`fk_id_band`) VALUES ('" & formatString(tempSong) & "', 'EN' , (SELECT `id_artist` FROM Artist WHERE `artist_name` = '" & formatString(tempArtist) & "'), NULL);")		
			End If
		Next
	
		counter = counter + 1
		objOutputFileEN.Close
	
Loop
objInputFileAnglo.Close

Function formatString(input)

	formatString = Replace(input,"'","\'")

End Function