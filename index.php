<?php
	function isLeapYear($year) {
		if (($year % 4 == 0) && ($year % 100 != 0) || $year % 400 == 0) {
			return true;
		} else {
			return false;
		}
	}

	function getDayOfTheWeek($year, $month, $day) {
		$lastTwoDigits = $year % 100;
		print("last two digits: " . $lastTwoDigits . "\n");

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
				print("-1 = " . $monthCode . "\n");
			}	
		} elseif ($month == 4 || $month == 7) {
			$monthCode = 0;			
		} elseif ($month == 2 || $month == 3 || $month == 11) {
			$monthCode = 4;	
			if ($month == 2 && isLeapYear($year)) {
				$monthCode = $monthCode - 1;
				print("-1 =" . $monthCode . "\n");
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
		$week = ["Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Friday"];
		$dayOfTheWeek = ($howManyTwelve + $remainder + $howManyFours + $day + $month) % 7;
		print("day Of The Week: " . $week[$dayOfTheWeek] . "\n");
		
	}
	// test getDayOfTheWeek
	getDayOfTheWeek(1600, 1, 16);

	// test isLeapYear
	// echo "1996" . "\n";
	// isLeapYear(1996);
	// echo "\n";

	// echo "2000" . "\n";
	// isLeapYear(2000);
	// echo "\n";

	// echo "2012" . "\n";
	// isLeapYear(2012);
	// echo "\n";

	// echo "1900" . "\n";
	// isLeapYear(1900);
	// echo "\n";

	// echo "2011" . "\n";
	// isLeapYear(2011);
	// echo "\n";

?>