#!/bin/bash
#
# ARGS : 
#    1 : Config file for the database being updated
# VARS : 
#    PATCH_FILES : mask for the patch files to be uploaded
#    SQLDB SQLUSER SQLPASS : Mysql configuration
#    LATEST_PATCH_FILE : last applied patch
#

DIR="$(dirname $0)/.."

#### Settings (READ FROM THE FILE IS SECOND ARGUMENT)
CONFIG="$1"

if [ "$CONFIG" == "" ] || [ ! -f "$CONFIG" ]
then
    echo "Please specify the configuration file as first argument"
    exit;
fi

. $CONFIG

if [ "$LATEST_PATCH_FILE" == "" ] || [ "$PATCH_FILES" == "" ]
then
    echo "Please specify LATEST_PATCH_FILE in $CONFIG"
fi

if [ -f "$LATEST_PATCH_FILE" ]
then
    latestpatch=$(cat $LATEST_PATCH_FILE | grep -oE "[0-9]{12}")
else
    echo "The file $LATEST_PATCH_FILE does not exist!";
    exit
fi

echo "Applying patches to $SQLDB"

for f in $PATCH_FILES
do
    fileversion=$(echo $f | grep -oE "[0-9]{12}")
    if [ -n "$fileversion" ] && [ $fileversion -gt $latestpatch ]; 
    then
        echo "Applying $f ..."
        output=$(mysql --user="$SQLUSER" --password="$SQLPASS" $SQLDB < $f 2>&1)
	error=$(echo "$output" | grep -oE "ERROR")
        
        if [ "$error" == "ERROR" ]; then
            echo "SQL ERROR in file $f. Stopping patch execution."
            echo "$output"
	    echo "PATCH:"
            cat $f
            exit
        fi
        echo "$fileversion" > $LATEST_PATCH_FILE 
        echo "... Applied"
    fi
done

echo "All patches are applied"