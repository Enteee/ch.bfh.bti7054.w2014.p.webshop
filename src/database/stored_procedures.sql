--	stored_procedures.sql
--	Mischa Lehmann
--	ducksourceduckpond.ch
--	Version:1.0
--
--	Stored procedures and functions
--	Require:
--		- Requirement
--
--
--	Licence:
--	You're allowed to edit and publish my source in all of your free and open-source projects.
--	Please send me an e-mail if you'll implement this source in one of your commercial or proprietary projects.
-- 	Leave this Header untouched!
--
--	Warranty:
--       Warranty void if signet is broken
-- 	================== / /===================
-- 	[	Waranty	  / /	Signet 		]
--	=================/ /=====================	
--	!!Wo0t!!
--

-- =====================
-- get a random string with the given length (maximum 255 caracters)
delimiter //

DROP FUNCTION IF EXISTS getrndstring //

CREATE FUNCTION getrndstring (len SMALLINT)
 RETURNS VARCHAR(255)
 NOT DETERMINISTIC
 NO SQL
 COMMENT 'Compute a random string'

	BEGIN
		DECLARE RandomID varchar(255);
		DECLARE counter smallint;
		DECLARE RandomNumber float;
		DECLARE RandomNumberInt tinyint;
		DECLARE CurrentCharacter varchar(1);
		DECLARE ValidCharacters varchar(255);
		DECLARE ValidCharactersLength int;

		SET ValidCharacters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		SET ValidCharactersLength = CHAR_LENGTH(ValidCharacters);
		SET CurrentCharacter = '';
		SET RandomNumber = 0;
		SET RandomNumberInt = 0;
		SET RandomID = '';

		SET counter = 0;

		WHILE counter < len DO
			SET RandomNumber = Rand();
			-- Get a random index between 1 and ValidCaractersLength
			SET RandomNumberInt = CAST((RandomNumber*(ValidCharactersLength-1)) AS UNSIGNED INTEGER)+1; 

			SELECT SUBSTRING(ValidCharacters, RandomNumberInt, 1) INTO CurrentCharacter;

			SET RandomID = CONCAT(RandomID,CurrentCharacter);

			SET counter = counter + 1;

		END WHILE;

		RETURN RandomID;
	END//

delimiter ;

-- =====================
-- start holding something
delimiter //

DROP PROCEDURE IF EXISTS holdit //

CREATE PROCEDURE holdit (IN Type VARCHAR(15),OUT Aid VARCHAR(4),OUT Id INT)
 NOT DETERMINISTIC
 CONTAINS SQL
 COMMENT 'Start holding something'
 BEGIN
	DECLARE result INT;
	DECLARE tries INT;
	DECLARE max_tries INT;

	-- DEFINES
	SET max_tries = 100;

	-- INIT
	SET tries = 0;

	-- get a free Access_id
	REPEAT
		SET Aid = getrndstring(4);
		SET tries = tries +1;
		SELECT count(*) FROM StuffToHold WHERE Access_id = Aid INTO result;
	UNTIL result = 0 AND tries < max_tries
	END REPEAT;

	IF tries = max_tries THEN
		-- to many tries
		SET Aid = "ERRO";
		SET Id = 0;
	ELSE
		-- everything worked fine
		-- register somethind new to hold
		INSERT INTO StuffToHold SET 
			Access_id = Aid,
			Type = Type,
			Time = NOW();

		-- get the id
		SELECT LAST_INSERT_ID() INTO Id;
	END IF;
 END//

delimiter ;


-- =====================
-- start get me something back
delimiter //

DROP PROCEDURE IF EXISTS getit //

CREATE PROCEDURE getit (IN Aid VARCHAR(4),OUT GetId INT,OUT GetType VARCHAR(50),OUT GetTime TIMESTAMP)
 NOT DETERMINISTIC
 CONTAINS SQL
 COMMENT 'Get me something back'
 BEGIN	
	-- select data
	SELECT Id,Type,Time FROM StuffToHold
	WHERE
		Access_id = Aid
	Limit 1
	INTO GetId,GetType,GetTime;

	-- update that dataset
	UPDATE StuffToHold
	SET
		Last_Access = NOW(),
		Access_Count = Access_Count+1
	WHERE
		Id = GetId;

 END//

delimiter ;


-- =====================
-- add mime-type (If not exist) and return Foreign key
delimiter //

DROP FUNCTION IF EXISTS addmime //

CREATE FUNCTION addmime (SetMimeType VARCHAR(200))
 RETURNS INT
 DETERMINISTIC
 CONTAINS SQL
 COMMENT 'add mime-type'
 BEGIN
	DECLARE MimeCount INT;
	DECLARE MimeId INT;

	-- Does the mimetype already exist?
	SELECT COUNT(*) AS COUNT, Id FROM MimeTypes
	WHERE 
		MimeType = SetMimeType
	INTO 
		MimeCount, MimeId;

	-- no?
	IF MimeCount = 0 THEN
		-- add mime type
		INSERT INTO MimeTypes SET
			MimeType = SetMimeType,
			Icon = DEFAULT;

		-- get id of the last insert
		SELECT LAST_INSERT_ID() AS Id
		INTO
			MimeId;
	END IF;

	RETURN MimeId; 
 END//

