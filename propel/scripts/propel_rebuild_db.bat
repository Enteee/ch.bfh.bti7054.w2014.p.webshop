cd ..

: remove old generated config
del "..\conf\propel-codeshop-classmap.php"
del "..\conf\propel-codeshop-conf.php"

: remove old generated sql
del "..\sql\schema.sql"
del "..\sql\sqldb.map"

: remove old generated classes
rmdir /Q /S "..\model\codeshop\map"
rmdir /Q /S "..\model\codeshop\om"

: rebuild
call "..\vendor\propel\propel1\generator\bin\propel-gen.bat" om
call "..\vendor\propel\propel1\generator\bin\propel-gen.bat" convert-conf
call "..\vendor\propel\propel1\generator\bin\propel-gen.bat" sql
call "..\vendor\propel\propel1\generator\bin\propel-gen.bat" insert-sql

pause