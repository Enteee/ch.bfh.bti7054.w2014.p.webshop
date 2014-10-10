--	views.sql
--	Mischa Lehmann
--	ducksource@duckpond.ch
--	Version:1.0
--
--	Database views
--	Require:
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
-- get all files
DROP VIEW IF EXISTS allfiles;

CREATE VIEW allfiles
 AS SELECT 
	Finfo.Id AS Id,
	Finfo.FK_StuffToHold_Id AS FK_StuffToHold_Id,
	Finfo.Filename AS Filename,
	Finfo.Filesize AS Filesize,
	Mtypes.MimeType as MIME,
	Mtypes.Icon AS Icon
 FROM FileInformation AS Finfo
 	INNER JOIN 
		(MimeTypes AS Mtypes)
 	ON 
		(Finfo.FK_MimeTypes_Id = Mtypes.Id);

-- =====================
-- view on all Desk - Hold relations

DROP VIEW IF EXISTS desktohold;

CREATE VIEW desktohold
 AS SELECT 
	H1.Id AS Desk_Id,
	H2.*
 FROM StuffToHold AS H1 
	INNER JOIN 
		(StuffToHold_to_Desk AS Map,
		StuffToHold AS H2)
	ON 
		(H1.Id = Map.FK_Desk_Id AND H2.Id = Map.FK_StuffToHold_Id);
