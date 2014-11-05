#!/bin/bash

propel-gen
propel-gen build-sql
propel-gen sql
propel-gen insert-sql
propel-gen convert-conf

