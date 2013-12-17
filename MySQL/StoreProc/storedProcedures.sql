DROP PROCEDURE IF EXISTS updateArtist;
DELIMITER //
CREATE PROCEDURE `updateArtist` (IN pArtistName VARCHAR(70), IN pArtistID INT)
BEGIN
	UPDATE `publevieux_dev`.`artist` SET `artist_name`= pArtistName, `date_modified`= NOW() WHERE `id_artist`= pArtistID;
END//