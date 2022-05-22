<?php
	function isLeapYear($year) {
		if (($year % 4 == 0) && ($year % 100 != 0) || $year % 400 == 0) {
			print("true" . "\n");
			return true;

		} else {
			print("not leap year" . "\n");
			return false;
		}
	}

	function getDayOfTheWeek($year, $month, $day) {
		$lastTwoDigits = $year % 100;
		print($year . " year \n" . "last two digits: " . $lastTwoDigits . "\n");

		$remainder = $lastTwoDigits % 12;
		print("remainder: " . $remainder . "\n");

		$howManyFours = ($remainder - ($remainder % 4)) / 4;
		print("how Many Fours: " . $howManyFours . "\n");

		$howManyTwelve = ($lastTwoDigits - $remainder) / 12;
		print("how Many Twelve: " . $howManyTwelve . "\n");

		if ($month == 1 || $month == 10) {
			$monthCode = 1;		
			if ($month == 1 && isLeapYear($year)) {
				$monthCode = $monthCode - 1;
				print("monthCode - 1 = " . $monthCode . "\n");
			}	
		} elseif ($month == 4 || $month == 7) {
			$monthCode = 0;			
		} elseif ($month == 2 || $month == 3 || $month == 11) {
			$monthCode = 4;	
			if ($month == 2 && isLeapYear($year)) {
				$monthCode = $monthCode - 1;
				print("monthCode - 1 =" . $monthCode . "\n");
			}		
		} elseif ($month == 9 || $month == 12 ) {
			$monthCode = 6;			
		} elseif ($month == 5 ) {
			$monthCode = 2;			
		} elseif ($month == 8 ) {
			$monthCode = 3;			
		} else {
			$monthCode = 5;			
		}
	
		if ($year == 1600 || $year == 2000) {
			$monthCode = $monthCode + 6;
			print("+6: " . $monthCode . "\n");

		} elseif ($year == 1700 || $year == 2100 ) {
			$monthCode = $monthCode + 4;
			print("+4: " . $monthCode . "\n");
		} elseif ($year == 1800) {
			$monthCode = $monthCode + 2;
			print("+2: " . $monthCode . "\n");
		}
		print("month code: " . $monthCode . "\n");
		$week = ["Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Friday"];
		$total = $howManyTwelve + $remainder + $howManyFours + $day + $monthCode;
		print("total number: " . $total . "\n");
		
		$dayOfTheWeek = ($howManyTwelve + $remainder + $howManyFours + $day + $monthCode) % 7;
		print("day Of The Week: " . $week[$dayOfTheWeek] . "\n");
		
	}
	// getDayOfTheWeek(2100, 3, 16);
	getDayOfTheWeek(2022, 5, 22);
	isLeapYear(2022);
?>