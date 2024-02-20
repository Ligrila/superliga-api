#!/bin/sh

for i in `seq 60`; do # start 30 jobs in parallel
    echo $i
    php statistics.php $i >> output.txt &
done

while [ 1 ]; do fg 2> /dev/null; [ $? == 1 ] && break; done
