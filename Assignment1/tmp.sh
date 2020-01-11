#!/bin/bash

wget -qO data "http://www.espncricinfo.com/india/content/player/country.html?country=6"

sed -n -e '/<div id="rectPlyr_Playerlistodi" style="display: none; visibility: hidden;">/,/<\/div>/p' data | grep '<td' > players
touch project1.csv

while IFS= read -r line; do
	player=`echo "$line" | sed -n 's:.*>\(.*\)</a>.*:\1:p'`
	link=`echo "$line" | sed -n 's:.*href="\(.*\)">.*:\1:p'`
	link="http://www.espncricinfo.com$link"
	wget -qO data1 "$link"
	aver=`grep -A 7 "ODI" data1 | head -n 7 | tail -n 1 | sed -n 's:.*<td nowrap="nowrap">\(.*\)</td>.*:\1:p'`
	if [[ $aver != "" ]]
	then
		echo "$player, India, $aver" >> project1.csv
	fi
done < players

