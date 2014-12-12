#!/bin/bash

SQ3_DB="../resource/db.sq3"

if [ ! -e './schema.xml' ]; then
	echo "Run this script ini while pwd is the 'propel' directory"
	echo "Current pwd:$(pwd)"
	exit -1;
fi

if [ -e "${SQ3_DB}" ]; then
	rm "${SQ3_DB}"
fi
propel-gen
propel-gen build-sql
propel-gen sql
propel-gen insert-sql
propel-gen convert-conf
curl http://codeshop.ch/populate
if [ -e "${SQ3_DB}" ]; then
	chmod 777 "${SQ3_DB}"
fi
