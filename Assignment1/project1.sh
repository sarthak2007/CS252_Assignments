#!/bin/bash

while true; do
	printf "\n\n\n"
	printf "1. Press 1 if you want to add data\n2. Press 2 if you want to search data\n"
	printf "3. Press 3 if you want to display data\n4. Press 4 if you want to scrape data\n"
	echo "5. Press 5 if you want to exit"
	read input
	printf "\n\n\n"

	if [ $input -eq 1 ]
	then
		echo "Enter player name"
		read player
		echo "Enter team name"
		read team
		echo "Enter batting average"
		read aver
		if ! [[ "$aver" =~ ^[0-9]+$ ]]
		then
			echo "You had to enter a number"
			# exit 0
		else

			printf "\n"
			output=`awk -F "," -v var="$player" '{ if( $1 == var ) print $0; }' project1.csv`
			if [[ $output == "" ]]
			then
				echo "$player, $team, $aver" >> project1.csv
			else
				awk -F "," -v var1="$player" -v var2=" $team" -v var3=" $aver" '{ if( $1 == var1 ) {$2=var2;$3=var3} print}' OFS=, project1.csv > tmp.csv
				mv tmp.csv project1.csv
			fi
		fi


	elif [ $input -eq 2 ]
	then
		# echo "Enter T if want to search by team or P if by player name"
		# read temp

		# if [[ "$temp" == "T" ]]
		# then
		# 	echo "Enter team name"
		# 	read team
		# 	printf "\n"
		# 	output=`awk -F"," -v var=" $team" '{ if( $2 == var ) print $0; }' project1.csv`
		# 	if [[ $output == "" ]]
		# 	then
		# 		echo "No records found"
		# 	else
		# 		echo "$output"
		# 		lines=`echo "$output" | wc -l`
		# 		if [[ $lines == 1 ]]
		# 		then
		# 			printf "\n"
		# 			echo "Do you want to delete this record? If yes then press Y else N"
		# 			read response
		# 			if [[ "$response" == "Y" ]]
		# 			then
		# 				awk -F "," -v var="$output" '$0 != var' project1.csv > tmp.csv
		# 				mv tmp.csv project1.csv
		# 			fi	
		# 		fi 
		# 	fi


		# elif [[ "$temp" == "P" ]]
		# then
		# 	echo "Enter player name"
		# 	read player
		# 	printf "\n"
		# 	output=`awk -F "," -v var="$player" '{ if( $1 == var ) print $0; }' project1.csv`
		# 	if [[ $output == "" ]]
		# 	then
		# 		echo "No records found"
		# 	else
		# 		echo $output
		# 		printf "\n"
		# 		echo "Do you want to delete this record? If yes then press Y else N"
		# 		read response
		# 		if [[ "$response" == "Y" ]]
		# 		then
		# 			awk -F "," -v var="$output" '$0 != var' project1.csv > tmp.csv
		# 			mv tmp.csv project1.csv
		# 		fi
		# 	fi

		# else
		# 	echo "You had to enter only T or P"
		# fi
		echo "Enter the pattern by which you want to search"
		read temp
		grep -n $temp project1.csv | column -t -s ","
		echo "Do you want to delete any record? If yes then press Y else N"
		read response
		printf "\n\n\n\n"
		if [[ "$response" == "Y" ]]
		then
			echo "Enter line number you want to delete"
			read line
			printf "\n\n\n\n"
			tp=$line"d";
			# echo $tp;
			sed $tp project1.csv > tmp
			mv tmp project1.csv
		fi	

	elif [ $input -eq 3 ]
	then
		# cat project1.csv
		column project1.csv -t -s ","  
	elif [ $input -eq 4 ]
	then
		bash tmp.sh

		
	elif [ $input -eq 5 ]
	then
		exit
	else
		echo "Give correct input"
	fi



done