delimiter ;

-- =====================
-- hold a file please
delimiter //

DROP PROCEDURE IF EXISTS holdfile //

CREATE PROCEDURE holdfile (IN SetFilename VARCHAR(100),IN SetFilesize INT,IN SetMIME VARCHAR(200),OUT Aid VARCHAR(4),OUT Status INT)
 NOT DETERMINISTIC
 CONTAINS SQL
 COMMENT 'Hold a file'
 BEGIN
	DECLARE StuffToHold_Id INT;

	-- Set Status to not successful
	SET Status = -1;

	IF SetFilesize > 0 THEN
		-- Start holding
		CALL holdit ('File',Aid,StuffToHold_Id);

		-- was successful holdit request?
		IF Aid != "ERRO" AND StuffToHold_Id != 0 THEN
			-- write FileInformation
			INSERT INTO FileInformation SET 
				FK_StuffToHold_Id = StuffToHold_Id,
				Filename = SetFilename,
				Filesize = SetFilesize,
				FK_MimeTypes_Id = addmime(SetMIME);
			SET Status = 1;
		END IF;

	END IF;

 END//

delimiter ;

-- =====================
-- Get used space of all files
delimiter //

DROP FUNCTION IF EXISTS used_space //

CREATE FUNCTION used_space ()
 RETURNS INT
 NOT DETERMINISTIC
 NO SQL
 COMMENT 'Get the used space of all the data'

	BEGIN
		DECLARE used INT;
		SELECT SUM(Filesize) FROM FileInformation INTO used;
		
		IF used IS NULL THEN
			SET used = 0;
		END IF;

		RETURN used;
	END//

delimiter ;

-- =====================
-- get a file
delimiter //

DROP PROCEDURE IF EXISTS getfile //

CREATE PROCEDURE getfile (IN StuffToHold_Id INT,OUT GetFilename VARCHAR(100),OUT GetFilesize INT,OUT GetMime VARCHAR(200),OUT GetMimeIcon VARCHAR(100))
 NOT DETERMINISTIC
 CONTAINS SQL
 COMMENT 'Get a file'
 BEGIN
	SELECT 
		Filename,
	 	Filesize,
		MIME,
		Icon
	FROM allfiles
	WHERE
		FK_StuffToHold_Id = StuffToHold_Id
	LIMIT 1
	INTO
		GetFilename, GetFilesize, GetMime, GetMimeIcon;

 END//

delimiter ;


-- =====================
-- Open a new Desk
delimiter //

DROP PROCEDURE IF EXISTS opendesk //

CREATE PROCEDURE opendesk (OUT Aid VARCHAR(4),OUT Status INT)
 NOT DETERMINISTIC
 CONTAINS SQL
 COMMENT 'Open a new Desk'
 BEGIN
	DECLARE StuffToHold_Id INT;

	-- Set Status to not successful
	SET Status = -1;

	-- Hold a new desk
	CALL holdit ('Desk',Aid,StuffToHold_Id);

	-- was successful holdit request?
	IF Aid != "ERRO" AND StuffToHold_Id != 0 THEN
		-- set status to success	
		SET Status = 1;
	END IF;

 END//

delimiter ;

-- =====================
-- Add a hold to a desk
-- Status -2 : Invalid Desk_Access_Id / Desk not found
-- Status -1 : Invalid Hold_Access_Id / Hold not found
delimiter //

DROP PROCEDURE IF EXISTS holdtodesk //

CREATE PROCEDURE holdtodesk (IN Desk_Aid VARCHAR(4),IN Hold_Aid VARCHAR(4),OUT Status INT)
 DETERMINISTIC
 CONTAINS SQL
 COMMENT 'Add hold to desk'
 BEGIN
	DECLARE Desk_Id INT;
	DECLARE StuffToHold_Id INT;

	-- Set to default values
	SET Desk_Id = 0;
	SET StuffToHold_Id = 0;

	-- Set Status to not successful (There is no desk)
	SET Status = -2;
	
	-- Select the Id of the Desk
	SELECT Id FROM StuffToHold
	WHERE
		Access_id = Desk_Aid AND
		Type = 'Desk'
	LIMIT 1
	INTO
		Desk_Id;

	IF Desk_Id > 0 THEN
		-- Set Status to not successful (There is no Hold)
		SET Status = -1;

		-- Select the Id of the hold
		SELECT Id FROM StuffToHold
		WHERE
			Access_id = Hold_Aid
		LIMIT 1
		INTO
			StuffToHold_Id;

		IF StuffToHold_Id > 0 THEN			
			-- Set hold to desk
			INSERT INTO StuffToHold_to_Desk SET
				FK_StuffToHold_Id = StuffToHold_Id,
				FK_Desk_Id = Desk_Id;

			-- Set Status to success
			SET Status = 1;	

		END IF;
	END IF;

 END//

delimiter ;

