cd ..

: remove old generated config
del "..\conf\propel-codeshop-classmap.php"
del "..\conf\propel-codeshop-conf.php"

: rebuild
call "..\vendor\propel\propel1\generator\bin\propel-gen.bat" convert-conf

pause