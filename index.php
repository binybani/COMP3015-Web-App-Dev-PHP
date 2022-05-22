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
		$remainder = $lastTwoDigits % 12;
		$howManyFours = ($remainder - ($remainder % 4)) / 4;
		$howManyTwelve = ($lastTwoDigits - $remainder) / 12;

		if ($month == 1 || $month == 10) {
			$monthCode = 1;		
			if ($month == 1 && isLeapYear($year)) {
				$monthCode = $monthCode - 1;
			}	
		} elseif ($month == 4 || $month == 7) {
			$monthCode = 0;			
		} elseif ($month == 2 || $month == 3 || $month == 11) {
			$monthCode = 4;	
			if ($month == 2 && isLeapYear($year)) {
				$monthCode = $monthCode - 1;
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
	
		$firstTwoDigits = substr($year, 0, 2);
		if ($firstTwoDigits == 16 || $firstTwoDigits == 20) {
			$monthCode = $monthCode + 6;
		} elseif ($firstTwoDigits == 17 || $firstTwoDigits == 21) {
			$monthCode = $monthCode + 4;
		} elseif ($firstTwoDigits == 18) {
			$monthCode = $monthCode + 2;
		}

		$week = ["Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday" , "Friday"];
		$total = $howManyTwelve + $remainder + $howManyFours + $day + $monthCode;		
		$dayOfTheWeek = ($howManyTwelve + $remainder + $howManyFours + $day + $monthCode) % 7;
		return $week[$dayOfTheWeek];
		// print(" is a " . $week[$dayOfTheWeek]);		
	}

	function makeCalendar($year) {
		$months = range(1,12);
		foreach ($months as $month) {
			if ($month == 1 || $month == 3 ||$month == 5 || $month == 7 || $month == 9 || $month == 10 || $month == 12) {
				$days = range(1, 31);
			} elseif($month == 4 || $month == 6 ||$month == 9 || $month == 11) {
				$days = range(1, 30);
			} else {
				if (isLeapYear($year)) {
					$days = range(1, 29);
				} else {
					$days = range(1, 28);
				}
			}
			foreach ($days as $day) {
				$eachWeek = getDayOfTheWeek($year, $month, $day);
				echo "$month" . "-" . "$day" . "-" . "$year" . " is a " . "$eachWeek" . "\n";
			}
		}
	}

	// for each day in 2022
	makeCalendar(2022);
?>