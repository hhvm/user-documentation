#!/bin/sh

FROM=$1
TO=$2

if [ -z "$FROM" -o -z "$TO" ]; then
  cat <<EOF
Usage: $0 <lower bound> <upper bound>

e.g. $0 4 7 would rename sections 04 through 07 to 05 through 08
EOF
  exit 1
fi

for i in $(seq $TO -1 $FROM); do
  if [ $i -lt 10 ]; then
    NAME_PREFIX=0$i
  else
    NAME_PREFIX=$i
  fi
  for file in $NAME_PREFIX*; do
    git mv $file $(echo $file | sed "s/$i/$(($i + 1))/");
  done;
done
