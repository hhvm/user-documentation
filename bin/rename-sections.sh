#!/bin/sh

# To run
# % rename-sections from to
# e.g., 
# % rename-sections 4 7
# would rename 04 through 07 to 05 to 08

FROM=$1
TO=$2

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
