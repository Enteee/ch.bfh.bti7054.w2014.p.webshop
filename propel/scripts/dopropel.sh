#!/bin/bash

if [ ! -e './schema.xml' ]; then
	echo "Run this script ini while pwd is the 'propel' directory"
	echo "Current pwd:$(pwd)"
	exit -1;
fi

propel-gen
propel-gen build-sql
propel-gen sql
propel-gen insert-sql
propel-gen convert-conf

