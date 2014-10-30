cd "C:\Users\Mathias\Documents\GitHub\ch.bfh.bti7054.w2014.p.webshop\src\database"

: remove build folder
rmdir /Q /S "C:\Users\Mathias\Documents\GitHub\ch.bfh.bti7054.w2014.p.webshop\src\database\build"

: generate schema.xml
call "C:\Users\Mathias\Documents\GitHub\ch.bfh.bti7054.w2014.p.webshop\src\lib\propelorm\generator\bin\propel-gen.bat" . reverse

: generate object model
call "C:\Users\Mathias\Documents\GitHub\ch.bfh.bti7054.w2014.p.webshop\src\lib\propelorm\generator\bin\propel-gen.bat" om

: runtime configuration
call "C:\Users\Mathias\Documents\GitHub\ch.bfh.bti7054.w2014.p.webshop\src\lib\propelorm\generator\bin\propel-gen.bat" convert-conf

pause
