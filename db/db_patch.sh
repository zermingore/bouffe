#!/bin/sh


DB_FILE="tmp/$0_tmp.db"

rm -rf ./tmp
mkdir -p tmp

# Create a unmodified DB
echo | sqlite3 -init schema.sql "$DB_FILE" || exit 2

# Creating a patch, redirecting errors
sqlite3 "$DB_FILE" .dump > "${DB_FILE}".dump 2>tmp/dump_err || exit 2


# Dump the currently used DB
sqlite3 db .dump > tmp/db.dump 2>tmp/dump_err || exit 2


# sqldiff "${DB_FILE}" db

diff --minimal --suppress-common-lines "${DB_FILE}".dump tmp/db.dump > tmp/dump_diff
ret=$?
if [ $ret -eq 0 ]; then
  echo "nothing to do"
  exit 0
else
  if [ $ret -ne 1 ]; then
    exit $ret
  fi
fi


mkdir -p ../custom
grep '>' tmp/dump_diff | sed s/'^> '//g > ../custom/db/db.patch

cat ../custom/db/db.patch

if [ -f dump_err ]; then
  echo "__________________________________________________"
  echo "Issues encountered:"
  cat dump_err
fi
