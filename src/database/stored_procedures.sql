--  stored_procedures.sql
--  Mischa Lehmann
--  ducksourceduckpond.ch
--  Version:1.0
--
--  Stored procedures and functions
--  Require:
--      - Requirement
--
--
--  Licence:
--  You're allowed to edit and publish my source in all of your free and open-source projects.
--  Please send me an e-mail if you'll implement this source in one of your commercial or proprietary projects.
--  Leave this Header untouched!
--
--  Warranty:
--       Warranty void if signet is broken
--  ================== / /===================
--  [   Waranty       / /   Signet          ]
--  =================/ /=====================   
--  !!Wo0t!!
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


