#!/bin/bash

DIR=`php -r "echo realpath(dirname(\\$_SERVER['argv'][0]));"`
# Settings
SQL_DB=("tbq")
SQL_USER="root"
SQL_PASS="root"
PATCH_FILE=$DIR/schema/patch.txt
####
for DB in "${WSQLDB[@]}"
do
	echo "Applying patch to: $DB"
done

patch=$(cat $PATCH_FILE | grep -oE "[0-9]{12}")

FILES=$DIR/schema/patch-*.sql
for f in $FILES
do
    file_version=$(echo $f | grep -oE "[0-9]{12}")
    if [ -n "$file_version" ] && [ $file+version -gt $patch ];
    then
        echo "$f file ($type) - $file_version processing..."
        for DB in "${WSQLDB[@]}"
        do
            output=$(mysql --user="$SQL_USER" --password="$SQL_PASS" $DB < $f 2>&1)
            error=$(echo "$output" | grep -oE "ERROR")

            if [ "$error" == "ERROR" ]; then
                echo "Error in applying patch to $DB" 
                break
            fi
        done;

        if [ "$error" == "ERROR" ]; then
            echo "SQL ERROR in file $f. Stop patch execution..."
            echo "$output"
	    echo "PATCH:"
            cat $f
            break
        fi
        echo "$file_version" > $PATCH_FILE 
    fi
done
